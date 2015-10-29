<?php
	register_sidebar(array('name'=>__('Sidebar','language'),
		'before_widget' => "<div class='right-block'><div class='right-white-block'><ul class='side-nav'>",
		'after_widget' => '</ul></div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array('name'=> __('Vehicle Details Widget','language'),
		'before_widget' => "<div class='specs'><div class='right-block'><div class='right-white-block'><ul class='side-nav'>",
		'after_widget' => '</ul></div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array('name'=>__('Similar Cars','language'),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	));	
	register_sidebar(array('name'=>__('Search Module','language'),

		'before_widget' => "<div class='right-block'><div class='right-white-block'><ul class='side-nav'>",
		'after_widget' => '</ul></div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));	
	register_sidebar(array('name'=>__('Footer','language'),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	));
?>