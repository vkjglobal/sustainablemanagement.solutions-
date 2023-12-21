<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

class Elementor_STM_Contact extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_contact';
	}

	public function get_title() {
		return esc_html__( 'Contact Info', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-contact-info';
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
			'section_content',
			array(
				'label' => __( 'Content', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => __( 'Widget Style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'style_1' => __( 'Style 1', 'consulting-elementor-widgets' ),
					'style_2' => __( 'Style 2', 'consulting-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'name',
			array(
				'label'       => __( 'Name', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type contact name here', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Choose Image', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'image_size',
			array(
				'label'       => __( 'Image size', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "default" size.', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'job',
			array(
				'label'       => __( 'Job', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type contact job here', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'phone',
			array(
				'label'       => __( 'Phone', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type contact phone here', 'consulting-elementor-widgets' ),
				'condition'   => array(
					'style' => 'style_2',
				),
			)
		);

		$this->add_control(
			'phone_two',
			array(
				'label'       => __( 'Phone 2', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type contact second phone here', 'consulting-elementor-widgets' ),
				'condition'   => array(
					'style' => 'style_2',
				),
			)
		);

		$this->add_control(
			'email',
			array(
				'label'       => __( 'Email', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type contact email here', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'skype',
			array(
				'label'       => __( 'Skype', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type contact skype here', 'consulting-elementor-widgets' ),
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_contact_' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_contact_';

			$image = consulting_get_image( $settings['image']['id'], $settings['image_size'] );

			if ( ! empty( $image['thumbnail'] ) ) {
				$image = $image['thumbnail'];
			}

			$settings['image']['thumbnail'] = $image;

			consulting_show_template( 'contact', $settings );

		}
	}
}
