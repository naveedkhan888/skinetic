<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Triple_Widget_Container extends Widget_Base
{
    public function get_name()
    {
        return 'triple_widget_container';
    }

    public function get_title()
    {
        return esc_html__('XP Service 1', 'xconnect');
    }

    public function get_icon()
    {
        return 'eicon-inner-section';
    }

    public function get_categories()
    {
        return ['category_xconnect'];
    }

    public function get_keywords()
    {
        return ['container', 'triple', 'widget'];
    }

    protected function register_controls()
    {
        // Content Section
        $this->start_controls_section('widgets_content', [
            'label' => esc_html__('Widgets', 'xconnect'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'xconnect'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
                'prefix_class' => 'elementor-grid%s-',
                'selectors' => [
                    '{{WRAPPER}} .triple-widget-container' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        
        $repeater = new Repeater();

        // Create tabs within repeater
        $repeater->start_controls_tabs('widget_tabs');

        // Content Tab
        $repeater->start_controls_tab('tab_content', [
            'label' => esc_html__('Content', 'xconnect'),
        ]);

        // Add URL Control
        $repeater->add_control(
            'widget_link',
            [
                'label' => esc_html__('Link', 'xconnect'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'xconnect'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // Content Controls
        $repeater->add_control('subtitle', [
            'label' => esc_html__('Subtitle', 'xconnect'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Your Subtitle', 'xconnect'),
            'label_block' => true,
        ]);

        
        $repeater->add_control('icon', [
            'label' => esc_html__('Icon', 'xconnect'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-home',
                'library' => 'fa-solid',
            ],
            
        ]);

        $repeater->add_control('heading', [
            'label' => esc_html__('Heading', 'xconnect'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Your Heading', 'xconnect'),
            'label_block' => true,
        ]);

        $repeater->add_control('heading_tag', [
            'label' => esc_html__('Heading Tag', 'xconnect'),
            'type' => Controls_Manager::SELECT,
            'default' => 'h2',
            'options' => [
                'h1' => 'H1',
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
            ],
        ]);

        $repeater->add_control('divider', [
            'label' => esc_html__('Show Divider', 'xconnect'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $repeater->add_control('paragraph', [
            'label' => esc_html__('Paragraph', 'xconnect'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => esc_html__('Sed ut perspiciatis unde omnis iste natus ut perspic iatis unde omnis', 'xconnect'),
            'rows' => 5,
        ]);

        $repeater->end_controls_tab();

        // Style Tab
        $repeater->start_controls_tab('tab_style', [
            'label' => esc_html__('Style', 'xconnect'),
        ]);

        // Background Style
        $repeater->add_control('background_color', [
            'label' => esc_html__('Background Color', 'xconnect'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
            ],
        ]);

        // Subtitle Style
        $repeater->add_control('subtitle_heading', [
            'label' => esc_html__('Subtitle', 'xconnect'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $repeater->add_control('subtitle_color', [
            'label' => esc_html__('Color', 'xconnect'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} .custom-widget__subtitle' => 'color: {{VALUE}};',
                '{{WRAPPER}} {{CURRENT_ITEM}} .custom-subtitle-link' => 'color: {{VALUE}};',
            ],
        ]);

        $repeater->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'subtitle_typography',
            'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .custom-widget__subtitle',
        ]);

        // Icon Style
        $repeater->add_control('icon_heading', [
            'label' => esc_html__('Icon', 'xconnect'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $repeater->add_control('icon_color', [
            'label' => esc_html__('Color', 'xconnect'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} .elementor-icon i' => 'color: {{VALUE}};',
                '{{WRAPPER}} {{CURRENT_ITEM}} .elementor-icon svg' => 'fill: {{VALUE}};',
            ],
        ]);

        $repeater->add_responsive_control('icon_size', [
            'label' => esc_html__('Size', 'xconnect'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 6,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        // Heading Style
        $repeater->add_control('heading_style_heading', [
            'label' => esc_html__('Heading', 'xconnect'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $repeater->add_control('heading_color', [
            'label' => esc_html__('Color', 'xconnect'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} .custom-heading' => 'color: {{VALUE}};',
                '{{WRAPPER}} {{CURRENT_ITEM}} .custom-heading-link' => 'color: {{VALUE}};',
            ],
        ]);

        $repeater->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'heading_typography',
            'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .custom-heading',
        ]);

        // Divider Style
        $repeater->add_control('divider_style_heading', [
            'label' => esc_html__('Divider', 'xconnect'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'divider' => 'yes',
            ],
        ]);

        $repeater->add_control('divider_color', [
            'label' => esc_html__('Color', 'xconnect'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'divider' => 'yes',
            ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} .custom-divider' => 'border-top-color: {{VALUE}};',
            ],
        ]);

        $repeater->add_control('divider_style', [
            'label' => esc_html__('Style', 'xconnect'),
            'type' => Controls_Manager::SELECT,
            'default' => 'solid',
            'options' => [
                'solid' => esc_html__('Solid', 'xconnect'),
                'dashed' => esc_html__('Dashed', 'xconnect'),
                'dotted' => esc_html__('Dotted', 'xconnect'),
                'double' => esc_html__('Double', 'xconnect'),
            ],
            'condition' => [
                'divider' => 'yes',
            ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} .custom-divider' => 'border-top-style: {{VALUE}};',
            ],
        ]);

        // Paragraph Style
        $repeater->add_control('paragraph_style_heading', [
            'label' => esc_html__('Paragraph', 'xconnect'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $repeater->add_control('paragraph_color', [
            'label' => esc_html__('Color', 'xconnect'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} .custom-paragraph' => 'color: {{VALUE}};',
            ],
        ]);

        $repeater->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'paragraph_typography',
            'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .custom-paragraph',
        ]);

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        // Add the repeater control
        $this->add_control('widgets', [
            'label' => esc_html__('Widgets', 'xconnect'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'subtitle' => esc_html__('Your Subtitle', 'xconnect'),
                    'heading' => esc_html__('Title 1', 'xconnect'),
                    
                ],
                [
                    'subtitle' => esc_html__('Your Subtitle', 'xconnect'),
                    'heading' => esc_html__('Title 2', 'xconnect'),
                    
                ],
                [
                    'subtitle' => esc_html__('Your Subtitle', 'xconnect'),
                    'heading' => esc_html__('Title 3', 'xconnect'),
                    
                ],
            ],
            'title_field' => '{{{ heading }}}',
        ]);

        $this->end_controls_section();

        // Container Style Section
        $this->start_controls_section('section_style_container', [
            'label' => esc_html__('Container Style', 'xconnect'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        // Add display grid to container
        $this->add_responsive_control(
            'container_width',
            [
                'label' => esc_html__('Container Width', 'xconnect'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'vw'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .triple-widget-container' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control('items_gap', [
            'label' => esc_html__('Items Gap', 'xconnect'),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 20,
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .triple-widget-container' => 'grid-gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // Global Widget Style Section
        $this->start_controls_section('section_style_global', [
            'label' => esc_html__('Global Widget Style', 'xconnect'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        // Global Container Style
        $this->add_control('global_container_heading', [
            'label' => esc_html__('Container', 'xconnect'),
            'type' => Controls_Manager::HEADING,
        ]);

        $this->add_group_control(Group_Control_Background::get_type(), [
            'name' => 'global_background',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .custom-widget',
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name' => 'global_border',
            'selector' => '{{WRAPPER}} .custom-widget',
        ]);

        $this->add_responsive_control('global_border_radius', [
            'label' => esc_html__('Border Radius', 'xconnect'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .custom-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            'name' => 'global_box_shadow',
            'selector' => '{{WRAPPER}} .custom-widget',
        ]);

        $this->add_responsive_control('global_padding', [
            'label' => esc_html__('Padding', 'xconnect'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .custom-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        // Global Subtitle Style
        $this->add_control('global_subtitle_heading', [
            'label' => esc_html__('Subtitle', 'xconnect'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'global_subtitle_typography',
            'selector' => '{{WRAPPER}} .custom-widget__subtitle',
        ]);

        $this->add_responsive_control('global_subtitle_spacing', [
            'label' => esc_html__('Spacing', 'xconnect'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .custom-widget__subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);

        // Global Icon Style 
        $this->add_control('global_icon_heading', [
            'label' => esc_html__('Icon', 'xconnect'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $this->add_responsive_control('global_icon_size', [
            'label' => esc_html__('Size', 'xconnect'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 6,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('global_icon_padding', [
            'label' => esc_html__('Padding', 'xconnect'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .custom-widget__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control('global_icon_replace', [
            'label' => esc_html__('Replace All Icons', 'xconnect'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => '',
                'library' => '',
            ],
            'condition' => [
                'widgets!' => [],
            ],
        ]);

        $this->add_control('global_icon_color', [
            'label' => esc_html__('Icon Color', 'xconnect'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-icon i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .elementor-icon svg' => 'fill: {{VALUE}};',
            ],
        ]);

        $this->add_control('global_icon_background_enable', [
            'label' => esc_html__('Icon Background', 'xconnect'),
            'type' => Controls_Manager::SWITCHER,
            'default' => '',
            'prefix_class' => 'icon-background-',
        ]);

        $this->add_control('global_icon_background_color', [
            'label' => esc_html__('Background Color', 'xconnect'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'global_icon_background_enable' => 'yes',
            ],
            'selectors' => [
                '{{WRAPPER}} .custom-widget__icon' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('global_icon_border_radius', [
            'label' => esc_html__('Border Radius', 'xconnect'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'condition' => [
                'global_icon_background_enable' => 'yes',
            ],
            'selectors' => [
                '{{WRAPPER}} .custom-widget__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('global_icon_spacing', [
            'label' => esc_html__('Icon Spacing', 'xconnect'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .custom-widget__icon' => 'margin-left: {{SIZE}}{{UNIT}};',
            ],
        ]);

        // Global Heading Style
        $this->add_control('global_heading_style_heading', [
            'label' => esc_html__('Heading', 'xconnect'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'global_heading_typography',
            'selector' => '{{WRAPPER}} .custom-heading',
        ]);

        $this->add_responsive_control('global_heading_spacing', [
            'label' => esc_html__('Spacing', 'xconnect'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .custom-widget__heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);

        // Global Divider Style
        $this->add_control('global_divider_style_heading', [
            'label' => esc_html__('Divider', 'xconnect'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $this->add_control('global_divider_style', [
            'label' => esc_html__('Style', 'xconnect'),
            'type' => Controls_Manager::SELECT,
            'default' => 'solid',
            'options' => [
                'solid' => esc_html__('Solid', 'xconnect'),
                'dashed' => esc_html__('Dashed', 'xconnect'),
                'dotted' => esc_html__('Dotted', 'xconnect'),
                'double' => esc_html__('Double', 'xconnect'),
            ],
            'selectors' => [
                '{{WRAPPER}} .custom-divider' => 'border-top-style: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('global_divider_width', [
            'label' => esc_html__('Width', 'xconnect'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => 1,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .custom-divider' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('global_divider_thickness', [
            'label' => esc_html__('Thickness', 'xconnect'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 20,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .custom-divider' => 'border-top-width: {{SIZE}}{{UNIT}};',
            ],
        ]);

        // Global Paragraph Style
        $this->add_control('global_paragraph_style_heading', [
            'label' => esc_html__('Paragraph', 'xconnect'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'global_paragraph_typography',
            'selector' => '{{WRAPPER}} .custom-paragraph',
        ]);

        $this->add_responsive_control('global_paragraph_spacing', [
            'label' => esc_html__('Spacing', 'xconnect'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .custom-widget__paragraph' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]);

        // Hover Effects
        $this->add_control('hover_effects_heading', [
            'label' => esc_html__('Hover Effects', 'xconnect'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $this->start_controls_tabs('hover_effects_tabs');

        $this->start_controls_tab('hover_effects_normal', [
            'label' => esc_html__('Normal', 'xconnect'),
        ]);

        $this->add_control('widget_transition', [
            'label' => esc_html__('Transition Duration', 'xconnect'),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 0.3,
            ],
            'range' => [
                'px' => [
                    'min' => 0.1,
                    'max' => 3,
                    'step' => 0.1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .custom-widget' => 'transition: all {{SIZE}}s ease-in-out;',
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab('hover_effects_hover', [
            'label' => esc_html__('Hover', 'xconnect'),
        ]);

        $this->add_control('widget_scale', [
            'label' => esc_html__('Scale', 'xconnect'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 1.5,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .custom-widget:hover' => 'transform: scale({{SIZE}});',
            ],
        ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            'name' => 'widget_hover_shadow',
            'selector' => '{{WRAPPER}} .custom-widget:hover',
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
    ?>
        <div class="triple-widget-container">
            <?php
            foreach ($settings['widgets'] as $index => $item) :
                $widget_class = 'elementor-repeater-item-' . $item['_id'];
                $color_class = 'custom-widget-bg-' . ($index + 1);

                // Build link attributes
                $link_attrs = '';
                if (!empty($item['widget_link']['url'])) {
                    $this->add_link_attributes('widget_link_' . $index, $item['widget_link']);
                    $link_attrs = $this->get_render_attribute_string('widget_link_' . $index);
                }
            ?>
                <div class="custom-widget <?php echo esc_attr($widget_class); ?> <?php echo esc_attr($color_class); ?>">
                    <div class="custom-widget__top">
                        <div class="custom-widget__subtitle-icon-container">
                            <?php if (!empty($item['subtitle'])) : ?>
                                <div class="custom-widget__subtitle">
                                    <span class="custom-subtitle-link">
                                        <?php echo esc_html($item['subtitle']); ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <?php 
                            $icon_to_render = !empty($settings['global_icon_replace']['value']) ? 
                                $settings['global_icon_replace'] : 
                                (!empty($item['icon']['value']) ? $item['icon'] : '');
                            
                            if (!empty($icon_to_render)) : 
                            ?>
                                <div class="custom-widget__icon">
                                    <span class="elementor-icon">
                                        <?php Icons_Manager::render_icon($icon_to_render, ['aria-hidden' => 'true']); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="custom-widget__bottom">
                        <?php if (!empty($item['heading'])) : ?>
                            <div class="custom-widget__heading">
                                <<?php echo esc_attr($item['heading_tag']); ?> class="custom-heading">
                                    <?php if (!empty($item['widget_link']['url'])) : ?>
                                        <a href="<?php echo esc_url($item['link_url']); ?>" 
                                           target="<?php echo esc_attr($item['link_target']); ?>" 
                                           rel="<?php echo esc_attr($item['link_rel']); ?>" 
                                           class="custom-heading-link">
                                            <?php echo esc_html($item['heading']); ?>
                                        </a>
                                    <?php else : ?>
                                        <?php echo esc_html($item['heading']); ?>
                                    <?php endif; ?>
                                </<?php echo esc_attr($item['heading_tag']); ?>>
                            </div>
                        <?php endif; ?>

                        <?php if ('yes' === $item['divider']) : ?>
                            <div class="custom-widget__divider">
                                <div class="custom-divider"></div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($item['paragraph'])) : ?>
                            <div class="custom-widget__paragraph">
                                <p class="custom-paragraph">
                                    <?php echo esc_html($item['paragraph']); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
    <?php
    }
}

// Register the widget
Plugin::instance()->widgets_manager->register(new Triple_Widget_Container());

?>