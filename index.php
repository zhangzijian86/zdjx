<?php get_header(); ?>
	<div id="main_left">
        <!-- Introduction begin -->
        <div id="aboutus">
			<div class="aboutus_title">
				<h2 class="Container_title"><a href="<?php if ( get_option('wpyou_aboutus_url') ) { ?><?php echo stripslashes(get_option('wpyou_aboutus_url')); ?><?php } else { ?><?php bloginfo('siteurl');?>/about-us/<?php } ?>">企业简介</a></h2>
				<div class="more"></div>
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
					<h2 class="Container_title"><a href="<?php bloginfo('siteurl');?>/category/products">典型案例</a></h2>
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
        <!-- 工作动态 start-->
        <div id="solution">
			<div class="solution_title">
				<?php if (get_option('wpyou_solution_id')) { $solutionid = get_option('wpyou_solution_id'); ?><h2 class="Container_title"><a href="<?php echo get_category_link($solutionid);?>" title="<?php echo get_cat_name( $solutionid ); ?>"><?php echo get_cat_name( $solutionid ); ?></a></h2>
				<?php query_posts('caller_get_posts=1&showposts=10&cat='.$solutionid); ?>
				<?php } else { ?>
				<h2 class="Container_title"><a href="<?php bloginfo('siteurl');?>/category/solution">工作动态</a></h2>
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
        <!-- 工作动态 end-->
		
        <!-- 技术跟踪 start-->
        <div class="solutionList news">
			<div class="news_title">
				<?php if (get_option('wpyou_news_id')) { $newsid = get_option('wpyou_news_id'); ?><h2 class="Container_title"><a href="<?php echo get_category_link($newsid);?>" title="<?php echo get_cat_name( $newsid ); ?>"><?php echo get_cat_name( $newsid ); ?></a></h2>
				<?php query_posts('caller_get_posts=1&showposts=10&cat='.$newsid); ?>
					<?php } else { ?>
					<h2 class="Container_title"><a href="<?php bloginfo('siteurl');?>/category/news">技术跟踪</a></h2>                
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
        <!-- 技术跟踪 end-->
        <!-- 咨询服务 start-->
        <div id="solution">
			<div class="solution_title">
				<?php if (get_option('wpyou_partner_id')) { $solutionid = get_option('wpyou_partner_id'); ?><h2 class="Container_title"><a href="<?php echo get_category_link($solutionid);?>" title="<?php echo get_cat_name( $solutionid ); ?>"><?php echo get_cat_name( $solutionid ); ?></a></h2>
				<?php query_posts('caller_get_posts=1&showposts=10&cat='.$solutionid); ?>
				<?php } else { ?>
				<h2 class="Container_title"><a href="<?php bloginfo('siteurl');?>/category/solution">咨询服务</a></h2>
					<?php query_posts('caller_get_posts=1&showposts=10&cat=solution'); ?>
				<?php } ?>
				<?php if (get_option('wpyou_partner_id')) { $solutionid = get_option('wpyou_partner_id'); ?>   
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
        <!-- 咨询服务 end-->
		
        <!-- 技术推广 start-->
        <div class="solutionList news">
			<div class="news_title">
				<?php if (get_option('wpyou_new_products')) { $newsid = get_option('wpyou_new_products'); ?><h2 class="Container_title"><a href="<?php echo get_category_link($newsid);?>" title="<?php echo get_cat_name( $newsid ); ?>"><?php echo get_cat_name( $newsid ); ?></a></h2>
				<?php query_posts('caller_get_posts=1&showposts=10&cat='.$newsid); ?>
					<?php } else { ?>
					<h2 class="Container_title"><a href="<?php bloginfo('siteurl');?>/category/news">技术推广</a></h2>                
					<?php query_posts('caller_get_posts=1&showposts=10&cat=news'); ?>
				<?php } ?>
				<?php if (get_option('wpyou_new_products')) { $newsid = get_option('wpyou_new_products'); ?>   
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
        <!-- 技术推广 end-->

        <!-- 教育培训 start-->
        <div id="solution">
			<div class="solution_title">
				<?php if (get_option('wpyou_hot_products')) { $solutionid = get_option('wpyou_hot_products'); ?><h2 class="Container_title"><a href="<?php echo get_category_link($solutionid);?>" title="<?php echo get_cat_name( $solutionid ); ?>"><?php echo get_cat_name( $solutionid ); ?></a></h2>
				<?php query_posts('caller_get_posts=1&showposts=10&cat='.$solutionid); ?>
				<?php } else { ?>
				<h2 class="Container_title"><a href="<?php bloginfo('siteurl');?>/category/solution">教育培训</a></h2>
					<?php query_posts('caller_get_posts=1&showposts=10&cat=solution'); ?>
				<?php } ?>
				<?php if (get_option('wpyou_hot_products')) { $solutionid = get_option('wpyou_hot_products'); ?>   
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
        <!-- 教育培训 end-->
		
        <!-- 主题专栏 start-->
        <div class="solutionList news">
			<div class="news_title">
				<?php if (get_option('wpyou_sliderposts')) { $newsid = get_option('wpyou_sliderposts'); ?><h2 class="Container_title"><a href="<?php echo get_category_link($newsid);?>" title="<?php echo get_cat_name( $newsid ); ?>"><?php echo get_cat_name( $newsid ); ?></a></h2>
				<?php query_posts('caller_get_posts=1&showposts=10&cat='.$newsid); ?>
					<?php } else { ?>
					<h2 class="Container_title"><a href="<?php bloginfo('siteurl');?>/category/news">主题专栏</a></h2>                
					<?php query_posts('caller_get_posts=1&showposts=10&cat=news'); ?>
				<?php } ?>
				<?php if (get_option('wpyou_sliderposts')) { $newsid = get_option('wpyou_sliderposts'); ?>   
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
        <!-- 主题专栏 end-->
    </div>
	<div id="friendly">
		<div id="friendlink">
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
