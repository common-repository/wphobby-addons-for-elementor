<?php
/**
 * Elements template
 */

$elements = [
    'content-elements'  => [
        'title' => __( 'Content Elements', 'wphobby-addons-for-elementor' ),
        'elements'  => [
            [
                'key'   => 'banner',
                'title' => __( 'Banner', 'wphobby-addons-for-elementor' ),
            ],
            [
                'key'   => 'slider_box',
                'title' => __( 'Slider Box', 'wphobby-addons-for-elementor' ),
            ],
            [
                'key'   => 'post_grid',
                'title' => __( 'Post Grid', 'wphobby-addons-for-elementor' ),
            ]
        ]
    ],
    'woocommerce-elements'  => [
        'title' => __( 'Woocommerce Elements', 'wphobby-addons-for-elementor' ),
        'elements'  => [
            [
                'key'   => 'wc_product_grid',
                'title' => __( 'Woocommerce Products Grid', 'wphobby-addons-for-elementor' ),
            ]
        ]
    ],
    'third-party-elements'  => [
    'title' => __( 'Third Party Elements', 'wphobby-addons-for-elementor' ),
    'elements'  => [
        [
            'key'   => 'mailchimp',
            'title' => __( 'MailChimp', 'wphobby-addons-for-elementor' ),
        ]
    ]
]
];

?>
<div id="elements" class="whae-settings-tab whae-elements-list">
    <div class="row">
        <div class="col-full">

            <?php foreach($elements as $element) : ?>
                <?php echo !empty($element['title']) ? '<h4>'.$element['title'].'</h4>' : ''; ?>

                <div class="whae-checkbox-container">
                    <?php
                    foreach($element['elements'] as $item) {
                        $checked = checked( 'on', $this->get_settings($item['key'], 'on'), false );
                        $label_class = '';
                        $class = isset($item['class']) ? ' '.$item['class'] : '';
                        ?>
                        <div class="whae-checkbox<?php echo $class; ?>">
                            <div class="whae-elements-info">
                                <p class="whae-el-title">
                                    <?php _e( $item['title'], 'wphobby-addons-for-elementor' ) ?>
                                </p>
                            </div>
                            <label class="switch <?php echo $label_class; ?>" for="<?php echo esc_attr($item['key']); ?>">
                                <input type="checkbox" id="<?php echo esc_attr($item['key']); ?>" name="<?php echo esc_attr($item['key']); ?>" <?php echo esc_attr($checked); ?> />
                                <span class="slider round"></span>
                            </label>
                        </div>
                    <?php } ?>
                </div>
            <?php endforeach; ?>

            <div class="whae-save-btn-wrap">
                <button type="submit" class="button whae-btn js-whae-settings-save"><?php _e('Save settings', 'wphobby-addons-for-elementor'); ?></button>
            </div>
        </div>
    </div>
</div>
