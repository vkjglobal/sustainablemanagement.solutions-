<?php

use Elementor\Controls_Manager;

class Elementor_STM_News extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_news';
	}

	public function get_title() {
		return esc_html__( 'Posts', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-posts';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	public function get_script_depends() {
		return array( 'isotope', 'packery', 'imagesloaded' );
	}

	public function add_dimensions( $selector = '' ) {
		$this->start_controls_section(
			'section_dimensions',
			array(
				'label' => __( 'Dimensions', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_responsive_control(
			'margin',
			array(
				'label'      => __( 'Margin', 'consulting-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					"{{WRAPPER}} {$selector}" => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'padding',
			array(
				'label'      => __( 'Padding', 'consulting-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					"{{WRAPPER}} {$selector}" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_controls() {
		$consulting_layout = get_option( 'consulting_layout', 'layout_1' );
		Consulting_Elementor_Widgets::add_query_builder( $this, 'qb' );

		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Additional params', 'plugin-name' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'view_style',
			array(
				'label'   => __( 'Style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array_flip(
					array(
						esc_html__( 'Style 1', 'consulting-elementor-widgets' ) => 'style_1',
						esc_html__( 'Style 2', 'consulting-elementor-widgets' ) => 'style_2',
						esc_html__( 'Style 3', 'consulting-elementor-widgets' ) => 'style_3',
						esc_html__( 'Style 4', 'consulting-elementor-widgets' ) => 'style_4',
						esc_html__( 'Style 5', 'consulting-elementor-widgets' ) => 'style_5',
						esc_html__( 'Style 6', 'consulting-elementor-widgets' ) => 'style_6',
						esc_html__( 'Style 7', 'consulting-elementor-widgets' ) => 'style_7',
						esc_html__( 'Style 8', 'consulting-elementor-widgets' ) => 'style_8',
					)
				),
			)
		);

		$this->add_control(
			'posts_per_row',
			array(
				'label'     => __( 'Posts per row', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 4,
				'options'   => array(
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
				),
				'condition' => array(
					'view_style' => array( 'style_1', 'style_2', 'style_7' ),
				),
			)
		);

		$this->add_control(
			'disable_preview_image',
			array(
				'label'        => __( 'Disable Preview Image', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'disable',
			)
		);

		$this->add_control(
			'img_size',
			array(
				'label'       => __( 'Image size', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'consulting-elementor-widgets' ),
			)
		);

		if ( 'layout_16' === $consulting_layout || 'layout_17' === $consulting_layout ) {
			$this->add_control(
				'style',
				array(
					'label'   => __( 'Style', 'consulting-elementor-widgets' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'default' => 4,
					'options' => array(
						1 => 1,
						2 => 2,
					),
				)
			);
		}

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_posts' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {
			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_posts';

			$settings['query'] = Consulting_Elementor_Widgets::get_query_builder( $settings, 'qb' );

			consulting_load_vc_element( 'news', $settings, $settings['view_style'] );
		}
	}
}
