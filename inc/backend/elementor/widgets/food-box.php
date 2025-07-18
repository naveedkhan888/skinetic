<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Widget Name: XP Image Box Food
 */
class XP_Image_Box_Food extends Widget_Base {

    public function get_name() {
        return 'xp_image_box_food';
    }

    public function get_title() {
        return __( 'XP Image Box Food', 'skinetic' );
    }

    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return [ 'category_skinetic' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Image Box', 'skinetic' ),
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'skinetic' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', 'skinetic' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'skinetic' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'skinetic' ),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .xp-image-box' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'image_box',
            [
                'label' => esc_html__( 'Image Box', 'skinetic' ),
                'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image_box_size',
                'exclude' => ['1536x1536', '2048x2048'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'skinetic' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Marketing Research', 'skinetic' ),
            ]
        );

        $this->add_control(
            'header_size',
            [
                'label' => __( 'Title HTML Tag', 'skinetic' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h5',
            ]
        );

        $this->add_control(
            'des',
            [
                'label' => 'Description',
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Analysis of the market as a whole and its particular components (competitors, consumers, product, etc.)', 'skinetic' ),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'skinetic' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'skinetic' ),
                'default' => [
                    'url' => '#'
                ],
            ]
        );

        $this->add_control(
            'label_link',
            [
                'label' => 'Label Button',
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Explore More', 'skinetic' ),
                'label_block' => true,
                'condition' => [
                    'link[url]!' => '',
                ],
            ]
        );

        // Add Price Control
        $this->add_control(
            'price',
            [
                'label' => __( 'Price', 'skinetic' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '99.99', 'skinetic' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        /*** Style ***/

        $this->start_controls_section(
            'style_content_section',
            [
                'label' => __( 'Content', 'skinetic' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // General
        $this->add_control(
            'heading_general',
            [
                'label' => __( 'General', 'skinetic' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'box_bg',
            [
                'label' => __( 'Background', 'skinetic' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xp-image-box' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label' => __( 'Padding Box', 'skinetic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .content-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'radius_box',
            [
                'label' => __( 'Border Radius', 'skinetic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .xp-image-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_box_shadow',
                'selector' => '{{WRAPPER}} .xp-image-box',
            ]
        );

        // Title
        $this->add_control(
            'heading_title',
            [
                'label' => __( 'Title', 'skinetic' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'title_space',
            [
                'label' => __( 'Spacing', 'skinetic' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .title-box' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'skinetic' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .title-box a' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'title_hcolor',
            [
                'label' => __( 'Hover Color', 'skinetic' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .title-box a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'link[url]!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title-box',
            ]
        );

        // Description
        $this->add_control(
            'heading_des',
            [
                'label' => __( 'Description', 'skinetic' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'des_color',
            [
                'label' => __( 'Color', 'skinetic' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .description-box' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'des_typography',
                'selector' => '{{WRAPPER}} .description-box',
            ]
        );

        // Price
        $this->add_control(
            'heading_price',
            [
                'label' => __( 'Price', 'skinetic' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Color', 'skinetic' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .price-box' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'price_bg_color',
            [
                'label' => __( 'Background Color', 'skinetic' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .price-box' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .price-box',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Ensure that we have necessary data
        if ( empty( $settings['image_box']['url'] ) || empty( $settings['title'] ) ) {
            return;
        }

        $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';

        echo '<div class="xp_bx_price xp-image-box ' . esc_attr(isset($settings['custom_class']) ? $settings['custom_class'] : '') . '">';
        echo '<div class="image-box">';
        echo '<img src="' . esc_url($settings['image_box']['url']) . '" alt="' . esc_attr__('Image', 'skinetic') . '" />';
        echo '</div>';
        echo '<div class="content-box image-box-price">';
        echo '<' . esc_html($settings['header_size']) . ' class="title-box">';
        if ( ! empty( $settings['link']['url'] ) ) {
            echo '<a href="' . esc_url($settings['link']['url']) . '"' . $target . $nofollow . '>';
            echo esc_html($settings['title']);
            echo '</a>';
        } else {
            echo esc_html($settings['title']);
        }
        echo '</' . esc_html($settings['header_size']) . '>';
        echo '<div class="description-box">' . esc_html($settings['des']) . '</div>';
        if ( ! empty( $settings['price'] ) ) {
            echo '<div class="price-box">' . esc_html($settings['price']) . '</div>';
        }
        if ( ! empty( $settings['label_link'] ) && ! empty( $settings['link']['url'] ) ) {
            echo '<a href="' . esc_url($settings['link']['url']) . '" class="button"' . $target . $nofollow . '>';
            echo esc_html($settings['label_link']);
            echo '</a>';
        }
        echo '</div>';
        echo '</div>';
    }

    protected function _content_template() {
    ?>
    <#
    var link = settings.link.url ? settings.link.url : '#';
    var target = settings.link.is_external ? ' target="_blank"' : '';
    var nofollow = settings.link.nofollow ? ' rel="nofollow"' : '';
    var header_tag = settings.header_size ? settings.header_size : 'h5';
    #>
    <div class="xp_bx_price xp-image-box {{{ settings.custom_class }}}">
        <div class="image-box">
            <img src="{{{ settings.image_box.url }}}" alt="<?php esc_attr_e( 'Image', 'skinetic' ); ?>">
        </div>
        <div class="content-box image-box-price">
            <{{ header_tag }} class="title-box">
                <# if ( settings.link.url ) { #>
                    <a href="{{{ link }}}"{{ target }}{{ nofollow }}>
                        {{{ settings.title }}}
                    </a>
                <# } else { #>
                    {{{ settings.title }}}
                <# } #>
            </{{ header_tag }}>
            <div class="description-box">{{{ settings.des }}}</div>
            <# if ( settings.price ) { #>
                <div class="price-box">{{{ settings.price }}}</div>
            <# } #>
            <# if ( settings.label_link && settings.link.url ) { #>
                <a href="{{{ link }}}" class="button"{{ target }}{{ nofollow }}>
                    {{{ settings.label_link }}}
                </a>
            <# } #>
        </div>
    </div>
    <?php
}

}

Plugin::instance()->widgets_manager->register_widget_type( new XP_Image_Box_Food() );
?>
