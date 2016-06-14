<div class="sidebar <?php if (get_option('wpyou_sidebar_position') == '1') { echo 'sidebarr'; } ?>">
    <ul>
    	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('侧边栏') ) : ?>
    	<?php endif; ?>
    </ul>
</div>