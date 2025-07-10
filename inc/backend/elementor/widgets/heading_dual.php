<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Heading 
 */
class xConnect_Heading_dual extends Widget_Base{

 	public function get_name() {
		return 'iheading2';
	}

	public function get_title() {
		return __( 'XP Heading Dual', 'xconnect' );
	}

	public function get_icon() {
		return 'eicon-icon-box';
	}

	public function get_categories() {
		return [ 'category_xconnect' ];
	}

	public static function get_subtitle_style() {
		return [
			'' 				=> __( 'Default', 'xconnect' ),
			'is_highlight' 	=> __( 'Highlight', 'xconnect' ),
			'is_line' 		=> __( 'Line', 'xconnect' ),
		];
	}

	protected function register_controls() {
		// Content Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'xconnect' ),
			]
		);

		// Existing Subtitle Control
		$this->add_control(
			'sub',
			[
				'label' => __( 'Subtitle', 'xconnect' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'our services', 'xconnect' ),
				'placeholder' => __( 'Enter your subtitle', 'xconnect' ),
				'label_block' => true,
			]
		);


		// Main Title
		$this->add_control(
			'title',
			[
				'label' => __( 'Main Title', 'xconnect' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'What we do', 'xconnect' ),
				'placeholder' => __( 'Enter your title', 'xconnect' ),
				'label_block' => true,
			]
		);

		// First Parent Title
		$this->add_control(
			'parent_title_1',
			[
				'label' => __( 'First Parent Title', 'xconnect' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'First', 'xconnect' ),
				'placeholder' => __( 'Enter first parent title', 'xconnect' ),
				'label_block' => true,
			]
		);

		// Second Parent Title
		$this->add_control(
			'parent_title_2',
			[
				'label' => __( 'Second Parent Title', 'xconnect' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Second', 'xconnect' ),
				'placeholder' => __( 'Enter second parent title', 'xconnect' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'header_size',
			[
				'label' => __( 'Title HTML Tag', 'xconnect' ),
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
				'default' => 'h2',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'xconnect' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'xconnect' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'xconnect' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'xconnect' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);

		$this->end_controls_section();

		// Style Section
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Heading', 'xconnect' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Subtitle
		$this->add_control(
			'heading_stitle',
			[
				'label' => __( 'Subtitle', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'subtitle_style',
			[
				'label' => __( 'Subtitle Style', 'xconnect' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => self::get_subtitle_style(),
			]
		);
		$this->add_responsive_control(
			'line_width',
			[
				'label' => __( 'Width', 'xconnect' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 45,
				],
				'selectors' => [
					'{{WRAPPER}} .xp-heading > span.is_line:before' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xp-heading > span.is_line' => 'padding-left: calc({{SIZE}}{{UNIT}} + 15px);',
				],
				'condition'	=> [
					'subtitle_style'	=> 'is_line'
				]
			]
		);

		$this->add_control(
			'stitle_color',
			[
				'label' => __( 'Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading > span' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}} .xp-heading > span.is_line:before' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'stitle_bg',
			[
				'label' => __( 'Background color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading > span' => 'background: {{VALUE}};',
				],
				'condition'	=> [
					'subtitle_style'	=> 'is_highlight'
				]
			]
		);
		$this->add_control(
			'stitle_border',
			[
				'label' => __( 'Border Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading > span' => 'border-color: {{VALUE}};',
				],
				'condition'	=> [
					'subtitle_style'	=> 'is_highlight'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'stitle_typography',
				'selector' => '{{WRAPPER}} .xp-heading > span',
			]
		);
		$this->add_responsive_control(
			'stitle_bottom_space',
			[
				'label' => __( 'Spacing', 'xconnect' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-heading > span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// First Parent Title Styling
		$this->add_control(
			'heading_parent_title_1',
			[
				'label' => __( 'First Parent Title', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'parent_title_1_color',
			[
				'label' => __( 'Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading .parent-head-1' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'parent_title_1_typography',
				'selector' => '{{WRAPPER}} .xp-heading .parent-head-1',
			]
		);

		// First Parent Title Styling
        $this->add_control(
            'heading_parent_title_1_colors',
            [
                'label' => __( 'First Parent Title Colors', 'xconnect' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Text Stroke Option for First Parent Title
        $this->add_control(
            'parent_title_1_stroke_enable',
            [
                'label' => __( 'Text Stroke Effect', 'xconnect' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'no' => [
                        'title' => __( 'No', 'xconnect' ),
                        'icon' => 'eicon-close',
                    ],
                    'yes' => [
                        'title' => __( 'Yes', 'xconnect' ),
                        'icon' => 'eicon-check',
                    ],
                ],
                'default' => 'no',
            ]
        );

        $this->add_control(
            'parent_title_1_stroke_color',
            [
                'label' => __( 'Stroke Color', 'xconnect' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .xp-heading .parent-head-1.has-stroke' => '-webkit-text-stroke-color: {{VALUE}};',
                ],
                'condition' => [
                    'parent_title_1_stroke_enable' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'parent_title_1_stroke_width',
            [
                'label' => __( 'Stroke Width', 'xconnect' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .xp-heading .parent-head-1.has-stroke' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'parent_title_1_stroke_enable' => 'yes',
                ],
            ]
        );


		// Second Parent Title Styling
		$this->add_control(
			'heading_parent_title_2_colors',
			[
				'label' => __( 'Second Parent Title Colors', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'parent_title_2_color',
			[
				'label' => __( 'Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading .parent-head-2' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'parent_title_2_typography',
				'selector' => '{{WRAPPER}} .xp-heading .parent-head-2',
			]
		);

		// Second Parent Title Styling
        $this->add_control(
            'heading_parent_title_2',
            [
                'label' => __( 'Second Parent Title', 'xconnect' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Text Stroke Option for Second Parent Title
        $this->add_control(
            'parent_title_2_stroke_enable',
            [
                'label' => __( 'Text Stroke Effect', 'xconnect' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'no' => [
                        'title' => __( 'No', 'xconnect' ),
                        'icon' => 'eicon-close',
                    ],
                    'yes' => [
                        'title' => __( 'Yes', 'xconnect' ),
                        'icon' => 'eicon-check',
                    ],
                ],
                'default' => 'no',
            ]
        );

        $this->add_control(
            'parent_title_2_stroke_color',
            [
                'label' => __( 'Stroke Color', 'xconnect' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .xp-heading .parent-head-2.has-stroke' => '-webkit-text-stroke-color: {{VALUE}};',
                ],
                'condition' => [
                    'parent_title_2_stroke_enable' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'parent_title_2_stroke_width',
            [
                'label' => __( 'Stroke Width', 'xconnect' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .xp-heading .parent-head-2.has-stroke' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'parent_title_2_stroke_enable' => 'yes',
                ],
            ]
        );

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading .main-head' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .xp-heading .main-head',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();
        
        $hl = $settings['subtitle_style'];

        $this->add_render_attribute( 'subtitle', 'class', $hl );
        $this->add_render_attribute( 'heading', 'class', 'main-head' );
        
        // Add stroke class for First Parent Title
        $parent_heading_1_classes = 'parent-head hl-text parent-head-1';
        if ($settings['parent_title_1_stroke_enable'] === 'yes') {
            $parent_heading_1_classes .= ' has-stroke';
        }
        $this->add_render_attribute( 'parent_heading_1', 'class', $parent_heading_1_classes );
        
        // Add stroke class for Second Parent Title
        $parent_heading_2_classes = 'parent-head hl-text parent-head-2';
        if ($settings['parent_title_2_stroke_enable'] === 'yes') {
            $parent_heading_2_classes .= ' has-stroke';
        }
        $this->add_render_attribute( 'parent_heading_2', 'class', $parent_heading_2_classes );

        $title = $settings['title'];
        $parent_title_1 = $settings['parent_title_1'];
        $parent_title_2 = $settings['parent_title_2'];

        $title_html = sprintf( 
            '<%1$s %2$s>%3$s %4$s %5$s</%1$s>', 
            $settings['header_size'], 
            $this->get_render_attribute_string( 'heading' ),
            $title, 
            (!empty($parent_title_1) ? '<span '.$this->get_render_attribute_string( 'parent_heading_1' ).'>' . $parent_title_1 . '</span>' : ''),
            (!empty($parent_title_2) ? '<span '.$this->get_render_attribute_string( 'parent_heading_2' ).'>' . $parent_title_2 . '</span>' : '')
        );
        ?>
        <div class="xp-heading">
            <?php if( ! empty( $settings['sub'] ) ) { echo '<span '.$this->get_render_attribute_string( 'subtitle' ).'>' .$settings['sub']. '</span>'; } ?>
            <?php if( ! empty( $settings['title'] ) ) { echo wp_kses_post( $title_html ); } ?>
        </div>
        <?php
    }
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new xConnect_Heading_dual() );