<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

class Elementor_STM_Portfolio extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_portfolio';
	}

	public function get_title() {
		return esc_html__( 'Portfolio', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-briefcase';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	public function get_script_depends() {
		return array( 'imagesloaded', 'isotope', 'packery' );
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
		$portfolio_categories_array = get_terms( 'stm_portfolio_category' );
		$portfolio_categories       = array(
			esc_html__( 'All', 'consulting-elementor-widgets' ) => 'all',
		);
		if ( $portfolio_categories_array && ! is_wp_error( $portfolio_categories_array ) ) {
			foreach ( $portfolio_categories_array as $cat ) {
				$portfolio_categories[ $cat->name ] = $cat->slug;
			}
		}

		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'plugin-name' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'category',
			array(
				'label'   => __( 'Сategory', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array_flip( $portfolio_categories ),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'   => __( 'Posts Per page', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 12,
			)
		);

		$this->add_control(
			'category_filter_enable',
			array(
				'label'        => __( 'Show Category Filter', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'no',
				'condition'    => array(
					'category' => array( 'all' ),
				),
			)
		);

		$this->add_control(
			'masonry_grid',
			array(
				'label'        => __( 'Masonry Grid', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'no',
				'condition'    => array(
					'style' => array( 'style_3' ),
				),
			)
		);

		$this->add_control(
			'load_more_enable',
			array(
				'label'        => __( 'Show Load More Button', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'pagination_enable',
			array(
				'label'        => __( 'Show Pagination', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'placeholder'  => __( 'Before disable Load More Button', 'consulting-elementor-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => __( 'Style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array_flip(
					array(
						esc_html__( 'Style 1', 'consulting-elementor-widgets' ) => 'style_1',
						esc_html__( 'Style 2', 'consulting-elementor-widgets' ) => 'style_2',
						esc_html__( 'Style 3', 'consulting-elementor-widgets' ) => 'style_3',
					)
				),
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_portfolio' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_portfolio';

			consulting_show_template( 'portfolio', $settings );

		}
	}
}
