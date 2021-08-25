<?php
/**
 * Sub Rosa functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sub_Rosa
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/*Load Carbon Fields*/
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

if ( ! function_exists( 'subrosa_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function subrosa_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Sub Rosa, use a find and replace
		 * to change 'subrosa' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'subrosa', get_template_directory() . '/languages' );

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
		add_image_size('featured',700);
		add_image_size('featured_landscape',1360);
		add_image_size('featured_square',700,700,array('center','top'));
		

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'subrosa' ),
				'menu-2' => esc_html__( 'Footer 1', 'secret_history' ),
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

		
	}
endif;
add_action( 'after_setup_theme', 'subrosa_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function subrosa_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'subrosa_content_width', 640 );
}
add_action( 'after_setup_theme', 'subrosa_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

/**
 * Enqueue scripts and styles.
 */
function subrosa_scripts() {
	wp_enqueue_style( 'subrosa-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'subrosa-style', 'rtl', 'replace' );

	wp_enqueue_script( 'subrosa-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/flickity.pkgd.min.js', array(),'2.21', true );
	wp_enqueue_script( 'flickity-init', get_template_directory_uri() . '/js/flickity-init.js', array(), _S_VERSION, true );
	wp_enqueue_style( 'flickity-style', get_template_directory_uri() . '/css/flickity.css', array(),'2.21' );

}
add_action( 'wp_enqueue_scripts', 'subrosa_scripts' );


/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/template-tags.php';

/**
 * Create Custom Post Types
 */

require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Carbon Fields Functions
 */
require get_template_directory() . '/inc/carbon.php';


/**
 * Display blocks
 */
require get_template_directory() . '/inc/blocks.php';

/**
 * Disable Gutenburg
 */
add_filter("use_block_editor_for_post_type", "disable_gutenberg_editor");
function disable_gutenberg_editor()
{
return false;
}

