<?php
// Create ACF options page.
add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {
	if( function_exists('acf_add_options_page') ) {
		$options_page = acf_add_options_page(array(
			'page_title'    => __('Theme Settings'),
			'menu_title'    => __('Theme Settings'),
			'menu_slug'     => 'theme-settings',
			'capability'    => 'edit_posts',
			'redirect'      => false
		));
	}
}

// Add a default image option to ACF fields.
add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field');
function add_default_value_to_image_field($field) {
	acf_render_field_setting( $field, array(
		'label'			=> 'Default Image',
		'instructions'	=> 'Appears when creating a new post',
		'type'			=> 'image',
		'name'			=> 'default_value',
	));
}