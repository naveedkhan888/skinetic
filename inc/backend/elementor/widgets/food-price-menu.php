<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Food_Price_Menu_Widget extends Widget_Base {

    public function get_name() {
        return 'food_price_menu';
    }

    public function get_title() {
        return __( 'Food Price Menu', 'xconnect' );
    }

    public function get_icon() {
        return 'eicon-menu-bar';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        // Content Controls
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'xconnect' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'xconnect' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Menu Item' , 'xconnect' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'xconnect' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => __( 'H1', 'xconnect' ),
                    'h2' => __( 'H2', 'xconnect' ),
                    'h3' => __( 'H3', 'xconnect' ),
                    'h4' => __( 'H4', 'xconnect' ),
                    'h5' => __( 'H5', 'xconnect' ),
                    'h6' => __( 'H6', 'xconnect' ),
                    'p' => __( 'p', 'xconnect' ),
                    'span' => __( 'span', 'xconnect' ),
                    'div' => __( 'div', 'xconnect' ),
                ],
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __( 'Description', 'xconnect' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Menu Item Description' , 'xconnect' ),
                'show_label' => true,
            ]
        );

        $repeater->add_control(
            'description_tag',
            [
                'label' => __( 'Description HTML Tag', 'xconnect' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'p',
                'options' => [
                    'h1' => __( 'H1', 'xconnect' ),
                    'h2' => __( 'H2', 'xconnect' ),
                    'h3' => __( 'H3', 'xconnect' ),
                    'h4' => __( 'H4', 'xconnect' ),
                    'h5' => __( 'H5', 'xconnect' ),
                    'h6' => __( 'H6', 'xconnect' ),
                    'p' => __( 'p', 'xconnect' ),
                    'span' => __( 'span', 'xconnect' ),
                    'div' => __( 'div', 'xconnect' ),
                ],
            ]
        );

        $repeater->add_control(
            'price',
            [
                'label' => __( 'Price', 'xconnect' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '$10' , 'xconnect' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_label',
            [
                'label' => __( 'Menu Label', 'xconnect' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Special', 'xconnect' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __( 'Image', 'xconnect' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __( 'Link', 'xconnect' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'xconnect' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __( 'List Items', 'xconnect' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __( 'Menu Item #1', 'xconnect' ),
                        'description' => __( 'Description for menu item #1', 'xconnect' ),
                        'price' => __( '$10', 'xconnect' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Controls
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'xconnect' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Style
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'xconnect' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Title Typography', 'xconnect' ),
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        // Description Style
        $this->add_control(
            'description_color',
            [
                'label' => __( 'Description Color', 'xconnect' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __( 'Description Typography', 'xconnect' ),
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        // Price Style
        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'xconnect' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Menu Label Style - Background Color
        $this->add_control(
            'menu_label_bg_color',
            [
                'label' => __( 'Menu Label Background Color', 'xconnect' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-label' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => __( 'Price Typography', 'xconnect' ),
                'selector' => '{{WRAPPER}} .price',
            ]
        );

        // Separator Style
        $this->add_control(
            'separator_style',
            [
                'label' => __( 'Separator Style', 'xconnect' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'solid' => __( 'Solid', 'xconnect' ),
                    'dotted' => __( 'Dotted', 'xconnect' ),
                    'dashed' => __( 'Dashed', 'xconnect' ),
                    'double' => __( 'Double', 'xconnect' ),
                    'none' => __( 'None', 'xconnect' ),
                ],
                'default' => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .separator' => 'border-bottom-style: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'separator_weight',
            [
                'label' => __( 'Separator Weight', 'xconnect' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .separator' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'separator_color',
            [
                'label' => __( 'Separator Color', 'xconnect' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .separator' => 'border-bottom-color: {{VALUE}}',
                ],
            ]
        );

        // Item Separator Style
        $this->add_control(
            'item_separator_style',
            [
                'label' => __( 'Item Separator Style', 'xconnect' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'solid' => __( 'Solid', 'xconnect' ),
                    'dotted' => __( 'Dotted', 'xconnect' ),
                    'dashed' => __( 'Dashed', 'xconnect' ),
                    'double' => __( 'Double', 'xconnect' ),
                    'none' => __( 'None', 'xconnect' ),
                ],
                'default' => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .item-separator' => 'border-top-style: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'item_separator_weight',
            [
                'label' => __( 'Item Separator Weight', 'xconnect' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .item-separator' => 'border-top-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'item_separator_color',
            [
                'label' => __( 'Item Separator Color', 'xconnect' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item-separator' => 'border-top-color: {{VALUE}}',
                ],
            ]
        );

        // Item Spacing
        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => __( 'Item Spacing', 'xconnect' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .menu-item' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['list'] ) ) {
            echo '<div class="food-price-menu">';
            foreach ( $settings['list'] as $index => $item ) {
                echo '<div class="menu-item">';
                if ( ! empty( $item['image']['url'] ) ) {
                    echo '<div class="image"><img src="' . esc_url( $item['image']['url'] ) . '" alt="' . esc_attr( $item['title'] ) . '"></div>';
                }
                echo '<div class="content">';
                echo '<div class="title_priccce">'; 
                echo '<' . $item['title_tag'] . ' class="title">' . esc_html( $item['title'] ) . '</' . $item['title_tag'] . '>';
                // Render Menu Label if available
                if ( ! empty( $item['menu_label'] ) ) {
                    echo '<div class="menu-label">' . esc_html( $item['menu_label'] ) . '</div>';
                }
                // Add item separator within the item
                echo '<div class="item-separator"></div>';
                echo '<div class="price">' . esc_html( $item['price'] ) . '</div>';
                echo '</div>';
                echo '<' . $item['description_tag'] . ' class="description">' . esc_html( $item['description'] ) . '</' . $item['description_tag'] . '>';
                if ( ! empty( $item['link']['url'] ) ) {
                    $target = $item['link']['is_external'] ? ' target="_blank"' : '';
                    $nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
                    echo '<a href="' . esc_url( $item['link']['url'] ) . '"' . $target . $nofollow . '>' . esc_html( $item['title'] ) . '</a>';
                }
                echo '</div>';
                echo '</div>';
                // Add separator between items, except after the last item
                if ( $index < count( $settings['list'] ) - 1 ) {
                    echo '<div class="separator"></div>';
                }
            }
            echo '</div>';
        }
    }

    protected function _content_template() {
        ?>
        <# if ( settings.list.length ) { #>
            <div class="food-price-menu">
                <# _.each( settings.list, function( item, index ) { #>
                    <div class="menu-item">
                        <# if ( item.image.url ) { #>
                            <div class="image"><img src="{{ item.image.url }}" alt="{{ item.title }}"></div>
                        <# } #>
                        <div class="content">
                            <div class="title_priccce">
                                <{{{ item.title_tag }}} class="title">{{{ item.title }}}</{{{ item.title_tag }}}>
                                <# if ( item.menu_label ) { #>
                                <div class="menu-label">{{{ item.menu_label }}}</div>
                                <# } #>
                                <# if ( index < settings.list.length - 1 ) { #>
                                    <div class="item-separator"></div>
                                <# } #>
                                <div class="price">{{{ item.price }}}</div>
                            </div>
                            <{{{ item.description_tag }}} class="description">{{{ item.description }}}</{{{ item.description_tag }}}>
                            <# if ( item.link.url ) { 
                                var target = item.link.is_external ? ' target="_blank"' : '';
                                var nofollow = item.link.nofollow ? ' rel="nofollow"' : '';
                            #>
                                <a href="{{ item.link.url }}"{{ target }}{{ nofollow }}>{{{ item.title }}}</a>
                            <# } #>
                        </div>
                    </div>
                <# }); #>
                <div class="separator"></div>
            </div>
        <# } #>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Food_Price_Menu_Widget() );
