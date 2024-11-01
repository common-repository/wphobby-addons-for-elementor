<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WHAE_Elementor_Widget_Banner extends Widget_Base {

    public function get_name() {
        return 'whae-banner-addons';
    }
    
    public function get_title() {
        return __( 'Add Banner', 'wphobby-addons-for-elementor' );
    }

    public function get_icon() {
        return 'whae-icon eicon-image';
    }
    public function get_categories() {
        return [ 'wphobby-addons-for-elementor' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'add_banner_content',
            [
                'label' => esc_html__( 'Banner', 'wphobby-addons-for-elementor' ),
            ]
        );

            $this->add_control(
                'banner_layout',
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
                        '6'   => esc_html__( 'Style Six', 'wphobby-addons-for-elementor' ),
                    ],
                ]
            );

            $this->add_control(
                'banner_content_pos',
                [
                    'label' => esc_html__( 'Content Position', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'center',
                    'options' => [
                        'top'   => esc_html__( 'Top', 'wphobby-addons-for-elementor' ),
                        'center'   => esc_html__( 'Center', 'wphobby-addons-for-elementor' ),
                        'bottom'   => esc_html__( 'Bottom', 'wphobby-addons-for-elementor' ),
                    ],
                ]
            );

            $this->add_control(
                'banner_image',
                [
                    'label' => esc_html__( 'Image', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'banner_image_size',
                    'default' => 'large',
                    'separator' => 'none',
                ]
            );

            $this->add_control(
                'banner_title',
                [
                    'label' => esc_html__( 'Title', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Banner Title', 'wphobby-addons-for-elementor' ),
                ]
            );

            $this->add_control(
                'banner_sub_title',
                [
                    'label' => esc_html__( 'Sub Title', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Banner Sub Title', 'wphobby-addons-for-elementor' ),
                ]
            );

            $this->add_control(
                'banner_description',
                [
                    'label' => esc_html__( 'Description', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'placeholder' => esc_html__( 'Banner Description', 'wphobby-addons-for-elementor' ),
                ]
            );

            $this->add_control(
                'banner_link',
                [
                    'label' => esc_html__( 'Banner Link', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'wphobby-addons-for-elementor' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '#',
                        'is_external' => false,
                        'nofollow' => false,
                    ],
                ]
            );

            $this->add_control(
                'banner_button_txt',
                [
                    'label' => esc_html__( 'Button Text', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Button Text', 'wphobby-addons-for-elementor' ),
                ]
            );
            
        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'add_banner_style_section',
            [
                'label' => esc_html__( 'Style', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'add_banner_section_align',
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
                        '{{WRAPPER}} .whae-banner .banner-content' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'add_banner_section_margin',
                [
                    'label' => esc_html__( 'Margin', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .whae-banner .banner-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'add_banner_section_padding',
                [
                    'label' => esc_html__( 'Padding', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .whae-banner .banner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
        $this->end_controls_section();

        // Style Title tab section
        $this->start_controls_section(
            'banner_title_style_section',
            [
                'label' => esc_html__( 'Title', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'banner_title!'=>'',
                ]
            ]
        );

            $this->add_control(
                'banner_title_color',
                [
                    'label' => esc_html__( 'Color', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '#1f1e26',
                    'selectors' => [
                        '{{WRAPPER}} .whae-banner .banner-content h2' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'banner_title_typography',
                    'label' => esc_html__( 'Typography', 'wphobby-addons-for-elementor' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .whae-banner .banner-content h2',
                ]
            );

            $this->add_responsive_control(
                'banner_title_margin',
                [
                    'label' => esc_html__( 'Margin', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .whae-banner .banner-content h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'banner_title_padding',
                [
                    'label' => esc_html__( 'Padding', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .whae-banner .banner-content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
        $this->end_controls_section();

        // Style Sub Title tab section
        $this->start_controls_section(
            'banner_sub_title_style_section',
            [
                'label' => esc_html__( 'Sub Title', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'banner_sub_title!'=>'',
                ]
            ]
        );

            $this->add_control(
                'banner_sub_title_color',
                [
                    'label' => esc_html__( 'Color', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '#1f1e26',
                    'selectors' => [
                        '{{WRAPPER}} .whae-banner .banner-content h6' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'banner_sub_title_typography',
                    'label' => esc_html__( 'Typography', 'wphobby-addons-for-elementor' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .whae-banner .banner-content h6',
                ]
            );

            $this->add_responsive_control(
                'banner_sub_title_margin',
                [
                    'label' => esc_html__( 'Margin', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .whae-banner .banner-content h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'banner_sub_title_padding',
                [
                    'label' => esc_html__( 'Padding', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .whae-banner .banner-content h6' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
        $this->end_controls_section();

        // Style Description tab section
        $this->start_controls_section(
            'banner_description_style_section',
            [
                'label' => esc_html__( 'Description', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'banner_description!'=>'',
                ]
            ]
        );

            $this->add_control(
                'banner_description_color',
                [
                    'label' => esc_html__( 'Color', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default' => '#1f1e26',
                    'selectors' => [
                        '{{WRAPPER}} .whae-banner .banner-content p' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'banner_description_typography',
                    'label' => esc_html__( 'Typography', 'wphobby-addons-for-elementor' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .whae-banner .banner-content p',
                ]
            );

            $this->add_responsive_control(
                'banner_description_margin',
                [
                    'label' => esc_html__( 'Margin', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .whae-banner .banner-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'banner_description_padding',
                [
                    'label' => esc_html__( 'Padding', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .whae-banner .banner-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
        $this->end_controls_section();

        // Style Button tab section
        $this->start_controls_section(
            'banner_button_style_section',
            [
                'label' => esc_html__( 'Button', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'banner_button_txt!'=>'',
                ]
            ]
        );

            $this->start_controls_tabs('button_style_tabs');

                $this->start_controls_tab(
                    'button_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'wphobby-addons-for-elementor' ),
                    ]
                );
                    $this->add_control(
                        'button_text_color',
                        [
                            'label'     => esc_html__( 'Color', 'wphobby-addons-for-elementor' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   =>'#383838',
                            'selectors' => [
                                '{{WRAPPER}} .whae-banner .banner-content a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'label' => esc_html__( 'Typography', 'wphobby-addons-for-elementor' ),
                            'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                            'selector' => '{{WRAPPER}} .whae-banner .banner-content a',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => esc_html__( 'Border', 'wphobby-addons-for-elementor' ),
                            'selector' => '{{WRAPPER}} .whae-banner .banner-content a',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'wphobby-addons-for-elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .whae-banner .banner-content a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => esc_html__( 'Background', 'wphobby-addons-for-elementor' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .whae-banner .banner-content a',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => esc_html__( 'Padding', 'wphobby-addons-for-elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .whae-banner .banner-content a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_margin',
                        [
                            'label' => esc_html__( 'Margin', 'wphobby-addons-for-elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .whae-banner .banner-content a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Normal tab end

                // Button Hover tab start
                $this->start_controls_tab(
                    'button_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'wphobby-addons-for-elementor' ),
                    ]
                );
                    
                    $this->add_control(
                        'button_hover_text_color',
                        [
                            'label'     => esc_html__( 'Color', 'wphobby-addons-for-elementor' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   =>'#383838',
                            'selectors' => [
                                '{{WRAPPER}} .whae-banner .banner-content a:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => esc_html__( 'Border', 'wphobby-addons-for-elementor' ),
                            'selector' => '{{WRAPPER}} .whae-banner .banner-content a:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'wphobby-addons-for-elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .whae-banner .banner-content a:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_hover_background',
                            'label' => esc_html__( 'Background', 'wphobby-addons-for-elementor' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .whae-banner .banner-content a:hover',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'whae_banner', 'class', 'whae-banner whae-banner-content-pos-'.$settings['banner_content_pos'] );
        $this->add_render_attribute( 'whae_banner', 'class', 'whae-banner-style-'.$settings['banner_layout'] );

        // URL Generate
        if ( ! empty( $settings['banner_link']['url'] ) ) {
            
            $this->add_render_attribute( 'url', 'href', $settings['banner_link']['url'] );
            if ( $settings['banner_link']['is_external'] ) {
                $this->add_render_attribute( 'url', 'target', '_blank' );
            }

            if ( ! empty( $settings['banner_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'url', 'rel', 'nofollow' );
            }
        }
       
        ?>
            <div <?php echo $this->get_render_attribute_string( 'whae_banner' ); ?>>
                <div class="banner-thumb">
                    <a <?php echo $this->get_render_attribute_string( 'url' ); ?>>
                        <?php
                            echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'banner_image_size', 'banner_image' );
                        ?>
                    </a>
                </div>
                <div class="banner-content">
                    <?php
                        if( !empty( $settings['banner_sub_title'] ) ){
                            echo '<h6>'.esc_html__( $settings['banner_sub_title'], 'wphobby-addons-for-elementor' ).'</h6>';
                        }
                        if( !empty( $settings['banner_title'] ) ){
                            echo '<h2>'.esc_html__( $settings['banner_title'], 'wphobby-addons-for-elementor' ).'</h2>';
                        }
                        if( !empty( $settings['banner_description'] ) ){
                            echo '<p>'.esc_html__( $settings['banner_description'], 'wphobby-addons-for-elementor' ).'</p>';
                        }

                        if( !empty( $settings['banner_button_txt'] ) ){
                            echo '<a '.$this->get_render_attribute_string( 'url' ).'>'.esc_html__( $settings['banner_button_txt'],'wphobby-addons-for-elementor' ).'</a>';
                        }
                    ?>
                </div>
            </div>

        <?php

    }

}