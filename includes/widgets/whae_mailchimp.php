<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WHAE_Elementor_Widget_Mailchimp extends Widget_Base {

    public function get_name() {
        return 'whae-mailchimp-wp-addons';
    }

    public function get_title() {
        return esc_html__( 'Mailchimp for wp', 'wphobby-addons-for-elementor' );
    }

    public function get_icon() {
        return 'whae-icon eicon-mailchimp';
    }
    public function get_categories() {
        return [ 'wphobby-addons-for-elementor' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'whae_mailchimp',
            [
                'label' => esc_html__( 'Mailchimp', 'wphobby-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'whae_mailchimp_form_style',
            [
                'label' => esc_html__( 'Style', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => esc_html__( 'Style One', 'wphobby-addons-for-elementor' ),
                    '2'   => esc_html__( 'Style Two', 'wphobby-addons-for-elementor' ),
                    '3'   => esc_html__( 'Style Three', 'wphobby-addons-for-elementor' ),
                    '4'   => esc_html__( 'Style Four', 'wphobby-addons-for-elementor' ),
                    '5'   => esc_html__( 'Style Five', 'wphobby-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'whae_mailchimp_id',
            [
                'label'       => esc_html__( 'Mailchimp ID', 'wphobby-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '583', 'wphobby-addons-for-elementor' ),
                'description' => esc_html__( 'For show ID <a href="admin.php?page=mailchimp-for-wp-forms" target="_blank"> Click here </a>', 'wphobby-addons-for-elementor' ),
                'label_block' => true,
                'separator'   => 'before',
            ]
        );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'whae_mailchimp_section_style',
            [
                'label' => esc_html__( 'Style', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'whae_mailchimp_section_padding',
            [
                'label' => esc_html__( 'Padding', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .whae-input-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'whae_mailchimp_section_margin',
            [
                'label' => esc_html__( 'Margin', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .whae-input-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'whae_mailchimp_section_background',
                'label' => esc_html__( 'Background', 'wphobby-addons-for-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .whae-input-box',
            ]
        );

        $this->add_responsive_control(
            'whae_mailchimp_section_align',
            [
                'label' => esc_html__( 'Alignment', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .whae-input-box' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
                'separator' =>'before',
            ]
        );

        $this->end_controls_section();

        // Input Box style tab start
        $this->start_controls_section(
            'whae_mailchimp_input_style',
            [
                'label'     => esc_html__( 'Input Box', 'wphobby-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'whae_input_box_height',
            [
                'label' => esc_html__( 'Height', 'wphobby-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]'  => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'whae_input_box_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .mc4wp-form input[type*="email"]',
            ]
        );

        $this->add_control(
            'whae_input_box_background',
            [
                'label'     => esc_html__( 'Background Color', 'wphobby-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]'         => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]'        => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form select[name*="_mc4wp_lists"]' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'whae_input_box_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'wphobby-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'whae_input_box_placeholder_color',
            [
                'label'     => esc_html__( 'Placeholder Color', 'wphobby-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]::-moz-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]:-ms-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form select[name*="_mc4wp_lists"]'      => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'whae_input_box_border',
                'label' => esc_html__( 'Border', 'wphobby-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .mc4wp-form input[type*="email"]',
            ]
        );

        $this->add_responsive_control(
            'whae_input_box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'whae_input_box_padding',
            [
                'label' => esc_html__( 'Padding', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'whae_input_box_margin',
            [
                'label' => esc_html__( 'Margin', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->end_controls_section(); // Input box style tab end

        // Input submit button style tab start
        $this->start_controls_section(
            'whae_mailchimp_inputsubmit_style',
            [
                'label'     => esc_html__( 'Button', 'wphobby-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('whae_submit_style_tabs');

        // Button Normal tab start
        $this->start_controls_tab(
            'whae_submit_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'wphobby-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'whae_input_submit_height',
            [
                'label' => esc_html__( 'Height', 'wphobby-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'whae_input_submit_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .mc4wp-form input[type*="submit"]',
            ]
        );

        $this->add_control(
            'whae_input_submit_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'wphobby-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]'  => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'whae_input_submit_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'wphobby-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]'  => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'whae_input_submit_padding',
            [
                'label' => esc_html__( 'Padding', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'whae_input_submit_margin',
            [
                'label' => esc_html__( 'Margin', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'whae_input_submit_border',
                'label' => esc_html__( 'Border', 'wphobby-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .mc4wp-form input[type*="submit"]',
            ]
        );

        $this->add_responsive_control(
            'whae_input_submit_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'whae_input_submit_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'wphobby-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .mc4wp-form input[type*="submit"]',
            ]
        );

        $this->end_controls_tab(); // Button Normal tab end

        // Button Hover tab start
        $this->start_controls_tab(
            'whae_submit_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'wphobby-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'whae_input_submithover_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'wphobby-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]:hover'  => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'whae_input_submithover_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'wphobby-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]:hover'  => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'whae_input_submithover_border',
                'label' => esc_html__( 'Border', 'wphobby-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .mc4wp-form input[type*="submit"]:hover',
            ]
        );

        $this->end_controls_tab(); // Button Hover tab end

        $this->end_controls_tabs();

        $this->end_controls_section(); // Input submit button style tab end

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'mailchimp_area_attr', 'class', 'whae-mailchimp' );
        $this->add_render_attribute( 'mailchimp_area_attr', 'class', 'whae-mailchimp-style-'.$settings['whae_mailchimp_form_style'] );

        ?>
        <div <?php echo $this->get_render_attribute_string( 'mailchimp_area_attr' ); ?> >
            <div class="whae-input-box">
                <?php echo do_shortcode( '[mc4wp_form  id="'.$settings['whae_mailchimp_id'].'"]' ); ?>
            </div>
        </div>
        <?php
    }

}

