<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Elementor_Header_Search extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_header_search';
	}

	public function get_title() {
		return esc_html__( 'Consulting Search', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-search consulting_icon_hb';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_search_button',
			array(
				'label' => __( 'Button', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'search_button_size',
			array(
				'label'      => __( 'Size', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max' => 100,
					),
				),
				'default'    => array(
					'size' => 14,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .consulting-search button' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'search_button_color',
			array(
				'label'     => __( 'Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-search button' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'search_button_color_action',
			array(
				'label'     => __( 'Color on active', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-search.active button' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_field',
			array(
				'label' => __( 'Field', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'search_field_size',
			array(
				'label'      => __( 'Size', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max' => 100,
					),
				),
				'default'    => array(
					'size' => 14,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .consulting-search input' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'search_field_color',
			array(
				'label'     => __( 'Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-search input' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'search_field_bg_color',
			array(
				'label'     => __( 'Background', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-search input' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'search_field_border',
			array(
				'label'      => __( 'Border width', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max' => 30,
					),
				),
				'default'    => array(
					'size' => 2,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .consulting-search input' => 'border-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'search_field_border_radius',
			array(
				'label'      => __( 'Border radius', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max' => 200,
					),
				),
				'default'    => array(
					'size' => 4,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .consulting-search input' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'search_field_border_color',
			array(
				'label'     => __( 'Border', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-search input' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		?>

		<div class="consulting-search">
			<?php get_search_form( true ); ?>
		</div>

		<?php

	}
}
