<?php

use Elementor\Controls_Manager;

class Elementor_STM_Testimonials_Pager extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_testimonials_pager';
	}

	public function get_title() {
		return esc_html__( 'Testimonials Pager', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-review';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	public function get_style_depends() {
		return array( 'consulting-animate.min.css' );
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
		$testimonial_categories_array = get_terms( 'stm_testimonials_category' );
		$testimonial_categories       = array(
			esc_html__( 'All', 'consulting-elementor-widgets' ) => 'all',
		);
		if ( $testimonial_categories_array && ! is_wp_error( $testimonial_categories_array ) ) {
			foreach ( $testimonial_categories_array as $cat ) {
				$testimonial_categories[ $cat->name ] = $cat->slug;
			}
		}

		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'category',
			array(
				'label'   => __( 'Category', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT2,
				'options' => array_flip( $testimonial_categories ),
			)
		);

		$this->add_control(
			'count',
			array(
				'label'   => __( 'Count', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => array(
					'3' => 3,
					'4' => 4,
				),
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.stm_l17_testimonials' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {
			$settings = $this->get_settings_for_display();

			consulting_show_template( 'testimonials_pager', $settings );
		}
	}
}
