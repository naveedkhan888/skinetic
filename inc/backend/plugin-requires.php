<?php
/**
 * Register required, recommended plugins for theme
 *
 * @link http://tgmpluginactivation.com/configuration/
 *
 * @package xConnect
 */
require_once get_template_directory() . '/inc/libs/class-tgm-plugin-activation.php';
function xconnect_register_required_plugins() {
	$protocol = is_ssl() ? 'https' : 'http';
	$plugins = array(
		array(
			'name'               => esc_html__( 'Meta Box', 'xconnect' ),
			'slug'               => 'meta-box',
			'required'           => true,
		),
		array(
			'name'               => esc_html__( 'Kirki', 'xconnect' ),
			'slug'               => 'kirki',
			'required'           => true,
		),
		array(
			'name'               => esc_html__( 'Elementor Page Builder', 'xconnect' ),
			'slug'               => 'elementor',
			'required'           => true,
		),
		array(
            'name'               => esc_html__( 'Contact Form 7', 'xconnect' ),
            'slug'               => 'contact-form-7',
            'required'           => true,
		),
		array(
            'name'               => esc_html__( 'MailChimp for WordPress', 'xconnect' ),
            'slug'               => 'mailchimp-for-wp',
            'required'           => true,
		),
		array(
            'name'               => esc_html__( 'XP Portfolio', 'xconnect' ), // The plugin name.
            'slug'               => 'xp_portfolio', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://dpsample.com/xp_portfolio.zip'), // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(            
            'name'               => esc_html__( 'XP One Click Demo Content', 'xconnect' ), // The plugin name.
            'slug'               => 'soo-demo-importer', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://dpsample.com/soo-demo-importer.zip'), // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(            
            'name'               => esc_html__( 'Core Code xConnect', 'xconnect' ), // The plugin name.
            'slug'               => 'core-code-xconnect', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://dpsample.com/themes_data/xconnect/core-code-xconnect.zip'), // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(            
            'name'               => esc_html__( 'Revolution Slider', 'xconnect' ), // The plugin name.
            'slug'               => 'revslider', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://dpsample.com/revslider.zip'), // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => esc_html__( 'WooCommerce', 'xconnect' ),
            'slug'               => 'woocommerce',
            'required'           => true,
		),
		array(
            'name'               => esc_html__( 'Qi Addons For Elementor', 'xconnect' ),
            'slug'               => 'qi-addons-for-elementor',
            'required'           => true,
		),
		array(
            'name'               => esc_html__( 'Classic Editor', 'xconnect' ),
            'slug'               => 'classic-editor',
            'required'           => true,
		),
        
	);
	$config  = array(
		'domain'       => 'xconnect',
		'default_path' => '',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => false,
		'message'      => '',
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'xconnect' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'xconnect' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'xconnect' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'xconnect' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'xconnect' ),
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'xconnect' ),
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'xconnect' ),
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'xconnect' ),
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'xconnect' ),
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'xconnect' ),
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'xconnect' ),
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'xconnect' ),
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'xconnect' ),
			'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'xconnect' ),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'xconnect' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'xconnect' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'xconnect' ),
			'nag_type'                        => 'updated',
		),
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'xconnect_register_required_plugins' );
