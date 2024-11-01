<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WHAE_Elementor_Widget_Slider_Box extends Widget_Base {

    public function get_name() {
        return 'whae-slider';
    }

    public function get_title() {
        return esc_html__( 'Slider', 'wphobby-addons-for-elementor' );
    }

    public function get_icon() {
        return 'whae-icon eicon-thumbnails-down';
    }

    public function get_categories() {
        return [ 'wphobby-addons-for-elementor' ];
    }

    public function get_script_depends() {
        return [
            'slick',
            'whae-widgets-scripts',
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __( 'Slides', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'wphobby-addons-for-elementor' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title & Subtitle', 'wphobby-addons-for-elementor' ),
                'placeholder' => __( 'Type title here', 'wphobby-addons-for-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Type subtitle here', 'wphobby-addons-for-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_item',
            [
                'label' => __( 'Slider Item', 'wphobby-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .ha-slick-item',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label' => __( 'Border Radius', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ha-slick-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings_for_display();

        if ( empty( $settings['slides'] ) ) {
            return;
        }
        ?>

        <div class="whae-slick-wrapper">

            <?php foreach ( $settings['slides'] as $slide ) :
                $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                if ( ! $image ) {
                    $image = $slide['image']['url'];
                }
                ?>
                <div class="whae-slick-item">
                    <?php if ( $image ) : ?>
                        <img class="img-responsive" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $slide['title'] ); ?>">
                    <?php endif; ?>

                    <?php if ( $slide['title'] || $slide['subtitle'] ) : ?>
                        <div class="whae-slick-content">
                            <?php if ( $slide['subtitle'] ) : ?>
                            <a href="" class="tag-title" tabindex="0"><?php echo esc_html( $slide['subtitle'] ); ?></a>
                            <?php endif; ?>
                            <?php if ( $slide['title'] ) : ?>
                                <h3><?php echo esc_html( $slide['title'] ); ?></h3>
                            <?php endif; ?>
                            <a href="#" class="slide-btn">Request a Demo</a>
                        </div>
                    <?php endif; ?>
                </div>

            <?php endforeach; ?>

        </div>

        <?php

    }

}