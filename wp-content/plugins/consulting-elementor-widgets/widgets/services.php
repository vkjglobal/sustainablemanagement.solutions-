<?php

use Elementor\Controls_Manager;

class Elementor_STM_Services extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_services';
	}

	public function get_title() {
		return esc_html__( 'Services', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-star';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	public function get_script_depends() {
		return array( 'owl.carousel' );
	}

	public function get_style_depends() {
		return array( 'owl.carousel' );
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
		$service_category_array = get_terms( 'stm_service_category' );
		$service_category       = array(
			esc_html__( 'All', 'consulting-elementor-widgets' ) => 'all',
		);
		if ( $service_category_array && ! is_wp_error( $service_category_array ) ) {
			foreach ( $service_category_array as $cat ) {
				$service_category[ $cat->name ] = $cat->slug;
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
			'style',
			array(
				'label'   => __( 'Style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array_flip(
					array(
						esc_html__( 'Style 1', 'consulting-elementor-widgets' )  => 'style_1',
						esc_html__( 'Style 2', 'consulting-elementor-widgets' )  => 'style_2',
						esc_html__( 'Style 3', 'consulting-elementor-widgets' )  => 'style_3',
						esc_html__( 'Style 4', 'consulting-elementor-widgets' )  => 'style_4',
						esc_html__( 'Style 5', 'consulting-elementor-widgets' )  => 'style_5',
						esc_html__( 'Style 6', 'consulting-elementor-widgets' )  => 'style_6',
						esc_html__( 'Style 7', 'consulting-elementor-widgets' )  => 'style_7',
						esc_html__( 'Style 8', 'consulting-elementor-widgets' )  => 'style_8',
						esc_html__( 'Style 9', 'consulting-elementor-widgets' )  => 'style_9',
						esc_html__( 'Style 10', 'consulting-elementor-widgets' ) => 'style_10',
						esc_html__( 'Style 11', 'consulting-elementor-widgets' ) => 'style_11',
					)
				),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'   => __( 'Number Posts', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 12,
			)
		);

		$this->add_control(
			'posts_per_row',
			array(
				'label'     => __( 'Posts Per Row', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 4,
				'options'   => array(
					4 => 4,
					3 => 3,
					2 => 2,
					1 => 1,
				),
				'condition' => array(
					'style' => array(
						'style_1',
						'style_2',
						'style_3',
						'style_4',
						'style_6',
						'style_9',
						'style_10',
					),
				),
			)
		);

		$this->add_control(
			'category',
			array(
				'label'   => __( 'Category', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array_flip( $service_category ),
			)
		);

		$this->add_control(
			'img_size',
			array(
				'label'       => __( 'Image size', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'service_image',
			array(
				'label'        => __( 'Hide image', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => array(
					'style' => array(
						'style_1',
						'style_2',
						'style_3',
						'style_4',
						'style_6',
					),
				),
			)
		);

		$this->add_control(
			'service_cat',
			array(
				'label'        => __( 'Hide category', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'style' => array(
						'style_1',
						'style_2',
						'style_6',
					),
				),
			)
		);

		$this->add_control(
			'service_title',
			array(
				'label'        => __( 'Hide Title', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'service_excerpt',
			array(
				'label'        => __( 'Hide Excerpt', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => array(
					'style' => array(
						'style_1',
						'style_6',
						'style_8',
					),
				),
			)
		);

		$this->add_control(
			'service_more',
			array(
				'label'        => __( 'Hide More Button', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => array(
					'style' => array(
						'style_1',
						'style_6',
						'style_8',
					),
				),
			)
		);

		$this->add_control(
			'service_pagination',
			array(
				'label'        => __( 'Hide Pagination', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'style' => array(
						'style_8',
					),
				),
			)
		);

		/*Colors*/
		$this->add_control(
			'title_color',
			array(
				'label' => __( 'Title Color', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			)
		);

		$this->add_control(
			'excerpt_color',
			array(
				'label' => __( 'Excerpt Color', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			)
		);

		$this->add_control(
			'link_color',
			array(
				'label' => __( 'More button Color', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			)
		);

		$this->add_control(
			'category_color',
			array(
				'label' => __( 'Category Color', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_services' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_services';

			consulting_load_vc_element( 'services', $settings, $settings['style'] );

		}
	}
}
