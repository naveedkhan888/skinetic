<?php

/* admin style */
if ( ! function_exists( 'xconnect_custom_wp_admin_style' ) ) :
    function xconnect_custom_wp_admin_style() {
        wp_register_style( 'xconnect_custom_wp_admin_css', get_template_directory_uri() . '/inc/backend/css/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'xconnect_custom_wp_admin_css' );
        
        wp_enqueue_script( 'xconnect_custom_wp_admin_js', get_template_directory_uri()."/inc/backend/js/admin-script.js", array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'xconnect_custom_wp_admin_js' );
    }
    add_action( 'admin_enqueue_scripts', 'xconnect_custom_wp_admin_style' );
endif;

/* upload SVG file */

//add_filter('upload_mimes', 'xconnect_mime_types', 10, 1);

/**
 * add group fonts
 */
add_filter( 'elementor/fonts/groups', function( $font_groups ) {
  $font_groups['xconnect_fonts'] = __( 'xConnect Fonts', 'xconnect' );
  return $font_groups;
} );

/* Filters the fonts used by Elementor to add additional fonts. */
add_filter( 'elementor/fonts/additional_fonts', function ( $additional_fonts ) {
  $additional_fonts['DM Sans'] = 'xconnect_fonts';
  return $additional_fonts;
} );