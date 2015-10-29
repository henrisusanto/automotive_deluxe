<?php get_header(); ?>
<div id="content-single">
<div class="tri-col-span right detail-page">
<div class="cpsAjaxLoaderSingle">   	
</div>
	</div>
		<?php cps_ajax_search_results(); ?>
		 
			<div class="tri-col-span hideOnSearch">
				<h2 class="search-title">
				<?php if ( is_tag() ) {
						 __( 'Tag Archives: %s', 'language' );
				} elseif ( is_archive() ) {
					wp_title(''); __(' Category','language'); 
				} else {
					echo wp_title( '', false, right ); 
				} ?></h2>
				<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
                  	<div class="blog-post">
					<h1><a href="<?php the_permalink() ?>"><?php the_title();?></a></h1>
					<?php if(has_post_thumbnail()) {  the_post_thumbnail('featured');} ?>
                    	<?php the_content();?>
					</div>
				<?php 
					endwhile;
					else:
				?>
					<div class="no-post">
						<h3><?php _e('No, Results Found','language');?></h3>
						<p><?php _e('Sorry, No Posts found!','language');?></p>
					</div>
				<?php endif;?>
				<?php theme_pagination( $wp_query->max_num_pages); ?>
			</div>			
		</div><!--end of content div-->
		
		<div id="sidebar-search" > 
		<?php if ( !dynamic_sidebar( __('Search Module','language') ) ) : ?>
				<?php endif; ?>
				</div>
		<div id="sidebar" class="common">

        <?php if ( !dynamic_sidebar( __('Sidebar','language') ) ) : ?>

				<?php endif; ?>

			</div>	
		<div class="clearfix"></div>
	</div><!--end of container div-->
<?php get_footer(); ?>