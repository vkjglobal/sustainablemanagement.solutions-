<?php

use Elementor\Controls_Manager;

class Elementor_STM_Steps extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_steps';
	}

	public function get_title() {
		return esc_html__( 'Steps', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-steps';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	public function get_script_depends() {
		return array( 'owl.carousel' );
	}

	public function get_style_depends() {
		return array( 'owl.carousel', 'steps' );
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
			'box_style',
			array(
				'label'   => __( 'Steps box style', 'consulting-elementor-widgets' ),
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'stm_step_title',
			array(
				'label'       => __( 'Title', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Step Title', 'consulting-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'stm_step_content',
			array(
				'label'      => __( 'Content', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::WYSIWYG,
				'show_label' => false,
			)
		);

		$this->add_control(
			'steps',
			array(
				'label'       => __( 'Steps', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'stm_step_title'   => __( 'Company Title #1', 'consulting-elementor-widgets' ),
						'stm_step_content' => __( 'Item content. Click the edit button to change this text.', 'consulting-elementor-widgets' ),
					),
				),
				'title_field' => '{{{ stm_step_title }}}',
			)
		);

		$this->add_control(
			'disable_carousel',
			array(
				'label'        => __( 'Disable Carousel Mode', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
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

		$this->add_control(
			'link_label',
			array(
				'label' => __( 'Link label', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_steps' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {
			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_steps';

			if ( ! empty( $settings['link']['url'] ) ) {
				$link = Consulting_Elementor_Widgets::build_link( $settings );

				$settings['text'] = '<a href="' . esc_attr( $link['url'] ) . '" class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-color-theme_style_2"'
					. ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
					. ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
					. '>' . esc_attr( $link['title'] ) . '</a>';
			}

			consulting_load_vc_element( 'steps', $settings, $settings['box_style'] );
		}
	}
}
