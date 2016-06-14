<?php get_header(); ?>
	<div id="main_left">
        <!-- Introduction begin -->
        <div id="aboutus">
			<div class="aboutus_title">
				<h2 class="Container_title"><a href="<?php if ( get_option('wpyou_aboutus_url') ) { ?><?php echo stripslashes(get_option('wpyou_aboutus_url')); ?><?php } else { ?><?php bloginfo('siteurl');?>/about-us/<?php } ?>">企业简介</a></h2>
				<div class="more"><a href="<?php if ( get_option('wpyou_aboutus_url') ) { ?><?php echo stripslashes(get_option('wpyou_aboutus_url')); ?><?php } else { ?><?php bloginfo('siteurl');?>/about-us/<?php } ?>">查看更多 ></a></div>
			</div>
			<div class="aboutus_border">
				<div class="aboutus_cont">
						<?php if ( get_option('wpyou_aboutus') ) { ?>
						<?php echo stripslashes(get_option('wpyou_aboutus')); ?>
						<?php } else { ?>
						请在后台的【 外观 - 当前主题设置 】中添加 企业简介 的内容
						<?php } ?>
				</div>
			</div>
        </div>
        <!-- Introduction end -->
		
		<div id="Product" >
			<div class="product_title">
				<?php if (get_option('wpyou_products_id')) { $productid = get_option('wpyou_products_id'); ?><h2 class="Container_title"><a href="<?php echo get_category_link($productid);?>" title="<?php echo get_cat_name( $productid ); ?>"><?php echo get_cat_name( $productid ); ?></a></h2>
					<?php query_posts('caller_get_posts=1&showposts=6&cat='.$productid); ?>
				<?php } else { ?>        	
					<h2 class="Container_title"><a href="<?php bloginfo('siteurl');?>/category/products">驾校风采</a></h2>
					<?php query_posts('caller_get_posts=1&showposts=6&cat=products'); ?>
				<?php } ?>
				<?php if (get_option('wpyou_products_id')) { $productsid = get_option('wpyou_products_id'); ?>   
					<div class="more"><a href="<?php echo get_category_link( $productsid );?>">查看更多 ></a></div>
				<?php } else { ?>
					<div class="more"><a href="<?php bloginfo('siteurl');?>/category/products">查看更多 ></a></div>
				<?php } ?>
			</div>
			<div class="product_border">
				<ul>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<li><a href="<?php the_permalink() ?>" target="_blank" title="<?php the_title(); ?>"><img src="<?php echo catch_post_image(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" /></a></li>
					<?php endwhile ?>
					<?php endif ?>
				</ul>
			</div>
        </div>
    </div>
	
    <div id="main_right">
        <!-- solution start-->
        <div id="solution">
			<div class="solution_title">
				<?php if (get_option('wpyou_solution_id')) { $solutionid = get_option('wpyou_solution_id'); ?><h2 class="Container_title"><a href="<?php echo get_category_link($solutionid);?>" title="<?php echo get_cat_name( $solutionid ); ?>"><?php echo get_cat_name( $solutionid ); ?></a></h2>
				<?php query_posts('caller_get_posts=1&showposts=10&cat='.$solutionid); ?>
				<?php } else { ?>
				<h2 class="Container_title"><a href="<?php bloginfo('siteurl');?>/category/solution">解决方案</a></h2>
					<?php query_posts('caller_get_posts=1&showposts=10&cat=solution'); ?>
				<?php } ?>
				<?php if (get_option('wpyou_solution_id')) { $solutionid = get_option('wpyou_solution_id'); ?>   
				<div class="more"><a href="<?php echo get_category_link( $solutionid );?>">查看更多 ></a></div>
				<?php } else { ?>
				<div class="more"><a href="<?php bloginfo('siteurl');?>/category/solution">查看更多 ></a></div>
				<?php } ?>
			</div>
			<div class="solution_border">
				<ul class="solutionList">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					  <li><span>[<?php the_time('Y-m-d') ?>]</span><a title="<?php the_title() ?>" href="<?php the_permalink() ?>" target="_blank"><?php the_title() ?></a></li>
					<?php endwhile ?>
				</ul>
					<?php endif ?>
			</div>
        </div>
        <!-- solution end-->
		
        <!-- news start-->
        <div class="solutionList news">
			<div class="news_title">
				<?php if (get_option('wpyou_news_id')) { $newsid = get_option('wpyou_news_id'); ?><h2 class="Container_title"><a href="<?php echo get_category_link($newsid);?>" title="<?php echo get_cat_name( $newsid ); ?>"><?php echo get_cat_name( $newsid ); ?></a></h2>
				<?php query_posts('caller_get_posts=1&showposts=10&cat='.$newsid); ?>
					<?php } else { ?>
					<h2 class="Container_title"><a href="<?php bloginfo('siteurl');?>/category/news">新闻中心</a></h2>                
					<?php query_posts('caller_get_posts=1&showposts=10&cat=news'); ?>
				<?php } ?>
				<?php if (get_option('wpyou_news_id')) { $newsid = get_option('wpyou_news_id'); ?>   
					<div class="more"><a href="<?php echo get_category_link( $newsid );?>">查看更多 ></a></div>
				<?php } else { ?>
					<div class="more"><a href="<?php bloginfo('siteurl');?>/category/news">查看更多 ></a></div>
				<?php } ?>
			</div>
			<div class="news_border">
				<ul>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<li><span>[<?php the_time('Y-m-d') ?>]</span><a title="<?php the_title() ?>" href="<?php the_permalink() ?>" target="_blank"><?php the_title() ?></a></li>
					<?php endwhile ?>
				</ul>
					<?php endif ?>
			</div>
        </div>
        <!-- news end-->
    </div>
	<div id="friendly">
		<div id="friendlink">
			<span class="item"><a href="<?php bloginfo('url'); ?>/links" target="_blank" ref="external nofollow">申请链接：</a></span>
			<ul class="footer_links">
				<?php
					$bookmarks = get_bookmarks('orderby=rand');
					if ( !empty($bookmarks) ) {
						foreach ($bookmarks as $bookmark) {
							echo '<li><a target="_blank" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '">' . $bookmark->link_name . '</a></li>';
						}
					}
				?>
			</ul>
		</div>
	</div>
<?php get_footer(); ?>