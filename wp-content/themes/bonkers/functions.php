<?php

/**
 * Bonkers functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bonkers
 */

/**
 * Bonkers only works with PHP 5.4 or later.
 */
if ( version_compare( phpversion(), '5.4', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'bonkers_setup' ) ) :
	/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
	function bonkers_setup() {

		/*
		 * Defines Constant
		 */
		$bonkers_theme_data = wp_get_theme();
		define( 'BONKERS_THEME_NAME', $bonkers_theme_data['Name'] );
		define( 'BONKERS_THEME_VERSION', $bonkers_theme_data['Version'] );

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Bonkers, use a find and replace
		 * to change 'bonkers' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bonkers', get_template_directory() . '/languages' );

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
		 * Enable support for WooCommerce.
		 *
		 */
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		if ( function_exists( 'add_image_size' ) ) {
			//Blog
			add_image_size( 'bonkers_post', 456, 256, true );
			add_image_size( 'bonkers_post_single', 953, 9999, false );

		}

		/*
		 * Enable support for selective refresh.
		 *
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary'     => esc_html__( 'Primary Menu', 'bonkers' ),
				'social'      => esc_html__( 'Social Menu', 'bonkers' ),
				'footer-menu' => esc_html__( 'Footer Menu', 'bonkers' ),
			)
		);

			/*
             * Switch default core markup for search form, comment form, and comments
             * to output valid HTML5.
			 */
			add_theme_support(
				'html5', array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				)
			);

			// Set up the WordPress core custom background feature.
			add_theme_support(
				'custom-background', apply_filters(
					'bonkers_custom_background_args', array(
						'default-color' => 'ffffff',
						'default-image' => '',
					)
				)
			);

			// Add Logo support
			add_theme_support(
				'custom-logo', array(
					'height'      => 150,
					'width'       => 110,
					'flex-height' => false,
					'flex-width'  => true,
				)
			);

			// Styles for TinyMCE
			$font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=PT+Sans:300,400,700' );
			add_editor_style( array( 'assets/css/bootstrap.css', 'assets/css/editor-style.css', $font_url ) );

	}
endif; // bonkers_setup
add_action( 'after_setup_theme', 'bonkers_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bonkers_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bonkers_content_width', 780 );
}
add_action( 'after_setup_theme', 'bonkers_content_width', 0 );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bonkers_widgets_init() {

	require get_template_directory() . '/inc/widget-areas/widget-areas.php';

}
add_action( 'widgets_init', 'bonkers_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bonkers_scripts() {

	/**
	 * Enqueue Stylesheets
	 */
	require get_template_directory() . '/inc/scripts/stylesheets.php';

	/**
	 * Enqueue Scripts
	 */
	require get_template_directory() . '/inc/scripts/scripts.php';

}
add_action( 'wp_enqueue_scripts', 'bonkers_scripts' );

/**
 * Custom CSS generated by the Theme.
 */
require get_template_directory() . '/inc/scripts/styles.php';

/**
 * Admin Styles
 *
 * Enqueue styles to the Admin Panel.
 */
function bonkers_wp_admin_style() {
		wp_register_style( 'bonkers_custom_wp_admin_css', get_template_directory_uri() . '/assets/css/admin-styles.css', false, '1.0.0' );
		wp_enqueue_style( 'bonkers_custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'bonkers_wp_admin_style' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Extras
 *
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Jetpack
 *
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 * Theme Functions
 *
 * Add Theme Functions
 */

// Custom Header
require get_template_directory() . '/inc/theme-functions/custom-header.php';

// Retina Logo
require get_template_directory() . '/inc/theme-functions/retina-logo.php';

// Bonkers Helper Class
require get_template_directory() . '/inc/class-bonkers-helper.php';

// Bonkers Import Demo Class
require get_template_directory() . '/inc/libraries/welcome-screen/inc/class-epsilon-import-data.php';

// Bonkers Class
require get_template_directory() . '/inc/class-bonkers.php';

/**
 * Customizer
 *
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';