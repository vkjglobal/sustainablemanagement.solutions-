<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

class Elementor_STM_Partner extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_partner';
	}

	public function get_title() {
		return esc_html__( 'Our Partner', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-handshake';
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
					)
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label' => __( 'Title', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'position',
			array(
				'label'     => __( 'Position', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'rows'      => 10,
				'condition' => array(
					'style' => 'style_2',
				),
			)
		);

		$this->add_control(
			'logo',
			array(
				'label' => __( 'Logo', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			)
		);

		$this->add_control(
			'img_size',
			array(
				'label' => __( 'Image size', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'description',
			array(
				'label' => __( 'Description', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
				'rows'  => 10,
			)
		);

		$this->add_control(
			'link',
			array(
				'label'         => __( 'Link', 'consulting-elementor-widgets' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => true,
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_partner' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {
			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_partner ' . $settings['style'];

			$settings['img_size'] = ( ! empty( $settings['img_size'] ) ) ? $settings['img_size'] : '350x204';

			$settings['partner_thumbnail'] = consulting_get_image( $settings['logo']['id'], $settings['img_size'] );
			if ( ! empty( $settings['partner_thumbnail']['thumbnail'] ) ) {
				$settings['partner_thumbnail'] = $settings['partner_thumbnail']['thumbnail'];
			}

			if ( ! empty( $settings['link']['url'] ) ) {
				$settings['link'] = Consulting_Elementor_Widgets::build_link( $settings );
			}

			consulting_show_template( 'partner', $settings );

		}
	}
}
