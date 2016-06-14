<?php
/*
Template Name: 友情链接
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
	<div class="content <?php if (get_option('wpyou_sidebar_position') == '1') { echo 'contentl'; } ?>">
        <div class="breadcrumb">
            <?php include (TEMPLATEPATH . '/breadcrumb.php'); ?>
        </div>
        <div class="single page">
				<div class="textbox_content">
					<p>一、友情链接申请后，请将本站链接加入到贵站友情链接之中，快速交换链接QQ：286959750</p>
					<p>二、首页文字链接互换条件是PR及权重对等，搜索引擎收录正常，同等位置投放我方网站文字链接</p>
					<p>三、本站链接名称：<a href="<?php bloginfo('siteurl'); ?>/"><?php bloginfo('name'); ?></a></p>
					<p>四、本站链接地址：<a href="<?php bloginfo('siteurl'); ?>/"><?php bloginfo('siteurl'); ?>/</a></p>
					<p>做好本站链接后请在本页面留言，我们会在1-3个工作日之内添加上你的链接。</p>
				</div>		
				<div class="links_content">
					<ul>
						<?php
							$bookmarks = get_bookmarks('orderby=rand');
							if ( !empty($bookmarks) ) {
								foreach ($bookmarks as $bookmark) {
									echo '<li class="linkpage"><a target="_blank" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '">' . $bookmark->link_name . '</a></li>';
								}
							}
						?>
					</ul>
				</div>
                <div class="post_comment">
                    <?php comments_template('/gbcomments.php'); ?>
                </div>
        </div>
    </div>
<?php get_footer(); ?>