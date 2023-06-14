<?php 
// Load CSS.
function load_css() {
	// Third Party CSS Libraries

	// Bootstrap CSS
	wp_enqueue_style("bootstrap",get_template_directory_uri()."/resources/bootstrap.min.css",array(),'4.4.1');

	// Bootstrap Override CSS
	wp_enqueue_style("bootstrap-override",get_template_directory_uri()."/assets/css/bootstrap-override.css",array(),time_as_version());

	// Slick CSS
	wp_enqueue_style("slick",get_template_directory_uri()."/resources/slick.css",array(),time_as_version());

	// Fonts CSS
	wp_enqueue_style("fonts",get_template_directory_uri()."/assets/css/fonts.css",array(),time_as_version());

	// Main CSS
	wp_enqueue_style("main",get_template_directory_uri()."/assets/css/style.css",array(),time_as_version());
}
add_action("wp_enqueue_scripts","load_css");

// Load javascript.
function load_js() {
	wp_deregister_script('jquery');

	// Third Party JS Libraries
	wp_enqueue_script("jquery",get_template_directory_uri()."/resources/jquery.js",array(),'3.4.1',true);
	
	// Slick JS
	wp_register_script("slick",get_template_directory_uri()."/resources/slick.min.js",array("jquery"),'1.8.1',true);
	wp_enqueue_script("slick");

	// Custom JS
	wp_register_script("custom",get_template_directory_uri()."/assets/js/custom.js",array("jquery"),time_as_version(),true);
	wp_enqueue_script("custom");
}
add_action("wp_enqueue_scripts","load_js");

// Set version for CSS and JS register.
function time_as_version(){
	return time();
}