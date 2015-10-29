<?php get_header();?>
		<?php if (have_posts()) :  while (have_posts()) : the_post();?>	 
		<?php 
			  global $options;$fields;$options2;$options3;$symbols;
			  $fields = get_post_meta($post->ID, 'mod1', true);
			  $options = my_get_theme_options();
			  $options2 = get_post_meta($post->ID, 'mod2', true);
			  $options3 = get_post_meta($post->ID, 'mod3', true);
			  $symbols = get_option('gorilla_symbols');
			  ?>
<div class="tri-col-span right detail-page"></div>
   		<?php cps_ajax_search_results(); ?>    
            <div class="detail-page-content hideOnSearch">
               <div class="clear"></div>
				<h1 class="hideOnSearch"><?php if ( $fields['year']){ echo $fields['year'];}else {  echo ''; }?> <?php the_title();?></h1>
                <h3 class="show-for-small"><?php $options['price_text'];?> <?php if ( $fields['price']){ echo $symbols['currency'].number_format($fields['price']);}else {  echo ''; }?> </h3>
                 <div class="clear"></div>
					<ul class="quick-list quick-glance hideOnSearch ">
           				<?php	if (is_numeric( $fields['price'])){ echo '<li><p class="strong">'.$options['price_text'].':</p> '.$symbols['currency']; echo number_format($fields['price']).'</li>';}else {  echo '<li><p class="strong">'.$options['price_text'].':</p> '.$fields['price'].'<li>'; } ?> 						<?php	if ( $fields['miles']){ echo '<li><p class="strong">'.$options['miles_text'].':</p> '.$fields['miles'].'</li>';}else {  echo ''; }?>
            			<?php	if ( $fields['vehicle_type']){ echo '<li><p class="strong">'.$options['vehicle_type_text'].':</p> '.$fields['vehicle_type'].'</li>';}else {  echo ''; }?>
            			<?php	if ( $fields['drive']){ echo '<li><p class="strong">'.$options['drive_text'].':</p> '.$fields['drive'].'</li>';}else {  echo ''; }?>
            			<?php	if ( $fields['transmission']){ echo '<li><p class="strong">'.$options['transmission_text'].':</p> '.$fields['transmission'].'</li>';}else {  echo ''; }?>
            			<?php	if ( $fields['exterior']){ echo '<li><p class="strong">'.$options['exterior_text'].':</p> '.$fields['exterior'].'</li>';}else {  echo ''; }?>
   						<?php	if ( $fields['interior']){ echo '<li><p class="strong">'.$options['interior_text'].':</p> '.$fields['interior'].'</li>';}else {  echo ''; }?>
   						<?php	if ( $fields['epamileage']){ echo '<li><p class="strong">'.$options['epa_mileage_text'].':</p> '.$fields['epamileage'].'</li>';}else {  echo ''; }?>
   						<?php	if ( $fields['stock']){ echo '<li><p class="strong">'.$options['stock_text'].':</p> '.$fields['stock'].'</li>';}else {  echo ''; }?>
   						<?php	if ( $fields['vin']){ echo '<li><p class="strong">'.$options['vin_text'].':</p> '.$fields['vin'].'</li>';}else {  echo ''; }?>
   						<div style="background:none; padding:10px 3px 0px 3px!important;margin:0px auto;"><?php   if ( $fields['carfax']){ ?>  <a class="carfax" target="_blank" href='http://www.carfax.com/VehicleHistory/p/Report.cfx?partner=<?php  echo $fields['carfax']; ?>&vin=<?php  echo $fields['vin']; ?>'><img style="border:1px solid #ccc" src='http://www.carfaxonline.com/media/img/subscriber/buyback.jpg' border='0'></a><?php  }else {   echo '';  }?></div>		
					</ul>	                    			
			<div id="gallery_holder" class="big-view hideOnSearch">	
				<div id="gallery" class="big-view hideOnSearch" style="height:auto;">					
                  		    <?php gallery($post->ID,'gallery'); ?> 
                                   <div style="clear:both"></div>                   	
                   </div>
                     <div style="clear:both"></div> 
                   		<div class="small-view hideOnSearch" style="width:100%; float:left;">			
						<ul id="nav" class="elastislide-list thumbnails hideOnSearch">							
							<?php gallery_thumbs($post->ID,'thumbnail_gallery'); ?>							
						</ul>				
						</div>				
						</div>								
                             <span class="hide-for-small"><?php if ( !dynamic_sidebar( __('Vehicle Details Widget','language') ) ) : ?>
				<?php endif; ?></span>         
              				<div class="tabs hideOnSearch">									
					<span class="features-tab active">
						<?php _e('Features','language');?>
					</span>
					<span class="overview-tab">
						<?php _e('Overview','language');?>
					</span>										
						<?php $video_source = get_post_meta($post->ID, 'video_meta_box_source', true);
									$video_id = get_post_meta($post->ID, 'video_meta_box_videoid', true);					
									if(($video_source == "vimeo") && !empty($video_id)){ ?>
									<?php _e('Video','language');?>									<?php } elseif(( $video_source == "youtube") && !empty($video_id)){ ?>
									<span class="video-tab"><?php _e('Video','language');?></span> 
									<?php  } ?>					         										
					<div class="item-list">										
					<ul class="features active first feature-list">
                        		<?php	if (get_the_terms($post->ID, 'features')) {
  									$taxonomy = get_the_terms($post->ID, 'features');									
  									foreach ($taxonomy as $taxonomy_term) {
    								?> <li><?php echo $taxonomy_term->name;?></li><?php }  														
									}
									?>
                   		</ul>           					
						<ul class="overview">
                              	<?php 	$trim_length = 200; 
										$values = get_post_meta($post->ID, 'mod3', true);
										if (is_array($values))
										{
										foreach($values as $value) {
										add_filter( 'custom_filter', 'wpautop' );
										echo '<p class="car-detail">'.apply_filters( 'custom_filter', $value ).'</p>';}   
										}		
										?>	
						</ul>						                   
						<ul class="video">
							<li><?php $video_source = get_post_meta($post->ID, 'video_meta_box_source', true);
									$video_id = get_post_meta($post->ID, 'video_meta_box_videoid', true);					
									if(($video_source == "vimeo") && !empty($video_id)){ ?>
									<iframe src="http://player.vimeo.com/video/<?php echo $video_id; ?>?title=0&amp;portrait=0&amp;color=e275c7" width="478" height="310" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>
									<?php } elseif(( $video_source == "youtube") && !empty($video_id)){ ?>
									<iframe src="http://www.youtube.com/embed/<?php echo $video_id; ?>"  width="478" height="310" frameborder="0" allowfullscreen></iframe>
									<?php  } ?>
							</li>
						</ul>
					</div>                        
                </div>
                <div style="clear:both;"></div>              
            </div>         
            <div id="sidebar-search" > 
		<?php if ( !dynamic_sidebar( __('Search Module','language') ) ) : ?>
				<?php endif; ?>
				</div>               
             <div id="sidebar">
            	<?php if ( !dynamic_sidebar( __('Sidebar','language') ) ) : ?>
				<?php endif; ?>
			</div>        
          
            <?php  endwhile; endif; ?>            
			          	<div style="clear:both; width:980px; height:1px; overflow:hidden;" class="hide-for-small"></div>  
			<div class="hide-for-small"><?php if ( ! dynamic_sidebar('Similar Cars')) : ?> <?php endif; ?></div>
		<div style="clear:both; width:980px; height:1px; overflow:hidden;" class="hide-for-small"></div>
        <div style="clear:both; width:100%; height:1px; overflow:hidden;"></div>		
	</div>
 <?php get_footer(); ?>