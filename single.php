<?php get_header(); ?>
<?php get_sidebar(); ?>
	<div class="content">
        <div class="breadcrumb">
            <?php include (TEMPLATEPATH . '/breadcrumb.php'); ?>
        </div>
        <div class="single page">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php setPostViews(get_the_ID());?>
                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                <div class="meta">
                    <span>发布时间: <?php the_time('Y-m-d H:i'); ?></span>
                    <span>作者: <?php the_author_posts_link(); ?></span>
                    <span>浏览次数: <?php echo getPostViews(get_the_ID()); ?>次</span>
                    <span>字号: <a href="javascript:void(0)" class="mfbig">大</a> <a href="javascript:void(0)" class="mfmid">中</a> <a href="javascript:void(0)" class="mfsml mfcurrent">小</a> </span> 
                    <?php edit_post_link('编辑本文', '', ''); ?>
            	</div>
                <div class="entry">
                    <div class="entrycontent"><?php the_content(''); ?></div>
                </div>
            <div class="postmeta">
                <?php the_tags('<strong>本文标签:</strong> ', ', ', ''); ?>
            </div>
			<div class="meiwen_post_title">
				<?php if (get_next_post($categoryIDS)) { next_post_link('<div class="sxyp_1"><strong>上一篇：</strong>%link</div>','%title',true);} else { echo '<div class="sxyp_1"><strong>上一篇：</strong>已是最新文章</div>';} ?>
				<?php if (get_previous_post($categoryIDS)) { previous_post_link('<div class="sxyp_2"><strong>下一篇：</strong>%link</div>','%title',true);} else { echo '<div class="sxyp_2"><strong>下一篇：</strong>已是最后文章</div>';} ?>					
			</div>
            <div class="related">
            	<h3><?php _e('相关文章'); ?></h3>
                <ul>
                <?php
                    $categories = get_the_category($post->ID);
                    if ($categories) {
                        $category_ids = array();
                        foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                        $args=array(
                            'category__in' => $category_ids,
                            'post__not_in' => array($post->ID),
                            'showposts'=>10, // Number of related posts that will be shown.
                            'caller_get_posts'=>1
                        );
                    $my_query = new wp_query($args);
                        if( $my_query->have_posts() ) {
                            while ($my_query->have_posts()) {
                                $my_query->the_post();
                            ?>
                                <li><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
                            <?php
                            }
                        }
                    } else {
                        echo"<li>暂时没有和本文相关的文章</li>";
                    }
				wp_reset_query();
                ?>
                </ul>
            </div>
            <div class="post_comment">
                <?php comments_template('/gbcomments.php'); ?>
            </div>
			<?php endwhile; else : ?>
            <div class="single">
                <h4>没有找到您要访问的页面</h4>
                <div>抱歉, 没有找到对应的文章, 请您 <a href="<?php bloginfo('siteurl');?>/" class="underline"><strong>返回首页</strong></a> 或在搜索中查找所需的信息.</div>
            </div>
        <?php endif; ?>
        </div>
    </div>
<?php get_footer(); ?>