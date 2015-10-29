<?php

add_action("widgets_init", "theme_widgets_init");
function theme_widgets_init() {

	  register_widget("Contact_Sales_Consultant");
	  register_widget("Contact_Widget");
	  register_widget("Top_Deals");
	  register_widget("Refine_Further");	  
	  register_widget('Footer1_Widget');
	  register_widget('Footer2_Widget');
	  register_widget('Footer3_Widget');
	  register_widget('Footer4_Widget');
	  register_widget('Facebook_Widget');
	  register_widget('Simil_Widget');
	  register_widget('GTCD_Widget');  
	  }

	// Loan Calculator widget

class Loan_Calculator extends WP_Widget{

	function Loan_Calculator() {

		parent::WP_Widget(false, 'Automotive: Loan Calculator');

		}

	function widget($args, $instance) {

			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

		?>
<script language="JavaScript">

		function checkForZero(field){

    if (field.value == 0 || field.value.length == 0) {

        alert ("This field can't be 0!");

        field.focus(); }

    else

        calculatePayment(field.form);

		}

		function cmdCalc_Click(form)

		{

    if (form.price.value == 0 || form.price.value.length == 0) {

        alert ("The Price field can't be 0!");

        form.price.focus(); }

    else if (form.ir.value == 0 || form.ir.value.length == 0) {

        alert ("The Interest Rate field can't be 0!");

        form.ir.focus(); }

    else if (form.term.value == 0 || form.term.value.length == 0) {

        alert ("The Term field can't be 0!");

        form.term.focus(); }

    else

        calculatePayment(form);

		}



	function calculatePayment(form)

		{

    princ = form.price.value - form.dp.value;

    intRate = (form.ir.value/100) / 12;

    months = form.term.value * 12;

    form.pmt.value = Math.floor((princ*intRate)/(1-Math.pow(1+intRate,(-1*months)))*100)/100;

    form.principle.value = princ;

    form.payments.value = months;

		}

	</script>
<script language="JavaScript">

	function checkForZero(field)

	{

    if (field.value == 0 || field.value.length == 0) {

        }

    else

        calculatePayment(field.form);

	}

	function cmdCalc_Click(form)

	{

    if (form.price.value == 0 || form.price.value.length == 0) {

        alert ("The Price field can't be 0!");

        form.price.focus(); }

    else if (form.ir.value == 0 || form.ir.value.length == 0) {

        alert ("The Interest Rate field can't be 0!");

        form.ir.focus(); }

    else if (form.term.value == 0 || form.term.value.length == 0) {

        alert ("The Term field can't be 0!");

        form.term.focus(); }

    else

        calculatePayment(form);

	}

	function calculatePayment(form)

	{

    princ = form.price.value - form.dp.value;

    intRate = (form.ir.value/100) / 12;

    months = form.term.value * 12;

    form.pmt.value = Math.floor((princ*intRate)/(1-Math.pow(1+intRate,(-1*months)))*100)/100;

    form.principle.value = princ;

    form.payments.value = months;

	}

	</script>
<?php $symbols = get_option('gorilla_symbols');?>

<div class="right-block">
  <div class="loan-calculator">
    <h3><?php echo $title;?></h3>
    <form name="Loan Calculator" class="calculate-form">
      <p>
        <label class="loan-title" for="l-amount">
          <?php _e('PURCHASE PRICE:  '.$symbols['currency'].'','language')?>
        </label>
        <input type="text" size="10" name="price" value="0"  class="l-inputbar" id="l-amount" onBlur="checkForZero(this)" onChange="checkForZero(this)">
      </p>
      <p>
        <label class="loan-title" for="l-down">
          <?php _e('DOWN PAYMENT:  '.$symbols['currency'].'','language')?>
        </label>
        <input type="text" size="10" name="dp" id="l-down"   class="l-inputbar" value="0"  onChange="calculatePayment(this.form)">
      </p>
      <p>
        <label class="loan-title" for="l-amount">
          <?php _e('INTEREST RATE: %','language')?>
        </label>
        <input type="text" size="5"  name="ir" value="0" class="l-inputbar" onBlur="checkForZero(this)" onChange="checkForZero(this)">
      </p>
      <p>
        <label class="loan-title" for="l-amount">
          <?php _e('LOAN TERM: Yrs.   ','language')?>
        </label>
        <input type="text" size="4"  name="term" value="5" class="l-inputbar"  onBlur="checkForZero(this)" onChange="checkForZero(this)">
      </p>
      <p class="calculate-wrapper">
        <input type="button" name="cmdCalc" value="Calculate" class="calculate-btn" onClick="cmdCalc_Click(this.form)">
      </p>
      <p>
        <label class="loan-title" for="l-amount">
          <?php _e('MONTHLY PAYMENT: '.$symbols['currency'].'','language')?>
        </label>
        <input type="label" size="12"  class="l-inputbar"  name="pmt">
      </p>
    </form>
  </div>
</div>
<?php }

		function form($instance) {

		$title = strip_tags($instance['title']);

		?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e("<strong>Enter Calculator title:</strong> ","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<?php }		

		function update($new_instance, $old_instance) {	return $new_instance; }

}
class Simil_Widget extends WP_Widget {


	function __construct() {
		parent::__construct(
			'simil_widget', 
			__('Automotive: Similar Cars', 'language'), 
			array( 'description' => __( 'Automotive Similar Cars by Features', 'language' ), ) 
		);
	}

	         public function widget( $args, $instance ) {
			$title = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
			$number = isset( $instance['number'] ) ? apply_filters( 'widget_number', $instance['number'] ) : '';
		if ( ! empty( $title ) )
			
		  ?><div id="product-list-wrapper-similar" class="hide-for-small">

	<?php  echo $args['before_title'] .'<h2>'.$title .'</h2>'. $args['after_title'];?>

		<ul class="tricol-product-list-similar detail-page-product-list">

		<?php 

				global $post;  wp_reset_query();


				$terms = get_the_terms( $post->ID , 'features');

				$do_not_duplicate[] = $post->ID;

 				if(!empty($terms)){

    			foreach ($terms as $term) {

        		query_posts( array(

        		'features' => $term->slug,

        		'post__not_in' => $do_not_duplicate ) );

        		if(have_posts()){ while ( have_posts() ) : the_post(); $do_not_duplicate[] = $post->ID; ?>
        		
        		<?php if($count<$number): ?>

        		<?php 

			  global $options, $fields, $options2, $options3, $symbols;

			  $fields = get_post_meta($post->ID, 'mod1', true);

			  $options2 = get_post_meta($post->ID, 'mod2', true);

			  $options3 = get_post_meta($post->ID, 'mod3', true);

			  $symbols = get_option('gorilla_symbols');

			  $options = get_option('gorilla_fields');



			  ?>



				<li>

				<div class="image-container">

					<a href="<?php the_permalink();?>">

						<span class="<?php echo $fields['statustag'];?>"></span>

					</a>

					<a href="<?php the_permalink();?>">
					
					<?php

if ( 'user_listing' == get_post_type($post->ID) ) {

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

					</a>

				</div>
				

				 <p><strong><?php the_title();?></strong>

					<?php if ( $fields['year']){ echo $fields['year'].' | ';} else {  echo ''; } ?>

					<?php if ( $fields['miles']){ echo $fields['miles'].' '.$options['milestext'];}else {  echo ''; }?><br />

					<span class="price-style"><?php  if(is_numeric($fields['price'])){ echo $symbols['currency']; echo number_format($fields['price']);}else {  echo $fields['price']; } ?></span></p>

						<p><span class="detail-btn" href="<?php the_permalink();?>"><?php _e('View','language');?></span></p>
						

				</li>
				
				<?php $count++; endif; ?>

			<?php endwhile; wp_reset_query();

        	}

    	}

} 	?>

		</ul>

	</div><!--end of content div--><?php		

		
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Title', 'language' );
		}
		if ( isset( $instance[ 'number' ] ) ) {
			$number = $instance[ 'number' ];
		}
		else {
			$number = __( 'Number of vehicles', 'language' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'language'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of Vehicles:','language' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>">
		</p>

		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';

		return $instance;
		
	}

} 

// Top_Deals Widget

class Top_Deals extends WP_Widget{

	function Top_Deals() {

	parent::WP_Widget(false, 'Automotive: Top Deals');

	}

	function widget($args, $instance) {	
		
		$dealstitle = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$numdeals = apply_filters( 'widget_num', empty( $instance['num'] ) ? '' : $instance['num'], $instance, $this->id_base );
	?>
<div class="right-block">
  <div class="right-white-block mobile top-deals-mobile-wrapper">
    <h3>
      <?php if ( !empty( $dealstitle ) ) { echo  $dealstitle; }?>
    </h3>
    <ul class="deal-rates">
      <?php  wp_reset_query();	$query = new WP_Query(array(

							'post_type' => array('gtcd','user_listing'),

							'meta_key' => '_topdeal',

							'meta_value' => 'Yes',

							'posts_per_page' => $numdeals,

							));

							if ( $query->have_posts() ) while ( $query->have_posts() ) : $query->the_post();global $post, $field, $fields, $fields2, $fields3; $fields = get_post_meta($post->ID, 'mod1', true); $fields3 = get_post_meta($post->ID, 'mod3', true); $fields2 = get_post_meta($post->ID, 'mod2', true);  $symbols = get_option('gorilla_symbols'); $options = get_option('gorilla_fields');?>
      <li class="new-arrivals-list"> <a class="arrivals-link" href="<?php the_permalink();?>">
        <div class="image-container">
          <?php gorilla_img($post->ID,'thumbnail_gallery');?>
        </div>
        <div class="arrivals-details">
        <p>
			<span class="top-deals-title"><?php the_title();?></span>
        		  
           		 <?php if ( $fields['year']){ echo '<span class="year-style">'.$fields['year'].'</span> | ';} else {  echo ''; } ?><?php  if (is_numeric( $fields['price'])){ echo '<span class="price-style-deals">'.$symbols['currency']; echo  number_format($fields['price']).'</span>';}else {  echo '<span class="price-style-deals">'.$fields['price'].'</span>'; } ?>
          
            </p>
        </div>
        
          </a> 
        <div class="clear"></div>
        </li>
      <?php endwhile; wp_reset_query(); ?>
    </ul>
  </div>
</div>
<?php }

			function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );

		$dealstitle = strip_tags($instance['title']);

		$numdeals = strip_tags($instance['num']);

?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e('Widget Title:','language'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($dealstitle); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('num'); ?>">
    <?php _e('Number of listings:','language'); ?>
  </label>
  <input style="width: 30px;" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>"  type="text" value="<?php echo esc_attr($numdeals); ?>" />
</p>
<?php

	}
	

			function update($new_instance, $old_instance) {$instance['title'] = strip_tags($new_instance['title']);$instance['num'] = strip_tags($new_instance['num']);	return $new_instance; }

}



// Welcome Widget

class Welcome_Widget extends WP_Widget {

	function __construct() {

		$widget_ops = array('classname' => 'widget_text', 'description' => __('Welcome Legend on Home Page','language'));

		$control_ops = array('width' => 400, 'height' => 350);

		parent::__construct('Welcome', __('Automotive: Welcome Widget','language'), $widget_ops, $control_ops);}

		function widget( $args, $instance ) {

		extract($args);

		echo '';

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );

		echo $before_widget;

		if ( !empty( $title ) ) { echo $before_title . '<h1>'.$title.'</h1>' . $after_title; } ?>
<div class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
<?php

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		if ( current_user_can('unfiltered_html') )

			$instance['text'] =  $new_instance['text'];

		else

			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed

		$instance['filter'] = isset($new_instance['filter']);

		return $instance;

	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );

		$title = strip_tags($instance['title']);

		$text = esc_textarea($instance['text']);

?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e('Title:','language'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
<p>
  <input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />
  &nbsp;
  <label for="<?php echo $this->get_field_id('filter'); ?>">
    <?php _e('Automatically add paragraphs','language'); ?>
  </label>
</p>
<?php

	}

}	

// Refine Further Widget

class Refine_Further extends WP_Widget{

		function Refine_Further() {

			parent::WP_Widget(false, 'Automotive: Vehicle Details');

		}

		function widget($args, $instance) {

		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

		$title2 = empty($instance['title2']) ? ' ' : apply_filters('widget_title', $instance['title2']);

		$text2  = apply_filters( 'widget_textarea', empty( $instance['text2'] ) ? '' : $instance['text2'], $instance );	

		$title3 = empty($instance['title3']) ? ' ' : apply_filters('widget_title', $instance['title3']);

		$text3  = apply_filters( 'widget_textarea', empty( $instance['text3'] ) ? '' : $instance['text3'], $instance );		

		$title4 = empty($instance['title4']) ? ' ' : apply_filters('widget_title', $instance['title4']);			

		$text4  = apply_filters( 'widget_textarea', empty( $instance['text4'] ) ? '' : $instance['text4'], $instance );		

		?>
	
<div class="specs side-lift-block" >
  <ul class="refine-nav">
    <?php if(empty($instance['title'])){echo '';} else { ?>
    <li class="first"> <span><?php echo $title ?></span>
      <?php  

			  	global $post, $fields, $fields2, $fields3, $options, $symbols;

			  	$fields = get_post_meta($post->ID, 'mod1', true);

			  	$fields2 = get_post_meta($post->ID, 'mod2', true);

			  	$fields3 = get_post_meta($post->ID, 'mod3', true);

			  	$symbols = get_option('gorilla_symbols');

			  	$options = my_get_theme_options(); ?>
      <ul>
        <li>
          <?php if ( $fields['drive']){ echo '<p class="strong">'.$options['drive_text'].': </p>'.$fields['drive'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['enginetype']){ echo  '<p class="strong">'.$options['engine_type_text'].': </p>'.$fields2['enginetype'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['cylinders']){ echo '<p class="strong">'.$options['number_cylinders_text'].': </p>'.$fields2['cylinders'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['horsepower']){ echo '<p class="strong">'.$options['horsepower_text'].': </p>'.$fields2['horsepower'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['torque']){ echo '<p class="strong">'.$options['torque_text'].': </p>'.$fields2['torque'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['enginesize']){ echo '<p class="strong">'.$options['engine_size_text'].': </p>'.$fields2['enginesize'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['bore']){ echo '<p class="strong">'.$options['bore_text'].': </p>'.$fields2['bore'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['stroke']){ echo '<p class="strong">'.$options['stroke_text'].': </p>'.$fields2['stroke'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['valvespercylinder']){ echo '<p class="strong">'.$options['valves_text'].': </p>'.$fields2['valvespercylinder'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['fuelcapacity']){ echo '<p class="strong">'.$options['fuel_capacity_text'].': </p>'.$fields2['fuelcapacity'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields['epamileage']){ echo '<p class="strong">'.$options['epa_mileage_text'].': </p>'.$fields['epamileage'];}else {  echo ''; }?>
        </li>
        <li>
        <?php	if ( $fields['EPA_CITY_MPG']){ echo '<li><p class="strong">'._('EPA City MPG:','language').'</p> '.$fields['EPA_CITY_MPG'].'</li>';}else {  echo ''; }?>
		</li>			   						
   		<li>				   				  						   						   	<?php	if ( $fields['EPA_HIGHWAY_MPG']){ echo '<li><p class="strong">'._('EPA Highway MPG:','language').'</p> '.$fields['EPA_HIGHWAY_MPG'].'</li>';}else {  echo ''; }?>
   		</li>
   		<li>				   				  						   						   	<?php	if ( $fields2['FRONT_AIR_CONDITIONING']){ echo '<li><p class="strong">'._('Front Air Conditioning:','language').'</p> '.$fields2['FRONT_AIR_CONDITIONING'].'</li>';}else {  echo ''; }?>
   		</li>				   						   					
        <li>				   				  						   						   	<?php	if ( $fields2['FRONT_BRAKE_TYPE']){ echo '<li><p class="strong">'._('Front Brake Type:','language').'</p> '.$fields2['FRONT_BRAKE_TYPE'].'</li>';}else {  echo ''; }?>
   		</li>			
        <li>				   				  						   						   	<?php	if ( $fields2['ANTILOCK_BRAKING_SYSTEM']){ echo '<li><p class="strong">'._('Antilock Braking System:','language').'</p> '.$fields2['ANTILOCK_BRAKING_SYSTEM'].'</li>';}else {  echo ''; }?>
   		</li>	
        <li>				   				  						   						   	<?php	if ( $fields2['BRAKING_ASSIST']){ echo '<li><p class="strong">'._('Braking Assist:','language').'</p> '.$fields2['BRAKING_ASSIST'].'</li>';}else {  echo ''; }?>
   		</li>	        
        <li>				   				  						   						   	<?php	if ( $fields2['REAR_BRAKE_DIAMETER']){ echo '<li><p class="strong">'._('Rear Brake Diameter:','language').'</p> '.$fields2['REAR_BRAKE_DIAMETER'].'</li>';}else {  echo ''; }?>
   		</li>        
        <li>				   				  						   						   	<?php	if ( $fields2['AUTO_DIMMING_REARVIEW_MIRROR']){ echo '<li><p class="strong">'._('Auto Dimming Rearview Mirror:','language').'</p> '.$fields2['AUTO_DIMMING_REARVIEW_MIRROR'].'</li>';}else {  echo ''; }?>
   		</li>  
        <li>				   				  						   						   	<?php	if ( $fields2['RUNNING_BOARDS']){ echo '<li><p class="strong">'._('Running Boards:','language').'</p> '.$fields2['RUNNING_BOARDS'].'</li>';}else {  echo ''; }?>
   		</li>    		
        <li>				   				  						   						   	<?php	if ( $fields2['ROOF_RACK']){ echo '<li><p class="strong">'._('Roof Rack:','language').'</p> '.$fields2['ROOF_RACK'].'</li>';}else {  echo ''; }?>
   		</li>    		
        <li>				   				  						   						   	<?php	if ( $fields2['POWER_DOOR_LOCKS']){ echo '<li><p class="strong">'._('Power Door Locks:','language').'</p> '.$fields2['POWER_DOOR_LOCKS'].'</li>';}else {  echo ''; }?>
   		</li>    	   		
        <li>				   				  						   						   	<?php	if ( $fields2['ANTI_THEFT_ALARM_SYSTEM']){ echo '<li><p class="strong">'._('Anti Theft Alarm System:','language').'</p> '.$fields2['ANTI_THEFT_ALARM_SYSTEM'].'</li>';}else {  echo ''; }?>
   		</li>     		
        <li>				   				  						   						   	<?php	if ( $fields2['CRUISE_CONTROL']){ echo '<li><p class="strong">'._('Cruise Control:','language').'</p> '.$fields2['CRUISE_CONTROL'].'</li>';}else {  echo ''; }?>
   		</li>
   		<li>				   				  						   						   	<?php	if ( $fields2['1ST_ROW_VANITY_MIRRORS']){ echo '<li><p class="strong">'._('First Row Vanity Mirros:','language').'</p> '.$fields2['1ST_ROW_VANITY_MIRRORS'].'</li>';}else {  echo ''; }?>
   		</li> 
   		<li>				   				  						   						   	<?php	if ( $fields2['HEATED_DRIVER_SIDE_MIRROR']){ echo '<li><p class="strong">'._('Heated Driver Side Mirror:','language').'</p> '.$fields2['HEATED_DRIVER_SIDE_MIRROR'].'</li>';}else {  echo ''; }?>
   		</li>  
   		<li>				   				  						   						   	<?php	if ( $fields2['HEATED_PASSENGER_SIDE_MIRROR']){ echo '<li><p class="strong">'._('Heated Driver Passenger Mirror:','language').'</p> '.$fields2['HEATED_PASSENGER_SIDE_MIRROR'].'</li>';}else {  echo ''; }?>
   		</li> 
   		<li>				   				  						   						   	<?php	if ( $fields2['TRAILER_WIRING']){ echo '<li><p class="strong">'._('Trailer Wiring:','language').'</p> '.$fields2['TRAILER_WIRING'].'</li>';}else {  echo ''; }?>
   		</li>    		
   		<li>				   				  						   						   	<?php	if ( $fields2['TRAILER_HITCH']){ echo '<li><p class="strong">'._('Trailer Hitch:','language').'</p> '.$fields2['TRAILER_HITCH'].'</li>';}else {  echo ''; }?>
   		</li>    		
   		<li>				   				  						   						   	<?php	if ( $fields2['CRUISE_CONTROLS_ON_STEERING_WHEEL']){ echo '<li><p class="strong">'._('Cruise Control on Steering Wheel:','language').'</p> '.$fields2['CRUISE_CONTROLS_ON_STEERING_WHEEL'].'</li>';}else {  echo ''; }?>
   		</li>     		     		
   		<li>				   				  						   						   	<?php	if ( $fields2['AUDIO_CONTROLS_ON_STEERING_WHEEL']){ echo '<li><p class="strong">'._('Audio Control on Steering Wheel:','language').'</p> '.$fields2['AUDIO_CONTROLS_ON_STEERING_WHEEL'].'</li>';}else {  echo ''; }?>
   		</li>    		
   		<li>				   				  						   						   	<?php	if ( $fields2['FOLDING_2ND_ROW']){ echo '<li><p class="strong">'._('Folding Second Row Seats:','language').'</p> '.$fields2['FOLDING_2ND_ROW'].'</li>';}else {  echo ''; }?>
   		</li>
   		<li>				   				  						   						   	<?php	if ( $fields2['1ST_ROW_POWER_OUTLET']){ echo '<li><p class="strong">'._('First Row Power Outlet:','language').'</p> '.$fields2['1ST_ROW_POWER_OUTLET'].'</li>';}else {  echo ''; }?>
   		</li>       		
   		<li>				   				  						   						   	<?php	if ( $fields2['CARGO_AREA_POWER_OUTLET']){ echo '<li><p class="strong">'._('Cargo Area Power Outlet:','language').'</p> '.$fields2['CARGO_AREA_POWER_OUTLET'].'</li>';}else {  echo ''; }?>
   		</li> 
   		<li>				   				  						   						   	<?php	if ( $fields2['INDEPENDENT_SUSPENSION']){ echo '<li><p class="strong">'._('Independent Suspension:','language').'</p> '.$fields2['INDEPENDENT_SUSPENSION'].'</li>';}else {  echo ''; }?>
   		</li>  
   		<li>				   				  						   						   	<?php	if ( $fields2['REAR_SUSPENSION_TYPE']){ echo '<li><p class="strong">'._('Independent Suspension:','language').'</p> '.$fields2['REAR_SUSPENSION_TYPE'].'</li>';}else {  echo ''; }?>
   		</li>
   		<li>				   				  						   						   	<?php	if ( $fields2['FRONT_SUSPENSION_TYPE']){ echo '<li><p class="strong">'._('Rear Suspension Type:','language').'</p> '.$fields2['FRONT_SUSPENSION_TYPE'].'</li>';}else {  echo ''; }?>
   		</li> 
   		<li>				   				  						   						   	<?php	if ( $fields2['MAX_CARGO_CAPACITY']){ echo '<li><p class="strong">'._('Maximum Cargo Capacity Suspension:','language').'</p> '.$fields2['MAX_CARGO_CAPACITY'].'</li>';}else {  echo ''; }?>
   		</li>         		
   		<li>				   				  						   						   	<?php	if ( $fields2['PASSENGER_AIRBAG']){ echo '<li><p class="strong">'._('Passenger Airbags:','language').'</p> '.$fields2['PASSENGER_AIRBAG'].'</li>';}else {  echo ''; }?>
   		</li>    		
        <li>
          <?php if ( $fields2['wheelbase']){ echo '<p class="strong">'.$options['wheelbase_text'].': </p>'.$fields2['wheelbase'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['overalllength']){ echo '<p class="strong">'.$options['overall_length_text'].': </p>'.$fields2['overalllength'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['width']){ echo '<p class="strong">'.$options['width_text'].': </p>'.$fields2['width'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['height']){ echo '<p class="strong">'.$options['height_text'].': </p>'.$fields2['height'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['curbweight']){ echo '<p class="strong">'.$options['curb_weight_text'].': </p>'.$fields2['curbweight'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['legroom']){ echo '<p class="strong">'.$options['leg_room_text'].': </p>'.$fields2['legroom'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['headroom']){ echo '<p class="strong">'.$options['head_room_text'].': </p>'.$fields2['headroom'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['seatingcapacity']){ echo '<p class="strong">'.$options['seating_text'].': </p>'.$fields2['seatingcapacity'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields2['tires']){ echo '<p class="strong">'.$options['tires_text'].': </p>'.$fields2['tires'];}else {  echo ''; }?>
        </li>
        <li>
          <?php if ( $fields['transmission']){ echo '<p class="strong">'.$options['transmission_text'].': </p>'.$fields['transmission'];}else {  echo ''; }?>
        </li>
      </ul>
    </li>
    <?php } ?>
    <?php if(empty($instance['title2'])){echo '';}else{?>
    <li class="second"> <span><?php echo $title2 ?></span>
      <ul>
        <li><?php echo $text2; ?></li>
      </ul>
    </li>
    <?php } ?>
    <?php if(empty($instance['title3'])){echo '';}else{?>
    <li class="third"> <span><?php echo $title3; ?></span>
      <ul>
        <?php echo $text3; ?>
      </ul>
    </li>
    <?php } ?>
    <?php if(empty($instance['title4'])){echo '';}else{?>
    <li class="fourth"> <span><?php echo $title4; ?></span>
      <ul>
        <?php echo $text4; ?>
      </ul>
    </li>
    <?php } ?>
  </ul>
</div>
<?php }

		function form($instance) {

			$title = $instance['title'];
			$title2 = $instance['title2'];
			$title3 = $instance['title3'];			
			$title4 = $instance['title4'];			
			$text2 = $instance['text2'];
			$text3 = $instance['text3'];
			$text4 = $instance['text4'];

			?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e("<strong>Enter Full Specifications title:</strong> <br/>(leave empty to hide) ","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('title2'); ?>">
    <?php _e("<strong>Enter title for second module:</strong> <br/>(leave empty to hide)","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo esc_attr($title2); ?>" />
  </label>
</p>
<textarea id="<?php echo $this->get_field_id('text2'); ?>" name="<?php echo $this->get_field_name('text2'); ?>" rows="10" cols="46" ><?php echo wpautop( $text2 ); ?></textarea>
<p>
  <label for="<?php echo $this->get_field_id('title3'); ?>">
    <?php _e("Enter title for third module:</strong> <br/>(leave empty to hide)","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('title3'); ?>" name="<?php echo $this->get_field_name('title3'); ?>" type="text" value="<?php echo esc_attr($title3); ?>" />
  </label>
</p>
<textarea id="<?php echo $this->get_field_id('text3'); ?>" name="<?php echo $this->get_field_name('text3'); ?>" rows="10" cols="46" ><?php  echo wpautop( $text3 ); ?></textarea>
<p>
  <label for="<?php echo $this->get_field_id('title4'); ?>">
    <?php _e("<strong>Enter title for fourth module:</strong> <br/>(leave empty to hide)","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('title4'); ?>" name="<?php echo $this->get_field_name('title4'); ?>" type="text" value="<?php echo esc_attr($title4); ?>" />
  </label>
</p>
<textarea id="<?php echo $this->get_field_id('text4'); ?>" name="<?php echo $this->get_field_name('text4'); ?>" rows="10" cols="46" ><?php echo wpautop( $text4 );?></textarea>
<?php

	}		

	function update($new_instance, $old_instance) {	return $new_instance; }		

	}


// Automotive Search

class GTCD_Widget extends WP_Widget {

	function GTCD_Widget() {

		$widget_ops = array( 'description' => (__('Search Module' ,'language')));
		$this->WP_Widget('cd_widget', 'Automotive: Search Module', $widget_ops);

	}

	function widget($args, $instance) {
	
		
		extract($args, EXTR_SKIP);	

		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);	

		$blogurl = get_bloginfo('template_url')	;

		echo '<span class="innerSearchPopup">'.$before_widget;

		echo '<div class="cpsAjaxLoaderWidget" style="margin-top:-20px;">
		<div style="text-align:center;">';
         _e('Searching','language');
      echo '</div> <img style="margin-top:20px;" src="'.get_bloginfo('template_url').'/images/common/loader.gif" />   	

</div>';

		echo '<h3 class="search-title">'.$title.'</h3>';

		echo $after_title;

		?><div class="advSearchHome">
     <?php cps_search_form(); ?>    
      </div> <?php		

		echo $after_widget.'</span>';

	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;

	}

	function form($instance) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'profile_id' => '' ) );

		$title = strip_tags($instance['title']);

?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e("Title: ","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<?php
	

	

	}

}

// Contact Sales Consultant		 

class Contact_Sales_Consultant extends WP_Widget {

	function Contact_Sales_Consultant() {

		$widget_ops = array( 'description' => (__('Request More Information','language' )));

		$this->WP_Widget('contact_form_widget', 'Automotive: Request Vehicle Information', $widget_ops);

	}

	function widget($args, $instance) {
	
	
		if ( is_singular( array( 'gtcd', 'user-listing' ) ) ) {

		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);					  				 

		include_once(TEMPLATEPATH."/includes/form.php");
		
		}

		

	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;

	}

	function form($instance) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'profile_id' => '' ) );

		$title = strip_tags($instance['title']);

?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e("Legend: ","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<?php

	}

}
// Contact Widget 

class Contact_Widget extends WP_Widget {

	function Contact_Widget() {

		$widget_ops = array( 'description' => (__('Automotive Contact Form in The Sidebar','language' )));

		$this->WP_Widget('contact_side_widget', 'Automotive: Contact Form Sidebar', $widget_ops);

	}

	function widget($args, $instance) {
	
	
	if ( !is_singular( array( 'gtcd', 'user-listing' ) ) ) {
        
		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);					  				 

		include_once(TEMPLATEPATH."/includes/side-form.php");
		
		
		 }

		

	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;

	}

	function form($instance) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'profile_id' => '' ) );

		$title = strip_tags($instance['title']);

?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e("Legend: ","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<?php

	}

}


//  Facebook Widget

class Facebook_Widget extends WP_Widget {

	function Facebook_Widget() {

		$widget_ops = array( 'description' => (__('Your Facebook Fan Box, add your Facebook Fan Page ID and place this widget in your Sidebar to display your followers.','language')));

		$this->WP_Widget('facebook_widget', 'Automotive: Facebook Widget', $widget_ops);

	}

	function widget($args, $instance) {

		extract($args, EXTR_SKIP);

			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

		$profile_id = empty($instance['profile_id']) ? ' ' : apply_filters('widget_profile_id', $instance['profile_id']);					

		include_once(TEMPLATEPATH . '/facebook.php');

	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		$instance['profile_id'] = strip_tags($new_instance['profile_id']);

		return $instance;

	}

	function form($instance) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'profile_id' => '' ) );

		$title = strip_tags($instance['title']);

		$profile_id = strip_tags($instance['profile_id']);

?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e("Title: ","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('profile_id'); ?>">
    <?php _e("Facebook Page Name: ","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('profile_id'); ?>" name="<?php echo $this->get_field_name('profile_id'); ?>" type="text" value="<?php echo esc_attr($profile_id); ?>" />
  </label>
</p>
<?php

	}

}

// Footer 1

class Footer1_Widget extends WP_Widget {

	function Footer1_Widget() {

		$widget_ops = array( 'description' => (__('Footer 1 Widget' ,'language')));

		$this->WP_Widget('Footer1widget', 'Automotive: Footer 1 Module Widget', $widget_ops);

	}

	function widget($args, $instance) {

		extract($args, EXTR_SKIP);	

		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

		$text = empty($instance['text']) ? ' ' : apply_filters('widget_text', $instance['text']);	

		$pagelink = empty($instance['pagelink']) ? ' ' : apply_filters('widget_pagelink', $instance['pagelink']);

		$blogurl = get_bloginfo('template_url');								

		?>
<div class=" footer-col footer-col1">
  <h3 class="search-title"><?php echo $title;?></h3>
  <p><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></p>
  <p><a class="learn-more" href='<?php echo $pagelink; ?>'><?php _e('Learn more','language');?></a></p>
</div>
<?php }

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		$instance['text'] = strip_tags($new_instance['text']);

		$instance['pagelink'] = strip_tags($new_instance['pagelink']);

		if ( current_user_can('unfiltered_html') )

			$instance['text'] =  $new_instance['text'];

		else

			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );

		$instance['filter'] = isset($new_instance['filter']);

		return $instance;

		}	

		function form($instance) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '','pagelink' => '' ) );

		$title = strip_tags($instance['title']);

		$text = $instance['text'];

		$pagelink = strip_tags($instance['pagelink']);

		?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e("Title: ","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('pagelink'); ?>">
    <?php _e("URL for full page : ","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('pagelink'); ?>" name="<?php echo $this->get_field_name('pagelink'); ?>" type="text" value="<?php echo esc_attr($pagelink); ?>" />
  </label>
</p>
<textarea id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" rows="10" cols="30" ><?php echo $text; ?></textarea>
<p>
  <input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />
  &nbsp;
  <label for="<?php echo $this->get_field_id('filter'); ?>">
    <?php _e('Automatically add paragraphs','language'); ?>
  </label>
</p>
<?php

	}

}

// Footer 2	

class Footer2_Widget extends WP_Widget {

	function Footer2_Widget() {

		$widget_ops = array( 'description' => (__('Footer 2 Widget' ,'language')));

		$this->WP_Widget('Footer2widget', 'Automotive: Footer 2 Module Widget', $widget_ops);

	}

	function widget($args, $instance) {

		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);?>
<div class="footer-col footer-col2">
  <h3><?php echo $title;?></h3>
  <ul class="news">
    <?php $query = new WP_Query(array(

					'post_type' => array('post'),

					'posts_per_page' => 4

					));

						if ( $query->have_posts() ) while ( $query->have_posts() ) : $query->the_post(); 

					?>
    <p><li><a href="<?php the_permalink();?>">
      <?php the_title();?>
      </a></li></p>
    <?php endwhile; wp_reset_query(); ?>
  </ul>
</div>
<?php }

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;

	}

	function form($instance) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );

		$title = strip_tags($instance['title']);

		$text = $instance['text'];

		?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e("Title: ","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<?php

	}

}

// Footer 3

class Footer3_Widget extends WP_Widget {

	function Footer3_Widget() {

		$widget_ops = array( 'description' => (__('Footer 3 Widget' ,'language')));

		$this->WP_Widget('Footer3widget', 'Automotive: Footer 3 Module Widget', $widget_ops);

	}

	function widget($args, $instance) {

		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

		$text = empty($instance['text']) ? ' ' : apply_filters('widget_text', $instance['text']); ?>
<div class="footer-col footer-col3">
  <h3><?php echo $title;?></h3>
  </p><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?> </p></div>
<?php	

		}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		$instance['text'] = strip_tags($new_instance['text']);

		if ( current_user_can('unfiltered_html') )

			$instance['text'] =  $new_instance['text'];

		else

			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed

		$instance['filter'] = isset($new_instance['filter']);

		return $instance;

		}

	function form($instance) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );

		$title = strip_tags($instance['title']);

		$text = $instance['text']; ?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e("Title: ","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<textarea id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" rows="10" cols="30" ><?php echo $text; ?></textarea>
<p>
  <input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />
  &nbsp;
  <label for="<?php echo $this->get_field_id('filter'); ?>">
    <?php _e('Automatically add paragraphs','language'); ?>
  </label>
</p>
<?php

	}

}

// Footer 4

class Footer4_Widget extends WP_Widget {

	function Footer4_Widget() {

		$widget_ops = array( 'description' => (__('Footer 4 Widget (Map)' ,'language')));

		$this->WP_Widget('Footer4widget', 'Automotive: Footer 4 Module (Map)', $widget_ops);

		}

	function widget($args, $instance) {

		extract($args, EXTR_SKIP);	

		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$address = empty($instance['address']) ? ' ' : apply_filters('widget_title', $instance['address']);?>
<div class="footer-col footer-col4">
  <h3><?php echo $title;?></h3>
 <single-address><?php echo $address;?></single-address>
                        <script type="text/javascript">
	$(document).ready(function(){
   $("single-address").each(function(){                         
      var embed ="<div class='map'><iframe frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='https://maps.google.com/maps?f=q&amp;z=13&amp;source=s_q&amp;hl=en&amp;geocode=&amp;iwloc=near&amp;q="+ encodeURIComponent( $(this).text() ) +";&amp;output=embed'></iframe></div>";
      $(this).html(embed);                      
   });
});

	</script>

</div>
<?php	

		}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['address'] = strip_tags($new_instance['address']);

		return $instance;

		}

	function form($instance) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '','address' => '') );
		$title = strip_tags($instance['title']);
		$address = strip_tags($instance['address']);


		?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e("Title: ","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
      </label>
   <label for="<?php echo $this->get_field_id('address'); ?>">
    <?php _e("Address: ","language");?>
    <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo esc_attr($address); ?>" />
  </label>
</p>
<?php }

}