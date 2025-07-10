<?php 
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Widget Name: Post Grid
 */
class xConnect_Post_Grid extends Widget_Base {

 	public function get_name() {
		return 'ipostgrid';
	}

	public function get_title() {
		return __( 'XP Post Grid', 'xconnect' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'category_xconnect' ];
	}

	protected function register_controls() {
		//Content
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Posts', 'xconnect' ),
			]
		);
		$this->add_control(
			'post_cat',
			[
				'label' => __( 'Select Categories', 'xconnect' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->select_param_cate_post(),
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __( 'All Categories', 'xconnect' ),
			]
		);
		$this->add_control(
			'post_num',
			[
				'label' => __( 'Show Number Posts', 'xconnect' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '6',
			]
		);	
		$this->add_control(
			'exc',
			[
				'label' => esc_html__( 'Excerpt Length', 'xconnect' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '0',
			]
		);
		$this->add_control(
			'post_thumbnail',
			[
				'label' => __( 'Thumbnail Image Size', 'xconnect' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'xconnect-post-thumbnail-grid',
				'options' => [
					'xconnect-post-thumbnail-grid' => __( 'Default', 'xconnect' ),
					'full' => __( 'Full', 'xconnect' ),
				],
			]
		);

		// Grid Settings
		$this->add_control(
			'heading_grid',
			[
				'label' => __( 'Grid', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' => __( 'Columns', 'xconnect' ),
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
				'prefix_class' => 'elementor-grid-',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'grid_gap',
			[
				'label' => __( 'Grid Gap', 'xconnect' ),
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
					'{{WRAPPER}} .post-grid' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Section
		$this->start_controls_section(
			'posts_style',
			[
				'label' => __( 'Post Items', 'xconnect' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_general',
			[
				'label' => __( 'General', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'radius_box',
			[
				'label' => __( 'Border Radius', 'xconnect' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .post-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'item_bg',
			[
				'label' => __( 'Background', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-inner' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .post-inner',
			]
		);

		/* title */
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
					'{{WRAPPER}} .post-box h5 a' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'title_hcolor',
			[
				'label' => __( 'Hover Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box h5 a:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .post-box h5 a',
			]
		);

		/* excerpt */
		$this->add_control(
			'heading_excerpt',
			[
				'label' => __( 'Excerpt', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => __( 'Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .the-excerpt' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'selector' => '{{WRAPPER}} .post-box .the-excerpt',
			]
		);

		/* category */
		$this->add_control(
			'heading_cat',
			[
				'label' => __( 'Category', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_cat',
			[
				'label' => __( 'Show Category', 'xconnect' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'xconnect' ),
				'label_off' => __( 'Hide', 'xconnect' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'cat_color',
			[
				'label' => __( 'Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .post-cat a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_cat' => 'yes',
				]
			]
		);

		$this->add_control(
			'cat_bg',
			[
				'label' => __( 'Background', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .post-cat a' => 'background: {{VALUE}};',
				],
				'condition' => [
					'show_cat' => 'yes',
				]
			]
		);

		/* meta */
		$this->add_control(
			'heading_meta',
			[
				'label' => __( 'Meta', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => __( 'Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .entry-meta, {{WRAPPER}} .post-box .entry-meta a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_hover_color',
			[
				'label' => __( 'Hover Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .entry-meta a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .post-box .btn-details:hover' => 'border-color: {{VALUE}}; background: transparent;',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="post-grid elementor-grid">
			<?php
			$number_show = (!empty($settings['post_num']) ? $settings['post_num'] : 9);

			if( $settings['post_cat'] ){
				$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => $number_show,
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field'    => 'slug',
							'terms'    => $settings['post_cat']
						),
					),
				);
			}else{
				$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => $number_show,
				);
			}

			$blogpost = new \WP_Query($args);
			if($blogpost->have_posts()) : while($blogpost->have_posts()) : $blogpost->the_post(); ?> 
			
				<article id="post-<?php the_ID(); ?>" <?php post_class('post-box elementor-grid-item'); ?>>
					<div class="post-inner">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="entry-media">
								<?php if( $settings['show_cat'] ) { xconnect_posted_in(); } ?>
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail($settings['post_thumbnail']); ?>
								</a>
							</div>
						<?php } ?>

						<div class="inner-post">
							<?php if( !has_post_thumbnail() && $settings['show_cat'] ) xconnect_posted_in(); ?>
							<div class="entry-header">
								<?php the_title( '<h5 class="entry-title"><a class="title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
							</div>

							<?php if( $settings['exc'] ) { echo '<div class="entry-summary the-excerpt">' .xconnect_excerpt($settings['exc']). '...</div>'; } ?>
						</div>
						<div class="entry-meta">
							<?php if( xconnect_get_option( 'post_entry_meta' ) ) { xconnect_post_meta(); } ?>
							<a href="<?php the_permalink(); ?>" class="btn-details"><i class="xp-webicon-trajectory"></i></a>
						</div>
					</div>
				</article>

			<?php endwhile; wp_reset_postdata(); endif; ?>
		</div>
		<?php
	}

	protected function select_param_cate_post() {
		$args = array( 'orderby=name&order=ASC&hide_empty=0' );
		$terms = get_terms( 'category', $args );
		$cat = array();
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){		    
			foreach ( $terms as $term ) {
				$cat[$term->slug] = $term->name;
			}
		}
		return $cat;
	}
}
// Register the widget
Plugin::instance()->widgets_manager->register( new xConnect_Post_Grid() );