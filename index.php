<?php get_header(); ?>
	<div id="content">	
		<?php  if (is_front_page()){ get_template_part('includes/slider');} ?> 
			<span id="results"></span>
			<?php cps_ajax_search_results(); ?>			
				<div class="tri-col-span hideOnSearch mini-hide">
				</div>
				<div>
					<?php require_once( AUTODEALER_INCLUDES.'arrivals.php'); ?>
				</div>	
		</div><!--end of content div-->		
		<div id="sidebar-search" > 
		        <?php if ( !dynamic_sidebar( __('Search Module','language') ) ) : ?>
				<?php endif; ?>
				</div>
		<div id="sidebar" class="home" >				  
			<?php if ( !dynamic_sidebar( __('Sidebar','language') ) ) : ?>
			<?php endif; ?>
		</div><!--end of sidebar div-->	
		<div style="clear:both"></div>
		<div class="hide-for-small">
			<?php require_once( AUTODEALER_INCLUDES.'find-cars.php'); ?>
		</div>
	</div><!--end of container div-->  
	<div style="clear:both"></div>    
<?php get_footer(); ?>