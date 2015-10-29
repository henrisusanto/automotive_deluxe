<div class="hideOnSearch">
	<div class="show-for-small mobile top-deals-mobile-wrapper"><h2><?php _e('New Arrivals','language');?></h2></div>
		<div class="product-list-wrapper">
			<ul class="tricol-product-list">
				<?php $query = new WP_Query(array(
					'post_type' => array('gtcd','user_listing'),
					'posts_per_page' => '12'
					));
						if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); global $post,$field, $fields, $fields2, $fields3; $fields = get_post_meta($post->ID, 'mod1', true); $fields3 = get_post_meta($post->ID, 'mod3', true); $fields2 = get_post_meta($post->ID, 'mod2', true);  $symbols = get_option('gorilla_symbols'); $options = my_get_theme_options();?>				  	
				<li class="new-arrivals-list"><a class="arrivals-link" href="<?php the_permalink();?>"><div class="cpsAjaxLoaderHome">  </div> 
					<div class="image-container">				 
							<div class="<?php echo $fields['statustag'];?>"></div>					
<?php if ( 'user_listing' == get_post_type($post->ID) ) {
										$args = array(
										'order'          => 'ASC',
										'orderby'        => 'menu_order',
										'post_type'      => 'attachment',
										'post_parent'    => $post->ID,
										'post_mime_type' => 'image',
										'post_status'    => null,
										'numberposts'    => 1,
										);
										$attachments = get_posts($args);										
										if ($attachments) {
											foreach ($attachments as $attachment) {
												arrivals_img ($post->ID,'arrivals');
												}
											} 
										} elseif ( 'gtcd' == get_post_type($post->ID) ) {
												gorilla_img ($post->ID,'arrivals');
										}?> 
						 
					</div></a>
                    <div class="arrivals-details">
					<p><strong><?php the_title();?></strong></p>
					<div class="meta-style"><?php if ( $fields['year']){ echo $fields['year'].' | ';} else {  echo ''; } ?> <?php	 if ( $fields['miles']){ echo $fields['miles'].' '.$options['miles_text'];} elseif ($fields['miles'] == '0' ){ echo _e('0','language').' '.$options['miles_text'];} else {echo '';}  ?></div>
					<div class="price-style"><?php  if (is_numeric( $fields['price'])){ echo $symbols['currency']; echo number_format($fields['price']);} else {  echo $fields['price']; } ?></div>
						<p><a class="detail-btn" href="<?php the_permalink();?>"><?php _e('View','language');?></a></p>
                     </div>   
                    
				</li>
			<?php endwhile; wp_reset_query(); ?>  
                        		<?php else: ?>   				
				<?php echo '<div style="width:95%;margin:20px auto;"><h2>Welcome to WordPress Automotive theme</h2><p>Obtain setup documentation, theme files and full support on our forum located at <a href="http://gorillathemes.com/support">http://gorillathemes.com/support</a> , login with the username and password located in the welcome email sent at checkout time and post any theme setup related questions and we will guide you with your theme setup.</p>
				<p>To add a new vehicle listing login into your WordPress dashboard and click on Inventory -> Add listing and start adding your vehicles to the database in order for your car listings to be displayed in the slideshow, vehicle arrivals grid and inventory pages.</p><p>Vehicles selected as featured will appear in the gorgeous home screen slideshow.</p><p>Vehicles selected as a Top Deal will appear in the Top Deals widget in the theme sidebar.</p></div>';?>
				<?php endif; ?>      
		</ul>
	</div>
</div>


