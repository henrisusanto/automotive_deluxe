<?php
/*
Template Name: News
*/

?>
<?php get_header(); ?>
	<div id="content-single">
		<div class="tri-col-span right detail-page">
			<div class="cpsAjaxLoaderSingle"></div>
		</div>
		<?php cps_ajax_search_results(); ?>
			<div style="border-bottom:none;" class="detail-page-content hideOnSearch">
				<?php 					
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$the_query = new WP_Query( 'post_type=post&paged='.$paged.'' );
					while ( $the_query->have_posts() ) : $the_query->the_post();
					global $more;
					$more = 0;
					?>	
                  	<div class="blog-post">                 	 
						<h1><a href="<?php the_permalink() ?>"><?php the_title();?></a></h1>	
					<?php if ( has_post_thumbnail() ) { the_post_thumbnail('featured'); } ?>
						<?php the_content(__('Full Article...','language')); ?>
					</div>
				<?php endwhile;wp_reset_postdata();?>
				<?php theme_pagination( $the_query->max_num_pages); ?>	
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