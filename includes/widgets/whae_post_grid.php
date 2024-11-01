<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WHAE_Elementor_Widget_Post_Grid extends Widget_Base {

    public function get_name() {
        return 'wphobby-post-grid-addons';
    }

    public function get_title() {
        return __( 'Post Grid', 'wphobby-addons-for-elementor' );
    }

    public function get_icon() {
        return 'whae-icon eicon-posts-grid';
    }
    public function get_categories() {
        return [ 'wphobby-addons-for-elementor' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'post_grid_content',
            [
                'label' =>  esc_html__( 'Post Grid', 'wphobby-addons-for-elementor' ),
            ]
        );
        $this->add_control(
            'post_grid_style',
            [
                'label' =>  esc_html__( 'Layout', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   =>  esc_html__( 'Layout One', 'wphobby-addons-for-elementor' ),
                    '2'   =>  esc_html__( 'Layout Two', 'wphobby-addons-for-elementor' ),
                    '3'   =>  esc_html__( 'Layout Three', 'wphobby-addons-for-elementor' ),
                    '4'   =>  esc_html__( 'Layout Four', 'wphobby-addons-for-elementor' ),
                    '5'   =>  esc_html__( 'Layout Five', 'wphobby-addons-for-elementor' ),
                ],
            ]
        );

        $this->end_controls_section();

        // Content Option Start
        $this->start_controls_section(
            'post_content_option',
            [
                'label' =>  esc_html__( 'Post Option', 'wphobby-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'grid_post_type',
            [
                'label' => esc_html__( 'Content Sourse', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => false,
                'options' => whae_get_post_types(),
            ]
        );

        $this->add_control(
            'grid_categories',
            [
                'label' => esc_html__( 'Categories', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => whae_get_taxonomies(),
                'condition' =>[
                    'grid_post_type' => 'post',
                ]
            ]
        );

        $this->add_control(
            'grid_prod_categories',
            [
                'label' => esc_html__( 'Categories', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => whae_get_taxonomies('product_cat'),
                'condition' =>[
                    'grid_post_type' => 'product',
                ]
            ]
        );

        $this->add_control(
            'post_limit',
            [
                'label' =>  esc_html__('Limit', 'wphobby-addons-for-elementor'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
                'separator'=>'before',
            ]
        );

        $this->add_control(
            'custom_order',
            [
                'label' => esc_html__( 'Custom order', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'postorder',
            [
                'label' => esc_html__( 'Order', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC'  => esc_html__('Descending','wphobby-addons-for-elementor'),
                    'ASC'   => esc_html__('Ascending','wphobby-addons-for-elementor'),
                ],
                'condition' => [
                    'custom_order!' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Orderby', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'          => esc_html__('None','wphobby-addons-for-elementor'),
                    'ID'            => esc_html__('ID','wphobby-addons-for-elementor'),
                    'date'          => esc_html__('Date','wphobby-addons-for-elementor'),
                    'name'          => esc_html__('Name','wphobby-addons-for-elementor'),
                    'title'         => esc_html__('Title','wphobby-addons-for-elementor'),
                    'comment_count' => esc_html__('Comment count','wphobby-addons-for-elementor'),
                    'rand'          => esc_html__('Random','wphobby-addons-for-elementor'),
                ],
                'condition' => [
                    'custom_order' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__( 'Title', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label' => esc_html__( 'Category', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label' => esc_html__( 'Date', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section(); // Content Option End

        // Style Title tab section
        $this->start_controls_section(
            'post_grid_title_style_section',
            [
                'label' =>  esc_html__( 'Title', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_title'=>'yes',
                ]
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' =>  esc_html__( 'Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default'=>'#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ht-post .post-content .content h2 a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ht-post .post-content .content h4 a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' =>  esc_html__( 'Typography', 'wphobby-addons-for-elementor' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ht-post .post-content .content h4, {{WRAPPER}} .ht-post .post-content .content h2',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' =>  esc_html__( 'Margin', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ht-post .post-content .content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ht-post .post-content .content h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' =>  esc_html__( 'Padding', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ht-post .post-content .content h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ht-post .post-content .content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_align',
            [
                'label' =>  esc_html__( 'Alignment', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' =>  esc_html__( 'Left', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' =>  esc_html__( 'Center', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' =>  esc_html__( 'Right', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' =>  esc_html__( 'Justified', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ht-post .post-content .content h2' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .ht-post .post-content .content h4' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
            ]
        );

        $this->end_controls_section();

        // Style Date tab section
        $this->start_controls_section(
            'post_grid_date_style_section',
            [
                'label' =>  esc_html__( 'Date', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_date'=>'yes',
                ]
            ]
        );
        $this->add_control(
            'date_color',
            [
                'label' =>  esc_html__( 'Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default'=>'#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ht-post .post-content .content .meta' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'label' =>  esc_html__( 'Typography', 'wphobby-addons-for-elementor' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ht-post .post-content .content .meta',
            ]
        );

        $this->add_responsive_control(
            'date_margin',
            [
                'label' =>  esc_html__( 'Margin', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ht-post .post-content .content .meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'date_padding',
            [
                'label' =>  esc_html__( 'Padding', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ht-post .post-content .content .meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'date_align',
            [
                'label' =>  esc_html__( 'Alignment', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' =>  esc_html__( 'Left', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' =>  esc_html__( 'Center', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' =>  esc_html__( 'Right', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' =>  esc_html__( 'Justified', 'wphobby-addons-for-elementor' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ht-post .post-content .content .meta' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
            ]
        );

        $this->end_controls_section();

        // Style Category tab section
        $this->start_controls_section(
            'post_grid_category_style_section',
            [
                'label' =>  esc_html__( 'Category', 'wphobby-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_category'=>'yes',
                ]
            ]
        );
        $this->add_control(
            'category_color',
            [
                'label' =>  esc_html__( 'Color', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default'=>'#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ht-post a.post-category' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'label' =>  esc_html__( 'Typography', 'wphobby-addons-for-elementor' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ht-post a.post-category',
            ]
        );

        $this->add_responsive_control(
            'category_margin',
            [
                'label' =>  esc_html__( 'Margin', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ht-post a.post-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'category_padding',
            [
                'label' =>  esc_html__( 'Padding', 'wphobby-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ht-post a.post-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'category_background',
                'label' =>  esc_html__( 'Background', 'wphobby-addons-for-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ht-post a.post-category',
            ]
        );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $custom_order_ck    = $this->get_settings_for_display('custom_order');
        $orderby            = $this->get_settings_for_display('orderby');
        $postorder          = $this->get_settings_for_display('postorder');

        $this->add_render_attribute( 'whae_post_grid', 'class', 'whae-post-grid-area whae-post-grid-layout-'.$settings['post_grid_style'] );

        // Query
        $args = array(
            'post_type'             => !empty( $settings['grid_post_type'] ) ? $settings['grid_post_type'] : 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => !empty( $settings['post_limit'] ) ? $settings['post_limit'] : 3,
            'order'                 => $postorder
        );

        // Custom Order
        if( $custom_order_ck == 'yes' ){
            $args['orderby']    = $orderby;
        }

        if( !empty($settings['grid_prod_categories']) ){
            $get_categories = $settings['grid_prod_categories'];
        }else{
            $get_categories = $settings['grid_categories'];
        }

        $grid_cats = str_replace(' ', '', $get_categories);

        if (  !empty( $get_categories ) ) {
            if( is_array($grid_cats) && count($grid_cats) > 0 ){
                $field_name = is_numeric( $grid_cats[0] ) ? 'term_id' : 'slug';
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => ( $settings['grid_post_type'] == 'product' ) ? 'product_cat' : 'category',
                        'terms' => $grid_cats,
                        'field' => $field_name,
                        'include_children' => false
                    )
                );
            }
        }

        $grid_post = new \WP_Query( $args );

        ?>

        <div <?php echo $this->get_render_attribute_string( 'whae_post_grid' ); ?>>
            <div class="htb-col">
                <div class="<?php if( $settings['post_grid_style'] == 1 || $settings['post_grid_style'] == 2 || $settings['post_grid_style'] == 3 ) { echo 'row-1'; }else{ echo 'row--10' ;}?> htb-row">
                    <?php
                    $countrow = $gdc = $rowcount = 0;
                    $roclass = 'htb-col-lg-4 htb-col-md-4';
                    while( $grid_post->have_posts() ) : $grid_post->the_post();
                        $countrow++;
                        $gdc++;
                        if( $gdc > 6){ $gdc = 1; }
                        if( $countrow > 3){ $roclass = 'htb-col-lg-6 htb-col-md-6'; }else{ $roclass = $roclass; }
                        ?>

                        <?php if( $settings['post_grid_style'] == 2 ): ?>

                            <?php if ( $countrow == 1 ) : ?>
                                <div class="htb-col-lg-3 htb-col-sm-6 htb-col-12">
                            <?php endif;?>
                            <?php if ( $countrow == 1 || $countrow == 2) : ?>
                                <div class="ht-post">
                                    <div class="thumb">
                                        <a href="<?php the_permalink();?>">
                                            <?php
                                            if ( has_post_thumbnail() ){
                                                the_post_thumbnail();
                                            }else{
                                                echo '<img src="'.HTMEGA_ADDONS_PL_URL.'/assets/images/image-placeholder.png" alt="'.get_the_title().'" />';
                                            }
                                            ?>
                                        </a>
                                    </div>
                                    <?php
                                    if( $settings['show_category'] == 'yes' ){
                                        $i=0;
                                        foreach ( get_the_category() as $category ) {
                                            $i++;
                                            $term_link = get_term_link( $category );
                                            ?>
                                            <a class="post-category post-position-top-left" href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a>
                                            <?php
                                            if($i==1){break;}
                                        }
                                    }
                                    ?>
                                    <div class="post-content">
                                        <div class="content">
                                            <?php if( $settings['show_title'] == 'yes' ): ?>
                                                <h4><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), 8, '' ); ?></a></h4>
                                            <?php endif; if( $settings['show_date'] == 'yes' ): ?>
                                                <div class="meta">
                                                    <span class="meta-item date"><i class="fa fa-clock-o"></i>
                                                        <?php the_time(esc_html__('d F Y','wphobby-addons-for-elementor')); ?>
                                                    </span>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                            <?php if ( $countrow == 2 ) : ?>
                                </div>
                            <?php endif;?>

                            <?php if ( $countrow == 3 ) : ?>
                                <div class="htb-col-lg-6 htb-col-sm-6 htb-col-12">
                                    <div class="ht-post">
                                        <div class="thumb">
                                            <a href="<?php the_permalink();?>">
                                                <?php
                                                if ( has_post_thumbnail() ){
                                                    the_post_thumbnail();
                                                }else{
                                                    echo '<img src="'.HTMEGA_ADDONS_PL_URL.'/assets/images/image-placeholder.png" alt="'.get_the_title().'" />';
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <?php
                                        if( $settings['show_category'] == 'yes' ){
                                            $i=0;
                                            foreach ( get_the_category() as $category ) {
                                                $i++;
                                                $term_link = get_term_link( $category );
                                                ?>
                                                <a class="post-category post-position-top-left" href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a>
                                                <?php
                                                if($i==1){break;}
                                            }
                                        }
                                        ?>
                                        <div class="post-content">
                                            <div class="content">
                                                <?php if( $settings['show_title'] == 'yes' ): ?>
                                                    <h4><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), 8, '' ); ?></a></h4>
                                                <?php endif; if( $settings['show_date'] == 'yes' ): ?>
                                                    <div class="meta">
                                                        <span class="meta-item date"><i class="fa fa-clock-o"></i>
                                                            <?php the_time(esc_html__('d F Y','wphobby-addons-for-elementor')); ?>
                                                        </span>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>

                            <?php if ( $countrow == 4 ) : ?>
                                <div class="htb-col-lg-3 htb-col-sm-6 htb-col-12">
                            <?php endif;?>
                            <?php if ( $countrow == 4 || $countrow == 5 ) : ?>
                                <div class="ht-post">
                                    <div class="thumb">
                                        <a href="<?php the_permalink();?>">
                                            <?php
                                            if ( has_post_thumbnail() ){
                                                the_post_thumbnail();
                                            }else{
                                                echo '<img src="'.HTMEGA_ADDONS_PL_URL.'/assets/images/image-placeholder.png" alt="'.get_the_title().'" />';
                                            }
                                            ?>
                                        </a>
                                    </div>
                                    <?php
                                    if( $settings['show_category'] == 'yes' ){
                                        $i=0;
                                        foreach ( get_the_category() as $category ) {
                                            $i++;
                                            $term_link = get_term_link( $category );
                                            ?>
                                            <a class="post-category post-position-top-left" href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a>
                                            <?php
                                            if($i==1){break;}
                                        }
                                    }
                                    ?>
                                    <div class="post-content">
                                        <div class="content">
                                            <?php if( $settings['show_title'] == 'yes' ): ?>
                                                <h4><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), 8, '' ); ?></a></h4>
                                            <?php endif; if( $settings['show_date'] == 'yes' ): ?>
                                                <div class="meta">
                                                        <span class="meta-item date"><i class="fa fa-clock-o"></i>
                                                            <?php the_time(esc_html__('d F Y','wphobby-addons-for-elementor')); ?>
                                                        </span>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                            <?php if ( $countrow == 5 ) : ?>
                                </div>
                            <?php endif;?>


                        <?php elseif( $settings['post_grid_style'] == 3 ): ?>
                            <?php if( $countrow == 1): ?>
                                <div class="htb-col-lg-6 htb-col-sm-6 htb-col-12">
                                    <div class="ht-post">
                                        <div class="thumb">
                                            <a href="<?php the_permalink();?>">
                                                <?php
                                                if ( has_post_thumbnail() ){
                                                    the_post_thumbnail();
                                                }else{
                                                    echo '<img src="'.HTMEGA_ADDONS_PL_URL.'/assets/images/image-placeholder.png" alt="'.get_the_title().'" />';
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <?php
                                        if( $settings['show_category'] == 'yes' ){
                                            $i=0;
                                            foreach ( get_the_category() as $category ) {
                                                $i++;
                                                $term_link = get_term_link( $category );
                                                ?>
                                                <a class="post-category post-position-top-left" href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a>
                                                <?php
                                                if($i==1){break;}
                                            }
                                        }
                                        ?>
                                        <div class="post-content">
                                            <div class="content">
                                                <?php if( $settings['show_title'] == 'yes' ): ?>
                                                    <h2><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), 5, '' ); ?></a></h2>
                                                <?php endif; if( $settings['show_date'] == 'yes' ): ?>
                                                    <div class="meta">
                                                        <i class="fa fa-clock-o"></i>
                                                        <span class="meta-item date"><i class="fa fa-clock-o"></i>
                                                            <?php the_time(esc_html__('d F Y','wphobby-addons-for-elementor')); ?>
                                                        </span>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="htb-col-lg-6 htb-col-sm-6 htb-col-12">
                                <div class="htb-row row-1">
                            <?php endif; ?>

                            <?php if ( $countrow == 2) : ?>
                                <div class="htb-col-lg-12">
                                    <div class="ht-post">
                                        <div class="thumb">
                                            <a href="<?php the_permalink();?>">
                                                <?php
                                                if ( has_post_thumbnail() ){
                                                    the_post_thumbnail('whae_size_585x295');
                                                }else{
                                                    echo '<img src="'.HTMEGA_ADDONS_PL_URL.'/assets/images/image-placeholder.png" alt="'.get_the_title().'" />';
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <?php
                                        if( $settings['show_category'] == 'yes' ){
                                            $i=0;
                                            foreach ( get_the_category() as $category ) {
                                                $i++;
                                                $term_link = get_term_link( $category );
                                                ?>
                                                <a class="post-category post-position-top-left" href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a>
                                                <?php
                                                if($i==1){break;}
                                            }
                                        }
                                        ?>
                                        <div class="post-content">
                                            <div class="content">
                                                <?php if( $settings['show_title'] == 'yes' ): ?>
                                                    <h4><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), 5, '' ); ?></a></h4>
                                                <?php endif; if( $settings['show_date'] == 'yes' ): ?>
                                                    <div class="meta">
                                                        <i class="fa fa-clock-o"></i>
                                                                <span class="meta-item date"><i class="fa fa-clock-o"></i>
                                                                    <?php the_time(esc_html__('d F Y','wphobby-addons-for-elementor')); ?>
                                                                </span>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>

                            <?php if ( $countrow == 3 || $countrow == 4) : ?>
                                <div class="htb-col-lg-6">
                                    <div class="ht-post">
                                        <div class="thumb">
                                            <a href="<?php the_permalink();?>">
                                                <?php
                                                if ( has_post_thumbnail() ){
                                                    the_post_thumbnail();
                                                }else{
                                                    echo '<img src="'.HTMEGA_ADDONS_PL_URL.'/assets/images/image-placeholder.png" alt="'.get_the_title().'" />';
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <?php
                                        if( $settings['show_category'] == 'yes' ){
                                            $i=0;
                                            foreach ( get_the_category() as $category ) {
                                                $i++;
                                                $term_link = get_term_link( $category );
                                                ?>
                                                <a class="post-category post-position-top-left" href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a>
                                                <?php
                                                if($i==1){break;}
                                            }
                                        }
                                        ?>
                                        <div class="post-content">
                                            <div class="content">
                                                <?php if( $settings['show_title'] == 'yes' ): ?>
                                                    <h4><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), 5, '' ); ?></a></h4>
                                                <?php endif; if( $settings['show_date'] == 'yes' ): ?>
                                                    <div class="meta">
                                                        <i class="fa fa-clock-o"></i>
                                                                <span class="meta-item date"><i class="fa fa-clock-o"></i>
                                                                    <?php the_time(esc_html__('d F Y','wphobby-addons-for-elementor')); ?>
                                                                </span>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ( $countrow == 5 ) : ?>
                                </div>
                                </div>
                            <?php endif;?>

                        <?php elseif( $settings['post_grid_style'] == 4 ): ?>
                            <div class="htb-col-lg-4 htb-col-sm-6 htb-col-12">
                                <div class="ht-post black-overlay mt--30">
                                    <div class="thumb">
                                        <a href="<?php the_permalink();?>">
                                            <?php
                                            if ( has_post_thumbnail() ){
                                                the_post_thumbnail();
                                            }else{
                                                echo '<img src="'.HTMEGA_ADDONS_PL_URL.'/assets/images/image-placeholder.png" alt="'.get_the_title().'" />';
                                            }
                                            ?>
                                        </a>
                                    </div>
                                    <?php
                                    if( $settings['show_category'] == 'yes' ){
                                        $i=0;
                                        foreach ( get_the_category() as $category ) {
                                            $i++;
                                            $term_link = get_term_link( $category );
                                            ?>
                                            <a class="post-category post-position-top-left" href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a>
                                            <?php
                                            if($i==1){break;}
                                        }
                                    }
                                    ?>
                                    <div class="post-content">
                                        <div class="content">
                                            <?php if( $settings['show_title'] == 'yes' ): ?>
                                                <h4><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), 5, '' ); ?></a></h4>
                                            <?php endif; if( $settings['show_date'] == 'yes' ): ?>
                                                <div class="meta">
                                                    <span class="meta-item date"><i class="fa fa-clock-o"></i>
                                                        <?php the_time(esc_html__('d F Y','wphobby-addons-for-elementor')); ?>
                                                    </span>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php elseif( $settings['post_grid_style'] == 5 ): ?>
                            <?php if( $countrow == 1): ?>
                                <div class="htb-col-lg-8 htb-col-sm-6 htb-col-12">
                                    <div class="ht-post gradient-overlay gradient-overlay-<?php echo esc_attr($gdc);?> mt--20">
                                        <div class="thumb">
                                            <a href="<?php the_permalink();?>">
                                                <?php
                                                if ( has_post_thumbnail() ){
                                                    the_post_thumbnail('whae_size_585x295');
                                                }else{
                                                    echo '<img src="'.HTMEGA_ADDONS_PL_URL.'/assets/images/image-placeholder.png" alt="'.get_the_title().'" />';
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <?php
                                        if( $settings['show_category'] == 'yes' ){
                                            $i=0;
                                            foreach ( get_the_category() as $category ) {
                                                $i++;
                                                $term_link = get_term_link( $category );
                                                ?>
                                                <a class="post-category post-position-top-left" href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a>
                                                <?php
                                                if($i==1){break;}
                                            }
                                        }
                                        ?>
                                        <div class="post-content">
                                            <div class="content">
                                                <?php if( $settings['show_title'] == 'yes' ): ?>
                                                    <h4><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), 6, '' ); ?></a></h4>
                                                <?php endif; if( $settings['show_date'] == 'yes' ): ?>
                                                    <div class="meta">
                                                        <span class="meta-item date"><i class="fa fa-clock-o"></i><?php the_time(esc_html__('d F Y','wphobby-addons-for-elementor'));?></span>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php endif;?>
                            <?php if( $countrow == 2): ?>
                                <div class="htb-col-lg-4 htb-col-sm-6 htb-col-12">
                                    <div class="ht-post gradient-overlay gradient-overlay-<?php echo esc_attr($gdc);?> mt--20">
                                        <div class="thumb">
                                            <a href="<?php the_permalink();?>">
                                                <?php
                                                if ( has_post_thumbnail() ){
                                                    the_post_thumbnail();
                                                }else{
                                                    echo '<img src="'.HTMEGA_ADDONS_PL_URL.'/assets/images/image-placeholder.png" alt="'.get_the_title().'" />';
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <?php
                                        if( $settings['show_category'] == 'yes' ){
                                            $i=0;
                                            foreach ( get_the_category() as $category ) {
                                                $i++;
                                                $term_link = get_term_link( $category );
                                                ?>
                                                <a class="post-category post-position-top-left" href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a>
                                                <?php
                                                if($i==1){break;}
                                            }
                                        }
                                        ?>
                                        <div class="post-content">
                                            <div class="content">
                                                <?php if( $settings['show_title'] == 'yes' ): ?>
                                                    <h4><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), 6, '' ); ?></a></h4>
                                                <?php endif; if( $settings['show_date'] == 'yes' ): ?>
                                                    <div class="meta">
                                                        <span class="meta-item date"><i class="fa fa-clock-o"></i><?php the_time(esc_html__('d F Y','wphobby-addons-for-elementor'));?></span>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php endif;?>
                            <?php if( $countrow > 2 ): ?>
                                <div class="htb-col-lg-4 htb-col-sm-6 htb-col-12">
                                    <div class="ht-post gradient-overlay gradient-overlay-<?php echo esc_attr($gdc);?> mt--20">
                                        <div class="thumb">
                                            <a href="<?php the_permalink();?>">
                                                <?php
                                                if ( has_post_thumbnail() ){
                                                    the_post_thumbnail();
                                                }else{
                                                    echo '<img src="'.HTMEGA_ADDONS_PL_URL.'/assets/images/image-placeholder.png" alt="'.get_the_title().'" />';
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <?php
                                        if( $settings['show_category'] == 'yes' ){
                                            $i=0;
                                            foreach ( get_the_category() as $category ) {
                                                $i++;
                                                $term_link = get_term_link( $category );
                                                ?>
                                                <a class="post-category post-position-top-left" href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a>
                                                <?php
                                                if($i==1){break;}
                                            }
                                        }
                                        ?>
                                        <div class="post-content">
                                            <div class="content">
                                                <?php if( $settings['show_title'] == 'yes' ): ?>
                                                    <h4><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), 6, '' ); ?></a></h4>
                                                <?php endif; if( $settings['show_date'] == 'yes' ): ?>
                                                    <div class="meta">
                                                        <span class="meta-item date"><i class="fa fa-clock-o"></i><?php the_time(esc_html__('d F Y','wphobby-addons-for-elementor'));?></span>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php endif;?>

                        <?php else:?>
                            <div class="<?php echo esc_attr( $roclass ); ?> htb-col-12">
                                <div class="ht-post gradient-overlay gradient-overlay-<?php echo esc_attr($gdc);?> hero-post">

                                    <div class="thumb">
                                        <a href="<?php the_permalink();?>">
                                            <?php
                                            if ( has_post_thumbnail() ){
                                                the_post_thumbnail();
                                            }else{
                                                echo '<img src="'.HTMEGA_ADDONS_PL_URL.'/assets/images/image-placeholder.png" alt="'.get_the_title().'" />';
                                            }
                                            ?>
                                        </a>
                                    </div>
                                    <?php
                                    if( $settings['show_category'] == 'yes' ){
                                        $i=0;
                                        foreach ( get_the_category() as $category ) {
                                            $i++;
                                            $term_link = get_term_link( $category );
                                            ?>
                                            <a class="post-category post-position-top-left" href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a>
                                            <?php
                                            if($i==1){break;}
                                        }
                                    }
                                    ?>
                                    <div class="post-content">
                                        <div class="content">
                                            <?php if( $settings['show_title'] == 'yes' ): ?>
                                                <h4 class="title"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), 6, '' ); ?></a></h4>
                                            <?php endif; if( $settings['show_date'] == 'yes' ): ?>
                                                <div class="meta">
                                                    <span class="meta-item date"><i class="fa fa-clock-o"></i><?php the_time(esc_html__('d F Y','wphobby-addons-for-elementor'));?></span>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <?php endif;?>

                    <?php endwhile; wp_reset_postdata(); wp_reset_query(); ?>
                </div>
            </div>
        </div>

        <?php

    }

}