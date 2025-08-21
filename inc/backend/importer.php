<?php
/**
 * Hooks for importer
 *
 * @package Skinetic
 */


/**
 * Importer the demo content
 *
 * @since  1.0
 *
 */
function skinetic_importer() {
	return array(
		array(
			'name'       => 'Main Demo (all layout)',
			'preview'    => get_template_directory_uri().'/inc/backend/data/maintheme/home1.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/maintheme/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/maintheme/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/maintheme/widgets.wie',
			//'sliders'    => '/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home 2',
			'preview'    => get_template_directory_uri().'/inc/backend/data/maintheme/home2.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/maintheme/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/maintheme/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/maintheme/widgets.wie',
			//'sliders'    => '/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 2',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home 3',
			'preview'    => get_template_directory_uri().'/inc/backend/data/maintheme/home3.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/maintheme/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/maintheme/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/maintheme/widgets.wie',
			//'sliders'    => '/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 3',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
	);
}

add_filter( 'soo_demo_packages', 'skinetic_importer', 30 );




function skinetic_after_import_setup() {
	
	
	
	  // Get elementor Kit.
	  $kit_page = get_posts(
		[
		  'post_type'              => 'elementor_library',
		  'title'                  => 'Skinetic - Default Kit',
		  'post_status'            => 'all',
		  'numberposts'            => 1,
		  'update_post_term_cache' => false,
		  'update_post_meta_cache' => false,
		]
	  );
	
	 if ( ! empty( $kit_page ) ) {
		update_option( 'elementor_active_kit', $kit_page[0]->ID );
	  }

	// Check if Elementor is active
    if ( did_action( 'elementor/loaded' ) ) {
        // Regenerate CSS files
        \Elementor\Plugin::instance()->files_manager->clear_cache();
    }

}
add_action( 'import_end', 'skinetic_after_import_setup' );