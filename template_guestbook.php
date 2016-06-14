<?php
/*
Template Name: 留言板 - 模板
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
	<div class="content <?php if (get_option('wpyou_sidebar_position') == '1') { echo 'contentl'; } ?>">
        <div class="breadcrumb">
            <?php include (TEMPLATEPATH . '/breadcrumb.php'); ?>
        </div>
        <div class="single page">
                <div class="post_comment">
                    <?php comments_template('/gbcomments.php'); ?>
                </div>
        </div>
    </div>
<?php get_footer(); ?>