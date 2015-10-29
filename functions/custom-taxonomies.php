<?php
add_action( 'init', 'create_makemodel' );	
function create_makemodel() 
	{
		$options = my_get_theme_options();		
			
		$labels = array(
				'name' => ucfirst($options['make_model_text']), 'taxonomy general name' ,
				'singular_name' =>  ucfirst($options['make_model_text']), 'taxonomy singular name' ,
				'search_items' =>  __('Search ','language').ucfirst($options['make_model_text']),
				'all_items' => __( 'All ','language').ucfirst($options['make_model_text']),
				'parent_item' => __( 'Parent ','language').ucfirst($options['make_model_text']),
				'parent_item_colon' => __( 'Parent ','language').ucfirst($options['make_model_text']) .':' ,
				'edit_item' => __( 'Edit ','language').ucfirst($options['make_model_text']),
				'update_item' => __( 'Update ','language').ucfirst($options['make_model_text']),
				'add_new_item' => __( 'Add New ','language').ucfirst($options['make_model_text']),
				'new_item_name' => __( 'New ','language').ucfirst($options['make_model_text']) .' Name',		
				);		
		register_taxonomy(
				'makemodel',
				array( 'gtcd','user_listing' ),
				array(		
					'hierarchical' => true,
					'label' => ucfirst($options['make_model_text']),
					'public'	   => true,
					'can_export'   => true,
					'labels' => $labels
				));
	} 
add_action( 'init', 'create_makemodel' );	
function create_location() 
	{
		$options = my_get_theme_options();		
		
		$labels = array(
				'name' => ucfirst($options['location_text']), 'taxonomy general name' ,
				'singular_name' =>  ucfirst($options['location_text']), 'taxonomy singular name' ,
				'search_items' =>  __('Search ','language').ucfirst($options['location_text']),
				'all_items' => __( 'All ','language').ucfirst($options['location_text']),
				'parent_item' => __( 'Parent ','language').ucfirst($options['location_text']),
				'parent_item_colon' => __( 'Parent ','language').ucfirst($options['location_text']) .':' ,
				'edit_item' => __( 'Edit ','language').ucfirst($options['location_text']),
				'update_item' => __( 'Update ','language').ucfirst($options['location_text']),
				'add_new_item' => __( 'Add New ','language').ucfirst($options['location_text']),
				'new_item_name' => __( 'New ','language').ucfirst($options['location_text']) .' Name',		
				);		
		register_taxonomy(
				'location',
				array( 'gtcd','user_listing' ),
				array(		
					'hierarchical' => true,
					'label' => ucfirst($options['location_text']),
					'public'	   => true,
					'can_export'   => true,
					'labels' => $labels
				));
	} 
add_action( 'init', 'create_location' );	

function features() 
	 {	   
		$options = my_get_theme_options();
		
			
		$labels = array(
			'name' =>  ucfirst($options['features_text']), 'taxonomy general name' ,
			'singular_name' =>  ucfirst($options['features_text']), 'taxonomy singular name',
			'search_items' =>  __('Search ','language').ucfirst($options['features_text']),
			'all_items' => __( 'All ','language').ucfirst($options['features_text']),
			'parent_item' => __( 'Parent','language').ucfirst($options['features_text']),
			'parent_item_colon' => __( 'Parent ','language').ucfirst($options['features_text']) .':' ,
			'edit_item' => __( 'Edit ','language').ucfirst($options['features_text'] ),
			'update_item' => __( 'Update ','language').ucfirst($options['features_text']),
			'add_new_item' => __( 'Add New ','language').ucfirst($options['features_text']),
			'new_item_name' => __( 'New ','language').ucfirst($options['features_text']) .' Name'
		); 			
		register_taxonomy(
			'features',
			array( 'gtcd','user_listing' ),
			array(
				'hierarchical' => false,
				'label' => ucfirst($options['features_text']),
				'public' => true,
				'can_export' => true,
				'show_tagcloud' => true,
				'labels' => $labels
			));
	}
		 add_action( 'init', 'features' );	 
function custom_tag_cloud_widget($args) {
		$args['number'] = 0; 
		$args['largest'] = 18;
		$args['smallest'] = 10;
		$args['unit'] = 'px'; 
		$args['taxonomy'] = array('features'); 
		return $args;
	}
	add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );
?>