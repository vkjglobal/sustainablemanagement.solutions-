<?php

use Elementor\Controls_Manager;

class Elementor_STM_Events extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_events';
	}

	public function get_title() {
		return esc_html__( 'Events', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-calendar';
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

		$event_categories_array = get_terms( 'stm_event_category' );
		$event_categories       = array(
			'all' => esc_html__( 'All', 'consulting-elementor-widgets' ),
		);
		if ( $event_categories_array && ! is_wp_error( $event_categories_array ) ) {
			foreach ( $event_categories_array as $cat ) {
				$event_categories[ $cat->slug ] = $cat->name;
			}
		}

		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'events_filter',
			array(
				'label'   => __( 'Filter Events', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'upcoming',
				'options' => array(
					'upcoming' => esc_html__( 'Upcoming Events', 'consulting-elementor-widgets' ),
					'past'     => esc_html__( 'Past Events', 'consulting-elementor-widgets' ),
					'all'      => esc_html__( 'All Events', 'consulting-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'category',
			array(
				'label'   => __( 'Category', 'consulting-elementor-widgets' ),
				'default' => 'all',
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $event_categories,
			)
		);

		$this->add_control(
			'event_style',
			array(
				'label'   => __( 'Event Style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => array(
					'grid'    => esc_html__( 'Grid', 'consulting-elementor-widgets' ),
					'classic' => esc_html__( 'Classic', 'consulting-elementor-widgets' ),
					'modern'  => esc_html__( 'Modern', 'consulting-elementor-widgets' ),
					'widget'  => esc_html__( 'Widget', 'consulting-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label' => __( 'Number Posts', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'posts_per_row',
			array(
				'label'     => __( 'Posts per row', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'condition' => array(
					'event_style' => 'grid',
				),
				'options'   => array(
					4 => 4,
					3 => 3,
					2 => 2,
					1 => 1,
				),
			)
		);

		$this->add_control(
			'img_size',
			array(
				'label'     => __( 'Image size', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => array(
					'event_style' => array( 'grid', 'classic' ),
				),
			)
		);

		$this->add_control(
			'pagination_enable',
			array(
				'label'        => __( 'Show Pagination', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'your-plugin' ),
				'label_off'    => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'event_style' => array( 'grid', 'classic' ),
				),
			)
		);

		$this->add_control(
			'load_more_enable',
			array(
				'label'        => __( 'Show Load More Button', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'your-plugin' ),
				'label_off'    => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'event_style' => 'modern',
				),
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.stm_events_grid' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_events';

			consulting_show_template( 'events', $settings );

		}
	}
}
