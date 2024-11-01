<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WHAE_Elementor_Justified_Gallery extends Widget_Base {

    public function get_name() {
        return 'whae-justified-gallery';
    }

    public function get_title() {
        return esc_html__( 'Justified Gallery', 'wphobby-addons-for-elementor' );
    }

    public function get_icon() {
        return 'whae-icon eicon-thumbnails-down';
    }

    public function get_categories() {
        return [ 'wphobby-addons-for-elementor' ];
    }

    public function get_script_depends() {
        return [
            'jquery-magnific-popup',
            'jquery-justifiedGallery'
        ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_section_gallery',
            [
                'label' => __( 'Gallery', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'filter',
            [
                'label' => __( 'Filter Name', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Type gallery filter name', 'wphobby-addons-for-elementor' ),
                'description' => __( 'Filter name will be used in filter menu.', 'wphobby-addons-for-elementor' ),
                'default' => __( 'Filter Name', 'wphobby-addons-for-elementor' ),
            ]
        );

        $repeater->add_control(
            'images',
            [
                'type' => Controls_Manager::GALLERY,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'gallery',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                /** translators: 1: Filter name */
                'title_field' => sprintf( __( 'Filter Group: %1$s', 'wphobby-addons-for-elementor' ), '{{filter}}' ),
                'default' => [
                    [
                        'filter' => __( 'Happy', 'wphobby-addons-for-elementor' ),
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
            '_section_settings',
            [
                'label' => __( 'Settings', 'wphobby-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_filter',
            [
                'label' => __( 'Show Filter Menu?', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'wphobby-addons-for-elementor' ),
                'label_off' => __( 'No', 'wphobby-addons-for-elementor' ),
                'return_value' => 'yes',
                'description' => __( 'Enable to display filter menu.', 'wphobby-addons-for-elementor' ),
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'show_all_filter',
            [
                'label' => __( 'Show "All" Filter?', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'wphobby-addons-for-elementor' ),
                'label_off' => __( 'No', 'wphobby-addons-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __( 'Enable to display "All" filter in filter menu.', 'wphobby-addons-for-elementor' ),
                'condition' => [
                    'show_filter' => 'yes'
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'all_filter_label',
            [
                'label' => __( 'Filter Label', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'All', 'wphobby-addons-for-elementor' ),
                'placeholder' => __( 'Type filter label', 'wphobby-addons-for-elementor' ),
                'description' => __( 'Type "All" filter label.', 'wphobby-addons-for-elementor' ),
                'condition' => [
                    'show_all_filter' => 'yes',
                    'show_filter' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'show_caption',
            [
                'label' => __( 'Show Caption?', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'wphobby-addons-for-elementor' ),
                'label_off' => __( 'No', 'wphobby-addons-for-elementor' ),
                'return_value' => 'yes',
                'separator' => 'before',
                'description' => __( 'Make sure to add image caption.', 'wphobby-addons-for-elementor' ),
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'row_height',
            [
                'label' => __( 'Height', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'default' => [
                    'size' => 150,
                ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                    ],
                ],
            ]
        );

        $this->add_control(
            'margins',
            [
                'label' => __( 'Margins', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
            ]
        );

        $this->add_control(
            'last_row',
            [
                'label' => __( 'Last Row', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'justify',
                'options' => [
                    'nojustify' => __( 'No Justify', 'wphobby-addons-for-elementor' ),
                    'justify' => __( 'Justify', 'wphobby-addons-for-elementor' ),
                    'hide' => __( 'Hide', 'wphobby-addons-for-elementor' ),
                ]
            ]
        );

        $this->add_control(
            'enable_popup',
            [
                'label' => __( 'Enable Lightbox?', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'wphobby-addons-for-elementor' ),
                'label_off' => __( 'No', 'wphobby-addons-for-elementor' ),
                'separator' => 'before',
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'popup_image',
                'default' => 'large',
                'exclude' => [
                    'custom'
                ],
                'condition' => [
                    'enable_popup' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_image',
            [
                'label' => __( 'Image', 'wphobby-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ha-justified-gallery-item, {{WRAPPER}} .ha-justified-gallery-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .ha-justified-gallery-item'
            ]
        );

        $this->add_control(
            'image_bg_color',
            [
                'label' => __( 'Background Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-justified-gallery-item' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->start_controls_tabs(
            '_tabs_image_effects',
            [
                'separator' => 'before'
            ]
        );

        $this->start_controls_tab(
            '_tab_image_effects_normal',
            [
                'label' => __( 'Normal', 'wphobby-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'image_opacity',
            [
                'label' => __( 'Opacity', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-justified-gallery-item img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters',
                'selector' => '{{WRAPPER}} .ha-justified-gallery-item img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover',
            [
                'label' => __( 'Hover', 'wphobby-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'image_opacity_hover',
            [
                'label' => __( 'Opacity', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-justified-gallery-item:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters_hover',
                'selector' => '{{WRAPPER}} .ha-justified-gallery-item:hover img',
            ]
        );

        $this->add_control(
            'image_background_hover_transition',
            [
                'label' => __( 'Transition Duration', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-justified-gallery-item img' => 'transition-duration: {{SIZE}}s;',
                ],
            ]
        );

        $this->add_control(
            'image_hover_animation',
            [
                'label' => __( 'Hover Animation', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
                'default' => 'grow',
                'label_block' => true,
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_caption',
            [
                'label' => __( 'Caption', 'wphobby-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'caption_padding',
            [
                'label' => __( 'Padding', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .justified-gallery > .ha-justified-gallery-item > .caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'caption_color',
            [
                'label' => __( 'Text Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .justified-gallery > .ha-justified-gallery-item > .caption' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'caption_bg_color',
            [
                'label' => __( 'Background Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .justified-gallery > .ha-justified-gallery-item > .caption' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'caption_typography',
                'label' => __( 'Typography', 'wphobby-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .justified-gallery > .ha-justified-gallery-item > .caption',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_menu',
            [
                'label' => __( 'Filter Menu', 'wphobby-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_menu',
            [
                'label' => __( 'Menu', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'menu_margin',
            [
                'label' => __( 'Margin', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ha-gallery-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_buttons',
            [
                'label' => __( 'Filter Buttons', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ha-gallery-filter > li > button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_spacing',
            [
                'label' => __( 'Spacing', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ha-gallery-filter > li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .ha-gallery-filter > li > button'
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ha-gallery-filter > li > button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .ha-gallery-filter > li > button'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .ha-gallery-filter > li > button',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_responsive_control(
            'button_align',
            [
                'label' => __( 'Alignment', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'wphobby-addons-for-elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'wphobby-addons-for-elementor' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'wphobby-addons-for-elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'desktop_default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .ha-gallery-filter' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->start_controls_tabs( '_tabs_style_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'wphobby-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ha-gallery-filter > li > button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-gallery-filter > li > button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => __( 'Hover', 'wphobby-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-gallery-filter > li > button:hover, {{WRAPPER}} .ha-gallery-filter > li > button:focus, {{WRAPPER}} .ha-gallery-filter > .ha-filter-active > button:hover, {{WRAPPER}} .ha-gallery-filter > .ha-filter-active > button:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-gallery-filter > li > button:hover, {{WRAPPER}} .ha-gallery-filter > li > button:focus, {{WRAPPER}} .ha-gallery-filter > .ha-filter-active > button:hover, {{WRAPPER}} .ha-gallery-filter > .ha-filter-active > button:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-gallery-filter > li > button:hover, {{WRAPPER}} .ha-gallery-filter > li > button:focus, {{WRAPPER}} .ha-gallery-filter > .ha-filter-active > button:hover, {{WRAPPER}} .ha-gallery-filter > .ha-filter-active > button:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_active',
            [
                'label' => __( 'Active', 'wphobby-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'button_active_color',
            [
                'label' => __( 'Text Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-gallery-filter > .ha-filter-active > button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_active_bg_color',
            [
                'label' => __( 'Background Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-gallery-filter > .ha-filter-active > button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_active_border_color',
            [
                'label' => __( 'Border Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ha-gallery-filter > .ha-filter-active > button' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected static function get_data_prop_settings( $settings ) {
        $field_map = [
            'show_caption' => 'captions.bool',
            'margins.size' => 'margins.int',
            'row_height.size' => 'rowHeight.int',
            'last_row' => 'lastRow.str',
            'enable_popup' => 'enable_popup.bool'
        ];
        return whae_prepare_data_prop_settings( $settings, $field_map );
    }

    protected function get_gallery_data() {
        $gallery = $this->get_settings_for_display( 'gallery' );

        if ( ! is_array( $gallery ) || empty( $gallery ) ) {
            return [];
        }

        $menu = [];
        $items = [];

        foreach ( $gallery as $key => $item ) {
            if ( empty( $item['images'] ) ) {
                continue;
            }

            $images = $item['images'];
            $filter = 'ha-is--filter-' . ( $key + 1 );

            if ( $filter && ! isset( $data[ $filter ] ) ) {
                $menu[ $filter ] = $item['filter'];
            }

            foreach ( $images as $image ) {
                if ( ! isset( $items[ $image['id'] ] ) ) {
                    $items[ $image['id'] ] = [ $filter ];
                } else {
                    array_push( $items[ $image['id'] ], $filter );
                }
            }
        }

        return [
            'menu' => $menu,
            'items' => $items
        ];
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $gallery = $this->get_gallery_data();

        if ( empty( $gallery ) ) {
            return;
        }

        $this->add_render_attribute( 'container', 'class', [
            'hajs-justified-gallery'
        ] );

        $has_popup = $settings['enable_popup'];
        $item_html_tag = 'div';

        if ( $has_popup ) {
            $item_html_tag = 'a';
            $this->add_render_attribute( 'container', 'class', 'ha-popup--is-enabled' );
        }

        $this->add_render_attribute( 'container', 'data-happy-settings', self::get_data_prop_settings( $settings ) );

        if ( $settings['show_filter'] === 'yes' ) : ?>
            <ul class="ha-gallery-filter hajs-gallery-filter">
                <?php if ( $settings['show_all_filter'] === 'yes' ) : ?>
                    <li class="ha-filter-active"><button type="button" data-filter="*"><?php echo esc_html( $settings['all_filter_label'] ); ?></button></li>
                <?php endif; ?>
                <?php foreach ( $gallery['menu'] as $key => $val ) : ?>
                    <li><button type="button" data-filter=".<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $val ); ?></button></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    <div <?php echo $this->get_render_attribute_string( 'container' ); ?>>
        <?php foreach ( $gallery['items'] as $id => $filters ) :
            $caption = $settings['show_caption'] ? esc_attr( wp_get_attachment_caption( $id ) )  : '';
            $popup = $has_popup ? sprintf( 'href="%s"', esc_url( wp_get_attachment_image_url( $id, $settings['popup_image_size'] ) ) ) : '';
            ?>
            <<?php echo $item_html_tag; ?> <?php echo $popup; ?> class="ha-justified-gallery-item ha-js-popup <?php echo esc_attr( implode( ' ', $filters ) ); ?>" title="<?php echo $caption; ?>">
            <?php echo wp_get_attachment_image( $id, $settings['thumbnail_size'], false, ['class' => 'elementor-animation-' . esc_attr( $settings['image_hover_animation'] ) ] ); ?>
            </<?php echo $item_html_tag; ?>>
        <?php endforeach; ?>
        </div>

        <?php
    }

}