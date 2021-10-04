<?php

///////////////////////////////////////////////////////////////////////////////
// MAIN FUNCTIONS FILE
///////////////////////////////////////////////////////////////////////////////

// ---------------------------------------------------------------
// INCLUDES
// ---------------------------------------------------------------

// require get_stylesheet_directory() . '/src/includes/lib/Mobile_Detect.php';
// require get_stylesheet_directory() . '/src/includes/utils/console-log.php';
require get_stylesheet_directory() . '/src/includes/utils/get-theme-path.php';
require get_stylesheet_directory() . '/src/includes/template-classes.php';
require get_stylesheet_directory() . '/src/includes/template-functions.php';
include_recursive(get_stylesheet_directory() . '/src/includes/template-tags/');

// ---------------------------------------------------------------
// THEME SETUP ELEMENTS
// ---------------------------------------------------------------

if (!function_exists('wpnk_setup')):
    function wpnk_setup()
{
        show_admin_bar(false);
        add_theme_support('post-thumbnails');
        // acf_update_setting('google_api_key', 'AIzaSyDvcCztnE5NHUKgR47Fghb8Kf4eDP_fa0k');
        register_nav_menus(array(
            'wpnk_nav' => esc_html__('Main WPNK Nav', 'wpnk'),
        ));
    }
endif;
add_action('after_setup_theme', 'wpnk_setup');

// -- HIDE EDITOR IN SOME PAGES

add_action('admin_init', 'hide_editor');

// ---------------------------------------------------------------
// STYLE & SCRIPTS
// ---------------------------------------------------------------

if ( !is_admin() ) {
    function wpnk_dequeue_style() {
        // wp_dequeue_style('....');
    }
    add_action('wp_enqueue_scripts', 'wpnk_dequeue_style', 900);

    function wpnk_dequeue_scripts() {
        wp_deregister_script('wp-embed');
        // wp_deregister_script('jquery');
    }

    add_action('wp_enqueue_scripts', 'wpnk_dequeue_scripts', 901);

    function wpnk_enqueue_theme_builds() {
        if ( WP_DEBUG ) {
            wp_register_script( 'wpnk-site-scripts', wpnk_get_theme_path() . '/dist/js/main.js', array(), null, true );
            wp_enqueue_script( 'wpnk-site-scripts' );

            wp_register_style( 'wpnk-styles', wpnk_get_theme_path() . '/dist/styles/style.css', array(), null, 'all' );
            wp_enqueue_style( 'wpnk-styles' );
        }

        if ( ! WP_DEBUG ) {
            $js_file_time = filemtime( get_stylesheet_directory() . '/dist/js/main.js' );
            wp_register_script('wpnk-site-scripts', get_stylesheet_directory_uri() . '/dist/js/main.js', array(), $js_file_time, true);
            wp_enqueue_script( 'wpnk-site-scripts' );

            $css_file_time = filemtime(get_stylesheet_directory() . '/dist/styles/style.css');
            wp_register_style( 'wpnk-styles', get_stylesheet_directory_uri() . '/dist/styles/style.css', array(), $css_file_time, 'all' );
            wp_enqueue_style( 'wpnk-styles' );
        }
    }
    add_action( 'wp_enqueue_scripts', 'wpnk_enqueue_theme_builds', 999 );
}
