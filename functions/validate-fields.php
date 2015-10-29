<?php
function validate_fields($gorilla_fields) {
	 $keys = array_keys($_FILES);
	 $i = 0;
	
	 foreach ( $_FILES as $image ) {
	   if ($image['size']) {
	     if ( preg_match('/(jpg|jpeg|png|gif)$/', $image['type']) ) {
		 $override = array('test_form' => false);
		 $file = wp_handle_upload( $image, $override );
		 $gorilla_fields[$keys[$i]] = $file['url'];
	     } else {
		 $field = get_option('gorilla_fields');
		 $gorilla_fields[$keys[$i]] = $field[$logo];
		 wp_die('No image was uploaded.');
	     }
	   }
	   else {
	     $field = get_option('gorilla_fields');
	     $gorilla_fields[$keys[$i]] = $field[$keys[$i]];
	   }
	   $i++;
	 }
	 return $gorilla_fields;
	}
function validate_symbols($gorilla_symbols) {
	 $keys = array_keys($_FILES);
	 $i = 0;	
	 foreach ( $_FILES as $image ) {
	   if ($image['size']) {
	     if ( preg_match('/(jpg|jpeg|png|gif)$/', $image['type']) ) {
		 $override = array('test_form' => false);
		 $file = wp_handle_upload( $image, $override );
		 $gorilla_symbols[$keys[$i]] = $file['url'];
	     } else {
		 $symbols = get_option('gorilla_symbols');
		 $gorilla_symbols[$keys[$i]] = $symbols[$logo];
		 wp_die('No image was uploaded.');
	     }
	   }
	   else {
	     $symbols = get_option('gorilla_symbols');
	     $gorilla_symbols[$keys[$i]] = $symbols[$keys[$i]];
	   }
	   $i++;
	 }
	 return $gorilla_symbols;
	}
?>