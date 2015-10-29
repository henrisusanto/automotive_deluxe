<?php $query = new WP_Query(array('post_type' => array('gtcd'),'posts_per_page' => '1' )); if ( $query->have_posts() ) while ( $query->have_posts() ) : $query->the_post(); ?>

<?php global $output,$findmake,$post,$field, $fields, $fields2, $fields3; $fields = get_post_meta($post->ID, 'mod1', true); $fields3 = get_post_meta($post->ID, 'mod3', true); $fields2 = get_post_meta($post->ID, 'mod2', true);  $symbols = get_option('gorilla_symbols'); $options = my_get_theme_options();?>

			  	

	<div  class="full-width find-wrapper">

		<ul class="find-nav">

			<li><a class="active one" href="#" style="width:auto;"><?php _e('Find cars by Vehicle Type','language')?></a></li>

			<li><a class="two" href="#" style="width:auto;"><?php _e('Find cars by Features','language');?></a></li>

			<li class="last-child"><a class="three" href="#" style="width:auto;"><?php _e('Find cars by Make','language');?></a></li>

		</ul>

			<div id="cars-container">

				<ul class="cars-list list-one">

					<li><a  id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_1']);?>/"><img src="<?php bloginfo('template_url'); ?>/images/product-images/convertible.png" alt="<?php echo $options['vehicle_type_1'];?>" /></a>

	                                <a  id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_1']);?>/"><strong><?php	 if ( $fields['vehicletype']){ echo $options['vehicle_type_1'];}else {  echo ''; }?></strong></a>

					</li>

					<li><a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_2']);?>/"><img src="<?php bloginfo('template_url'); ?>/images/product-images/crossover.png" alt="<?php echo $options['vehicle_type_2'];?>" /></a>

						<a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_2']);?>/"><strong><?php	 if ( $fields['vehicletype']){ echo $options['vehicle_type_2'];}else {  echo ''; }?></strong></a>

					</li>

					<li><a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_3']);?>/"><img src="<?php bloginfo('template_url'); ?>/images/product-images/luxury.png" alt="<?php echo $options['vehicle_type_3'];?>" /></a>

						<a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_3']);?>/"><strong><?php	 if ( $fields['vehicletype']){ echo $options['vehicle_type_3'];}else {  echo ''; }?></strong></a>

					</li>

					<li><a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_4']);?>/"><img src="<?php bloginfo('template_url'); ?>/images/product-images/hybrid.png" alt="<?php echo $options['vehicle_type_4'];?>" /></a>

						<a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_4']);?>/"><strong><?php	 if ( $fields['vehicletype']){ echo $options['vehicle_type_4'];}else {  echo ''; }?></strong></a>

					</li>

					<li><a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_5']);?>/"><img src="<?php bloginfo('template_url'); ?>/images/product-images/minivans.png" alt="<?php echo $options['vehicle_type_5'];?>" /></a>

						<a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_5']);?>/"><strong><?php	 if ( $fields['vehicletype']){ echo $options['vehicle_type_5'];}else {  echo ''; }?></strong></a>

					</li>

					<li><a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_6']);?>/"><img src="<?php bloginfo('template_url'); ?>/images/product-images/pickuptrucks.png" alt="<?php echo $options['vehicle_type_6'];?>" /></a>

						<a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_6']);?>/"><strong><?php	 if ( $fields['vehicletype']){ echo $options['vehicle_type_6'];}else {  echo ''; }?></strong></a>                       </li>

					<li><a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_7']);?>/"><img src="<?php bloginfo('template_url'); ?>/images/product-images/sedanscoupes.png" alt="<?php echo $options['vehicle_type_7'];?>" /></a>

						<a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_7']);?>/"><strong><?php	 if ( $fields['vehicletype']){ echo $options['vehicle_type_7'];}else {  echo ''; }?></strong></a>

					</li>

					<li><a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_8']);?>/"><img src="<?php bloginfo('template_url'); ?>/images/product-images/diesel.png" alt="<?php echo $options['vehicle_type_8'];?>" /></a>

						<a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_8']);?>/"><strong><?php	 if ( $fields['vehicletype']){ echo $options['vehicle_type_8'];}else {  echo ''; }?></strong></a>

					</li>

					<li><a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_9']);?>/"><img src="<?php bloginfo('template_url'); ?>/images/product-images/sportutilities.png" alt="<?php echo $options['vehicle_type_9'];?>" /></a>

						<a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_9']);?>/"><strong><?php	 if ( $fields['vehicletype']){ echo $options['vehicle_type_9'];}else {  echo ''; }?></strong></a>

					</li>

					<li><a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_10']);?>/"><img src="<?php bloginfo('template_url'); ?>/images/product-images/sportscars.png" alt="<?php echo $options['vehicle_type_10'];?>" /></a>

						<a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_10']);?>/"><strong><?php	 if ( $fields['vehicletype']){ echo $options['vehicle_type_10'];}else {  echo ''; }?></strong></a>

					</li>

					<li><a id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_11']);?>/"><img src="<?php bloginfo('template_url'); ?>/images/product-images/wagons.png" alt="<?php echo $options['vehicle_type_11'];?>" /></a>

						<a href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_11']);?>/"><strong><?php	 if ( $fields['vehicletype']){ echo $options['vehicle_type_11'];}else {  echo ''; }?></strong></a>

					</li>

					<li><a  id="link" href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_12']);?>/"><img src="<?php bloginfo('template_url'); ?>/images/product-images/4WD-AWD.png" alt="<?php echo $options['vehicle_type_12'];?>" /></a>

						<a href="<?php bloginfo('url'); ?>/#search/<?php echo strtolower(str_replace(" ", "", vehicletype)); ?>-<?php echo str_replace(' ', '+', $options['vehicle_type_12']);?>/"><strong><?php	 if ( $fields['vehicletype']){ echo $options['vehicle_type_12'];}else {  echo ''; }?></strong></a>

					</li>

				</ul>

				<ul class="cars-list list-two">

				<?php if (get_terms('features')) { $taxonomy = get_terms( 'features', array(

 	'number'    => '50','orderby'=>'count'

 ) );

				

				foreach ($taxonomy as $taxonomy_term) {

    								$output .= '<li><a id="link" href="'.get_bloginfo('url').'/#search/'.strtolower(str_replace(" ", "", features)).'-'.str_replace(' ', '+', $taxonomy_term->name).'/">'. $taxonomy_term->name .'</a></li>';}

									echo $output;									

									}

								?>

				</ul>

				<ul class="cars-list list-three">

				<?php if (get_terms('makemodel')) { $makemodel = get_terms( 'makemodel', array( 'orderby'    => 'ASC', 'hide_empty' => 0, 'parent' => 0) );

				

				foreach ($makemodel as $makemodel_term) {

				

				

						$findmake.= '<li><a id="link" href="'.get_bloginfo('url').'/#search/'.strtolower(str_replace(" & ", '', makemodel)).'-'.str_replace(' ', '+', $makemodel_term->name).'/">'. $makemodel_term->name .'</a></li>';

						}

									echo $findmake;

									}	

									

						?>

				</ul>

		</div><!--end of cars container div-->

	</div>
<br/>
<?php endwhile; wp_reset_query(); ?> 