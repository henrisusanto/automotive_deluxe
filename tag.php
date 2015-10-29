<?php get_header(); ?>
<div id="sidebar-right">

            	<?php if ( !dynamic_sidebar( __('Sidebar','language') ) ) : ?>

				<?php endif; ?>

			</div>


		<div id="content">
			<div class="tri-col-span">
				<h2 class="search-title">
				<?php if ( is_tag() ) {
					echo 'Tag Result for &quot;'.$tag.'&quot; | ';
				} elseif ( is_archive() ) {
					wp_title(''); echo ' Archive'; 
				} else {
					echo wp_title( '', false, right ); 
				} ?></h2>
				<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
                  	<div class="blog-post">
					<h2><a href="<?php the_permalink() ?>"><?php the_title();?></a></h2>
                    	<?php the_excerpt();?>
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
			<div class="clearfix"></div>
	</div><!--end of container div-->
<?php get_footer(); ?>