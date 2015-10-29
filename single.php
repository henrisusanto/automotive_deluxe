<?php get_header(); ?>
	<div id="content-single">
		<div class="tri-col-span right detail-page">
			<div class="cpsAjaxLoaderSingle"></div>
		</div>
		<?php cps_ajax_search_results(); ?>
		<div class="tri-col-span hideOnSearch">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div class="blog-post">
					<h1><a href="<?php the_permalink() ?>"><?php the_title();?></a></h1>
						<?php if(has_post_thumbnail()) {  the_post_thumbnail('featured');} ?>
						<?php the_content();?>
				</div>
			<?php endwhile; ?>				
			<?php comments_template(); ?>
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