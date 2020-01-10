<?php
require get_template_directory().'/inc/nav-walker.php';
require get_template_directory().'/inc/widget.php';
require_once get_theme_file_path() .'/theme-options/cs-framework.php';

function theme_setup() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails', array('post', 'page', 'slider-item'));

	set_post_thumbnail_size(300, 440, true);
	add_image_size('SectionOne', 900, 900, true);
	add_image_size('slider-item', 1920, 1280, true);
}
add_action( 'after_setup_theme', 'theme_setup' );

// Add css and js
function jifinanceScripts(){
	//all css
	wp_enqueue_style('bootstrap_css', get_theme_file_uri('/css/bootstrap.min.css'), array(), 'v4.1.3');
	wp_enqueue_style('classy_nav', get_theme_file_uri('/css/classy-nav.css'), array(), 'v1.0.0');
	wp_enqueue_style('owl_carousel', get_theme_file_uri('/css/owl.carousel.min.css'), array(), 'v1.0.0');
	wp_enqueue_style('animate_css', get_theme_file_uri('/css/animate.css'), array(), 'v1.0.0');
	wp_enqueue_style('fontawsome_css', get_theme_file_uri('/css/font-awesome.min.css'), array(), 'v4.7.0');
	wp_enqueue_style('credit_icon', get_theme_file_uri('/css/credit-icon.css'), array(), 'v4.7.0');
	wp_enqueue_style('main_css', get_theme_file_uri('/css/main.css'), array(), 'v1.1.0');
	wp_enqueue_style('stylesheet', get_stylesheet_uri());

	//all js
	wp_enqueue_script('jquery_js', get_theme_file_uri('/js/jquery/jquery.min.js'), array(), 'v1.1.0', true);
	wp_enqueue_script('bootstrap_js', get_theme_file_uri('/js/bootstrap/bootstrap.min.js'), array(), 'v1.1.0' , true);
	wp_enqueue_script('bootstrap_popper_js', get_theme_file_uri('/js/bootstrap/popper.min.js'), array(), 'v1.1.0', true);
	wp_enqueue_script('plugin_js', get_theme_file_uri('/js/plugins/plugins.js'), array(), 'v1.1.0', true);
	wp_enqueue_script('active_js', get_theme_file_uri('/js/active.js'), array(), 'v1.1.0', true);
	// wp_enqueue_script('main_js', get_theme_file_uri('/js/main.js'), array(), 'v1.1.0', true);
	
	

}
add_action('wp_enqueue_scripts', 'jifinanceScripts');

// Register Menu
function jifinanceMenu(){
	add_theme_support('menus');
	register_nav_menu('primary', 'Primary Menu');
	// register_nav_menu('main_menu', __('Top Menu', 'jishop'));
}
add_action('init', 'jifinanceMenu');


// Register Sidebar
function jifinanceWidgets(){
	register_sidebar(array(
		'name'          => esc_html__( 'Sidebar name', 'jifinance' ),
		'id'            => 'unique-sidebar-id',    // ID should be LOWERCASE  ! ! !
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<div class="single-widget-area cata-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-heading">
                <div class="line"></div>
                <h4>',
		'after_title'   => '</h4>
            </div>' 
	));
	register_sidebar(array(
		'name'          => esc_html__( 'Footer Name', 'jifinance' ),
		'id'            => 'dsdf',    // ID should be LOWERCASE  ! ! !
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<div class="col-md-3 col-sm-6 col-xs-6"><div class="footer">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="footer-header">',
		'after_title'   => '</h3>' 
	));
}
add_action('widgets_init', 'jifinanceWidgets');


add_action('init', 'main_slider');
function main_slider(){
	register_post_type('slider-item', array(
		'labels' => array(
			'name' 			=> ('Slider'),
			'singular_name' => ('Slider'),
			'menu_name' 	=> ('Main SLider'),
			'name_admin_bar'=> ('add new'),
			'all_items' 	=> ('All Slider'),
			'add_new' 		=> ('add new'),
			'add_new_item' 	=> ('add slider'),
			'edit_item' 	=> ('Edit Slider'),
			'view_item' 	=> ('view SLider'),
			'search_items'	=> ('Search SLider')
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'slider-item'),
		'menu_position' => 9,
		'menu_icon' => 'dashicons-images-alt2',
		'supports' => array('title', 'thumbnail', 'editor','custom-fields')
		
	));
	 // add_meta_box( 'hcf-1', __( 'Hello Custom Field', 'hcf' ), 'hcf_display_callback', 'slider-item' );
}

//
// Enable custome taxonomy for main slider
// 

function main_slider_taxonomy(){
	register_taxonomy(
		'main_slider_cat',
		'slider-item',
		array(
			'hierarchical' => true,
			'label' => 'slider category',
			'query_var' => true,
			'rewrite' => array('slug' => 'slider-category', 'with_front' => true)
		)
	);
}
add_action('init', 'main_slider_taxonomy');

function jifinanceMoveCommentOne($fields){ //Moving to bottom comment fields
	$comment_field = $fields['comment'];
	unset ($fields['comment']);
	$fields['comment'] = $comment_field ;
	return $fields;
}
add_filter('comment_form_fields', 'jifinanceMoveCommentOne');
function jifinanceMoveComment($fields){ //Moving to bottom comment fields
	$comment_field = $fields['cookies'];
	unset ($fields['cookies']);
	$fields['cookies'] = $comment_field ;
	return $fields;
}
add_filter('comment_form_fields', 'jifinanceMoveComment');

add_filter( 'comment_form_default_fields', 'wpse_62742_comment_placeholders' );
function wpse_62742_comment_placeholders( $fields )
{
    $fields['author'] = str_replace(
        '<input',
        '<input placeholder="'
        /* Replace 'theme_text_domain' with your theme’s text domain.
         * I use _x() here to make your translators life easier. :)
         * See http://codex.wordpress.org/Function_Reference/_x
         */
            . _x(
                'First and last name or a nick name',
                'comment form placeholder',
                'jifinance'
                )
            . '"',
        $fields['author']
    );
    $fields['email'] = str_replace(
        '<input id="email" name="email" type="text"',
        /* We use a proper type attribute to make use of the browser’s
         * validation, and to get the matching keyboard on smartphones.
         */
        '<input type="email" placeholder="contact@example.com"  id="email" name="email"',
        $fields['email']
    );
    $fields['url'] = str_replace(
        '<input id="url" name="url" type="text"',
        // Again: a better 'type' attribute value.
        '<input placeholder="http://example.com" id="url" name="url" type="url"',
        $fields['url']
    );

    return $fields;
}