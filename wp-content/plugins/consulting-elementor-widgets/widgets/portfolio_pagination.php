<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

class Elementor_STM_Portfolio_Pagination extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_portfolio_pagination';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Post Pagination', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-arrows';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
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
		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'plugin-name' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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

		$this->add_control(
			'show_button',
			array(
				'label'        => __( 'Show Button', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'description'  => esc_html__( 'Button for link to the archive page.', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'     => __( 'Button link', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::URL,
				'condition' => array(
					'show_button' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_portfolio_pagination' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_portfolio_pagination';

			if ( ! empty( $settings['link']['url'] ) ) {
				$settings['link'] = Consulting_Elementor_Widgets::build_link( $settings );
			}

			consulting_show_template( 'portfolio_pagination', $settings );

		}
	}
}
