<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta id="Viewport" name="viewport" content=" ">
	<script type="text/javascript">
	if (screen.width < 767) {
		var mvp = document.getElementById('Viewport');
		mvp.setAttribute('content','width=device-width, initial-scale=1');}
</script>
<title>
<?php global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' ); $site_description = get_bloginfo( 'description', 'display' ); if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description"; if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s','language'), max( $paged, $page ) ); cps_show_title() ?>
</title>
<?php $options = get_option('automotive_theme_options'); $theme_color = $options['color']; if (!$theme_color) $theme_color = "style";?>
<link rel="stylesheet" id="theme-style" href="<?php echo get_stylesheet_directory_uri().'/'.$theme_color ?>.css"/>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/js/jquery.selectBox.css"/>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/includes/colorbox.css"/>
<!--CSS For Responsive-->
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/foundationFramework/stylesheets/foundation.css">
<script src="<?php bloginfo('template_url'); ?>/foundationFramework/javascripts/modernizr.foundation.js"></script>
<script>
    var  DivElement;
</script>
<!-- Generate Favicon Using 1.http://tools.dynamicdrive.com/favicon/ OR 2.http://www.favicon.cc/ -->
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<!--[if lt IE 7 ]> <body class="ie6" <?php body_class(); ?>> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7" <?php body_class(); ?>> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8" <?php body_class(); ?>> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9" <?php body_class(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<body <?php body_class(); ?>>
<!--<![endif]-->
<div class="fusion_tel">
 <h1 style="color:white;top:67px;position:absolute;right:210px;font-size:24px;">Toll Free: 1 (866) 979-7315  •  Local: (519) 682-2229</h1></div> 
</div>
<div class="row show-for-small whiteBack">
 <li class="name">
          <div>
<a href="<?php bloginfo('url'); ?>"> <img class="logo" src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /> </a> 
</div>
        </li>
  <div class="large-12.columns">
    <nav class="top-bar">
      <ul class="title-area">
        <li class="toggle-topbar down-arrow"><a id="menuToggle" href="#"></a></li>
        <li class="refine-search-single down-arrow"><a id="searchBoxPop2" href="#"></a></li>
      </ul>
      <section class="top-bar-section"> 
        <?php wp_nav_menu( array('theme_location' => 'header-menu','container' => false,'menu_class'=>'left'));?>
      </section>
    </nav>
  </div>
</div>
<div id="container">
<div class="header-wrapper">
  <div class="header"> <a class="hide-for-small" href="<?php bloginfo('url'); ?>"> <img class="logo" src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /> </a>
    <div class="nav-panel hide-for-small">
      <?php wp_nav_menu( array( 'theme_location' => 'header-menu','container' => false,'menu_class'=>'main-nav')); ?>
    </div><div class="clear"></div>
</div>  
</div>