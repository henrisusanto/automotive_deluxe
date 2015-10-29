<?php

add_action( 'restrict_manage_posts', 'stock_admin_posts_filter_restrict_manage_posts' );

function stock_admin_posts_filter_restrict_manage_posts(){
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    if ('gtcd' == $type){

       global $wpdb;
    $sql = "SELECT DISTINCT meta_value FROM $wpdb->postmeta 
        WHERE $wpdb->postmeta.meta_key = '_stock' AND meta_value != ''";
    $fields = $wpdb->get_results($sql, ARRAY_N);        
                ?>
        <select name="ADMIN_FILTER_FIELD_VALUE">
        <option value=""><?php _e('Filter By Stock Number', 'language'); ?></option>
        <?php
            $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';
            foreach ($fields as $field) {
                printf
                    (
                        '<option value="%s"%s>%s</option>',
                        $field[0],
                $field[0] == $current? ' selected="selected"':'',
                $field[0]
                    );
                }
        ?>
        </select>
        <?php
    }
}
add_filter( 'parse_query', 'stock_posts_filter' );

function stock_posts_filter( $query ){
    global $pagenow;
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    if ( 'gtcd' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != '') {
        $query->query_vars['meta_key'] = '_stock';
        $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
    }}
    add_action('save_post', 'save_stock_number');   

    function meta_options(){
        global $post;
        $custom = get_post_custom($post->ID);
        $stock_number = $custom["_stock"][0];
        $options;$fields;$options2;$options3;$symbols;
		$fields = get_post_meta($post->ID, 'mod1', true); ?>
    <input  name="stock_number" value="<?php	if ( $fields['_stock']){ echo $fields['_stock'];}else {  echo ''; }?>
" />
<?php
    }  
	function save_stock_number(){
		global $post;
		update_post_meta($post->ID, "_stock", $_POST["_stock"]);
	}
function my_theme_options_init() {

register_setting( 'my_options',  'my_theme_options',  'my_theme_options_validate' );
add_settings_section( 'general', '', '__return_false', 'theme_options'  );
add_settings_field( 'location_text', __( 'Location:', 'language' ), 'my_settings_field_location_text_input', 	'theme_options', 'general' );
add_settings_field( 'state_text', __( 'State:', 'language' ), 'my_settings_field_state_text_input', 	'theme_options', 'general' );	
add_settings_field( 'status_tag_text', __( 'Condition:', 'language' ), 'my_settings_field_status_tag_text_input', 	'theme_options', 'general' );
add_settings_field( 'featured_text', __( 'Featured:', 'language' ), 'my_settings_field_featured_text_input', 	'theme_options', 'general' );
add_settings_field( 'top_deal_text', __( 'Top Deal?:', 'language' ), 'my_settings_field_top_deal_text_input', 	'theme_options', 'general' );	
add_settings_field( 'drive_text', __( 'Drive:', 'language' ), 'my_settings_field_drive_text_input', 'theme_options', 	'general' );	
add_settings_field( 'epa_mileage_text', __( 'Epa Mileage:', 'language' ), 'my_settings_field_epa_mileage_text_input', 	'theme_options', 'general' );	
add_settings_field( 'transmission_text', __( 'Transmission:', 'language' ), 	'my_settings_field_transmission_text_input', 'theme_options', 'general' );	
add_settings_field( 'stock_text', __( 'Stock #:', 'language' ), 'my_settings_field_stock_text_input', 	'theme_options', 'general' );
add_settings_field( 'vin_text', __( 'VIN:', 'language' ), 'my_settings_field_vin_text_input', 'theme_options', 	'general' );
add_settings_field( 'carfax_text', __( 'Carfax Partner ID:', 'language' ), 'my_settings_field_carfax_text_input', 	'theme_options', 'general' );
add_settings_field( 'interior_text', __( 'Interior:', 'language' ), 'my_settings_field_interior_text_input', 	'theme_options', 'general' );
add_settings_field( 'interior_text', __( 'Interior:', 'language' ), 'my_settings_field_interior_text_input', 	'theme_options', 'general' );
add_settings_field( 'exterior_text', __( 'Exterior:', 'language' ), 'my_settings_field_exterior_text_input', 	'theme_options', 'general' );
add_settings_field( 'description_text', __( 'Description:', 'language' ), 'my_settings_field_description_text_input', 	'theme_options', 'general' );
add_settings_field( 'torque_text', __( 'Torque:', 'language' ), 'my_settings_field_torque_text_input', 	'theme_options', 'general' );
add_settings_field( 'price_text', __( 'Price:', 'language' ), 'my_settings_field_price_text_input', 'theme_options', 	'general' );	
add_settings_field( 'vehicle_type_text', __('Vehicle Type:','language' ),'my_settings_field_vehicle_type_text_input', 'theme_options', 'general' );									
add_settings_field( 'miles_text', __( 'Miles:', 'language' ), 'my_settings_field_miles_text_input', 'theme_options', 	'general' );	
add_settings_field( 'year_text', __( 'Year:', 'language' ), 'my_settings_field_year_text_input', 'theme_options', 	'general' );
add_settings_field( 'make_model_text', __( 'Make & Model:', 'language' ), 'my_settings_field_make_model_text_input', 'theme_options', 	'general' );
add_settings_field( 'features_text', __( 'Features:', 'language' ), 'my_settings_field_features_text_input', 'theme_options', 	'general' );
add_settings_field( 'engine_size_text', __( 'Engine Size:', 'language' ), 'my_settings_field_engine_size_text_input', 'theme_options', 	'general' );
add_settings_field( 'numbers_cylinders_text', __( 'Number of Cylinders:', 'language' ), 'my_settings_field_number_cylinders_text_input', 'theme_options', 	'general' );
add_settings_field( 'horsepower_text', __( 'Horsepower:', 'language' ), 'my_settings_field_horsepower_text_input', 'theme_options', 	'general' );
add_settings_field( 'compression_ratio_text', __( 'Compression Ratio:', 'language' ), 'my_settings_field_compression_ratio_text_input', 'theme_options', 	'general' );
add_settings_field( 'camshaft_text', __( 'Camshaft:', 'language' ), 'my_settings_field_camshaft_text_input', 'theme_options', 	'general' );
add_settings_field( 'engine_type_text', __( 'Engine Tye:', 'language' ), 'my_settings_field_engine_type_text_input', 'theme_options', 	'general' );
add_settings_field( 'bore_text', __( 'Bore:', 'language' ), 'my_settings_field_bore_text_input', 'theme_options', 	'general' );
add_settings_field( 'stroke_text', __( 'Stroke:', 'language' ), 'my_settings_field_stroke_text_input', 'theme_options', 	'general' );
add_settings_field( 'valves_text', __( 'Valves per Cylinder:', 'language' ), 'my_settings_field_valves_text_input', 'theme_options', 	'general' );
add_settings_field( 'fuel_capacity_text', __( 'Fuel Capacity:', 'language' ), 'my_settings_field_fuel_text_input', 'theme_options', 	'general' );
add_settings_field( 'wheelbase_text', __( 'Wheelbase:', 'language' ), 'my_settings_field_wheelbase_text_input', 'theme_options', 	'general' );
add_settings_field( 'overall_length_text', __( 'Overall Length:', 'language' ), 'my_settings_field_overall_length_text_input', 'theme_options', 	'general' );
add_settings_field( 'width_text', __( 'Width:', 'language' ), 'my_settings_field_width_text_input', 'theme_options', 	'general' );
add_settings_field( 'height_text', __( 'Height:', 'language' ), 'my_settings_field_height_text_input', 'theme_options', 	'general' );
add_settings_field( 'curb_weight_text', __( 'Curb Weight:', 'language' ), 'my_settings_field_curb_weight_text_input', 'theme_options', 	'general' );
add_settings_field( 'leg_room_text', __( 'Leg Room:', 'language' ), 'my_settings_field_leg_room_text_input', 'theme_options', 	'general' );
add_settings_field( 'head_room_text', __( 'Head Room:', 'language' ), 'my_settings_field_head_room_text_input', 'theme_options', 	'general' );
add_settings_field( 'seating_text', __( 'Seating Capacity (Std):', 'language' ), 'my_settings_field_seating_text_input', 'theme_options', 	'general' );
add_settings_field( 'tires_text', __( 'Tires (Std):', 'language' ), 'my_settings_field_tires_text_input', 'theme_options', 	'general' );

}
add_action( 'admin_init', 'my_theme_options_init' );
 

function my_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_my_options', 'my_option_page_capability' );


function my_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Search Fields', 'language' ),   // Name of page
		__( 'Search Fields', 'language' ),   // Label in menu
		'edit_theme_options',          // Capability required
		'theme_options',               // Menu slug, used to uniquely identify the page
		'my_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'my_theme_options_add_page' );
 

function my_get_theme_options() {
	$saved = (array) get_option( 'my_theme_options' );
	$defaults = array(
		'price_hide'       => 'off',
		'condition_hide'       => 'off',
		'location_hide'       => 'off', 
		'vehicle_type_hide'       => 'off', 
		'year_hide'       => 'off',
		'state_hide'       => 'off',
		'make_hide'       => 'off',
		'state_text'	=> __('State','language'), 
		'location_text'	=> __('Location','language'),
		'price_text'     => __('Price','language'),
		'status_tag_text'     => __('Condition','language'),
		'top_deal_text'     => __('Top Deal','language'),
		'featured_text'     => __('Featured','language'),
		'epa_mileage_text'     => __('EPA Mileage','language'),
		'stock_text'     => __('Stock','language'),
		'vin_text'     => __('VIN','language'),
		'carfax_text'     => __('Carfax Parner ID','language'),
		'interior_text'     => __('Interior','language'),
		'exterior_text'     => __('Exterior','language'),
		'drive_text'     => __('Drive','language'),
		'description_text'     	=> __('Description','language'),
		'torque_text'     	=> __('Torque','language'),
		'year_text'     	=> __('Year','language'),
		'miles_text'     	=> __('Miles','language'),
		'make_model_text'     	=> __('Make & Model','language'),
		'features_text'     	=> __('Features','language'),
		'year_start_text'     	=> __('1990','language'),
		'year_end_text'     	=> __('2015','language'),
		'engine_size_text'     	=> __('Engine Size','language'),
		'number_cylinders_text'     	=> __('Number of Cylinders','language'),
		'horsepower_text'     	=> __('Horsepower','language'),
		'compression_ratio_text'     	=> __('Compression Ratio','language'),
		'camshaft_text'     	=> __('Camshaft','language'),
		'engine_type_text'     	=> __('Engine Type','language'),
		'bore_text'     	=> __('Bore','language'),
		'stroke_text'     	=> __('Stroke','language'),
		'valves_text'     	=> __('Valves','language'),
		'fuel_capacity_text'     	=> __('Fuel Capacity','language'),
		'wheelbase_text'     	=> __('Wheelbase','language'),
		'overall_length_text'     	=> __('Overall Lenght','language'),
		'width_text'     	=> __('Width','language'),
		'height_text'     	=> __('Height','language'),
		'curb_weight_text'     	=> __('Curb Weight','language'),
		'leg_room_text'     	=> __('Leg Room','language'),
		'head_room_text'     	=> __('Head Room','language'),
		'seating_text'     	=> __('Seating Capacity (Std)','language'),
		'tires_text'     	=> __('Tires (Std)','language'),
		'transmission_text'     	=> __('Transmission','language'),
		'transmission_1'     	=> __('Automatic','language'),
		'transmission_2'     	=> __('Manual','language'),
		'transmission_3'     	=> __('Semi-Auto','language'),
		'transmission_4'     	=> __('Other','language'),
		'vehicle_type_text'     	=> __('Vehicle Type','language'),
		'vehicle_type_1'     	=> __('Convertibles','language'),
		'vehicle_type_2'     	=> __('Crossovers','language'),
		'vehicle_type_3'     	=> __('Luxury Vehicles','language'),
		'vehicle_type_4'     	=> __('Hybrids','language'),
		'vehicle_type_5'     	=> __('Minivans and Vans','language'),
		'vehicle_type_6'     	=> __('Pickup Trucks','language'),
		'vehicle_type_7'     	=> __('Sedans and Coupes','language'),
		'vehicle_type_8'     	=> __('Diesel Engines','language'),
		'vehicle_type_9'     	=> __('Sport Utilities','language'),
		'vehicle_type_10'     	=> __('Sports Cars','language'),
		'vehicle_type_11'     	=> __('Wagons','language'),
		'vehicle_type_12'     	=> __('4WD-AWD','language'),
	);
 
	$defaults = apply_filters( 'my_default_theme_options', $defaults );
	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );
 
	return $options;
}
 
function my_settings_field_year_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[year_text]" id="year-text-input" value="<?php echo esc_attr( $options['year_text'] ); ?>" /><label for="checkbox">
		<input type="checkbox" name="my_theme_options[year_hide]" id="checkbox" <?php checked( 'on', $options['year_hide'] ); ?> />
		<?php _e( ' Hide in Search Module.', 'language' ); ?>
	</label>
	<div style="padding:5px 0;"></div>
	<li class='li'><strong><?php _e('Start Date:','language');?></strong>&nbsp;<input type="text" name="my_theme_options[year_start_text]" id="year-text-input" value="<?php echo esc_attr( $options['year_start_text'] ); ?>" />
	<li class='lialt'>&nbsp;&nbsp;&nbsp;<strong><?php _e('End Date:','language');?></strong>&nbsp;<input type="text" name="my_theme_options[year_end_text]" id="year-text-input" value="<?php echo esc_attr( $options['year_end_text'] ); ?>" /></li>
	
	<?php
}
function my_settings_field_make_model_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[make_model_text]" id="make_model-text-input" value="<?php echo esc_attr( $options['make_model_text'] ); ?>" />
		<label for="checkbox">
		<input type="checkbox" name="my_theme_options[make_hide]" id="checkbox" <?php checked( 'on', $options['make_hide'] ); ?> />
		<?php _e( ' Hide in Search Module.', 'language' ); ?>
	</label>

	<?php
}
function my_settings_field_make_hide() {
	$options = my_get_theme_options();
	?>
	<?php
}
function my_settings_field_condition_hide() {
	$options = my_get_theme_options();
	?>
	<?php
}

function my_settings_field_state_hide() {
	$options = my_get_theme_options();
	?>
	<?php
}
function my_settings_field_price_hide() {
	$options = my_get_theme_options();
	?>
	<?php
}
function my_settings_field_year_hide() {
	$options = my_get_theme_options();
	?>
	<?php
}
function my_settings_field_vehicle_type_hide() {
	$options = my_get_theme_options();
	?>
	<?php
}
function my_settings_field_location_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[location_text]" id="location-text-input" value="<?php echo esc_attr( $options['location_text'] ); ?>" />	
	<?php	
}
function my_settings_field_state_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[state_text]" id="state-text-input" value="<?php echo esc_attr( $options['state_text'] ); ?>" />	<label for="checkbox">
		<input type="checkbox" name="my_theme_options[state_hide]" id="checkbox" <?php checked( 'on', $options['state_hide'] ); ?> />
		<?php _e( ' Hide in Search Module.', 'language' ); ?>
	</label>
	<?php	
}
function my_settings_field_price_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[price_text]" id="price-text-input" value="<?php echo esc_attr( $options['price_text'] ); ?>" />	<label for="checkbox">
		<input type="checkbox" name="my_theme_options[price_hide]" id="checkbox" <?php checked( 'on', $options['price_hide'] ); ?> />
		<?php _e( ' Hide in Search Module.', 'language' ); ?>
	</label>

	<?php	
}
function my_settings_field_featured_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[featured_text]" id="featured-text-input" value="<?php echo esc_attr( $options['featured_text'] ); ?>" />

	<?php
}
function my_settings_field_top_deal_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[top_deal_text]" id="top_deal-text-input" value="<?php echo esc_attr( $options['top_deal_text'] ); ?>" />

	<?php
}
function my_settings_field_status_tag_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[status_tag_text]" id="statustag_text-text-input" value="<?php echo esc_attr( $options['status_tag_text'] ); ?>" />
	<label for="checkbox">
		<input type="checkbox" name="my_theme_options[condition_hide]" id="checkbox" <?php checked( 'on', $options['condition_hide'] ); ?> />
		<?php _e( ' Hide in Search Module.', 'language' ); ?>
	</label>
	<?php
}
function my_settings_field_drive_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[drive_text]" id="drive-text-input" value="<?php echo esc_attr( $options['drive_text'] ); ?>" />
	<?php
}
function my_settings_field_epa_mileage_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[epa_mileage_text]" id="epa_mileage-text-input" value="<?php echo esc_attr( $options['epa_mileage_text'] ); ?>" />

	<?php
}
function my_settings_field_stock_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[stock_text]" id="stock-text-input" value="<?php echo esc_attr( $options['stock_text'] ); ?>" />

	<?php
}
function my_settings_field_vin_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[vin_text]" id="vin-text-input" value="<?php echo esc_attr( $options['vin_text'] ); ?>" />

	<?php
}
function my_settings_field_carfax_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[carfax_text]" id="carfax-text-input" value="<?php echo esc_attr( $options['carfax_text'] ); ?>" />

	<?php
}
function my_settings_field_interior_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[interior_text]" id="interior-text-input" value="<?php echo esc_attr( $options['interior_text'] ); ?>" />

	<?php
}
function my_settings_field_exterior_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[exterior_text]" id="exterior-text-input" value="<?php echo esc_attr( $options['exterior_text'] ); ?>" />

	<?php
}
function my_settings_field_torque_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[torque_text]" id="torque-text-input" value="<?php echo esc_attr( $options['torque_text'] ); ?>" />

	<?php
}
function my_settings_field_miles_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[miles_text]" id="miles-text-input" value="<?php echo esc_attr( $options['miles_text'] ); ?>" />

	<?php
}
function my_settings_field_features_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[features_text]" id="features-text-input" value="<?php echo esc_attr( $options['features_text'] ); ?>" />

	<?php
}
function my_settings_field_engine_size_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[engine_size_text]" id="engine_size-text-input" value="<?php echo esc_attr( $options['engine_size_text'] ); ?>" />

	<?php
}
function my_settings_field_number_cylinders_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[number_cylinders_text]" id="number_cylinders-text-input" value="<?php echo esc_attr( $options['number_cylinders_text'] ); ?>" />

	<?php
}
function my_settings_field_horsepower_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[horsepower_text]" id="horsepower-text-input" value="<?php echo esc_attr( $options['horsepower_text'] ); ?>" />

	<?php
}
function my_settings_field_compression_ratio_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[compression_ratio_text]" id="compression_ratio-text-input" value="<?php echo esc_attr( $options['compression_ratio_text'] ); ?>" />

	<?php
}
function my_settings_field_camshaft_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[camshaft_text]" id="camshaft-text-input" value="<?php echo esc_attr( $options['camshaft_text'] ); ?>" />

	<?php
}
function my_settings_field_engine_type_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[engine_type_text]" id="engine_type-text-input" value="<?php echo esc_attr( $options['engine_type_text'] ); ?>" />

	<?php
}
function my_settings_field_bore_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[bore_text]" id="bore-text-input" value="<?php echo esc_attr( $options['bore_text'] ); ?>" />

	<?php
}
function my_settings_field_stroke_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[stroke_text]" id="stroke-text-input" value="<?php echo esc_attr( $options['stroke_text'] ); ?>" />

	<?php
}
function my_settings_field_valves_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[valves_text]" id="valves-text-input" value="<?php echo esc_attr( $options['valves_text'] ); ?>" />

	<?php
}
function my_settings_field_fuel_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[fuel_capacity_text]" id="fuel_capacity-text-input" value="<?php echo esc_attr( $options['fuel_capacity_text'] ); ?>" />

	<?php
}
function my_settings_field_wheelbase_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[wheelbase_text]" id="wheelbase-text-input" value="<?php echo esc_attr( $options['wheelbase_text'] ); ?>" />

	<?php
}
function my_settings_field_overall_length_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[overall_length_text]" id="overall_length-text-input" value="<?php echo esc_attr( $options['overall_length_text'] ); ?>" />

	<?php
}
function my_settings_field_width_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[width_text]" id="width-text-input" value="<?php echo esc_attr( $options['width_text'] ); ?>" />

	<?php
}
function my_settings_field_height_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[height_text]" id="height-text-input" value="<?php echo esc_attr( $options['height_text'] ); ?>" />

	<?php
}
function my_settings_field_curb_weight_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[curb_weight_text]" id="curb_weight-text-input" value="<?php echo esc_attr( $options['curb_weight_text'] ); ?>" />

	<?php
}
function my_settings_field_leg_room_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[leg_room_text]" id="leg_room-text-input" value="<?php echo esc_attr( $options['leg_room_text'] ); ?>" />

	<?php
}
function my_settings_field_head_room_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[head_room_text]" id="head_room-text-input" value="<?php echo esc_attr( $options['head_room_text'] ); ?>" />

	<?php
}
function my_settings_field_seating_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[seating_text]" id="seating-text-input" value="<?php echo esc_attr( $options['seating_text'] ); ?>" />

	<?php
}
function my_settings_field_tires_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[tires_text]" id="tires-text-input" value="<?php echo esc_attr( $options['tires_text'] ); ?>" />

	<?php
}
function my_settings_field_description_text_input() {
	$options = my_get_theme_options();
	?>
	<input type="text" name="my_theme_options[description_text]" id="description-text-input" value="<?php echo esc_attr( $options['description_text'] ); ?>" />

	<?php
}
function my_settings_field_vehicle_type_text_input() {
	$options = my_get_theme_options();
	?>
	

<input type="text" name="my_theme_options[vehicle_type_text]" id="vehicle_type-text-input" value="<?php echo esc_attr( $options['vehicle_type_text'] ); ?>" /><label for="checkbox">
		<input type="checkbox" name="my_theme_options[vehicle_type_hide]" id="checkbox" <?php checked( 'on', $options['vehicle_type_hide'] ); ?> />
		<?php _e( ' Hide in Search Module.', 'language' ); ?>
	</label>
	<div style="padding:5px 0;"></div>
	
	
	<li class='li'><strong><?php _e('Option 1:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[vehicle_type_1]" id="vehicle_type-text-input" value="<?php echo esc_attr( $options['vehicle_type_1'] ); ?>" /></li>	
	<li class='lialt'><strong><?php _e('Option 2:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[vehicle_type_2]" id="vehicle_type-text-input" value="<?php echo esc_attr( $options['vehicle_type_2'] ); ?>" /></li>	
	<li class='li'><strong><?php _e('Option 3:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[vehicle_type_3]" id="vehicle_type-text-input" value="<?php echo esc_attr( $options['vehicle_type_3'] ); ?>" /></li>	
	<li class='lialt'><strong><?php _e('Option 4:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[vehicle_type_4]" id="vehicle_type-text-input" value="<?php echo esc_attr( $options['vehicle_type_4'] ); ?>" /></li>
	<li class='li'><strong><?php _e('Option 5:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[vehicle_type_5]" id="vehicle_type-text-input" value="<?php echo esc_attr( $options['vehicle_type_5'] ); ?>" /></li>	
	<li class='lialt'><strong><?php _e('Option 6:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[vehicle_type_6]" id="vehicle_type-text-input" value="<?php echo esc_attr( $options['vehicle_type_6'] ); ?>" /></li>	
	<li class='li'><strong><?php _e('Option 7:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[vehicle_type_7]" id="vehicle_type-text-input" value="<?php echo esc_attr( $options['vehicle_type_7'] ); ?>" /></li>	
	<li class='lialt'><strong><?php _e('Option 8:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[vehicle_type_8]" id="vehicle_type-text-input" value="<?php echo esc_attr( $options['vehicle_type_8'] ); ?>" /></li>	
	<li class='li'><strong><?php _e('Option 9:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[vehicle_type_9]" id="vehicle_type-text-input" value="<?php echo esc_attr( $options['vehicle_type_9'] ); ?>" /></li>	
	<li class='lialt'><strong><?php _e('Option 10:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[vehicle_type_10]" id="vehicle_type-text-input" value="<?php echo esc_attr( $options['vehicle_type_10'] ); ?>" /></li>	
	<li class='li'><strong><?php _e('Option 11:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[vehicle_type_11]" id="vehicle_type-text-input" value="<?php echo esc_attr( $options['vehicle_type_11'] ); ?>" /></li>
	<li class='lialt'><strong><?php _e('Option 12:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[vehicle_type_12]" id="vehicle_type-text-input" value="<?php echo esc_attr( $options['vehicle_type_12'] ); ?>" /></li>	
	<?php
}
function my_settings_field_transmission_text_input() {
	$options = my_get_theme_options();
	?>	
	<input type="text" name="my_theme_options[transmission_text]" id="transmission-text-input" value="<?php echo esc_attr( $options['transmission_text'] ); ?>" />
		<div style="padding:5px 0;"></div>
	<li class='li'><strong><?php _e('Option 1:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[transmission_1]" id="transmission-text-input" value="<?php echo esc_attr( $options['transmission_1'] ); ?>" /></li>
	
	<li class='lialt'><strong><?php _e('Option 2:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[transmission_2]" id="transmission-text-input" value="<?php echo esc_attr( $options['transmission_2'] ); ?>" /></li>
	
	<li class='li'><strong><?php _e('Option 3:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[transmission_3]" id="transmission-text-input" value="<?php echo esc_attr( $options['transmission_3'] ); ?>" /></li>
	
	<li class='lialt'><strong><?php _e('Option 4:','language');?></strong>&nbsp;&nbsp;<input type="text" name="my_theme_options[transmission_4]" id="transmission-text-input" value="<?php echo esc_attr( $options['transmission_4'] ); ?>" /></li>	
	<?php
}
function my_theme_options_render_page() {
	?>
		<div id="theme-options-wrap" class="widefat">    
    <div id="icon-themes" class="icon32"><br /></div> 
		<?php screen_icon(); ?>
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'language' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>
 
		<form method="post" action="options.php">
			
			<div class="tabber_container">
			<div class="block">			
				<?php settings_fields( 'my_options' );
				do_settings_sections( 'theme_options' ); ?>		</div>
			</div>			
				<?php submit_button();
			?>
		</form>
	</div>
	<?php
}
function my_theme_options_validate( $input ) {
	$output = array();

		if ( isset( $input['price_hide'] ) )
		$output['price_hide'] = 'on';	
		if ( isset( $input['year_hide'] ) )
		$output['year_hide'] = 'on';
		if ( isset( $input['vehicle_type_hide'] ) )
		$output['vehicle_type_hide'] = 'on';		
		if ( isset( $input['state_hide'] ) )
		$output['state_hide'] = 'on';		
		if ( isset( $input['make_hide'] ) )
		$output['make_hide'] = 'on';		
		if ( isset( $input['condition_hide'] ) )
		$output['condition_hide'] = 'on';
		if ( isset( $input['featured_text'] ) && ! empty( $input['featured_text'] ) )
		$output['featured_text'] = wp_filter_nohtml_kses( $input['featured_text'] );		
		if ( isset( $input['make_model_text'] ) && ! empty( $input['make_model_text'] ) )
		$output['make_model_text'] = wp_filter_nohtml_kses( $input['make_model_text'] );		
		if ( isset( $input['location_text'] ) && ! empty( $input['location_text'] ) )
		$output['location_text'] = wp_filter_nohtml_kses( $input['location_text'] );	
		if ( isset( $input['state_text'] ) && ! empty( $input['state_text'] ) )
		$output['state_text'] = wp_filter_nohtml_kses( $input['state_text'] );	
		if ( isset( $input['price_text'] ) && ! empty( $input['price_text'] ) )
		$output['price_text'] = wp_filter_nohtml_kses( $input['price_text'] );	
		if ( isset( $input['top_deal_text'] ) && ! empty( $input['top_deal_text'] ) )
		$output['top_deal_text'] = wp_filter_nohtml_kses( $input['top_deal_text'] );	
		if ( isset( $input['epa_mileage_text'] ) && ! empty( $input['epa_mileage_text'] ) )
		$output['epa_mileage_text'] = wp_filter_nohtml_kses( $input['epa_mileage_text'] );
		if ( isset( $input['stock_text'] ) && ! empty( $input['stock_text'] ) )
		$output['stock_text'] = wp_filter_nohtml_kses( $input['stock_text'] );
		 if ( isset( $input['vin_text'] ) && ! empty( $input['vin_text'] ) )
		$output['vin_text'] = wp_filter_nohtml_kses( $input['vin_text'] );
		if ( isset( $input['carfax_text'] ) && ! empty( $input['carfax_text'] ) )
		$output['carfax_text'] = wp_filter_nohtml_kses( $input['carfax_text'] );
		if ( isset( $input['interior_text'] ) && ! empty( $input['interior_text'] ) )
		$output['interior_text'] = wp_filter_nohtml_kses( $input['interior_text'] );
		if ( isset( $input['exterior_text'] ) && ! empty( $input['exterior_text'] ) )
		$output['exterior_text'] = wp_filter_nohtml_kses( $input['exterior_text'] );
		if ( isset( $input['drive_text'] ) && ! empty( $input['drive_text'] ) )
		$output['drive_text'] = wp_filter_nohtml_kses( $input['drive_text'] );
		if ( isset( $input['description_text'] ) && ! empty( $input['description_text'] ) )
		$output['description_text'] = wp_filter_nohtml_kses( $input['description_text'] );
		if ( isset( $input['torque_text'] ) && ! empty( $input['torque_text'] ) )
		$output['torque_text'] = wp_filter_nohtml_kses( $input['torque_text'] );
		if ( isset( $input['year_text'] ) && ! empty( $input['year_text'] ) )
		$output['year_text'] = wp_filter_nohtml_kses( $input['year_text'] );
		if ( isset( $input['miles_text'] ) && ! empty( $input['miles_text'] ) )
		$output['miles_text'] = wp_filter_nohtml_kses( $input['miles_text'] );
		if ( isset( $input['make_model_text'] ) && ! empty( $input['make_model_text'] ) )
		$output['make_model_text'] = wp_filter_nohtml_kses( $input['make_model_text'] );
		if ( isset( $input['features_text'] ) && ! empty( $input['features_text'] ) )
		$output['features_text'] = wp_filter_nohtml_kses( $input['features_text'] );
		if ( isset( $input['year_start_text'] ) && ! empty( $input['year_start_text'] ) )
		$output['year_start_text'] = wp_filter_nohtml_kses( $input['year_start_text'] );
		if ( isset( $input['year_end_text'] ) && ! empty( $input['year_end_text'] ) )
		$output['year_end_text'] = wp_filter_nohtml_kses( $input['year_end_text'] );
		if ( isset( $input['engine_size_text'] ) && ! empty( $input['engine_size_text'] ) )
		$output['engine_size_text'] = wp_filter_nohtml_kses( $input['engine_size_text'] );
		if ( isset( $input['number_cylinders_text'] ) && ! empty( $input['number_cylinders_text'] ) )
		$output['number_cylinders_text'] = wp_filter_nohtml_kses( $input['number_cylinders_text'] );
		if ( isset( $input['horsepower_text'] ) && ! empty( $input['horsepower_text'] ) )
		$output['horsepower_text'] = wp_filter_nohtml_kses( $input['horsepower_text'] );
		if ( isset( $input['compression_ratio_text'] ) && ! empty( $input['compression_ratio_text'] ) )
		$output['compression_ratio_text'] = wp_filter_nohtml_kses( $input['compression_ratio_text'] );
		if ( isset( $input['camshaft_text'] ) && ! empty( $input['camshaft_text'] ) )
		$output['camshaft_text'] = wp_filter_nohtml_kses( $input['camshaft_text'] );
		if ( isset( $input['engine_type_text'] ) && ! empty( $input['engine_type_text'] ) )
		$output['engine_type_text'] = wp_filter_nohtml_kses( $input['engine_type_text'] );
		if ( isset( $input['bore_text'] ) && ! empty( $input['bore_text'] ) )
		$output['bore_text'] = wp_filter_nohtml_kses( $input['bore_text'] );
		if ( isset( $input['stroke_text'] ) && ! empty( $input['stroke_text'] ) )
		$output['stroke_text'] = wp_filter_nohtml_kses( $input['stroke_text'] );
		if ( isset( $input['valves_text'] ) && ! empty( $input['valves_text'] ) )
		$output['valves_text'] = wp_filter_nohtml_kses( $input['valves_text'] );
		if ( isset( $input['fuel_capacity_text'] ) && ! empty( $input['fuel_capacity_text'] ) )
		$output['fuel_capacity_text'] = wp_filter_nohtml_kses( $input['fuel_capacity_text'] );
		if ( isset( $input['wheelbase_text'] ) && ! empty( $input['wheelbase_text'] ) )
		$output['wheelbase_text'] = wp_filter_nohtml_kses( $input['wheelbase_text'] );
		if ( isset( $input['overall_lenght_text'] ) && ! empty( $input['overall_lenght_text'] ) )
		$output['overall_lenght_text'] = wp_filter_nohtml_kses( $input['overall_lenght_text'] );
		if ( isset( $input['width_text'] ) && ! empty( $input['width_text'] ) )
		$output['width_text'] = wp_filter_nohtml_kses( $input['width_text'] );
		if ( isset( $input['height_text'] ) && ! empty( $input['height_text'] ) )
		$output['height_text'] = wp_filter_nohtml_kses( $input['height_text'] );
		if ( isset( $input['curb_weight_text'] ) && ! empty( $input['curb_weight_text'] ) )
		$output['curb_weight_text'] = wp_filter_nohtml_kses( $input['curb_weight_text'] );
		if ( isset( $input['leg_room_text'] ) && ! empty( $input['leg_room_text'] ) )
		$output['leg_room_text'] = wp_filter_nohtml_kses( $input['leg_room_text'] );
		if ( isset( $input['head_room_text'] ) && ! empty( $input['head_room_text'] ) )
		$output['head_room_text'] = wp_filter_nohtml_kses( $input['head_room_text'] );
		if ( isset( $input['seating_text'] ) && ! empty( $input['seating_text'] ) )
		$output['seating_text'] = wp_filter_nohtml_kses( $input['seating_text'] );
		if ( isset( $input['tires_text'] ) && ! empty( $input['tires_text'] ) )
		$output['tires_text'] = wp_filter_nohtml_kses( $input['tires_text'] );
		if ( isset( $input['transmission_text'] ) && ! empty( $input['transmission_text'] ) )
		$output['transmission_text'] = wp_filter_nohtml_kses( $input['transmission_text'] );
		if ( isset( $input['transmission_1'] ) && ! empty( $input['transmission_1'] ) )
		$output['transmission_1'] = wp_filter_nohtml_kses( $input['transmission_1'] );
		if ( isset( $input['transmission_2'] ) && ! empty( $input['transmission_2'] ) )
		$output['property_status_2'] = wp_filter_nohtml_kses( $input['transmission_2'] );
		if ( isset( $input['transmission_3'] ) && ! empty( $input['transmission_3'] ) )
		$output['transmission_3'] = wp_filter_nohtml_kses( $input['transmission_3'] );
		if ( isset( $input['transmission_4'] ) && ! empty( $input['transmission_4'] ) )
		$output['transmission_4'] = wp_filter_nohtml_kses( $input['transmission_4'] );
		if ( isset( $input['vehicle_type_text'] ) && ! empty( $input['vehicle_type_text'] ) )
		$output['vehicle_type_text'] = wp_filter_nohtml_kses( $input['vehicle_type_text'] );
		if ( isset( $input['vehicle_type_1'] ) && ! empty( $input['vehicle_type_1'] ) )
		$output['vehicle_type_1'] = wp_filter_nohtml_kses( $input['vehicle_type_1'] );
		if ( isset( $input['vehicle_type_2'] ) && ! empty( $input['vehicle_type_2'] ) )
		$output['vehicle_type_2'] = wp_filter_nohtml_kses( $input['vehicle_type_2'] );
		if ( isset( $input['vehicle_type_3'] ) && ! empty( $input['vehicle_type_3'] ) )
		$output['vehicle_type_3'] = wp_filter_nohtml_kses( $input['vehicle_type_3'] );
		if ( isset( $input['vehicle_type_4'] ) && ! empty( $input['vehicle_type_4'] ) )
		$output['vehicle_type_4'] = wp_filter_nohtml_kses( $input['vehicle_type_4'] );
		if ( isset( $input['vehicle_type_5'] ) && ! empty( $input['vehicle_type_5'] ) )
		$output['vehicle_type_5'] = wp_filter_nohtml_kses( $input['vehicle_type_5'] );
		if ( isset( $input['vehicle_type_6'] ) && ! empty( $input['vehicle_type_6'] ) )
		$output['vehicle_type_6'] = wp_filter_nohtml_kses( $input['vehicle_type_6'] );
		if ( isset( $input['vehicle_type_7'] ) && ! empty( $input['vehicle_type_7'] ) )
		$output['vehicle_type_7'] = wp_filter_nohtml_kses( $input['vehicle_type_7'] );
		if ( isset( $input['vehicle_type_8'] ) && ! empty( $input['vehicle_type_8'] ) )
		$output['vehicle_type_8'] = wp_filter_nohtml_kses( $input['vehicle_type_8'] );
		if ( isset( $input['vehicle_type_9'] ) && ! empty( $input['vehicle_type_9'] ) )
		$output['vehicle_type_9'] = wp_filter_nohtml_kses( $input['vehicle_type_9'] );
		if ( isset( $input['vehicle_type_10'] ) && ! empty( $input['vehicle_type_10'] ) )
		$output['vehicle_type_10'] = wp_filter_nohtml_kses( $input['vehicle_type_10'] );
		if ( isset( $input['vehicle_type_11'] ) && ! empty( $input['vehicle_type_11'] ) )
		$output['vehicle_type_11'] = wp_filter_nohtml_kses( $input['vehicle_type_11'] );
		if ( isset( $input['vehicle_type_12'] ) && ! empty( $input['vehicle_type_12'] ) )
		$output['vehicle_type_12'] = wp_filter_nohtml_kses( $input['vehicle_type_12'] );
	return apply_filters( 'my_theme_options_validate', $output, $input );
}
$CarsGallery = get_option('CarsGallery_mode');
if($CarsGallery != 'New'){
$args = array('post_type' => array('gtcd','user_listing') ,'posts_per_page'=>-1 );
	$myposts = get_posts( $args );
	foreach( $myposts as $post ){
		if ( $images = get_children(array(
			'post_parent' => $post->ID,
			'post_type' => 'attachment',
			'order' => 'ASC',
			'orderby' => 'menu_order',
			'post_mime_type' => 'image',
			)))
		{
			$Gallery = array();
			foreach( $images as $image ) {
				$Gallery[] = $image->ID;
			}
			$Gallery = implode(',',$Gallery);
			if($Gallery!=''){
				update_post_meta($post->ID, 'CarsGallery', $Gallery);
			}
		}
	}
	add_option('CarsGallery_mode', 'New', '', 'yes' );
}		
function implement_ajax_name()
		{
			if ( isset($_POST[ 'main_catid' ]) ) {
				$categories = get_categories('child_of=' . $_POST[ 'main_catid' ] . '&hide_empty=0&taxonomy=makemodel');
				foreach ( $categories as $cat ) {
					$option .= '<option value="' . $cat->name . '" data-value="' . $cat->term_id . '">';
					$option .= $cat->cat_name;
					$option .= ' (' . $cat->category_count . ')';
					$option .= '</option>';
				}
				echo '<option value="" selected="selected" data-value="-1">'. __('Select Model','language').'</option>' . $option;
				die();
			} // end if

		}
		add_action('wp_ajax_name_call' , 'implement_ajax_name');
		add_action('wp_ajax_nopriv_name_call' , 'implement_ajax_name'); //for users that are not logged in.

function implement_ajax_form()
		{
			if ( isset($_POST[ 'main_catid' ]) ) {
				$categories = get_categories('child_of=' . $_POST[ 'main_catid' ] . '&hide_empty=0&taxonomy=makemodel');
				foreach ( $categories as $cat ) {
					$option .= '<option value="' . $cat->name . '" data-value="' . $cat->term_id . '">';
					$option .= $cat->cat_name;
					$option .= ' (' . $cat->category_count . ')';
					$option .= '</option>';
				}
				echo '<option value="" selected="selected" data-value="-1">'. __('Select Model','language').'</option>' . $option;
				die();
			} // end if

		}
		add_action('wp_ajax_call_form' , 'implement_ajax_form');
		add_action('wp_ajax_nopriv_call_form' , 'implement_ajax_form'); //for users that are not logged in.
function implement_ajax_location()
		{
			if ( isset($_POST[ 'main_catid' ]) ) {
				$categories = get_categories('child_of=' . $_POST[ 'main_catid' ] . '&hide_empty=0&taxonomy=location');
				foreach ( $categories as $cat ) {
					$option .= '<option value="' . $cat->name . '" data-value="' . $cat->term_id . '">';
					$option .= $cat->cat_name;
					$option .= '</option>';
				}
				echo '<option value="" selected="selected" data-value="-1">'. __('Select City','language').'</option>' . $option;
				die();
			} // end if

		}
		add_action('wp_ajax_call_location' , 'implement_ajax_location');
		add_action('wp_ajax_nopriv_call_location' , 'implement_ajax_location'); //for users that are not logged in.
function wp_dropdown_categories_custom($args = '')
		{
			$defaults = array(
				'show_option_all' => '' , 'show_option_none' => '' ,
				'orderby' => 'id' , 'order' => 'ASC' ,
				'show_last_update' => 0 , 'show_count' => 0 ,
				'hide_empty' => 1 , 'child_of' => 0 ,
				'exclude' => '' , 'echo' => 1 ,
				'selected' => 0 , 'hierarchical' => 0 ,
				'name' => 'cat' , 'id' => '' ,
				'class' => 'postform' , 'depth' => 0 ,
				'tab_index' => 0 , 'taxonomy' => 'category' ,
				'hide_if_empty' => false
			);

			$defaults[ 'selected' ] = ( is_category() ) ? get_query_var('cat') : 0;
			// Back compat.
			if ( isset($args[ 'type' ]) && 'link' == $args[ 'type' ] ) {
				_deprecated_argument(__FUNCTION__ , '3.0' , '');
				$args[ 'taxonomy' ] = 'link_category';
			}
			$r = wp_parse_args($args , $defaults);

			if ( !isset($r[ 'pad_counts' ]) && $r[ 'show_count' ] && $r[ 'hierarchical' ] ) {
				$r[ 'pad_counts' ] = true;
			}

			$r[ 'include_last_update_time' ] = $r[ 'show_last_update' ];
			extract($r);

			$tab_index_attribute = '';
			if ( ( int ) $tab_index > 0 ) $tab_index_attribute = " tabindex=\"$tab_index\"";

			$categories = get_terms($taxonomy , $r);
			$name = esc_attr($name);
			$class = esc_attr($class);
			$id = $id ? esc_attr($id) : $name;

			if ( !$r[ 'hide_if_empty' ] || !empty($categories) ) $output = "<select name='$name' id='$id' class='$class' $tab_index_attribute>\n";
			else $output = '';

			if ( empty($categories) && !$r[ 'hide_if_empty' ] && !empty($show_option_none) ) {
				$show_option_none = apply_filters('list_cats' , $show_option_none);
				$output .= "\t<option value='' selected='selected' data-value='-1'>$show_option_none</option>\n";
			}

			if ( !empty($categories) ) {

				if ( $show_option_all ) {
					$show_option_all = apply_filters('list_cats' , $show_option_all);
					$selected = ( '0' === strval($r[ 'selected' ]) ) ? " selected='selected'" : '';
					$output .= "\t<option value='0'$selected data-value='0'>$show_option_all</option>\n";
				}

				if ( $show_option_none ) {
					$show_option_none = apply_filters('list_cats' , $show_option_none);
					$selected = ( '-1' === strval($r[ 'selected' ]) ) ? " selected='selected'" : '';
					$output .= "\t<option value='' $selected  data-value='-1'>$show_option_none</option>\n";
				}

				if ( $hierarchical ) $depth = $r[ 'depth' ];  // Walk the full depth.
				else $depth = -1; // Flat.

				$output .= walk_category_dropdown_tree($categories , $depth , $r);
			}
			if ( !$r[ 'hide_if_empty' ] || !empty($categories) ) $output .= "</select>\n";


			$output = apply_filters('wp_dropdown_cats' , $output);

			if ( $echo ) echo $output;

			return $output;

		}
class Walker_CategoryDropdown_Custom extends Walker_CategoryDropdown
        {
            function start_el(&$output , $category , $depth , $args)
            {
                $pad = str_repeat(' ' , $depth * 3);

                $cat_name = apply_filters('list_cats' , $category->name , $category);
                $output .= "\t<option class=\"level-$depth\" value=\"" . $category->name . "\" data-value=\"" . $category->term_id . "\"";
                if ( $category->term_id == $args[ 'selected' ] ) $output .= ' selected="selected"';
                $output .= '>';
                $output .= $pad . $cat_name;
                if ( $args[ 'show_count' ] ) $output .= '  (' . $category->count . ')';
                if ( array_key_exists('show_last_update', $args) && $args[ 'show_last_update' ] ) {
                    $format = 'Y-m-d';
                    $output .= '  ' . gmdate($format , $category->last_update_timestamp);
                }
                $output .= "</option>\n";

            }

        }
add_filter( 'request', 'mi_request_filter' );
function mi_request_filter( $query_vars ) {
    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }
    return $query_vars;
}
		define('AUTODEALER_INCLUDES', get_template_directory() . '/includes/');
		define('THEME_FUNCTIONS', get_template_directory() . '/functions/');
		define('THEME_WIDGETS', get_template_directory() . '/widgets/');	
		define('THEME_NAME', 'CARDEALER');
		define('THEME_DIR', get_bloginfo('template_directory'));	
		require_once(THEME_FUNCTIONS.'basic-theme-setup.php');
		require_once(THEME_FUNCTIONS . 'file/functions.php' );
		require_once(get_template_directory().'/includes/meta-box.php');
		require_once(THEME_FUNCTIONS.'gtcd-post-type.php');
		require_once(THEME_FUNCTIONS.'user-post-type.php');
		require_once(THEME_FUNCTIONS.'menu-and-settings-page.php');
		require_once(THEME_FUNCTIONS.'validate-fields.php');
		require_once(THEME_FUNCTIONS.'meta-boxes-code.php');
		require_once(THEME_FUNCTIONS.'custom-taxonomies.php');
		require_once(THEME_FUNCTIONS.'dashboard-widgets.php');	
		require_once(THEME_WIDGETS.'register-sidebars.php');
		require_once(THEME_FUNCTIONS.'search-code.php');
		require_once(get_template_directory(). '/widgets/theme-widgets.php');
	
if (!function_exists('load_theme_scripts')) {
	function load_theme_scripts() {
	if (!is_admin() && is_page_template( 'cdform.php' ) ) 
	{
	$mjscriptURL = get_template_directory_uri().'/foundationFramework/javascripts/';
	$jscriptURL = get_template_directory_uri().'/js/';
	wp_deregister_script( 'jquery' );
	$current_protocol = is_ssl() ? 'https' : 'http';
	wp_register_script( 'jquery', $current_protocol . '://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
    wp_enqueue_script( 'jquery' );	
	wp_register_script('myScript', ($jscriptURL.'scripts-form.js'), array('jquery'), NULL, true );
	wp_enqueue_script('myScript');
	wp_register_script('jselectBox', ($jscriptURL.'jquery.selectBox.js'), array('jquery'), NULL, true );
	wp_enqueue_script('jselectBox');
	wp_register_script('jvalidate', ($jscriptURL.'jquery.validate.min.js'), array('jquery'), NULL, true );
	wp_enqueue_script('jvalidate');
	wp_register_script('mediaQueryToggle', ($mjscriptURL.'jquery.foundation.mediaQueryToggle.js'), array('jquery'), NULL, true );
	wp_enqueue_script('mediaQueryToggle');	
	wp_register_script('navigation', ($mjscriptURL.'jquery.foundation.navigation.js'), array('jquery'), NULL, true );
	wp_enqueue_script('navigation');	
	wp_register_script('topbar', ($mjscriptURL.'jquery.foundation.topbar.js'), array('jquery'), NULL, true );
	wp_enqueue_script('topbar');	
	wp_register_script('reveal', ($mjscriptURL.'jquery.foundation.reveal.js'), array('jquery'), NULL, true );
	wp_enqueue_script('reveal');	
	wp_register_script('app', ($mjscriptURL.'app.js'), array('jquery'), NULL, true );
	wp_enqueue_script('app');	
	wp_register_script('mobileScript', ($mjscriptURL.'mobileScript.js'), array('jquery'), NULL, true );
	wp_enqueue_script('mobileScript');	
	wp_register_script('modernizr', ($mjscriptURL.'touch_slider/modernizr.custom.17475.js'), array('jquery'), NULL, true );
	wp_enqueue_script('modernizr');
	wp_register_script('elastislide', ($mjscriptURL.'touch_slider/jquery.elastislide.js'), array('jquery'), NULL, true );
	wp_enqueue_script('elastislide');	
	wp_register_script('jquerypp', ($mjscriptURL.'touch_slider/jquerypp.custom.js'), array('jquery'), NULL, true );
	wp_enqueue_script('jquerypp');	
		
	} else {
	$mjscriptURL = get_template_directory_uri().'/foundationFramework/javascripts/';	
	$jscriptURL = get_template_directory_uri().'/js/';
	wp_deregister_script( 'jquery' );
    $current_protocol = is_ssl() ? 'https' : 'http';
	wp_register_script( 'jquery', $current_protocol . '://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
    wp_enqueue_script( 'jquery' );
	wp_register_script('jsEasing', ($jscriptURL.'jquery.easing.1.3.js'), array('jquery'), NULL, true );
	wp_enqueue_script('jsEasing');			
	wp_register_script('jcolorbox', ($jscriptURL.'jquery.colorbox-min.js'), array('jquery'), NULL, true );
	wp_enqueue_script('jcolorbox');		
	wp_register_script('myScript', ($jscriptURL.'script.js'), array('jquery'), NULL, true );
	wp_enqueue_script('myScript');
	wp_register_script('mySlides', ($jscriptURL.'slides.min.jquery.js'), array('jquery'), NULL, true );
	wp_enqueue_script('mySlides');
	wp_register_script('myCycle', ($jscriptURL.'jquery.cycle.min.js'), array('jquery'), NULL, true );
	wp_enqueue_script('myCycle');
	wp_register_script('jselectBox', ($jscriptURL.'jquery.selectBox.js'), array('jquery'), NULL, true );
	wp_enqueue_script('jselectBox');
	wp_register_script('jvalidate', ($jscriptURL.'jquery.validate.min.js'), array('jquery'), NULL, true );
	wp_enqueue_script('jvalidate');
	wp_register_script('janimate', ($jscriptURL.'jquery.animate.js'), array('jquery'), NULL, true );
	wp_enqueue_script('janimate');
	wp_register_script('janchorScroll', ($jscriptURL.'jquery.anchorScroll.js'), array('jquery'), NULL, true );
	wp_enqueue_script('janchorScroll');
	wp_register_script('mediaQueryToggle', ($mjscriptURL.'jquery.foundation.mediaQueryToggle.js'), array('jquery'), NULL, true );
	wp_enqueue_script('mediaQueryToggle');	
	wp_register_script('navigation', ($mjscriptURL.'jquery.foundation.navigation.js'), array('jquery'), NULL, true );
	wp_enqueue_script('navigation');	
	wp_register_script('topbar', ($mjscriptURL.'jquery.foundation.topbar.js'), array('jquery'), NULL, true );
	wp_enqueue_script('topbar');	
	wp_register_script('reveal', ($mjscriptURL.'jquery.foundation.reveal.js'), array('jquery'), NULL, true );
	wp_enqueue_script('reveal');	
	wp_register_script('app', ($mjscriptURL.'app.js'), array('jquery'), NULL, true );
	wp_enqueue_script('app');	
	wp_register_script('mobileScript', ($mjscriptURL.'mobileScript.js'), array('jquery'), NULL, true );
	wp_enqueue_script('mobileScript');	
	wp_register_script('modernizr', ($mjscriptURL.'touch_slider/modernizr.custom.17475.js'), array('jquery'), NULL, true );
	wp_enqueue_script('modernizr');	
	wp_register_script('elastislide', ($mjscriptURL.'touch_slider/jquery.elastislide.js'), array('jquery'), NULL, true );
	wp_enqueue_script('elastislide');	
	wp_register_script('jquerypp', ($mjscriptURL.'touch_slider/jquerypp.custom.js'), array('jquery'), NULL, true );
	wp_enqueue_script('jquerypp');	
	}
	}
}
add_action('wp_enqueue_scripts', 'load_theme_scripts');   
// custom menu support
	add_theme_support( 'menus' );
	if ( function_exists( 'register_nav_menus' ) ) {
	  	register_nav_menus(
	  		array(
	  		  'header-menu' => 'Header Menu'
	  		)
	  	);
	}
	// post thumbnail support
	add_theme_support( 'post-thumbnails' );		
	// theme pagination method
	function theme_pagination($pages = ''){
		global $paged;		
		if(empty($paged))$paged = 1;		
		$prev = $paged - 1;							
		$next = $paged + 1;	
		$range = 3; // only change it to show more links
		$showitems = ($range * 2)+1;		
		if($pages == '')
		{	
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages)
			{
				$pages = 1;
			}
		}		
		if(1 != $pages){
			echo "<div id='pagination'>";
			echo ($paged > 2 && $paged > $range+1 && $showitems < $pages)? "<a href='".get_pagenum_link(1)."' class='btn'>&laquo; First</a> ":"";
			echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."' class='btn'>&laquo; Previous</a> ":"";				
			for ($i=1; $i <= $pages; $i++){
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
					echo ($paged == $i)? "<a href='".get_pagenum_link($i)."' class='btn current'>".$i."</a> ":"<a href='".get_pagenum_link($i)."' class='btn'>".$i."</a> "; 
				}
			}			
			echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."' class='btn'>Next &raquo;</a> " :"";
			echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."' class='btn'>Last &raquo;</a> ":"";
			echo "</div>";
			}
	}	
	// pie fix for wordpress
	function render_ie_pie() {
		echo '<!--[if lte IE 8]>
				<style type="text/css" media="screen">
					.search-form-wrapper,
					.search-form-wrapper .find-btn:hover,
					#slides,
					#slides img,
					.image-container img,
					.tricol-product-list li .image-container img,
					.tricol-product-list li a:hover,
					.find-wrapper,
					.find-nav li a,
					.cars-list li a img:hover,
					.right-white-block,
					.right-white-block .side-block-btn:hover,
					.side-lift-block .search-btn:hover,
					.detail-page-content .big-view img,
					.thumbnails li img,
					.thumbnails li img:hover,
					.side-product-wrapper .image-container img,
					.side-product-wrapper  a:hover,
					.result-car,
					.result-car img,
					.learn-more-btn:hover,
					.more-news:hover,
					.footer-bubmit-btn:hover,
					#pagination a.btn
					{
						behavior: url('.trailingslashit(get_bloginfo('template_url')).'js/PIE.php);
					}
				</style>
			<![endif]-->';
	}		
	add_action('wp_head', 'render_ie_pie' );
	
		
	function gorilla_img ($post_id,$size) {		
	$saved = get_post_custom_values('CarsGallery', $post_id);
	$saved = explode(',',$saved[0]);
	if ( count($saved)>0){
	 $image = $saved[0];
			$attachmenturl=wp_get_attachment_url($image);
			$attachmentimage= wp_get_attachment_image($image, $size );
			$bigp = wp_get_attachment_image($image, $size );
				?><?php echo $attachmentimage; ?><?php
		
	} else {
		echo "";
	}
?>
  <?php 
	}
	
	function arrivals_img ($post_id,$size) {		
	
	
	if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'order' => 'ASC',
		'posts_per_page' => 1,
		'orderby' => 'menu_order',
		'post_mime_type' => 'image',
		)))
	{			foreach( $images as $image ) {
			$attachmenturl=wp_get_attachment_url($image->ID);
			$attachmentlink=wp_get_attachment_url($image->ID);
			$attachmentimage= wp_get_attachment_image($image->ID, $size );
			$img_title = $image->post_title;
			$img_desc = $image->post_excerpt;
			
				?><?php echo $attachmentimage; ?><?php			
			
						
		}
	} else {
		echo "";
	}
}


	function gallery_img ($size) {		
	global $post;
	$tmp_post = $post;			
	$args = array(
   'post_type' => 'attachment',
	'numberposts' => 1,
   'orderby' => 'menu_order',
   'order' => 'ASC',
   'post_parent' => $post->ID
  );
  $attachments = get_posts( $args );
     if ( $attachments ) {
        foreach ( $attachments as $attachment ): setup_postdata($post);  
       
        $img_title = $attachment->post_title;		
		$img_desc = $attachment->post_excerpt;
		$attachmentlink=wp_get_attachment_url($attachment->ID);
		$imageUrl = wp_get_attachment_image_src( $attachment->ID, $size );
		?>


<a href ="<?php echo $imageUrl[0];?> "><img src="<?php echo $imageUrl[0]; ?>"/></a>



	

  <?php endforeach; $post = $tmp_post;
	}
}

	
if(!get_option("medium_crop"))
    add_option("medium_crop", "1");
	else
    update_option("medium_crop", "1");
	if(!get_option("large_crop"))
    add_option("large_crop", "1");
	else
    update_option("large_crop", "1");	
    if( FALSE === get_option("thumbnail_large_size_w") )
	{	
	add_option("featured_size_w", "738");
	add_option("featured_large_size_h", "300");
	add_option("featured_large_crop", "1");	
	add_option("thumbnail_large_size_w", "266");
	add_option("thumbnail_large_size_h", "166");
	add_option("thumbnail_large_crop", "1");	
	add_option("thumbnail_medium_size_w", "132");
	add_option("thumbnail_medium_size_h", "100");
	add_option("thumbnail_medium_crop", "1");	
	add_option("admin_photo_size_w", "220");
	add_option("admin_photo_size_h", "140");
	add_option("admin_photo_crop", "1");	
	add_option("thumbnail_results_size_w", "216");
	add_option("thumbnail_results_size_h", "140");
	add_option("thumbnail_results_crop", "1");	
	add_option("arrivals_size_w", "227");
	add_option("arrivals_size_h", "148");
	add_option("arrivals_crop", "1");	
	add_option("gallery_size_w", "500");
	add_option("gallery_size_h", "310");
	add_option("gallery_crop", "1");	
	add_option("thumbnail_gallery_size_w", "77");
	add_option("thumbnail_gallery_size_h", "60");
	add_option("thumbnail_gallery_crop", "1");		
	}
	else
	{	
	update_option("featured_size_w", "738");
	update_option("featured_size_h", "300");
	update_option("featured_crop", "1");	
	update_option("thumbnail_large_size_w", "266");
	update_option("thumbnail_large_size_h", "166");
	update_option("thumbnail_large_crop", "1");	
	update_option("thumbnail_medium_size_w", "132");
	update_option("thumbnail_medium_size_h", "100");
	update_option("thumbnail_medium_crop", "1");	
	update_option("admin_photo_size_w", "220");
	update_option("admin_photo_size_h", "140");
	update_option("admin_photo_crop", "1");		
	update_option("thumbnail_results_size_w", "216");
	update_option("thumbnail_results_size_h", "140");
	update_option("thumbnail_results_crop", "1");	
	update_option("arrivals_size_w", "227");
	update_option("arrivals_size_h", "148");
	update_option("arrivals_crop", "1");	
	update_option("gallery_size_w", "500");
	update_option("gallery_size_h", "310");
	update_option("gallery_crop", "1");	
	update_option("thumbnail_gallery_size_w", "77");
	update_option("thumbnail_gallery_size_h", "60");
	update_option("thumbnail_gallery_crop", "1");		
	}

function additional_image_sizes( $sizes ){
	$sizes[] = "featured";
	$sizes[] = "arrivals";
	$sizes[] = "gallery";
	$sizes[] = "admin_photo";
	$sizes[] = "thumbnail_large";
	$sizes[] = "thumbnail_gallery";
	$sizes[] = "thumbnail_medium";
	$sizes[] = "thumbnail_results";
	return $sizes;
	}
add_filter( 'intermediate_image_sizes', 'additional_image_sizes' );
	function remove_quick_edit( $actions ) {
	unset($actions['inline hide-if-no-js']);
	return $actions;
	}
	add_filter('post_row_actions','remove_quick_edit',10,1);
function cps_show_title(){
	global $CPS_OPTIONS;	
	$i = 0;
	// Taxonomies:
	if( isset($CPS_OPTIONS['taxonomies']) && !empty($CPS_OPTIONS['taxonomies']) ){
		foreach($CPS_OPTIONS['taxonomies'] as $taxonomy){
			if(isset($_GET[$taxonomy]) && trim($_GET[$taxonomy] != '')){
				$separator = $i ? '/': ' ';
				echo $separator . $taxonomy .'-'.$_GET[$taxonomy];
	// echo $separator . $_GET[$taxonomy];
				$i++;
			}
		}
	}
	foreach($CPS_OPTIONS['meta_boxes_vars'] as $meta_boxes){
		
		foreach($meta_boxes as $metaBox){
			if(isset($_GET[$metaBox['name']]) && trim($_GET[$metaBox['name']]) != ''){
				$separator = $i ? '/': ' ';
				echo $separator. $metaBox['name'] .'-'.  $_GET[$metaBox['name']];
				$i++;
				
			}
		}
	}
}
function get_hierarchical_terms($taxonomy, $parent = 0, $level = 0) 
	{
		$sPadding = '';
		
		for ($i = 0; $i <= $level; $i++) 
		{
			$sPadding .= '&nbsp;';
		}		
		$aTerms = get_terms($taxonomy, 'orderby=name&hide_empty=0&parent=' . (int)$parent);
		if($aTerms)
		{
			$aResults = array();
			foreach($aTerms as $oTerm) 
			{
				
				$oTerm->title = $sPadding . $oTerm->name;
				
				$aResults[] = $oTerm;
				
				$aChildren = get_hierarchical_terms($taxonomy, $oTerm->term_id, ((int)$level)+3);
				
				if ($aChildren) 
				{
					$aResults[] = $aChildren;
				}
			}
			return $aResults;
		}
		
		return false;
	}

add_action( 'show_user_profile', 'email_notification' );
add_action( 'edit_user_profile', 'email_notification' );

function email_notification( $user ) { ?>

	<h3><?php _e('E-mail Notification of New Listings Submitted for Approval','language');?></h3>
	<table class="form-table">
		<tr>
			<th>
				<label FOR="checktest"><?php _e('I want to be notified by e-mail','language');?></label>
			</th>
			<td>
			<?php $status = get_the_author_meta( 'emailmsg', $user->ID ); ?>
			<input type="hidden" name="emailmsg" value="0"/>		
			<input TYPE="checkbox" name="emailmsg" value="1" <?php checked( $status, 1 ); ?> /><br />
			</td>
		</tr>
	</table>	
<?php //if( !get_the_author_meta( 'emailmsg', $user->ID ) )  { 
//echo ''; 
//} else {
//echo get_the_author_meta( 'user_email', $user->ID );
//};
?>
<?php }
add_action( 'personal_options_update', 'save_email_option' );
add_action( 'edit_user_profile_update', 'save_email_option' );

function save_email_option( $user_id ) {

		if ( !current_user_can( 'edit_user', $user_id ) )
		
		{ return false; } else {if (isset($_POST['emailmsg'])) {
    update_user_meta( $user_id, 'emailmsg', $_POST['emailmsg'] );
}
	
	
}}
function remove_post_custom_fields() {
		remove_meta_box( 'postcustom' , 'gtcd' , 'normal' ); 
		}
		add_action( 'admin_menu' , 'remove_post_custom_fields' );
		function extended_contact_info($user_contactmethods) {  
		$user_contactmethods = array(
		'phone' => __('Phone','language'),
		'skype' => __('Skype','language'),
		'gtalk' => __('Gtalk','language')
		);  
		return $user_contactmethods;
	}  
	
	add_filter('user_contactmethods', 'extended_contact_info');
	
function custom_title_text( $title ){
		$screen = get_current_screen();
		if ( 'gtcd' == $screen->post_type ) {
		$title = __('Enter Vehicle Make & Model','language');
		}
		return $title;
	}
	add_filter( 'enter_title_here', 'custom_title_text' );

function admin_del_options() {
	   global $_wp_admin_css_colors;
	   $_wp_admin_css_colors = 0;
	}
	add_action('admin_head', 'admin_del_options');
	
	remove_filter('pre_user_description', 'wp_filter_kses');
function new_excerpt_more($more) {
		 global $post;
		return '...<a  class="more" href="'. get_permalink($post->ID) . '">'.__('more','language').'</a>';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
	
function new_excerpt_length($length) {
		return 34;
	}


	add_filter('excerpt_length', 'new_excerpt_length');

function remove_menus () {
		global $current_user;
			 get_currentuserinfo();
		     if ($current_user->user_level < 8){
			global $menu;
			$restricted = array(__('Dashboard','language'), __('Media','language'), __('Links','language'), __('Pages','language'), __('Appearance','language'), __('Tools','language'), __('Users','language'), __('Settings','language'), __('Comments','language'), __('Plugins','language'));
			end ($menu);
			while (prev($menu)){
				$value = explode(' ',$menu[key($menu)][0]);
				if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
		}}
	}
	add_action('admin_menu', 'remove_menus');
function gt_restrict_manage_authors() {
		  if (isset($_GET['post_type']) && post_type_exists($_GET['post_type']) && in_array(strtolower($_GET['post_type']), array('your_custom_post_types', 'here'))) {
			    wp_dropdown_users(array(
					'show_option_all'       => 'Show all Authors',
					'show_option_none'      => false,
					'name'                  => 'author',
					'selected'              => !empty($_GET['author']) ? $_GET['author'] : 0,
					'include_selected'      => false
			    ));
		  }
	}
	add_action('restrict_manage_posts', 'gt_restrict_manage_authors');
function custom_feed_request( $vars ) {
	 if (isset($vars['feed']) && !isset($vars['post_type']))
	  $vars['post_type'] = array( 'post', 'gtcd' );
	 return $vars;
	}
	add_filter( 'request', 'custom_feed_request' );


function prefix_filter_gettext( $translated, $original, $domain ) {
 

    $strings = array(
        'View all posts filed under %s' => 'See all articles filed under %s',
        'Howdy, %1$s' => 'Greetings, %1$s!',
     
    );

    if ( isset( $strings[$original] ) ) {
        $translations = &get_translations_for_domain( $domain );
        $translated = $translations->translate( $strings[$original] );
    }
 
    return $translated;
}
 
add_filter( 'gettext', 'prefix_filter_gettext', 10, 3 );
add_action('admin_init','my_init_method');
add_action( 'add_meta_boxes', 'video_meta_box_add' );	
	function video_meta_box_add()
	{
		add_meta_box( 'video-meta-box-id', 'Video Meta Box', 'video_meta_box_cb', 'gtcd', 'side', 'core' );
	}	
	function video_meta_box_cb( $post )
	{
		$values = get_post_custom( $post->ID );
		
		$videoid = isset( $values['video_meta_box_videoid'] ) ? esc_attr( $values['video_meta_box_videoid'][0] ) : '';
		$source = isset( $values['video_meta_box_source'] ) ? esc_attr( $values['video_meta_box_source'][0] ) : '';
		
		wp_nonce_field( 'video_meta_box_nonce', 'meta_box_nonce' );
		?>
		<p>
			<label for="video_meta_box_videoid"><?php _e('Video ID','language')?></label>
			<input type="text" name="video_meta_box_videoid" id="video_meta_box_videoid" value="<?php echo $videoid; ?>" />
		</p>		
		<p>
			<label for="video_meta_box_source"><?php _e('Video Source','language')?></label>
			<select name="video_meta_box_source" id="video_meta_box_source">
				<option value="youtube" <?php selected( $source, 'youtube' ); ?>><?php _e('YouTube','language')?></option>
				<option value="vimeo" <?php selected( $source, 'vimeo' ); ?>><?php _e('Vimeo','language')?></option>
			</select>
		</p>		
		<?php	
	}	
	add_action( 'save_post', 'video_meta_box_save' );	
	function video_meta_box_save( $post_id )
	{


		if( isset( $_POST['video_meta_box_videoid'] ) )
			update_post_meta( $post_id, 'video_meta_box_videoid', wp_kses( $_POST['video_meta_box_videoid'], $allowed ) );
			
		if( isset( $_POST['video_meta_box_source'] ) )
			update_post_meta( $post_id, 'video_meta_box_source', esc_attr( $_POST['video_meta_box_source'] ) );	
} ?>
<?php function my_query_post_type($query) {
    if ( is_category() && false == $query->query_vars['suppress_filters'] )
        $query->set( 'post_type', array( 'post', 'gtcd', ) );
    return $query;
}
add_filter('pre_get_posts', 'my_query_post_type');

add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );
function my_restrict_manage_posts()
{
    // only display these taxonomy filters on desired custom post_type listings
    global $typenow;
    if ($typenow == 'gtcd')
   {
      $filters = get_taxonomies();
   
        foreach ($filters as $tax_slug)
      {
         //creates drop down menu only for makemodel and features
         if($tax_slug == 'makemodel')
         {
            // retrieve the taxonomy object
            $tax_obj = get_taxonomy($tax_slug);
            $tax_name = $tax_obj->labels->name;
            // retrieve array of term objects per taxonomy
            $terms = get_terms($tax_slug, array( 'parent' => 0 ) );
            
   
            // output html for taxonomy dropdown filter
            echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
            echo "<option value=''>View  $tax_name</option>";
            foreach ($terms as $term)
            {
               // output each select option line, check against the last $_GET to show the current option selected
               echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
            }
            echo "</select>";
         }//end if
      }//end foreach
      
    }//end if
   
}//end function
// add conditional statements
function is_ipad() { // if the user is on an iPad
	$is_ipad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
	if ($is_ipad)
		return true;
	else return false;
}
function is_iphone() { // if the user is on an iPhone
	$cn_is_iphone = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPhone');
	if ($cn_is_iphone)
		return true;
	else return false;
}
function is_ipod() { // if the user is on an iPod Touch
	$cn_is_iphone = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPod');
	if ($cn_is_iphone)
		return true;
	else return false;
}
function is_ios() { // if the user is on any iOS Device
	if (is_iphone() || is_ipad() || is_ipod())
		return true;
	else return false;
}
function is_android() { // detect ALL android devices
	$is_android = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Android');
	if ($is_android)
		return true;
	else return false;
}
function is_android_mobile() { // detect only Android phones
	$is_android   = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Android');
	$is_android_m = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Mobile');
	if ($is_android && $is_android_m)
		return true;
	else return false;
}
function is_android_tablet() { // detect only Android tablets
	if (is_android() && !is_android_mobile())
		return true;
	else return false;
}
function is_mobile_device() { // detect Android Phones, iPhone or iPod
	if (is_android_mobile() || is_iphone() || is_ipod())
		return true;
	else return false;
}
function is_tablet() { // detect Android Tablets and iPads
	if ((is_android() && !is_android_mobile()) || is_ipad())
		return true;
	else return false;
}
add_action('admin_head', 'edmunds_javascript');
function edmunds_javascript() {
?>
<script type="text/javascript" > 
function get_api_data(){
		if (jQuery("#VIN_Code").val()==''){
			jQuery("#API_message").html('<div class="error"><p>Please type your vehicle VIN code first!</p></div>');
			jQuery("#API_message").show();
			return;
		}

		if (jQuery("#VIN_Code").val().length != 17){
			jQuery("#API_message").html('<div class="error"><p>Please type correct vehicle VIN code first!</p></div>');
			jQuery("#API_message").show();		
			return;
		}

		jQuery('#API_message').hide();		
		
		jQuery("#poststuff :input").attr("disabled", true);
		jQuery("#MyLoading").css({'display': 'inline'});
		jQuery("#GetData").hide();
		jQuery.ajax({
				type: "POST",
				data: ({action : 'rw_api_data', vin : jQuery("#VIN_Code").val()}),
				url: ajaxurl,				
				success: function(data)
				{
					jQuery("#poststuff :input").attr("disabled", false);
					var result = jQuery.parseJSON(data);
					jQuery.each(result, function(k, v) {
						if (k != 'makemodel-all'){
							if(jQuery('[name="' + k + '"]').is("select")) {
								//alert(k + ':' + v);
							}					
							if (k!='post_title'){
								jQuery('[name="' + k + '"]').val(v)								
							}else{
								if (jQuery('[name="post_title"]').val() == ''){
									jQuery('[name="post_title"]').val(v)
									jQuery("#title-prompt-text").hide()																								
								}
							}
						}else{
							jQuery('#' + k ).html(v)
						}
					});
						
					jQuery("#VIN_Code").val('');					
					jQuery("#MyLoading").css({'display': 'none'});					
					jQuery("#GetData").show();

				}
			});					
}

function messagebox(txt){
	jQuery("#messageBox").removeClass().addClass("confirmbox").html(txt).fadeIn(1000).fadeOut(1000);
}
function alertbox(txt){
	jQuery("#messageBox").removeClass().addClass("errorbox").html(txt).fadeIn(1000).fadeOut(1000);
}
// Delete image
function deletePost(id){
	var post_id = jQuery('#post_ID').val();		
    jQuery.ajax({
      url: ajaxurl,
      type: "post",
      data: ({action : 'rw_delete_file',postid: post_id, image_id: id, nonce: "<?php echo wp_create_nonce("DelGalImage");?>"}),
      success: function(data){
		  if (data=='0'){
			 messagebox('Image has been removed!');
			jQuery("#item_"+id).remove();

			var str = jQuery('#tgm-new-media-image').val();
			var exploded = str.split(',');
			jQuery.each(exploded, function (key, value) {
				if(value==id){
					exploded.splice(key,1)
				}
			});
			jQuery('#tgm-new-media-image').val(exploded.join(','));

		  }else{
			 alertbox('Image removal failed!');
		  }
		  
      },
      error:function(){
			 alertbox('Connection failed. please try again later!');
      }   
	});
}

// Save image gallery
function update_gallery(){
	jQuery('#rw-images-').empty();	
	var IDs = jQuery('#tgm-new-media-image').val();
	var id = jQuery('#post_ID').val();	
    jQuery.ajax({
      url: ajaxurl,
      type: "post",
      data: ({action : 'rw_save_gallery',post_id: id, Gallery_IDs: IDs, nonce: "<?php echo wp_create_nonce("AddGalImage");?>"}),
      success: function(data){
			messagebox("Gallery updated!");
			jQuery('#rw-images-').append(data);
      },
      error:function(){
			 alertbox('Connection failed. Gallery update didn\'t completed!');
      }   
	});
}	
jQuery(document).ready(function($) {
	// reorder images
	$('.rw-images').each(function(){
		var $this = $(this),
			order, data;
		$this.sortable({
			placeholder: 'ui-state-highlight',
			update: function (){
				order = $this.sortable('serialize');
				data = order + '|' + $('.rw-images-data').val();			
				$.post(ajaxurl, {action: 'rw_reorder_images', data: data}, function(response){																					
					if (response == '0'){
						messagebox("Images have been reordered");
					}else{
						alertmessage("You don't have permission to reorder images.");
					}
				});
			}
		});
	});

});
</script>
<?php
}
add_action( 'save_post', 'save_mademodel_meta');
function save_mademodel_meta(){
	if (isset($_POST['Vehicle_Make']) AND isset($_POST['Vehicle_model'])){
		$ID = $_POST['ID'];
		
		//Add new Made
		$term = term_exists($_POST['Vehicle_Make'], 'makemodel');
		
		if ($term !== 0 && $term !== null) {
			$Vehicle_Make_Id = intval($term['term_id']);
		}else{
			$term = wp_insert_term(
			  $_POST['Vehicle_Make'], // the term 
			  'makemodel', // the taxonomy
			  array(
				'parent'=> 0
			  )
			  );
			$Vehicle_Make_Id = $term['term_id'];
		}


		//Add new Model
		$term = term_exists($_POST['Vehicle_model'], 'makemodel');
		
		if ($term !== 0 && $term !== null) {
			$Vehicle_model_Id = intval($term['term_id']);
		}else{
			$term = wp_insert_term(
			  $_POST['Vehicle_model'], // the term 
			  'makemodel', // the taxonomy
			  array(
				'parent'=> $Vehicle_Make_Id
			  )
			  );
			$Vehicle_model_Id = $term['term_id'];
		}

		force_flush_term_cache('makemodel');
		$cat_ids = array($Vehicle_Make_Id,$Vehicle_model_Id);
		wp_set_object_terms($ID, $cat_ids, 'makemodel');
	}
	
}

function force_flush_term_cache( $taxonomy = 'category' ) {
	if ( !taxonomy_exists( $taxonomy ) ) return FALSE;

	wp_cache_set( 'last_changed', time( ) - 1800, 'terms' );
	wp_cache_delete( 'all_ids', $taxonomy );
	wp_cache_delete( 'get', $taxonomy );
	delete_option( "{$taxonomy}_children" );
	_get_term_hierarchy( $taxonomy );
	return TRUE;
}