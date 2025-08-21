<?php

// Skinetic Elementor Kit Configuration Class
namespace Skinetic\Compatibility;

// Load the theme's custom Widgets so that they appear in the Elementor element panel.
add_action( 'elementor/widgets/register', 'skinetic_register_elementor_widgets' );
function skinetic_register_elementor_widgets() {
    // Include PHP files for Elementor widgets
    // These files contain registration logic for custom Elementor widgets
    locate_template('/inc/backend/elementor/widgets/widgets.php', true, true);
    locate_template('/inc/backend/elementor/widgets/header/widgets.php', true, true);

}

// Add a custom 'category_skinetic' category for to the Elementor element panel so that our theme's widgets have their own category.
add_action( 'elementor/init', function() {
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_skinetic',
        [
            'title' => __( 'Skinetic', 'skinetic' ),
            'icon' => 'fa fa-plug', //default icon
        ],
        1 // position
    );
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_skinetic_header',
        [
            'title' => __( 'XP Header', 'skinetic' ),
            'icon' => 'fa fa-plug', //default icon
        ],
        2 // position
    );
});

// Post types with Elementor
function skinetic_add_cpt_support() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_cpt_support' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = [ 'page', 'post', 'xp_portfolio', 'xp_header_builders', 'xp_footer_builders' ]; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }
    
    //if it DOES exist, but portfolio is NOT defined
    else {
        $xp_portfolio       = in_array( 'xp_portfolio', $cpt_support );
        $xp_header_builders = in_array( 'xp_header_builders', $cpt_support );
        $xp_footer_builders = in_array( 'xp_footer_builders', $cpt_support );
        if( !$xp_portfolio ){
            $cpt_support[] = 'xp_portfolio'; //append to array
        }
        if( !$xp_header_builders ){
            $cpt_support[] = 'xp_header_builders'; //append to array
        }
        if( !$xp_footer_builders ){
            $cpt_support[] = 'xp_footer_builders'; //append to array
        }
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    
    //otherwise do nothing, portfolio already exists in elementor_cpt_support option
}
add_action( 'elementor/init', 'skinetic_add_cpt_support' );

// Upload SVG for Elementor
function skinetic_unfiltered_files_upload() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_unfiltered_files_upload' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = '1'; //create string value default to enable upload svg
        update_option( 'elementor_unfiltered_files_upload', $cpt_support ); //write it to the database
    }
}
add_action( 'elementor/init', 'skinetic_unfiltered_files_upload' );



/*Fix Elementor Pro*/
function skinetic_register_elementor_locations( $elementor_theme_manager ) {

    $elementor_theme_manager->register_all_core_location();

}
add_action( 'elementor/theme/register_locations', 'skinetic_register_elementor_locations' );

/*** add options to sections ***/
add_action('elementor/element/container/section_layout/after_section_end', function( $container, $args ) {

    /* header options */
    $container->start_controls_section(
        'header_custom_class',
        [
            'label' => __( 'For Header', 'skinetic' ),
            'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
        ]
    );
    $container->add_control(
        'sticky_class',
        [
            'label'        => __( 'Sticky On/Off', 'skinetic' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'return_value' => 'is-fixed',
            'prefix_class' => '',
        ]
    );
    $container->add_control(
        'sticky_background',
        [
            'label'     => __( 'Background Scroll', 'skinetic' ),
            'type'      => Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}.is-fixed.is-stuck' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'sticky_class' => 'is-fixed',
            ],
        ]
    );
    $container->add_responsive_control(
        'offset_space',
        [
            'label' => __( 'Offset', 'skinetic' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}.is-stuck' => 'top: {{SIZE}}{{UNIT}};',
                '.admin-bar {{WRAPPER}}.is-stuck' => 'top: calc({{SIZE}}{{UNIT}} + 32px);',
            ],
            'condition' => [
                'sticky_class' => 'is-fixed',
            ],
        ]
    );

    $container->end_controls_section();

}, 10, 2 );

/*** add options to columns ***/
if ( did_action( 'elementor/loaded' ) ) {
    require get_template_directory() . '/inc/backend/elementor/column.php';
}











if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if( !defined( 'ELEMENTOR_VERSION' ) ) {
    return;
}

class Skinetic_Elementor { 
    private static $instance;

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function __construct() {
        // Initialize the default kit update
        add_action( 'elementor/init', array( $this, 'update_default_elementor_kit' ) );
    }
    
    public function update_default_elementor_kit() {

        add_option( 'default_skinetic_kit', 0 );
        if ( get_option( 'default_skinetic_kit' ) == 0 ) {

            $kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit();

            if ( ! $kit->get_id() ) {
                return;
            }

            $kit->update_settings( [
                'system_colors' => array(
                     0 => array(
                        '_id' => 'primary',
                        'title' => 'Primary',
                        'color' => '',
                     ),
                     1 => array(
                        '_id' => 'secondary',
                        'title' => 'Secondary',
                        'color' => '',
                     ),
                     2 => array(
                        '_id' => 'text',
                        'title' => 'Text',
                        'color' => '',
                     ),
                     3 => array(
                        '_id' => 'accent',
                        'title' => 'Accent',
                        'color' => '',
                     ),
                     4 => array(
                        '_id' => 'accentsecondary',
                        'title' => 'Accent Secondary',
                        'color' => '',
                     ),
                     5 => array(
                        '_id' => 'white',
                        'title' => 'White Color',
                        'color' => '',
                     ),
                     6 => array(
                        '_id' => 'black',
                        'title' => 'Black Color',
                        'color' => '',
                     ),
                     7 => array(
                        '_id' => 'divider',
                        'title' => 'Divider Color',
                        'color' => '',
                     ),
                     8 => array(
                        '_id' => 'darkdivider',
                        'title' => 'Dark Divider Color',
                        'color' => '',
                     ),
                ),
            ] );

            \Elementor\Plugin::instance()->files_manager->clear_cache();
            update_option( 'default_skinetic_kit', 1 );
        }
    }
            
}

// Initialize the Awaiken_Elementor class
Skinetic_Elementor::instance();