<?php

use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Elementor_STM_Anchors_Link extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_anchors_link';
	}

	public function get_title() {
		return esc_html__( 'Anchors Link', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-link';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'anchor_link_text',
			array(
				'label' => __( 'Text link', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'anchor_link',
			array(
				'label'       => __( 'URL (Link)', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'default'     => array(
					'is_external' => 'true',
				),
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://your-link.com', 'consulting-elementor-widgets' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Link Styles', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'link_color',
			array(
				'label'     => __( 'Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-anchor_link_wrapper .consulting-anchor_link' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'link_color_action',
			array(
				'label'     => __( 'Color on hover', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-anchor_link_wrapper .consulting-anchor_link:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .consulting-anchor_link_wrapper .consulting-anchor_link:active' => 'color: {{VALUE}}',
					'{{WRAPPER}} .consulting-anchor_link_wrapper .consulting-anchor_link:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'anchor_link',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .consulting-anchor_link_wrapper .consulting-anchor_link',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'consulting-anchor_link_wrapper' );

		if ( ! empty( $settings['anchor_link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['anchor_link'] );
			$this->add_render_attribute( 'button', 'class', 'consulting-anchor_link' );
		} ?>

			<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
				<a <?php $this->print_render_attribute_string( 'button' ); ?>><?php echo esc_attr( $settings['anchor_link_text'] ); ?> <i class="stm-right-arrow"></i></a>
			</div>

		<?php
	}
}
