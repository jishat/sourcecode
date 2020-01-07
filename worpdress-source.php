<?php
//----------------------------------------------------
//1: In style.css
//---------------------------------------------------------

	/*
	Theme Name: Twenty Seventeen
	Theme URI: https://wordpress.org/themes/twentyseventeen/
	Author: the WordPress team
	Author URI: https://wordpress.org/
	Description: Twenty Seventeen brings your site to life with immersive featured images…………..
	Version: 1.0
	License: GNU General Public License v2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
	Text Domain: twentyseventeen
	Tags: one-column, two-columns, right-sidebar, flexible-header,…………….
	*/

//--------------------------------------------
//2: screenshot in web root
//--------------------------------------------
	1200 x 900 px

//---------------------------------------------
// Important wordpress Build in Function
//----------------------------------------------
	get_template_directory_uri()
	get_header() // for top header portion
	get_footer() // for footer portion
	wp_head() //before </head>  for top bar
	wp_footer() //before </body>  for top bar
	get_template_part("template_parts/sidebar/sidebar", "sidebar" )  //get any parts from ‘template_parts’ folder
	language_attributes() //For set lang=”en” in html tag
	bloginfo ("charset") //For set lang=”en” in html tag
	bloginfo ('name') //For set title into title tag
	bloginfo ('description') //For set description into title tag

	esc_url(home_url('/')); // for get home url
	_e(''); '&quot;'.$s.'&quot;'; //get keyword of search


//--------------------------------------------------------
// Important wordpress Build in Function in functions.php
//-----------------------------------------------------------
	add_theme_support('title-tag'); // for get title 
	function demo(){ // for add css and js
		// get css
		wp_enqueue_style('bootstrap_css', get_theme_file_uri('/css/bootstrap.min.css'), array(), 'v1.0.0');

		// get js file
		wp_enqueue_script('main_js', get_theme_file_uri('/js/main.js'), array(), 'v1.1.0', true);
	}
	add_action('wp_enqueue_scripts', 'demo');

	

	add_theme_support('post-thumbnails', array('post', 'page')) //thumbnail image
	set_post_thumbnail_size(300, 200, true);
	add_image_size('jishat', 500, 350, true); //add custome image size




//-------------------------------------------------------
// How to dynamic nav menu
//--------------------------------------------------------

	//1: register nav in function.php
		function jishopMenu(){ // Register Menu
			register_nav_menus( array(
	            'primary_menu' => __( 'Primary Menu', 'text_domain' ),
	            'footer_menu'  => __( 'Footer Menu', 'text_domain' ),
	        ) );
		}
		add_action('init', 'jishopMenu');

	//2: display the navigation in heading
		wp_nav_menu(
	            array(
	                 'theme_location' => 'primary',
	                // 'container_class' => 'classynav',
	                // 'items_wrap' => '<ul class="menu-list">%3$s</ul>'
	                'container'         => false,
	                'menu_class'        => 'menu-list',
	                'walker'        => new WH_Nav_Walker()
	            )
	    );


//-------------------------------------------------------------
// Important wordpress Build in Function in page.php
//-------------------------------------------------------------

	// for get post dynamic
	while(have_posts()) : 
	the_post(); 
	get_template_part("template_parts/content/content", "content");
	endwhile;

	// in the conent file
	the_title() // get the title
	the_content()// get the content
	the_time('g:i a')// get the Time
	comments_popup_link( $zero, $one, $more, $css_class, $none ); //show comment
	the_permalink(); //in anchor tag for get the link of post
	the_excerpt(); //for reduce content


//-------------------------------------------------------
// How to display post in blog page
//--------------------------------------------------------

if( have_posts()){
	while(have_posts()){ the_post();
		the_post_thumbnail('postimage', array('class' => 'any_class_name')); //display feature image
		the_post_thumbnail_url('postimage'); //for get url of feature image
		the_time('d M, Y');
		the_permalink();
		the_title();
		the_author();
		the_category(',');
		comments_popup_link( 'No Comments >>', '1 Comment', '% Comments' );
		the_excerpt();
	}
}else{
    echo esc_html_e('Sorry! has not any post');
}

the_posts_pagination(); //for show post pagination

// Note: After that will create single.php and then write same code


//-------------------------------------------------------
// How to display post by a specific category in any page
//--------------------------------------------------------

	$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'category_name' => 'technology',
				'posts_per_page' => 10,
				'order' => 'DESC',
			);
	$wpQuery = new WP_Query($args);

	if( $wpQuery->have_posts()){
		while($wpQuery->have_posts()){ 
			$wpQuery->the_post();
			the_post_thumbnail('postimage', array('class' => 'any_class_name')); //display feature image
			the_post_thumbnail_url('postimage'); //for get url of feature image
			the_time('d M, Y');
			the_permalink();
			the_title();
			the_author();
			comments_popup_link( 'No Comments >>', '1 Comment', '% Comments' );
			the_excerpt();
		}
	}else{
	    echo esc_html_e('Sorry! has not any post');
	}
	wp_reset_query();


//-------------------------------------------------------
// How to display related posts by tags in any page
//--------------------------------------------------------

	$wpPostTagId = wp_get_post_tags($post->ID);
	if($wpPostTagId){
		$postTag = $wpPostTagId[0]->term_id;
		$argss = array(
				'tag__in' => array($postTag),
				'post__not_in' => array($post->ID),
				'posts_per_page' => 10,
				'caller_get_posts' => 1
			);
		$wpQuery = new WP_Query($argss);

		if( $wpQuery->have_posts()){
			while($wpQuery->have_posts()){ 
				$wpQuery->the_post();
				the_post_thumbnail('postimage', array('class' => 'any_class_name')); //display feature image
				the_post_thumbnail_url('postimage'); //for get url of feature image
				the_time('d M, Y');
				the_permalink();
				the_title();
				the_author();
				comments_popup_link( 'No Comments >>', '1 Comment', '% Comments' );
				the_excerpt();
			}
		}else{
		    echo esc_html_e('Sorry! has not any post');
		}
	}
	wp_reset_query();


//--------------------------------------------------------
// How to display comment
//--------------------------------------------------------
	//1: add this function where want to show comment
		if ( comments_open() || get_comments_number() ) {
            comments_template();
        } 

	//2: create comments.php file


	//--------------------------------------------------------
	// How to move comment field
	//--------------------------------------------------------
		function jishopMoveComment($fields){ //Moving to bottom comment fields
			$comment_field = $fields['author'];
			unset ($fields['author']);
			$fields['author'] = $comment_field ;
			return $fields;
		}
		add_filter('comment_form_fields', 'jishopMoveComment');
	

	//--------------------------------------------------------
	//8: How to remove field in comment
	//--------------------------------------------------------
		function jishopRemoveComment($fields){ //Moving to bottom comment fields
			unset ($fields['author']);
			return $fields;
		}
		add_filter('comment_form_fields', 'jishopRemoveComment');


	//--------------------------------------------------------
	//8: How to change attribute in input field
	//--------------------------------------------------------
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


//--------------------------------------------------------
//8: How to add silder by custome post
//--------------------------------------------------------

	//
	//this code will go in function.php
	//
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
			'supports' => array('title', 'thumbnail', 'editor')
			
		));
	}

	//
	// Enable custome taxonomy for main slider
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

	//
	// this code will go slider.php
	// 
	global $post;
    $jifinanceSlide = array(
                        'posts_per_page' => -1, //-1 means unlimited slider show.
                        'post_type' => 'slider-item',
                        'page' => $paged,
                        'order' => 'DESC'
                    );
    $allInfo = get_posts($jifinanceSlide);

    foreach ($allInfo as $post) : setup_postdata($post);
        $sliderImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'slider-item'); //echo $sliderImg[0] and echo get_post_meta($post->ID, 'hello', true)
    endforeach;


 //--------------------------------------------------------
// How to dynamic search
//--------------------------------------------------------

	//1: create a search page 'search.php' and put same contents of index.php

	//2: in form action='esc_url(home_url('/'));'

	//3: echo the below code in search.php
		_e(''); echo '&quot;'.$s.'&quot;';


 //--------------------------------------------------------
// How to dynamic Archive sidebar and page
//--------------------------------------------------------
	
	//1: dynamic in sidebar
		wp_get_archives(array(
			'type' => 'monthly', 
			'limit' => 12, 
			'order' => 'ASC',
			// 'format' => 'html',
			// 'before' => '',
			// 'after' => '',
			// 'show_post_count' => false,
			// 'post_type' => 'post'
		));

	//2: After that create archive.php sothat show the post list onclick a archive


//--------------------------------------------------------
// How to register a widget
//--------------------------------------------------------

	//1: Register widget in function.php

		function jishopWidgets(){ //Register sidebar
			register_sidebar(array( 
				'name'          => esc_html__( 'Sidebar name', 'textDomain' ),
				'id'            => 'unique-sidebar-id',    // ID should be LOWERCASE  ! ! !
				'description'   => '',
				'class'         => '',
				'before_widget' => '<div class="col-md-3 col-sm-6 col-xs-6"> <div class="banner banner-2">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<div class="banner-caption"><h2 class="white-color">',
				'after_title'   => '</h2><button class="primary-btn">Shop Now</button></div>' 
			));
		}
		add_action('widgets_init', 'jishopWidgets');


//--------------------------------------------------------
// How to show latest post in sidebar
//--------------------------------------------------------

	$argsLatest = array(
            'post_type' => 'post',
            'posts_per_page' => 10
        );
    $wpQuery = new WP_Query($argsLatest); 

    while($wpQuery->have_posts()):
        $wpQuery->the_post();
    endwhile;


//-------------------------------------------------------
// How to display  category name in sidebar and show the post by category in a page
//--------------------------------------------------------
	//1- show category name in sidebar
		$var = array(
					'orderby' => 'slug',
					'parent' => 0
				);
		$getCategories = get_categories($var);
		foreach($getCategories as $getCategory){
			get_category_link($getCategory->term_id);
			$getCategory->name;
			$getCategory->description;
		}

	//After that create category.php sothat show the post list onclick a category
	
	
	
	
