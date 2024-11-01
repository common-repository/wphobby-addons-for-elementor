<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WHAE_Flip_Box extends Widget_Base {

    public function get_name() {
        return 'whae-flip-box';
    }

    public function get_title() {
        return esc_html__( 'Flip Box', 'wphobby-addons-for-elementor' );
    }

    public function get_icon() {
        return 'whae-icon eicon-thumbnails-down';
    }

    public function get_categories() {
        return [ 'wphobby-addons-for-elementor' ];
    }

    public function get_keywords() {
        return [ 'flip', 'box', 'flip', 'info', 'content', 'animation' ];
    }

    protected function _register_controls() {
        // Content.
        $this->start_controls_section(
            '_section_front',
            [
                'label' => __( 'Front Side', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'front_icon_type',
            [
                'label' => __( 'Media Type', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'icon',
                'options' => [
                    'none' => [
                        'title' => __( 'None', 'wphobby-addons-for-elementor' ),
                        'icon' => 'eicon-close',
                    ],
                    'icon' => [
                        'title' => __( 'Icon', 'wphobby-addons-for-elementor' ),
                        'icon' => 'eicon-star',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'wphobby-addons-for-elementor' ),
                        'icon' => 'eicon-image',
                    ],
                ],
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
                'front_selected_icon',
                [
                    'label' => __( 'Icon', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'front_icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'hm hm-home',
                        'library' => 'happy-icons',
                    ],
                    'condition' => [
                        'front_icon_type' => 'icon'
                    ],
                ]
            );

        $this->add_control(
            'front_icon_image',
            [
                'label' => __( 'Image', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'front_icon_type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'front_icon_thumbnail',
                'default' => 'thumbnail',
                'exclude' => [
                    'full',
                    'shop_catalog',
                    'shop_single',
                ],
                'condition' => [
                    'front_icon_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'front_title',
            [
                'label' => __( 'Title', 'wphobby-addons-for-elementor' ),
                'label_block' => true,
                'separator' => 'before',
                'type' => Controls_Manager::TEXT,
                'default' => 'Start Marketing',
                'placeholder' => __( 'Type Flip Box Title', 'wphobby-addons-for-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'front_description',
            [
                'label' => __( 'Description', 'wphobby-addons-for-elementor' ),
                'description' => whae_get_allowed_html_desc( 'basic' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'consectetur adipiscing elit, sed do<br>eiusmod Lorem ipsum dolor sit amet,<br> consectetur.',
                'placeholder' => __( 'Description', 'wphobby-addons-for-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'front_text_align',
            [
                'label' => __( 'Alignment', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front-inner .icon-wrap' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .ha-flip-box-front-inner .ha-text' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_back',
            [
                'label' => __( 'Back Side', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'back_icon_type',
            [
                'label' => __( 'Media Type', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'none',
                'options' => [
                    'none' => [
                        'title' => __( 'None', 'wphobby-addons-for-elementor' ),
                        'icon' => 'eicon-close',
                    ],
                    'icon' => [
                        'title' => __( 'Icon', 'wphobby-addons-for-elementor' ),
                        'icon' => 'eicon-star',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'wphobby-addons-for-elementor' ),
                        'icon' => 'eicon-image',
                    ],
                ],
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'back_icon_image',
            [
                'label' => __( 'Image', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'back_icon_type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'back_icon_thumbnail',
                'default' => 'thumbnail',
                'exclude' => [
                    'full',
                    'shop_catalog',
                    'shop_single',
                ],
                'condition' => [
                    'back_icon_type' => 'image'
                ]
            ]
        );

        $this->add_control(
                'back_selected_icon',
                [
                    'label' => __( 'Icon', 'wphobby-addons-for-elementor' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'back_icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-smile-wink',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'back_icon_type' => 'icon'
                    ],
                ]
            );

        $this->add_control(
            'back_title',
            [
                'label' => __( 'Title', 'wphobby-addons-for-elementor' ),
                'label_block' => true,
                'separator' => 'before',
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Start Marketing', 'wphobby-addons-for-elementor' ),
                'placeholder' => __( 'Type Flip Box Title', 'wphobby-addons-for-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'back_description',
            [
                'label' => __( 'Description', 'wphobby-addons-for-elementor' ),
                'description' => whae_get_allowed_html_desc( 'intermediate' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'consectetur adipiscing elit, sed do<br>eiusmod Lorem ipsum dolor sit amet.',
                'placeholder' => __( 'Description', 'wphobby-addons-for-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'back_text_align',
            [
                'label' => __( 'Alignment', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back-inner .icon-wrap' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .ha-flip-box-back-inner .ha-text' => 'text-align: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'flip_position',
            [
                'label' => __( 'Flip Direction', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left-right',
                'label_block' => false,
                'options' => [
                    'bottom-top' => [
                        'title' => __( 'Bottom To Top', 'wphobby-addons-for-elementor' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'left-right' => [
                        'title' => __( 'Left To Right', 'wphobby-addons-for-elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // Styles.
        $this->start_controls_section(
            '_section_common_style',
            [
                'label' => __( 'Common', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => __( 'Height', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ha-flip-box-back' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_area_border_radius',
            [
                'label' => __( 'Border Radius', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ha-flip-box-front:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ha-flip-box-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ha-flip-box-back:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // front side
        $this->start_controls_section(
            '_section_front_style',
            [
                'label' => __( 'Front Side', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'front_content_padding',
            [
                'label' => __( 'Padding', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'front_border',
                'selector' => '{{WRAPPER}} .ha-flip-box-front',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_box_shadow',
                'selector' => '{{WRAPPER}} .ha-flip-box-front',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'front_background_image',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ha-flip-box-front',
            ]
        );

        $this->add_control(
            'front_background_overlay',
            [
                'label' => __( 'Background Overlay', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'front_background_image_background' => 'classic'
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'front_icon_heading',
            [
                'label' => __( 'Media Type - Icon', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'front_icon_heading_image',
            [
                'label' => __( 'Media Type - Image', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'front_icon_type' => 'image'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'front_icon_spacing',
            [
                'label' => __( 'Bottom Spacing', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front .ha-flip-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'front_icon_image_size',
            [
                'label' => __( 'Resize Image', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'front_icon_type' => 'image'
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front-inner .icon-wrap .ha-flip-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'front_icon_image_fit',
            [
                'label' => __( 'Image Fit', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'contain'  => __( 'Contain', 'wphobby-addons-for-elementor' ),
                    'cover' => __( 'Cover', 'wphobby-addons-for-elementor' ),
                ],
                'condition' => [
                    'front_icon_type' => 'image'
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front-inner .icon-wrap .ha-flip-icon img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'front_icon_font_size',
            [
                'label' => __( 'Icon Size', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front-inner .ha-flip-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'front_icon_background_size',
            [
                'label' => __( 'Padding', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front-inner .icon-wrap .ha-flip-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'front_icon_border',
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
                'selector' => '{{WRAPPER}} .ha-flip-box-front-inner .icon-wrap .ha-flip-icon',
            ]
        );

        $this->add_control(
            'front_icon_border_radius',
            [
                'label' => __( 'Border Radius', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front-inner .icon-wrap .ha-flip-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ha-flip-box-front-inner .ha-flip-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_icon_box_shadow',
                'selector' => '{{WRAPPER}} .ha-flip-box-front-inner .ha-flip-icon',
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
            ]
        );

        $this->add_control(
            'front_icon_color',
            [
                'label' => __( 'Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front-inner .icon-wrap .ha-flip-icon i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'front_icon_background_color',
            [
                'label' => __( 'Background Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front-inner .icon-wrap .ha-flip-icon' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'front_text',
            [
                'label' => __( 'Title & Description', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( '_tabs_front_text' );
        $this->start_controls_tab(
            '_tab_front_title',
            [
                'label' => __( 'Title', 'wphobby-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'front_title_color',
            [
                'label' => __( 'Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front-inner .ha-flip-box-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'front_title_typography',
                'label' => __( 'Typography', 'wphobby-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ha-flip-box-front-inner .ha-flip-box-heading',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'front_title_text_shadow',
                'label' => __( 'Text Shadow', 'wphobby-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ha-flip-box-front-inner .ha-flip-box-heading',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_front_description',
            [
                'label' => __( 'Description', 'wphobby-addons-for-elementor' ),
            ]
        );

        $this->add_responsive_control(
            'front_description_space',
            [
                'label' => __( 'Spacing', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front-inner .ha-text p' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'front_description_color',
            [
                'label' => __( 'Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-front-inner .ha-text p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'front_description_typography',
                'label' => __( 'Typography', 'wphobby-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ha-flip-box-front-inner .ha-text p',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'front_description_text_shadow',
                'label' => __( 'Text Shadow', 'wphobby-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ha-flip-box-front-inner .ha-text p',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        // back side
        $this->start_controls_section(
            '_section_back_text_style',
            [
                'label' => __( 'Back Side', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'back_content_padding',
            [
                'label' => __( 'Padding', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'back_border',
                'selector' => '{{WRAPPER}} .ha-flip-box-back',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'back_box_shadow',
                'selector' => '{{WRAPPER}} .ha-flip-box-back',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'back_background_image',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ha-flip-box-back',
            ]
        );

        $this->add_control(
            'back_background_overlay',
            [
                'label' => __( 'Background Overlay', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.27)',
                'condition' => [
                    'back_background_image_background' => 'classic'
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'back_background_color',
            [
                'label' => __( 'Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#27374c',
                'condition' => [
                    'back_background_type' => 'color'
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'back_icon_heading',
            [
                'label' => __( 'Media Type - Icon', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_control(
            'back_icon_heading_image',
            [
                'label' => __( 'Media Type - Image', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'back_icon_type' => 'image'
                ],
            ]
        );

        $this->add_responsive_control(
            'back_icon_spacing',
            [
                'label' => __( 'Bottom Spacing', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back-inner .ha-flip-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'back_icon_image_size',
            [
                'label' => __( 'Resize Image', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'back_icon_type' => 'image'
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back-inner .ha-flip-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'back_icon_image_fit',
            [
                'label' => __( 'Image Fit', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'contain'  => __( 'Contain', 'wphobby-addons-for-elementor' ),
                    'cover' => __( 'Cover', 'wphobby-addons-for-elementor' ),
                ],
                'condition' => [
                    'back_icon_type' => 'image'
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back-inner .icon-wrap .ha-flip-icon img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'back_icon_font_size',
            [
                'label' => __( 'Icon Size', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back-inner .ha-flip-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'back_icon_padding',
            [
                'label' => __( 'Padding', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back-inner .icon-wrap .ha-flip-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'back_icon_border',
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image' ],
                ],
                'selector' => '{{WRAPPER}} .ha-flip-box-back-inner .icon-wrap .ha-flip-icon',
            ]
        );

        $this->add_control(
            'back_icon_border_radius',
            [
                'label' => __( 'Border Radius', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image']
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back-inner .icon-wrap .ha-flip-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ha-flip-box-back-inner .ha-flip-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'back_icon_box_shadow',
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image']
                ],
                'selector' => '{{WRAPPER}} .ha-flip-box-back-inner .ha-flip-icon',
            ]
        );

        $this->add_control(
            'back_icon_color',
            [
                'label' => __( 'Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back-inner .ha-flip-icon i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'back_icon_background_color',
            [
                'label' => __( 'Background Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back-inner .icon-wrap .ha-flip-icon' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'back_text',
            [
                'label' => __( 'Title & Description', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( '_tabs_back_text' );
        $this->start_controls_tab(
            '_tab_back_title',
            [
                'label' => __( 'Title', 'wphobby-addons-for-elementor' ),
            ]
        );

        $this->add_responsive_control(
            'back_title_space',
            [
                'label' => __( 'Bottom Spacing', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back-inner .ha-flip-box-heading-back' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'back_title_color',
            [
                'label' => __( 'Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back-inner .ha-flip-box-heading-back' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'back_title_typography',
                'label' => __( 'Typography', 'wphobby-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ha-flip-box-back-inner .ha-flip-box-heading-back',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'back_title_shadow',
                'label' => __( 'Text Shadow', 'wphobby-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ha-flip-box-back-inner .ha-flip-box-heading-back',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_back_description',
            [
                'label' => __( 'Description', 'wphobby-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'back_description_color',
            [
                'label' => __( 'Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-flip-box-back-inner .ha-text p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'back_description_typography',
                'label' => __( 'Typography', 'wphobby-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ha-flip-box-back-inner .ha-text p',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'back_description_text_shadow',
                'label' => __( 'Text Shadow', 'wphobby-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ha-flip-box-back-inner .ha-text p',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // icon/image
        if ( $settings['front_icon_image']['id'] && isset( $settings['front_icon_image']['url'] ) ) {
            $this->add_render_attribute( 'front_icon_image', 'src', $settings['front_icon_image']['url'] );
            $this->add_render_attribute( 'front_icon_image', 'alt', Control_Media::get_image_alt( $settings['front_icon_image'] ) );
            $this->add_render_attribute( 'front_icon_image', 'title', Control_Media::get_image_title( $settings['front_icon_image'] ) );
        }

        // title & description
        $this->add_render_attribute( 'front_title', 'class', 'ha-flip-box-heading' );
        $this->add_render_attribute( 'back_title', 'class', 'ha-flip-box-heading-back' );
        $this->add_render_attribute( 'front_description', 'class', 'ha-desc' );
        $this->add_render_attribute( 'back_description', 'class', 'ha-desc' );
        $this->add_inline_editing_attributes( 'back_description', 'intermediate' );

        // display type
        $this->add_render_attribute( 'display', 'class', 'ha-flip-box-container ha-flip-effect-classic' );

        // flip position
        $this->add_render_attribute( 'flip-position', 'class', 'ha-flip-box-inner' );
        if ( $settings['flip_position'] === 'bottom-top' ) {
            $this->add_render_attribute( 'flip-position', 'class', 'ha-flip-up' );
        } elseif ( $settings['flip_position'] === 'left-right' ) {
            $this->add_render_attribute( 'flip-position', 'class', 'ha-flip-right' );
        }
        ?>

        <div <?php echo $this->get_render_attribute_string( 'display' ); ?>>

            <div <?php echo $this->get_render_attribute_string( 'flip-position' ); ?>>
                <div class="ha-flip-box-inner-wrapper">
                    <div class="ha-flip-box-front">
                        <div class="ha-flip-box-front-inner">
                            <div class="icon-wrap">
                                <?php if ( ! empty( $settings['front_icon'] ) || ! empty( $settings['front_selected_icon'] ) ) : ?>
                                    <span class="ha-flip-icon icon">
                                        <?php whae_render_icon( $settings, 'front_icon', 'front_selected_icon' ); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ( $settings['front_icon_image'] ) : ?>
                                    <div class="ha-flip-icon">
                                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'front_icon_thumbnail', 'front_icon_image' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="ha-text">
                                <?php if ( $settings['front_title'] ) : ?>
                                    <h2 <?php echo $this->get_render_attribute_string( 'front_title' ); ?>><?php echo whae_kses_basic( $settings['front_title'] ); ?></h2>
                                <?php endif; ?>

                                <?php if ( $settings['front_description'] ) : ?>
                                    <p <?php echo $this->get_render_attribute_string( 'front_description' ); ?>><?php echo whae_kses_basic( $settings['front_description'] ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="ha-flip-box-back">
                        <div class="ha-flip-box-back-inner">
                            <div class="icon-wrap">
                                <?php if ( ! empty( $settings['back_icon'] ) || ! empty( $settings['back_selected_icon'] ) ) : ?>
                                    <span class="ha-flip-icon icon">
                                        <?php whae_render_icon( $settings, 'back_icon', 'back_selected_icon' ); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ( $settings['back_icon_image'] ) : ?>
                                    <div class="ha-flip-icon">
                                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'back_icon_thumbnail', 'back_icon_image' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="ha-text">
                                <?php if ( $settings['back_title'] ) : ?>
                                    <h2 <?php echo $this->get_render_attribute_string( 'back_title' ); ?>><?php echo whae_kses_basic( $settings['back_title'] ); ?></h2>
                                <?php endif; ?>

                                <?php if ( $settings['back_description'] ) : ?>
                                    <p <?php echo $this->get_render_attribute_string( 'back_description' ) ?>><?php echo whae_kses_intermediate( $settings['back_description'] ); ?></p>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php

    }

}