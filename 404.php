<?php get_header(); ?>
<div id="content-single">
	<div class="tri-col-span right detail-page">
		<div class="cpsAjaxLoaderSingle"></div>
	</div>
	<div class="blog-post">
		<h1><?php _e('404 Page Not Found!','language');?></h1>
			<p><?php _e('Sorry, no results found. Please try another search','language');?></p>
	</div>							
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