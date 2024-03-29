<?php
/**
 * DevfolioX functions and definitions
 *
 *
 * @package DevfolioX
 */

 require ABSPATH . "vendor/stoutlogic/acf-builder/autoload.php";

 use StoutLogic\AcfBuilder\FieldsBuilder;

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function devfoliox_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on DevfolioX, use a find and replace
		* to change 'devfoliox' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'devfoliox', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'devfoliox' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'devfoliox_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'devfoliox_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function devfoliox_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'devfoliox_content_width', 640 );
}
add_action( 'after_setup_theme', 'devfoliox_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function devfoliox_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'devfoliox' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'devfoliox' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'devfoliox_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function devfoliox_scripts() {
	wp_enqueue_style( 'devfoliox-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'devfoliox-style', 'rtl', 'replace' );

	wp_enqueue_script( 'devfoliox-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'devfoliox_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/** Custom Post Type */
/**
 * Initialize ACF Builder
 */
add_action('init', function () {
	// Import ACF fields
	foreach(glob(get_template_directory() . "/inc/fields/*.php") as $file){
		require  $file;
	}

    register_post_type('door_type', [
            'labels' => [
                'name'                => __('Doors', 'cnc_autodoor'),
                'singular_name'       => __('Door', 'cnc_autodoor'),
                'menu_name'           => __('Doors', 'cnc_autodoor'),
                'parent_item_colon'   => __('Parent Door', 'cnc_autodoor'),
                'all_items'           => __('All Doors', 'cnc_autodoor'),
                'view_item'           => __('View Doors', 'cnc_autodoor'),
                'add_new_item'        => __('Add New Door', 'cnc_autodoor'),
                'add_new'             => __('Add New', 'cnc_autodoor'),
                'edit_item'           => __('Edit Door', 'cnc_autodoor'),
                'update_item'         => __('Update Door', 'cnc_autodoor'),
                'search_items'        => __('Search Doors', 'cnc_autodoor'),
                'not_found'           => __('Not Found', 'cnc_autodoor'),
                'not_found_in_trash'  => __('Not found in Trash', 'cnc_autodoor'),
            ],
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'door'],
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-excerpt-view',
			'menu_position' => 3
    ]);

});


// Add meny to api
// add_theme_support( 'menus' );

// Return formatted Primary Menu
function top_nav_menu() {
    $menu = wp_get_nav_menu_items('primary-menu');
    $result = [];
    foreach($menu as $item) {
        $my_item = [
            'name' => $item->title,
            'href' => str_replace('/home/', '/', $item->url)
        ];
        $result[] = $my_item;
    }
    return $result;
}
// add endpoint
add_action( 'rest_api_init', function() {
    // top-nav menu
    register_rest_route( 'wp/v2', 'primary-menu', array(
        'methods' => 'GET',
        'callback' => 'top_nav_menu',
    ) );
});



/**
 * Import Profile class to get AFt fields
 */
require get_template_directory() . '/classes/profile.php';

// Profile endpoints
add_action( 'rest_api_init', function() {
    // top-nav menu
    register_rest_route( 'wp/v2', 'personal-details', array(
        'methods' => 'GET',
        'callback' => function () {
			return Profile::getPersonalDetails();
		},
    ) );
});

add_action( 'rest_api_init', function() {
    // top-nav menu
    register_rest_route( 'wp/v2', 'profile-social-media', array(
        'methods' => 'GET',
        'callback' => function () {
			return Profile::getSocialMedia();
		},
    ) );
});

add_action( 'rest_api_init', function() {
    // top-nav menu
    register_rest_route( 'wp/v2', 'profile-contact-info', array(
        'methods' => 'GET',
        'callback' => function () {
			return Profile::getConatctInfo();
		},
    ) );
});

// Add Contact Shortcode
function contact_info_shortcode() {
	$contactInfo = Profile::getConatctInfo();
	$contactInfoOutput = '<ul class="contact-info">';
	$contactInfoOutput .= '<li class="phone"><a href="tel:' . esc_attr($contactInfo['phone']) . '">' . esc_html($contactInfo['phone']) . '</a></li>';
	$contactInfoOutput .= '<li class="email"><a href="mailto:' . esc_attr($contactInfo['email']) . '">' . esc_html($contactInfo['email']) . '</a></li>';
	$contactInfoOutput .= '<li class="address"><span>' . esc_html($contactInfo['address']) . '</span></li>';
	$contactInfoOutput .= '</ul>';
	return $contactInfoOutput;
}
// register shortcode
add_shortcode('contact_info', 'contact_info_shortcode');

// Address shortcode
add_shortcode('contact_address', function() {
	return '<p class="perso-info">' . $address = get_field('address', 'option') . '</p>';
});
// Phone shortcode
add_shortcode('contact_phone', function() {
	return '<a href="tel:' . esc_attr(get_field('phone', 'option')) . '" class="perso-info" >' . esc_html(get_field('phone', 'option'))  . '</a>';
});
// Email shortcode
add_shortcode('contact_email', function() {
	return '<a href="mailto:' . esc_attr(get_field('email', 'option')) . '" class="perso-info">' . esc_html(get_field('email', 'option')) . '</a>';
});
