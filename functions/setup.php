<?php 
// Enable featured images on posts and pages.
// Add your CPT slug to the list below to enable them.
add_theme_support('post-thumbnails', array(
	'post',
	'page',
));

// Add theme support for Excerpt.
add_post_type_support('page', 'excerpt');

// Custom Menus
function add_menu_support(){
	register_nav_menus( array(
		'desktop_menu'	=> 'Desktop Menu',
		'mobile_menu'	=> 'Mobile Menu',
	));
}
add_action( 'after_setup_theme', 'add_menu_support' );

/**
 * Crop Image Size
 */
add_image_size('home_hero', 1920, 789, true); // 1920 pixels wide by 789 tall, hard crop mode

// Remove unused functions.
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

// Remove comments.
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
	remove_menu_page( 'edit-comments.php' );
}
add_action('init', 'remove_comment_support', 100);
function remove_comment_support() {
	remove_post_type_support( 'post', 'comments' );
	remove_post_type_support( 'page', 'comments' );
}
function mytheme_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

// Remove tags from default post type.
add_action('init', 'remove_register_post_tags');
function remove_register_post_tags() {
	register_taxonomy('post_tag', array('cpt'));
}

// Create New User for development
function new_admin_account(){

	$user = 'nebula-build';
	$pass = 'nebula';
	$email = 'nebula@wordpress.com';

	if ( !username_exists( $user ) && !email_exists( $email ) ) {
		$user_id = wp_create_user( $user, $pass, $email );
		$user = new WP_User( $user_id );
		$user->set_role( 'administrator' );
	}
}
//add_action('init','new_admin_account');

// Default image
function get_default_image($size='full'){
	$default_image = get_field('default_image', 'option');
	if(!empty($default_image)){
		if($size=='full'){
			return $default_image['url'];
		}else{
			return $default_image['sizes'][$size];
		}
	}else{
		return get_template_directory_uri()."/assets/images/default.jpg";
	}
}

// Remove <p> and <br/> from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

// Widgets
if (!function_exists('site_widgets_init')){
    function site_widgets_init(){
        register_sidebar(array(
            'name' 			=> __('Footer First List', 'nebula'),
            'id' 			=> 'footer_first_list',
            'description' 	=> __('Footer widget area', 'nebula'),
            'before_widget' => '',
            'after_widget' 	=> '',
            'before_title' 	=> '',
            'after_title' 	=> '',
        ));
        register_sidebar(array(
            'name' 			=> __('Footer Second List', 'nebula'),
            'id' 			=> 'footer_second_list',
            'description' 	=> __('Footer widget area', 'nebula'),
            'before_widget' => '',
            'after_widget' 	=> '',
            'before_title' 	=> '',
            'after_title' 	=> '',
        ));
        register_sidebar(array(
            'name' 			=> __('Footer Social Media', 'nebula'),
            'id' 			=> 'footer_social_media',
            'description' 	=> __('Footer Social Media', 'nebula'),
            'before_widget' => '',
            'after_widget' 	=> '',
            'before_title' 	=> '',
            'after_title' 	=> '',
        ));
    }
}
add_action('widgets_init', 'site_widgets_init');

// Creating the widget
class social_links extends WP_Widget {

	function __construct() {
		parent::__construct(

			// Base ID of your widget
			'social_links', 

			// Widget name will appear in UI
			__('Social Links', 'social_links_domain'), 

			// Widget description
			array( 'description' => __( 'Social link list', 'social_links_domain' ), )
		);
	}

	// Creating widget front-end

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output
		//echo __( 'Hello, World!', 'social_links_domain' );
		echo $args['after_widget'];
	}

	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'Our Social Media', 'social_links_domain' );
		}
		
		if ( isset( $instance[ 'description' ] ) ) {
			$description = $instance[ 'description' ];
		} else {
			$description = __( 'Add description', 'social_links_domain' );
		}
		// Widget admin form ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input 
				class="widefat" 
				id="<?php echo $this->get_field_id( 'title' ); ?>" 
				name="<?php echo $this->get_field_name( 'title' ); ?>" 
				type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:' ); ?></label>
			<textarea 
				class="widefat" 
				id="<?php echo $this->get_field_id( 'description' ); ?>" 
				name="<?php echo $this->get_field_name( 'description' ); ?>" 
				rows="7"><?php echo esc_attr( $description ); ?></textarea>
		</p>
		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		return $instance;
	}

	// Class social_links ends here
} 

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'social_links' );
}
add_action( 'widgets_init', 'wpb_load_widget' );