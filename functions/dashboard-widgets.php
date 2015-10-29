<?php
	add_action('wp_dashboard_setup', 'my_dashboard_widgets');		   
function my_dashboard_widgets() {
	     global $wp_meta_boxes;
	     unset(
		    $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],
		    $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
		    $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']
	     );
	     wp_add_dashboard_widget( 'dashboard_custom_feed', 'News from Gorilla Themes', 'dashboard_custom_feed_output' ); 
	}		
function dashboard_custom_feed_output() {
	     echo '<div class="rss-widget">';
	     wp_widget_rss_output(array(
		    'url' => 'http://feeds2.feedburner.com/GorillaThemes',
		    'title' => 'Latest News',
		    'items' => 5,
		    'show_summary' => 1,
		    'show_author' => 0,
		    'show_date' => 1 
	     ));
	     echo "</div>";
	}
?>