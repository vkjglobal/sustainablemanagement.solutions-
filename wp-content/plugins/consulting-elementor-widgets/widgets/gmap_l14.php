<?php

use Elementor\Controls_Manager;

class Elementor_STM_Gmap_L14 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_gmap_l14';
	}

	public function get_title() {
		return esc_html__( 'Gmap style 2', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-google-maps';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	public function get_script_depends() {
		return array( 'gmap' );
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
			'map_height',
			array(
				'label'   => __( 'Map height', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '100vh',
			)
		);

		$this->add_control(
			'map_title',
			array(
				'label' => __( 'Map title', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'map_zoom',
			array(
				'label'   => __( 'Map zoom', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 18,
			)
		);

		$this->add_control(
			'marker',
			array(
				'label'   => __( 'Map marker', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'disable_mouse_whell',
			array(
				'label'   => __( 'Map zoom on wheel', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'disable',
				'options' => array(
					'disable' => __( 'Disable map zoom on mouse wheel scroll', 'consulting-elementor-widgets' ),
					'enable'  => __( 'Enable map zoom on mouse wheel scroll', 'consulting-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'el_class',
			array(
				'label' => __( 'Extra class name', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		/*Addresses*/
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Title', 'consulting-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'country',
			array(
				'label'   => __( 'Country', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'rows'    => 5,
				'default' => __( 'Address', 'consulting-elementor-widgets' ),
			)
		);

		$repeater->add_control(
			'lat',
			array(
				'label' => __( 'Latitude', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'lng',
			array(
				'label'       => __( 'Longitude', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => wp_kses(
					__( '<a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Here is a tool</a> where you can find Latitude & Longitude of your location', 'consulting-elementor-widgets' ),
					array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					)
				),
			)
		);

		$this->add_control(
			'addresses',
			array(
				'label'       => __( 'Repeater List', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'title' => __( 'Title #1', 'consulting-elementor-widgets' ),
					),
					array(
						'title' => __( 'Title #2', 'consulting-elementor-widgets' ),
					),
				),
				'title_field' => '{{{ title }}}',
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.stm_gmap_wrapper_l14' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {
			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' stm_gmap_wrapper stm_gmap_wrapper_l14';

			$settings['marker'] = ( ! empty( $settings['marker']['id'] ) ) ? $settings['marker']['id'] : '';

			if ( ! empty( $_GET['action'] ) && ( 'elementor' === $_GET['action'] || 'elementor_ajax' === $_GET['action'] ) ) {
				echo "<div class='consulting-elementor-notice'>" . esc_html__( 'Check module in preview mode.', 'consulting-elementor-widgets' ) . '</div>';
			} else {
				consulting_show_template( 'gmap_l14', $settings );
			}
		}
	}

	protected function content_template() {
		echo "<div class='consulting-elementor-notice'>" . esc_html__( 'Check module in preview mode.', 'consulting-elementor-widgets' ) . '</div>';
	}
}
