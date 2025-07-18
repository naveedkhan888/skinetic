<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skinetic_Logo extends Widget_Base {

	public function get_name() {
		return 'ilogo';
	}

	public function get_title() {
		return __( 'XP Logo', 'skinetic' );
	}

	public function get_icon() {
		return 'eicon-logo';
	}

	public function get_categories() {
		return [ 'category_skinetic_header' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Logo', 'skinetic' ),
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
					],
				],
				'selectors' => [
					'{{WRAPPER}} .the-logo' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'logo_image',
			[
				'label' => esc_html__( 'Image', 'skinetic' ),
				'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'description' => esc_html__( 'Upload a custom logo. If empty, site logo from Customizer will be used.', 'skinetic' ),
			]
		);

		$this->add_responsive_control(
			'logo_width',
			[
				'label' => __( 'Width', 'skinetic' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .the-logo img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'logo_height',
			[
				'label' => __( 'Height', 'skinetic' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .the-logo img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$logo_url = '';

		// Check if widget logo image is set
		if ( ! empty( $settings['logo_image']['url'] ) ) {
			$logo_url = esc_url( $settings['logo_image']['url'] );
		} 
		// Else fallback to Customizer site logo
		elseif ( has_custom_logo() ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
		}

		// Fallback alt text
		$site_name = get_bloginfo( 'name', 'display' );
		$site_url  = esc_url( home_url( '/' ) );
		?>
		<div class="the-logo">
			<a href="<?php echo $site_url; ?>">
				<?php if ( $logo_url ) : ?>
					<img src="<?php echo $logo_url; ?>" alt="<?php echo esc_attr( $site_name ); ?>">
				<?php else : ?>
					<span class="site-title"><?php echo esc_html( $site_name ); ?></span>
				<?php endif; ?>
			</a>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Skinetic_Logo() );
