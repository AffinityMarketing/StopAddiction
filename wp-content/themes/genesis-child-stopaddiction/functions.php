<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://www.studiopress.com/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function genesis_sample_localization_setup() {

	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );

}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

// Defines the child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Genesis Sample' );
define( 'CHILD_THEME_URL', 'https://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.6.0' );

add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script(
		'genesis-sample-responsive-menu',
		get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js",
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);
	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

	wp_enqueue_script(
		'genesis-sample',
		get_stylesheet_directory_uri() . '/js/genesis-sample.js',
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

}

/**
 * Defines responsive menu settings.
 *
 * @since 2.3.0
 */
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( '', 'genesis-sample' ),
		'menuIconClass'    => 'dashicons-before dashicons-menu',
		'subMenu'          => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'      => array(
			'combine' => array(
				'.nav-secondary',
			),
			'others'  => array(),
		),
	);

	return $settings;

}
add_theme_support( 'genesis-structural-wraps', array(
    'header',
    'menu-primary',
    'menu-secondary',
    'footer-widgets',
    'footer'
) );

// Sets the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 1180; // Pixels.
}

// Adds support for HTML5 markup structure.
add_theme_support(
	'html5', array(
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
	)
);

// Adds support for accessibility.
add_theme_support(
	'genesis-accessibility', array(
		'404-page',
		'drop-down-menu',
		'headings',
		'rems',
		'search-form',
		'skip-links',
	)
);

// Adds viewport meta tag for mobile browsers.
add_theme_support(
	'genesis-responsive-viewport'
);

// Adds custom logo in Customizer > Site Identity.
add_theme_support(
	'custom-logo', array(
		'height'      => 120,
		'width'       => 700,
		'flex-height' => true,
		'flex-width'  => true,
	)
);

// Renames primary and secondary navigation menus.
add_theme_support(
	'genesis-menus', array(
		'primary'   => __( 'Header Menu', 'genesis-sample' ),
		'secondary' => __( 'Secondary Navigation Menu', 'genesis-sample' ),
		'footer' => __( 'Footer Menu', 'genesis-sample' ),
	)
);

// Adds support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Adds support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 4 );

// Removes header right widget area.
//unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Removes output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

add_action( 'genesis_theme_settings_metaboxes', 'genesis_sample_remove_metaboxes' );
/**
 * Removes output of unused admin settings metaboxes.
 *
 * @since 2.6.0
 *
 * @param string $_genesis_admin_settings The admin screen to remove meta boxes from.
 */
function genesis_sample_remove_metaboxes( $_genesis_admin_settings ) {

	remove_meta_box( 'genesis-theme-settings-header', $_genesis_admin_settings, 'main' );
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_admin_settings, 'main' );

}

add_filter( 'genesis_customizer_theme_settings_config', 'genesis_sample_remove_customizer_settings' );
/**
 * Removes output of header settings in the Customizer.
 *
 * @since 2.6.0
 *
 * @param array $config Original Customizer items.
 * @return array Filtered Customizer items.
 */
function genesis_sample_remove_customizer_settings( $config ) {

	unset( $config['genesis']['sections']['genesis_header'] );
	return $config;

}

// Displays custom logo.
//add_action( 'genesis_site_title', 'the_custom_logo', 0 );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
//  remove_action( 'genesis_after_header', 'genesis_do_subnav' );
//add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

/**
 * Reposition the secondary navigation with Genesis
 *
 * @author Reasons to Use Genesis
 * @link http://reasonstousegenesis.com/nav-secondary/
 */
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
//add_action( 'genesis_before_header', 'genesis_do_subnav' ); // replace another_hook with your desired hook


add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'footer' !== $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;
	return $args;

}

// Add footer menu just above footer widget area
//add_action( 'genesis_before_footer', 'amethyst_footer_menu', 9 );
function amethyst_footer_menu() {
  
	genesis_nav_menu( array(
		'theme_location' => 'footer',
		'container'       => 'div',
		'container_class' => 'wrap',
		'menu_class'     => 'menu genesis-nav-menu menu-footer',
		'depth'           => 1
	) );
}
// Add attributes to markup
// http://www.rfmeier.net/using-genesis_markup-with-html5-in-genesis-2-0/
add_filter( 'genesis_attr_nav-footer', 'custom_add_nav_footer_attr' );
function custom_add_nav_footer_attr( $attributes ){
	 // add role
    $attributes['role'] = 'navigation';
        
    // add itemscope
    $attributes['itemscope'] = 'itemscope';
    
    // add the site navigation schema
    $attributes['itemtype'] = 'http://schema.org/SiteNavigationElement';
    
    // return the attributes
    return $attributes;
        
}

add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}
/**
 *Move header widget inside site title area.
 */

//Remove old header function and replace with custom
remove_action( 'genesis_header','genesis_do_header' );
add_action( 'genesis_header', 'genesis_child_do_header' );

function genesis_child_do_header() {

	global $wp_registered_sidebars;

	genesis_markup( array(
		'open'    => '<div %s>',
		'context' => 'title-area',
	) );
  
  genesis_markup( array(
		'open'    => '<div %s>',
		'context' => 'logoblock',
	) );

		/**
		 * Fires inside the title area, before the site description hook.
		 *
		 * @since 2.6.0
		 */
		do_action( 'genesis_site_title' );

		/**
		 * Fires inside the title area, after the site title hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'genesis_site_description' );

     genesis_markup( array(
		'close'    => '</div>',
		'context' => 'logoblock',
	) );

	if ( has_action( 'genesis_header_right' ) || ( isset( $wp_registered_sidebars['header-right'] ) && is_active_sidebar( 'header-right' ) ) ) {

		genesis_markup( array(
			'open'    => '<div %s>',
			'context' => 'header-widget-area',
		) );

			/**
			 * Fires inside the header widget area wrapping markup, before the Header Right widget area.
			 *
			 * @since 1.5.0
			 */
			do_action( 'genesis_header_right' );
			add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
			dynamic_sidebar( 'header-right' );
			remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );

		genesis_markup( array(
			'close'   => '</div>',
			'context' => 'header-widget-area',
		) );

	}
		genesis_markup( array(
		'close'   => '</div>',
		'context' => 'title-area',
	) );

}

// Add Home Page Slider Widget Area
//Add in new Widget areas
function narconon_extra_widgets() {	
	
	genesis_register_sidebar( array(
	'id'            => 'slider',
	'name'          => __( 'Slider', 'genesischild' ),
	'description'   => __( 'This is the Slider area', 'genesischild' ),
	'before_widget' => '<div class="wrap slider">',
	'after_widget'  => '</div>',
	) );
}

add_action( 'widgets_init', 'narconon_extra_widgets' );



//Position the slider Area
function narconon_slider_widget() {
	if( is_front_page() ) {
	$callback = genesis_widget_area ( 'slider', array(
	'before' => '<section class="section section-hero section-overview-hero section-overview-hero-v4">',
	'after'  => '<div class="section-hero-media google-yellow section-hero-media-right-v4"><div class="hero-image awhpv6-hero-image"></div></div></section>',));
	}
}

add_action( 'genesis_after_header','narconon_slider_widget' );

/**
 * Dequeue the Genesis Responsive Slider stylesheet.
 *
 * Hooked to the wp_print_styles action, with a late priority (100),
 * so that it is after the style was enqueued.
 */
add_action( 'wp_print_styles', function() {
	// if we are on front page, abort.
	if ( is_front_page() ) {
		return;
	}

	wp_dequeue_style( 'slider_styles' );
}, 100 );

/**
 * Dequeue the Genesis Responsive Slider script.
 *
 * Hooked to the wp_print_scripts action, with a late priority (100),
 * so that it is after the script was enqueued.

add_action( 'wp_print_scripts', function() {
	// if we are on front page, abort.
	if ( is_front_page() ) {
		return;
	}

	wp_dequeue_script( 'flexslider' );
}, 100 );
 */

add_action( 'init', 'create_custom_post_type' );

function create_custom_post_type() {

   $labels = array(
    'name' => __( 'Homepage Slides' ),
    'singular_name' => __( 'Homepage Slide' )
    );

    $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => false,
    'rewrite' => array('slug' => 'slides'),
  	'taxonomies' => array( 'category'),
	'supports'  => array( 'title', 'editor', 'thumbnail' , 'custom-fields', 'excerpt' )
	
    );

  register_post_type( 'slides', $args);
}
// Create new image size for our hero image
add_image_size( 'hero-image', 4608, 3456, true ); // creates a hero image size
function feature_image_header() {
if( is_singular('Homepage Slides') && has_post_thumbnail()) {
 
    genesis_image(
    array(
        'size' => 'hero-image',
        'attr' => array( 'class' => 'alignleft' )
        ) );
        }
}
 
add_action('genesis_after_post_title', 'feature_image_header');

add_action( 'wp_print_styles', 'my_deregister_styles', 100 );

function my_deregister_styles() {
	wp_deregister_style( 'slider_styles' );
    /** standard slideshow styles */
	wp_register_style( 'slider_styles', get_stylesheet_directory_uri() .'/css/slider.css' );
	wp_enqueue_style( 'slider_styles' );
}
// Adds theme support for wide and full Gutenberg blocks.
add_theme_support( 'align-wide' );

/**
 * Adds a `gutenberg-page` class to the pages using Gutenberg.
 */
add_action(
    'body_class', function( $classes ) {
        if ( function_exists( 'the_gutenberg_project' ) && gutenberg_post_has_blocks( get_the_ID() ) ) {
            $classes[] = 'gutenberg-page';
        }

        return $classes;
    }
);
// Add backend styles for Gutenberg.
add_action( 'enqueue_block_editor_assets', 'photographus_add_gutenberg_assets' );

/**
 * Load Gutenberg stylesheet.
 */
function photographus_add_gutenberg_assets() {
	// Load the theme styles within Gutenberg.
	wp_register_style( 'photographus-gutenberg', get_stylesheet_directory_uri() .'/css/gutenberg-editor-style.css');
    wp_enqueue_style('photographus-gutenberg');
};
add_action( 'genesis_before_header', 'utility_bar' );
/**
* Add utility bar above header.
*
* @author Carrie Dils
* @copyright Copyright (c) 2013, Carrie Dils
* @license GPL-2.0+
*/
function utility_bar() {
 
	echo '<div class="utility-bar fixed">';
 
  	  genesis_markup( array(
		'open'    => '<div %s>',
		'context' => 'logoblockmobile',
	) );

		/**
		 * Fires inside the title area, before the site description hook.
		 *
		 * @since 2.6.0
		 */
		do_action( 'genesis_site_title' );

		/**
		 * Fires inside the title area, after the site title hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'genesis_site_description' );

     genesis_markup( array(
		'close'    => '</div>',
		'context' => 'logoblockmobile',
		) );
 
    genesis_do_subnav();
  
  echo '<div class="bar_phone" style="display:none;">'; 
  
  dynamic_sidebar( 'header-right' );
 
  echo '</div></div><div class="clearfix"></div>';
    echo '<script>jQuery(document).ready(function() { var topOfOthDiv = jQuery(".site-header").offset().top;jQuery(window).scroll(function() {if(jQuery(window).scrollTop() > topOfOthDiv) {jQuery(".bar_phone").show(200);}if(jQuery(window).scrollTop() < topOfOthDiv) { //scrolled past the other div?
            jQuery(".bar_phone").hide(200); //reached the desired point -- show div
        }});});</script>';
 
}
add_action( 'genesis_before_footer', 'before_footer_widget_area', 5 );
function before_footer_widget_area() {


	echo '
	<div id="footer">
	<div id="pre-footer-links" class="clearfix footer-container">
		<span class="pre-footer-link pre-footer-link-logo">
			<a class="nn-logo" href="/">

    
    <svg class="logo-svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="197.16px" height="51.613px" viewBox="0 0 197.16 51.613" enable-background="new 0 0 197.16 51.613" xml:space="preserve">

    <g id="nn_logo_green">
        <g>
            <g>
                <path id="SVGID_17_" fill="#000000" d="M120.387,0.747c0.07,0.164,0.135,0.325,0.213,0.484c2.45,5.17,4.902,10.336,7.357,15.506
                    c0.133,0.271,0.227,0.48-0.023,0.789c-4.312,5.312-8.603,10.636-12.912,15.95c-0.112,0.143-0.362,0.252-0.549,0.254
                    c-2.852,0.018-5.699-0.002-8.553,0.033c-1.246,0.02-2.482,0.203-3.585,0.876c-1.433,0.868-1.981,2.268-2.067,3.834
                    c-0.099,1.854-0.07,3.717-0.088,5.575c-0.011,0.729-0.004,1.458-0.004,2.247h-0.462c-4.413,0-8.824,0-13.235-0.002
                    c-0.242,0-0.478-0.018-0.718-0.035c-1.082-0.095-1.776-0.602-1.844-1.675c-0.111-1.562-0.111-3.144-0.009-4.709
                    c0.073-1.073,0.789-1.659,1.868-1.823c0.369-0.056,0.747-0.078,1.121-0.078c2.813-0.028,5.639-0.06,8.458-0.072
                    c0.261-0.004,0.396-0.083,0.5-0.324c0.314-0.733,0.655-1.448,0.981-2.17c0.249-0.54,0.493-1.078,0.754-1.646
                    c-0.159-0.013-0.247-0.02-0.335-0.02c-4.007-0.002-8.014-0.011-12.017,0.007c-0.688,0.002-1.38,0.072-2.059,0.188
                    c-2.36,0.394-3.759,1.679-3.973,4.035c-0.208,2.291-0.138,4.611-0.164,6.917c-0.007,0.507,0.067,1.017,0.145,1.521
                    c0.33,2.067,1.494,3.399,3.564,3.839c0.759,0.163,1.544,0.266,2.317,0.269c5.278,0.023,10.564,0.017,15.844,0
                    c0.205,0,0.468-0.123,0.595-0.278c4.132-5.087,8.257-10.186,12.372-15.284c1.018-1.259,1.006-1.28,2.602-1.021
                    c1.224,0.198,2.346,0.614,3.183,1.672c-3.961,4.969-7.896,9.905-11.896,14.926h0.611c1.952,0,3.902,0.016,5.852-0.004
                    c0.72-0.009,1.441-0.049,2.154-0.14c2.588-0.322,4.135-1.858,4.286-4.449c0.127-2.171,0.095-4.35,0.093-6.522
                    c0-1.35-0.227-2.658-1.031-3.802c0.039-0.063,0.066-0.114,0.105-0.164c3.67-4.608,7.344-9.223,11.021-13.823
                    c0.111-0.138,0.342-0.247,0.519-0.252c1.156-0.021,2.312-0.012,3.468-0.012c0.106,0.002,0.219,0.032,0.385,0.057
                    c-1.918,2.623-3.789,5.193-5.627,7.713c1.774,0,3.529,0.013,5.283-0.016c0.182,0,0.413-0.164,0.535-0.321
                    c2.848-3.658,5.68-7.323,8.518-10.991c0.074-0.1,0.141-0.211,0.229-0.349c-2.81-0.208-5.558-0.413-8.312-0.618l-0.008-0.099
                    c5.024-3.632,10.057-7.26,15.104-10.905c-1.025-1.158-2.021-2.273-3.04-3.42c-5.188,3.759-10.368,7.51-15.562,11.272
                    c-0.074-0.145-0.121-0.235-0.17-0.329c-1.973-4.055-3.942-8.107-5.91-12.167c-0.135-0.271-0.275-0.397-0.604-0.394
                    C124.861,0.805,120.973,0.747,120.387,0.747"></path>
            </g>
        </g>
        <g>
            <g>
                <path id="SVGID_19_" fill="#000000" d="M157.473,46.249c-1.177-0.051-1.841-0.639-1.914-1.8c-0.096-1.4-0.113-2.815-0.031-4.217
                    c0.089-1.419,0.744-2.131,2.146-2.19c2.213-0.103,4.436-0.1,6.649,0c1.378,0.06,2.047,0.735,2.137,2.099
                    c0.101,1.472,0.062,2.964-0.053,4.438c-0.081,1.082-0.737,1.622-1.828,1.67c-1.201,0.051-2.401,0.011-3.603,0.011v0.009
                    c-0.69,0-1.387,0.014-2.078,0.014C158.421,46.277,157.943,46.271,157.473,46.249 M156.729,33.749
                    c-0.609,0.005-1.229,0.081-1.832,0.175c-2,0.319-3.412,1.342-3.914,3.384c-0.123,0.479-0.219,0.975-0.228,1.465
                    c-0.032,1.919-0.044,3.838-0.04,5.758c0.008,0.612,0.044,1.229,0.137,1.834c0.295,1.921,1.293,3.271,3.229,3.793
                    c0.603,0.166,1.229,0.301,1.851,0.312c1.684,0.041,5.045,0.122,5.045,0.122c1.959-0.063,3.93-0.048,5.885-0.215
                    c2.314-0.202,3.699-1.444,4.203-3.561c0.1-0.419,0.19-0.858,0.19-1.287c-0.005-2.439,0.054-4.893-0.086-7.325
                    c-0.131-2.332-1.464-3.725-3.747-4.206c-0.613-0.133-1.246-0.228-1.871-0.231c-1.769-0.018-3.535-0.021-5.31-0.021
                    C159.068,33.742,157.898,33.743,156.729,33.749"></path>
            </g>
        </g>
        <g>
            <g>
                <path id="SVGID_21_" fill="#000000" d="M7.794,33.908c-2.085,0.016-4.17,0.01-6.255,0.01c-0.145,0-0.292,0.017-0.459,0.021
                    v16.368h4.638V38.483c0.164,0.217,0.255,0.33,0.343,0.453c2.663,3.682,5.327,7.358,7.979,11.048
                    c0.19,0.258,0.376,0.374,0.702,0.372c2.071-0.016,4.141-0.01,6.212-0.014c0.157,0,0.321-0.011,0.483-0.018V33.939h-4.602v11.736
                    l-0.112,0.026c-0.123-0.171-0.249-0.339-0.371-0.509c-2.637-3.645-5.274-7.288-7.906-10.938
                    c-0.173-0.239-0.341-0.351-0.645-0.351C7.8,33.908,7.796,33.908,7.794,33.908"></path>
            </g>
        </g>
        <g>
            <g>
                <path id="SVGID_23_" fill="#000000" d="M175.957,33.918v16.392h4.605V38.471c0.135,0.171,0.213,0.263,0.277,0.356
                    c2.694,3.716,5.385,7.435,8.067,11.151c0.18,0.262,0.366,0.378,0.69,0.373c1.485-0.011,2.979-0.008,4.465-0.008
                    c0.603,0,1.193,0,1.791-0.003c0.146,0,0.285-0.011,0.432-0.017V33.943h-4.602v11.895c-0.227-0.305-0.367-0.497-0.502-0.687
                    c-2.637-3.646-5.271-7.291-7.918-10.933c-0.092-0.129-0.262-0.284-0.396-0.286c-1.486-0.015-2.97-0.017-4.462-0.017
                    C177.596,33.918,176.779,33.918,175.957,33.918"></path>
            </g>
        </g>
        <g>
            <g>
                <path id="SVGID_25_" fill="#000000" d="M127.8,33.918c-0.547,0-1.098,0-1.646,0c-0.146,0-0.289,0.017-0.428,0.021v16.362h4.59
                    V38.479c0.177,0.223,0.285,0.354,0.389,0.494c2.662,3.681,5.327,7.356,7.979,11.048c0.178,0.247,0.371,0.334,0.668,0.33
                    c2.084-0.011,4.172-0.005,6.256-0.005h0.436V33.954h-4.586v11.757c-0.198-0.12-0.32-0.28-0.438-0.444
                    c-2.649-3.672-5.309-7.334-7.955-11.01c-0.174-0.243-0.349-0.349-0.653-0.349C130.871,33.92,129.336,33.92,127.8,33.918"></path>
            </g>
        </g>
        <g>
            <g>
                <path id="SVGID_27_" fill="#000000" d="M35.749,34.312c-1.675,2.701-3.367,5.39-5.04,8.09c-0.183,0.293-0.384,0.396-0.724,0.396
                    c-1.349-0.021-2.698-0.011-4.05-0.011h-0.472v4.14h2.399c-0.719,1.159-1.401,2.256-2.099,3.376
                    c0.124,0.026,0.167,0.045,0.208,0.045c1.77,0,3.541,0.009,5.312-0.013c0.159,0,0.371-0.168,0.464-0.312
                    c0.583-0.933,1.146-1.867,1.695-2.812c0.141-0.247,0.297-0.32,0.571-0.318c2.022,0.01,4.049,0.005,6.075,0.005h0.483V42.77H36.12
                    c0.915-1.521,1.784-2.971,2.681-4.453c0.131,0.195,0.226,0.328,0.318,0.47c2.458,3.743,4.925,7.485,7.38,11.238
                    c0.161,0.243,0.326,0.335,0.616,0.328c1.5-0.016,2.999-0.005,4.5-0.005h0.895c-0.107-0.188-0.16-0.292-0.224-0.395
                    c-3.328-5.255-6.656-10.506-9.976-15.77c-0.145-0.23-0.309-0.271-0.546-0.27c-1.771,0.001-3.542,0.013-5.314-0.011
                    c-0.007,0-0.012,0-0.02,0C36.093,33.906,35.921,34.035,35.749,34.312"></path>
            </g>
        </g>
        <g>
            <g>
                <path id="SVGID_29_" fill="#000000" d="M55.208,33.918h-0.492v16.396h4.574v-12.3h0.587c2.338,0,4.677,0,7.016,0.003
                    c0.433,0,0.87,0.013,1.303,0.041c0.951,0.062,1.375,0.488,1.437,1.44c0.016,0.256,0.014,0.514,0.009,0.768
                    c-0.023,1.463-0.81,2.241-2.271,2.247c-1.318,0.005-2.641,0.002-3.958,0.002h-0.514c0.08,0.125,0.097,0.164,0.124,0.199
                    c2.189,2.47,4.371,4.938,6.57,7.396c0.118,0.135,0.355,0.223,0.535,0.227c1.8,0.018,3.601,0.011,5.401,0.009
                    c0.109,0,0.223-0.021,0.403-0.041c-1.672-1.797-3.287-3.535-4.942-5.318c0.296-0.103,0.526-0.201,0.771-0.25
                    c1.326-0.295,2.007-1.174,2.215-2.465c0.27-1.686,0.27-3.384,0.018-5.062c-0.282-1.877-1.225-2.833-2.955-3.162
                    c-0.468-0.088-0.953-0.123-1.43-0.125c-2.401-0.004-4.801-0.004-7.202-0.004C60.007,33.918,57.608,33.918,55.208,33.918"></path>
            </g>
        </g>
        <g>
            <g>
                <path id="SVGID_31_" fill="#000000" d="M131.986,2.635c-1.577,1.467-1.651,3.816-0.166,5.347c0.861,0.884,1.923,1.297,3.156,1.32
                    c0.354-0.048,0.721-0.062,1.062-0.155c1.515-0.404,2.597-1.308,2.991-2.861c0.369-1.43-0.059-2.672-1.133-3.669
                    c-0.799-0.741-1.865-1.11-2.935-1.11C133.883,1.504,132.799,1.883,131.986,2.635"></path>
            </g>
        </g>
    </g>
    </svg>

</a><span class="reg">®</span>
		</span>

		<span class="pre-footer-link pre-footer-link-address" itemscope="" itemtype="http://schema.org/Organization" itemid="https://www.narconon.org/">
		
			<span itemprop="name"><strong>Narconon International</strong></span>
			<a href="https://www.google.com/maps/place/Narconon+Drug+%26+Alcohol+Rehab+Centers/@34.1019893,-118.3439101,15z/data=!4m5!3m4!1s0x0:0xe9a8e6dff37b1ad5!8m2!3d34.1019893!4d-118.3439101"><span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"><address><span itemprop="streetAddress">7065 Hollywood Blvd</span>, <span itemprop="addressLocality">Los Angeles</span>, <span itemprop="addressRegion">CA</span> <span itemprop="postalCode">90028</span>, <span itemprop="addressRegion">United States</span></address></span></a>
		
		</span>

		<span class="pre-footer-link pre-footer-share">
			<a target="_blank" class="f-logo share-logo icon-facebook" href="https://www.facebook.com/narconon"></a><a target="_blank" class="tweet-logo share-logo icon-twitter" href="https://twitter.com/narconon"></a><a target="_blank" class="gplus-logo share-logo icon-google-plus" href="https://plus.google.com/+Narconon"></a><a target="_blank" class="youtube-logo share-logo icon-play2" href="https://www.youtube.com/narconon"></a><a target="_blank" class="rss-logo share-logo icon-feed" href="/rss.xml"></a>

			</span>
	</div>
	</div>
	';
 
}
// Remove site footer.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
// Customize site footer
add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() { ?>

	<div id="copyright" class="clearfix footer-container">
		<div class="copyright-inner" itemscope="" itemtype="http://schema.org/Organization" itemid="https://www.narconon.org/">

			<meta itemprop="telephone" content="8007758750">

			<div><a href="/tmnotice.html">© 2018

				
				<span itemprop="name">Narconon International</span>. 
				

				All Rights Reserved.</a> &nbsp;•&nbsp; <a href="/online-privacy-notice.html">Online Privacy Notice</a> &nbsp;•&nbsp; <a href="/terms-of-use.html">Terms of Use</a> &nbsp;•&nbsp; <a href="/notice-of-privacy-practices.html">Notice of Privacy Practices</a> &nbsp;•&nbsp; <a href="/disclaimer.html">Disclaimer: Individual results are not guaranteed and may&nbsp;vary.</a> <br>&nbsp;</div>

    		

				

			<div class="copyright-end-line">Narconon and the Narconon logo are trademarks and service marks owned by the Association for Better Living and Education International and are used with its permission.</div>
		</div>


		


		<!-- cookie notice here if applicable -->
		




	</div>

<?php
}