<?php
	class RW_Meta_Box_Taxonomy extends RW_Meta_Box 
	{		
		function add_missed_values() 
		{
			parent::add_missed_values();
			
			// add 'multiple' option to taxonomy field with checkbox_list type
			foreach ($this->_meta_box['fields'] as $key => $field) 
			{
				if ('taxonomy' == $field['type'] && 'checkbox_list' == $field['options']['type']) 
				{
					$this->_meta_box['fields'][$key]['multiple'] = true;
				}
			}
		}		
	}	
	$prefix = 'rw_';
	$meta_boxes_sec[] = array(
		'id' => 'gallery',
		'title' => __('Photo Gallery','language'),
		'pages' => array('gtcd'),
		'hide_in_search' => true,
		'fields' => array(
			array(
				'name' => '',
				'desc' => '',
				'id' => $prefix . 'gallery',
				'type' => 'image'						// image upload
			)
		)
	);
	foreach ($meta_boxes_sec as $meta_box) 
	{
		$my_box = new RW_Meta_Box_Taxonomy($meta_box);
	}	
	class RW_Meta_Box_Validate 
	{
		function check_name($text) 
		{
			if ($text == '') 
			{
				return '';
			}
			return $text;
		}
	}
?>