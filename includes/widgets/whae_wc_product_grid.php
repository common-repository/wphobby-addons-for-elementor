<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WHAE_Elementor_Widget_WC_Product extends Widget_Base {

    public function get_name() {
        return 'whae-product-addons';
    }

    public function get_title() {
        return __( 'WC : Categories', 'wphobby-addons-for-elementor' );
    }

    public function get_icon() {
        return 'whae-icon eicon-product-categories';
    }
    public function get_categories() {
        return [ 'wphobby-addons-for-elementor' ];
    }

    protected function _register_controls() {

        // Content Controls
        $this->start_controls_section(
            'whae_section_product_grid_settings',
            [
                'label' => esc_html__('Product Settings', 'wphobby-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'whae_product_grid_product_filter',
            [
                'label' => esc_html__('Filter By', 'wphobby-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'recent-products',
                'options' => [
                    'recent-products' => esc_html__('Recent Products', 'wphobby-addons-for-elementor'),
                    'featured-products' => esc_html__('Featured Products', 'wphobby-addons-for-elementor'),
                    'best-selling-products' => esc_html__('Best Selling Products', 'wphobby-addons-for-elementor'),
                    'sale-products' => esc_html__('Sale Products', 'wphobby-addons-for-elementor'),
                    'top-products' => esc_html__('Top Rated Products', 'wphobby-addons-for-elementor'),
                ],
            ]
        );

        $this->add_control(
            'whae_product_grid_column',
            [
                'label' => esc_html__('Columns', 'wphobby-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '2' => esc_html__('2', 'wphobby-addons-for-elementor'),
                    '3' => esc_html__('3', 'wphobby-addons-for-elementor'),
                    '4' => esc_html__('4', 'wphobby-addons-for-elementor'),
                    '6' => esc_html__('6', 'wphobby-addons-for-elementor'),
                ],
            ]
        );

        $this->add_control(
            'whae_product_grid_products_count',
            [
                'label' => esc_html__('Products Count', 'wphobby-addons-for-elementor'),
                'type' => Controls_Manager::NUMBER,
                'default' => 4,
                'min' => 1,
                'max' => 1000,
                'step' => 1,
            ]
        );

        $this->add_control(
            'whae_product_grid_categories',
            [
                'label' => esc_html__('Product Categories', 'wphobby-addons-for-elementor'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => whae_woocommerce_product_categories(),
            ]
        );

        $this->add_control(
            'whae_product_grid_style_preset',
            [
                'label' => esc_html__('Style Preset', 'wphobby-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'whae-product-simple',
                'options' => [
                    'whae-product-default' => esc_html__('Default', 'wphobby-addons-for-elementor'),
                    'whae-product-simple' => esc_html__('Simple Style', 'wphobby-addons-for-elementor'),
                    'whae-product-reveal' => esc_html__('Reveal Style', 'wphobby-addons-for-elementor'),
                    'whae-product-overlay' => esc_html__('Overlay Style', 'wphobby-addons-for-elementor'),
                ],
            ]
        );

        $this->add_control(
            'whae_product_grid_rating',
            [
                'label' => esc_html__('Show Product Rating?', 'wphobby-addons-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings_for_display();

        $args = [
            'post_type' => 'product',
            'posts_per_page' => $settings['whae_product_grid_products_count'] ?: 4,
            'order' => 'DESC',
        ];

        if (!empty($settings['whae_product_grid_categories'])) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $settings['whae_product_grid_categories'],
                    'operator' => 'IN',
                ],
            ];
        }

        if ($settings['whae_product_grid_product_filter'] == 'featured-products') {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'featured'
                ]
            ];
        } else if ($settings['whae_product_grid_product_filter'] == 'best-selling-products') {
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
        } else if ($settings['whae_product_grid_product_filter'] == 'sale-products') {
            $args['meta_query'] = [
                'relation' => 'OR',
                [
                    'key' => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric',
                ], [
                    'key' => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric',
                ],
            ];
        } else if ($settings['whae_product_grid_product_filter'] == 'top-products') {
            $args['meta_key'] = '_wc_average_rating';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
        }


        echo '<div class="whae-product-grid ' . $settings['whae_product_grid_style_preset'] . '">
			<div class="woocommerce">
                <div class="row whae-product-columns-' . $settings['whae_product_grid_column'] . '">
                    ' . $this->render_template($args, $settings) . '
                </div>
			</div>
		</div>';

    }

    protected function render_template($args, $settings)
    {
        switch ( $settings['whae_product_grid_column'] ) {

            case 2 :
                $product_class = 'col-md-6 product-item';
                break;

            case 3 :
                $product_class = 'col-lg-4 col-md-6 product-item';
                break;

            case 4 :
                $product_class = 'col-lg-3 col-sm-6 product-item';
                break;

            case 6 :
                $product_class = 'col-lg-2 col-sm-6 product-item';
                break;

            default:
                $product_class = 'product-item';
                break;
        }

        $query = new \WP_Query($args);

        ob_start();

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $product = wc_get_product(get_the_ID());

                if ($settings['whae_product_grid_style_preset'] == 'whae-product-simple' || $settings['whae_product_grid_style_preset'] == 'whae-product-reveal') {
                    echo '<div class="'. $product_class .'">
                            <div class="product-img">
                                <a href="' . $product->get_permalink() . '">'. $product->get_image('woocommerce_thumbnail') .'</a>
                                <div class="product-button-group">
                                    <a href="#product-popup" data-effect="mfp-zoom-in" class="hasium-btn hasium-quick-view" data-product_id="' . $product->get_id() . '">
                                        <span class="hasium-icon-quick-view"></span>
                                    </a>
                                    <a href="#" class="hasium-btn hasium-add-cart">
                                        <span class="hasium-icon-cart"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="product-info text-center">
                                <h3 class="product-title">
                                    <a href="' . $product->get_permalink() . '">' . $product->get_title() . '</a>
                                </h3>
                                <div class="product-price">
                                    <span class="old">' . $product->get_regular_price() . '</span>
                                    <span>' . $product->get_sale_price() . '</span>
                                </div>
                            </div>
                    </div>';
                } else if ($settings['whae_product_grid_style_preset'] == 'whae-product-overlay') {
                    echo '<div class="'. $product_class .'">
                            <div class="product-img">
                                <a href="' . $product->get_permalink() . '">'. $product->get_image('woocommerce_thumbnail') .'</a>
                                <div class="product-button-group">
                                    <a href="#product-popup" data-effect="mfp-zoom-in" class="hasium-btn hasium-quick-view" data-product_id="' . $product->get_id() . '">
                                        <span class="hasium-icon-quick-view"></span>
                                    </a>
                                    <a href="#" class="hasium-btn hasium-add-cart">
                                        <span class="hasium-icon-cart"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="product-info text-center">
                                <h3 class="product-title">
                                    <a href="' . $product->get_permalink() . '">' . $product->get_title() . '</a>
                                </h3>
                                <div class="product-price">
                                    <span class="old">' . $product->get_regular_price() . '</span>
                                    <span>' . $product->get_sale_price() . '</span>
                                </div>
                            </div>
                    </div>';
                } else {
                    echo '<div class="'. $product_class .'">
                            <div class="product-img">
                                <a href="' . $product->get_permalink() . '">'. $product->get_image('woocommerce_thumbnail') .'</a>
                                <div class="product-button-group">
                                    <a href="#product-popup" data-effect="mfp-zoom-in" class="hasium-btn hasium-quick-view" data-product_id="' . $product->get_id() . '">
                                        <span class="hasium-icon-quick-view"></span>
                                    </a>
                                    <a href="#" class="hasium-btn hasium-add-cart">
                                        <span class="hasium-icon-cart"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="product-info text-center">
                                <h3 class="product-title">
                                    <a href="' . $product->get_permalink() . '">' . $product->get_title() . '</a>
                                </h3>
                                <div class="product-price">
                                    <span class="old">' . $product->get_regular_price() . '</span>
                                    <span>' . $product->get_sale_price() . '</span>
                                </div>
                            </div>
                    </div>';
                }
            }
        } else {
            _e('<p class="no-posts-found">No posts found!</p>', 'wphobby-addons-for-elementor');
        }

        wp_reset_postdata();

        return ob_get_clean();
    }
}

