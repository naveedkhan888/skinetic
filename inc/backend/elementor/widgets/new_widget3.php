<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit;
}

class Custom_Medical_Services_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'custom_medical_services';
    }

    public function get_title()
    {
        return esc_html__('XP Service 2', 'xconnect');
    }

    public function get_icon()
    {
        return 'eicon-kit-details';
    }

    public function get_categories()
    {
        return ['category_xconnect'];
    }

    protected function register_controls()
    {
        // Content Tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Services', 'xconnect'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Add Column Control
        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'xconnect'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [
                    
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'prefix_class' => 'elementor-grid-',
                'frontend_available' => true,
            ]
        );

        // Add Column Gap Control
        $this->add_responsive_control(
            'column_gap',
            [
                'label' => esc_html__('Columns Gap', 'xconnect'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .medical-services-grid' => 'grid-column-gap: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        // Add Row Gap Control
        $this->add_responsive_control(
            'row_gap',
            [
                'label' => esc_html__('Rows Gap', 'xconnect'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .medical-services-grid' => 'grid-row-gap: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        // ADD THIS CODE HERE - Global Title Tag Control
        $this->add_control(
            'global_title_tag',
            [
                'label' => esc_html__('Default Title HTML Tag', 'xconnect'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
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
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'service_icon',
            [
                'label' => esc_html__('Icon', 'xconnect'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-plus-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
            'service_title',
            [
                'label' => esc_html__('Title', 'xconnect'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'xconnect'),
            ]
        );

        // ADD THESE TWO CONTROLS HERE - Custom Title Tag Controls
        $repeater->add_control(
            'custom_title_tag',
            [
                'label' => esc_html__('Custom Title Tag', 'xconnect'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'xconnect'),
                'label_off' => esc_html__('No', 'xconnect'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'xconnect'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
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
                'condition' => [
                    'custom_title_tag' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'read_more_text',
            [
                'label' => esc_html__('Read More Text', 'xconnect'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'xconnect'),
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'xconnect'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'xconnect'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        // Individual Style Controls
        $repeater->add_control(
            'custom_style',
            [
                'label' => esc_html__('Custom Style', 'xconnect'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $repeater->start_controls_tabs(
            'style_tabs',
            [
                'condition' => [
                    'custom_style' => 'yes',
                ],
            ]
        );

        $repeater->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__('Normal', 'xconnect'),
            ]
        );

        // Background Color
        $repeater->add_control(
            'background_color',
            [
                'label' => esc_html__('Background Color', 'xconnect'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Icon Style
        $repeater->add_control(
            'individual_icon_heading',
            [
                'label' => esc_html__('Icon', 'xconnect'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'icon_color',
            [
                'label' => esc_html__('Color', 'xconnect'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .service-icon-wrapper i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .service-icon-wrapper svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Size', 'xconnect'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .service-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .service-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Heading Style
        $repeater->add_control(
            'individual_heading_heading',
            [
                'label' => esc_html__('Heading', 'xconnect'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'heading_color',
            [
                'label' => esc_html__('Color', 'xconnect'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .service-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'heading_spacing',
            [
                'label' => esc_html__('Top Spacing', 'xconnect'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .service-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => esc_html__('Typography', 'xconnect'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .service-title',
            ]
        );

        // Read More Link Style
        $repeater->add_control(
            'individual_read_more_heading',
            [
                'label' => esc_html__('Read More Link', 'xconnect'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'read_more_color',
            [
                'label' => esc_html__('Text Color', 'xconnect'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .service-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'read_more_typography',
                'label' => esc_html__('Typography', 'xconnect'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .service-link',
            ]
        );

        $repeater->add_responsive_control(
            'read_more_spacing',
            [
                'label' => esc_html__('Top Spacing', 'xconnect'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .service-link' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Add Padding Controls in Repeater
        $repeater->add_control(
            'custom_padding_heading',
            [
                'label' => esc_html__('Padding', 'xconnect'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'custom_style' => 'yes',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'item_padding',
            [
                'label' => esc_html__('Padding', 'xconnect'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'custom_style' => 'yes',
                ],
            ]
        );

        $repeater->end_controls_tab();
        $repeater->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__('Hover', 'xconnect'),
            ]
        );

        $repeater->add_control(
            'background_hover_color',
            [
                'label' => esc_html__('Background Color', 'xconnect'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Add icon hover color control in repeater
        $repeater->add_control(
            'icon_hover_color',
            [
                'label' => esc_html__('Icon Hover Color', 'xconnect'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover .service-icon-wrapper i' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover .service-icon-wrapper svg' => 'fill: {{VALUE}} !important; color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'custom_style' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'read_more_hover_color',
            [
                'label' => esc_html__('Read More Color', 'xconnect'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .service-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'services',
            [
                'label' => esc_html__('Services', 'xconnect'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'service_title' => esc_html__('Service 1', 'xconnect'),
                        'service_icon' => [
                            'value' => 'fas fa-phone-alt',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'service_title' => esc_html__('Service 2', 'xconnect'),
                        'service_icon' => [
                            'value' => 'fas fa-microscope',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'service_title' => esc_html__('Service 3', 'xconnect'),
                        'service_icon' => [
                            'value' => 'fas fa-stethoscope',
                            'library' => 'fa-solid',
                        ],
                    ],
                    
                ],
                'title_field' => '{{{ service_title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Global Styles', 'xconnect'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'alert_note',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => '<div style="color: red; font-weight: normal; padding: 10px; background-color: #ffe4e4; border: 1px solid red; border-radius: 5px;">
                            First, disable the custom styles of each widget, then apply the global styles to ensure they take effect properly.
                          </div>',
                'content_classes' => 'alert-note',
            ]
        );

        // Background Color
        $this->add_control(
            'background_color',
            [
                'label' => esc_html__('Background Color', 'xconnect'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .medical-service-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Icon Style Controls
        $this->add_control(
            'icon_style_heading',
            [
                'label' => esc_html__('Icon', 'xconnect'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Add the new hover color control right after the icon_size control:
        $repeater->add_control(
            'icon_hover_color_simple',
            [
                'label' => esc_html__('Icon Color', 'xconnect'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover .service-icon-wrapper i' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover .service-icon-wrapper svg' => 'fill: {{VALUE}} !important; color: {{VALUE}} !important;',
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover .service-icon' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'custom_style' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Color', 'xconnect'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .service-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Add this new control for icon hover color
        $this->add_control(
            'icon_hover_color',
            [
                'label' => esc_html__('Hover Color', 'xconnect'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .medical-service-item:hover .service-icon-wrapper i' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .medical-service-item:hover .service-icon-wrapper svg' => 'fill: {{VALUE}} !important; color: {{VALUE}} !important;',
                    '{{WRAPPER}} .medical-service-item:hover .service-icon' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Size', 'xconnect'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 80,
                ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Heading Style Controls
        $this->add_control(
            'heading_style_heading',
            [
                'label' => esc_html__('Heading', 'xconnect'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Color', 'xconnect'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .service-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_spacing',
            [
                'label' => esc_html__('Top Spacing', 'xconnect'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => esc_html__('Typography', 'xconnect'),
                'selector' => '{{WRAPPER}} .service-title',
            ]
        );

        // Read More Link Style Controls
        $this->add_control(
            'read_more_style_heading',
            [
                'label' => esc_html__('Read More Link', 'xconnect'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'read_more_color',
            [
                'label' => esc_html__('Text Color', 'xconnect'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .service-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_hover_color',
            [
                'label' => esc_html__('Text Hover Color', 'xconnect'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .service-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'read_more_typography',
                'label' => esc_html__('Typography', 'xconnect'),
                'selector' => '{{WRAPPER}} .service-link',
            ]
        );

        $this->add_responsive_control(
            'read_more_spacing',
            [
                'label' => esc_html__('Top Spacing', 'xconnect'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-link' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Add Global Padding Controls
        $this->add_control(
            'padding_style_heading',
            [
                'label' => esc_html__('Padding', 'xconnect'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'global_item_padding',
            [
                'label' => esc_html__('Item Padding', 'xconnect'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .medical-service-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'width_control',
            [
                'label' => esc_html__('Width', 'xconnect'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'em', 'vw'], // Supported units
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%', // Default unit
                    'size' => 100, // Default size
                ],
                'responsive' => true, // Enables responsive controls
                'selectors' => [
                    '{{WRAPPER}} .service-top-content .service-title' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Add a unique class for this widget instance
        $widget_id = $this->get_id();
        $widget_class = 'medical-services-' . $widget_id;
        // Detect if global styles are applied
        $use_global_styles = isset($settings['custom_style']) && $settings['custom_style'] === 'no';
        // Wrapper classes
        $wrapper_classes = ['elementor-widget-container'];
        // Add custom or global styles class
        if ($use_global_styles) {
            $wrapper_classes[] = 'use-global-styles';
        } else {
            $wrapper_classes[] = 'use-custom-styles';
        }

        $this->add_render_attribute(
            'wrapper',
            [
                'class' => [
                    'elementor-grid',
                    'elementor-grid-' . $settings['columns'],
                    'elementor-grid-tablet-' . $settings['columns_tablet'],
                    'elementor-grid-mobile-' . $settings['columns_mobile']
                ]
            ]
        );
?>

        <div class="medical-services-grid <?php echo esc_attr($widget_class); ?>">
            <?php
            $total_items = count($settings['services']);
            foreach ($settings['services'] as $index => $service) :
                $link_url = !empty($service['link']['url']) ? $service['link']['url'] : '#';
                $link_target = !empty($service['link']['is_external']) ? ' target="_blank"' : '';
                $link_nofollow = !empty($service['link']['nofollow']) ? ' rel="nofollow"' : '';

                // Determine which title tag to use
                $title_tag = 'h3'; // Default
                if (!empty($service['custom_title_tag']) && $service['custom_title_tag'] === 'yes') {
                    $title_tag = $service['title_tag'];
                } elseif (!empty($settings['global_title_tag'])) {
                    $title_tag = $settings['global_title_tag'];
                }
            ?>
                <div class="medical-service-item elementor-repeater-item-<?php echo esc_attr($service['_id']); ?>">
                    <div class="service-content">
                        <div class="service-top-content">
                            <div class="service-icon-wrapper">
                                <?php Icons_Manager::render_icon($service['service_icon'], ['aria-hidden' => 'true', 'class' => ['service-icon', 'elementor-icon']]); ?>
                            </div>
                            <?php
                            printf(
                                '<%1$s class="service-title"><a href="%2$s" %3$s>%4$s</a></%1$s>',
                                esc_attr($title_tag), // Heading tag (e.g., h2)
                                esc_url($link_url), // Link URL
                                esc_attr($link_target) . ' ' . esc_attr($link_nofollow), // Link target and rel attributes
                                esc_html($service['service_title']) // Heading content
                            );
                            ?>
                        </div>
                        <?php if (!empty($service['read_more_text'])) : ?>
                            <a href="<?php echo esc_url($link_url); ?>" 
                               class="service-link" 
                               <?php echo esc_attr($link_target) . ' ' . esc_attr($link_nofollow); ?>>
                                <span class="read-more-text"><?php echo esc_html($service['read_more_text']); ?></span>
                                <span class="arrow"></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

<?php
    }
}

Plugin::instance()->widgets_manager->register(new Custom_Medical_Services_Widget());
