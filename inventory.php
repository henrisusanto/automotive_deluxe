<?php
/*
Template Name: Full Inventory
*/
?>
<?php get_header(); ?>
<div id="content-single">
		<?php cps_ajax_search_results(); ?>	
	</div>
	<div id="sidebar-search" > 
		<?php if ( !dynamic_sidebar( __('Search Module','language') ) ) : ?>
		<?php endif; ?>
	</div>
	<div id="sidebar" class="common">
	<?php if ( !dynamic_sidebar( __('Sidebar','language') ) ) : ?>
		<?php endif; ?>
	</div>
	<div class="clearfix"></div>
</div>
<?php get_footer(); ?>