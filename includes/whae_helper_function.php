<?php
/**
 * WHAE Helper Functions
 *
 * @author  WPHobby
 * @package WPHobby Addons For Elementor
 * @version 1.0.0
 */

/*
 * Get Post Type
 * @return array
 */
if( !function_exists('whae_get_post_types') ){
    function whae_get_post_types( $args = [] ) {

        $post_type_args = [
            'show_in_nav_menus' => true,
        ];
        if ( ! empty( $args['post_type'] ) ) {
            $post_type_args['name'] = $args['post_type'];
        }
        $_post_types = get_post_types( $post_type_args , 'objects' );

        $post_types  = [];
        foreach ( $_post_types as $post_type => $object ) {
            $post_types[ $post_type ] = $object->label;
        }
        return $post_types;
    }
}

/*
 * Get Taxonomy
 * @return array
 */
if( !function_exists('whae_get_taxonomies') ){
    function whae_get_taxonomies( $whae_taxonomy = 'category' ){
        $terms = get_terms( array(
            'taxonomy' => $whae_taxonomy,
            'hide_empty' => true,
        ));
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
                $options[ $term->slug ] = $term->name;
            }
            return $options;
        }
    }
}

/**
 * WooCommerce Product Categories Query
 *
 * @return array
 */
if( !function_exists('whae_woocommerce_product_categories') ) {
    function whae_woocommerce_product_categories()
    {
        $terms = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
        ));

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }
}

/*
 * Get Plugin Options
 * return on/off
 */
if( !function_exists('whae_get_option') ){
    function whae_get_option( $option, $section, $default = '' ){
        $options = get_option( $section );
        if( !$options ){
            return $default;
        }
        if ( isset( $options[$option] ) ) {
            return $options[$option];
        }else{
            return 'off';
        }

    }
}

/*
 * Prepare Data Settings
 */
if( !function_exists('whae_prepare_data_prop_settings') ) {
    function whae_prepare_data_prop_settings(&$settings, $field_map = [])
    {
        $data = [];
        foreach ($field_map as $key => $data_key) {
            $setting_value = whae_get_setting_value($settings, $key);
            list($data_field_key, $data_field_type) = explode('.', $data_key);
            $validator = $data_field_type . 'val';

            if (is_callable($validator)) {
                $val = call_user_func($validator, $setting_value);
            } else {
                $val = $setting_value;
            }
            $data[$data_field_key] = $val;
        }
        return wp_json_encode($data);
    }
}

/*
 * Prepare Data Settings
 */
if( !function_exists('whae_get_setting_value') ) {
    function whae_get_setting_value(&$settings, $keys)
    {
        if (!is_array($keys)) {
            $keys = explode('.', $keys);
        }
        if (is_array($settings[$keys[0]])) {
            return whae_get_setting_value($settings[$keys[0]], array_slice($keys, 1));
        }
        return $settings[$keys[0]];
    }
}

/**
 * Check if WPForms is activated
 *
 * @return bool
 */
if( !function_exists('whae_is_wpforms_activated') ) {
    function whae_is_wpforms_activated()
    {
        return class_exists('\WPForms\WPForms');
    }
}

/*
 * Get current user display name
 */
if( !function_exists('whae_get_current_user_display_name') ) {
    function whae_get_current_user_display_name()
    {
        $user = wp_get_current_user();
        $name = 'user';
        if ($user->exists() && $user->display_name) {
            $name = $user->display_name;
        }
        return $name;
    }
}

/**
 * Call a shortcode function by tag name.
 *
 * @since  1.0.3
 *
 * @param string $tag     The shortcode whose function to call.
 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
 * @param array  $content The shortcode's content. Default is null (none).
 *
 * @return string|bool False on failure, the result of the shortcode on success.
 */
if( !function_exists('whae_do_shortcode') ) {
    function whae_do_shortcode($tag, array $atts = array(), $content = null)
    {
        global $shortcode_tags;
        if (!isset($shortcode_tags[$tag])) {
            return false;
        }
        return call_user_func($shortcode_tags[$tag], $atts, $content, $tag);
    }
}

/**
 * Get a list of all WPForms
 *
 * @return array
 */
if( !function_exists('whae_get_wpforms') ) {
    function whae_get_wpforms()
    {
        $forms = [];
        if (whae_is_wpforms_activated()) {
            $_forms = get_posts([
                'post_type' => 'wpforms',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
            ]);

            if (!empty($_forms)) {
                $forms = wp_list_pluck($_forms, 'post_title', 'ID');
            }
        }
        return $forms;
    }
}

/**
 * Check elementor version
 *
 * @param string $version
 * @param string $operator
 * @return bool
 */
if( !function_exists('whae_is_elementor_version') ) {
    function whae_is_elementor_version($operator = '<', $version = '2.6.0')
    {
        return defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, $version, $operator);
    }
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param string $string
 * @return string
 */
function whae_kses_intermediate( $string = '' ) {
    return wp_kses( $string, whae_get_allowed_html_tags( 'intermediate' ) );
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param string $string
 * @return string
 */
function whae_kses_basic( $string = '' ) {
    return wp_kses( $string, whae_get_allowed_html_tags( 'basic' ) );
}

/**
 * Get a translatable string with allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return string
 */
function whae_get_allowed_html_desc( $level = 'basic' ) {
    if ( ! in_array( $level, [ 'basic', 'intermediate' ] ) ) {
        $level = 'basic';
    }

    $tags_str = '<' . implode( '>,<', array_keys( whae_get_allowed_html_tags( $level ) ) ) . '>';
    return sprintf( __( 'This input field has support for the following HTML tags: %1$s', 'wphobby-addons-for-elementor' ), '<code>' . esc_html( $tags_str ) . '</code>' );
}

/**
 * Get a list of all the allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return array
 */
function whae_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b' => [],
        'i' => [],
        'u' => [],
        'em' => [],
        'br' => [],
        'abbr' => [
            'title' => [],
        ],
        'span' => [
            'class' => [],
        ],
        'strong' => [],
    ];

    if ( $level === 'intermediate' ) {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
    }

    return $allowed_html;
}

/**
 * Render icon html with backward compatibility
 *
 * @param array $settings
 * @param string $old_icon_id
 * @param string $new_icon_id
 * @param array $attributes
 */
function whae_render_icon( $settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = [] ) {
    // Check if its already migrated
    $migrated = isset( $settings['__fa4_migrated'][ $new_icon_id ] );
    // Check if its a new widget without previously selected icon using the old Icon control
    $is_new = empty( $settings[ $old_icon_id ] );

    $attributes['aria-hidden'] = 'true';

    if ( whae_is_elementor_version( '>=', '2.6.0' ) && ( $is_new || $migrated ) ) {
        \Elementor\Icons_Manager::render_icon( $settings[ $new_icon_id ], $attributes );
    } else {
        if ( empty( $attributes['class'] ) ) {
            $attributes['class'] = $settings[ $old_icon_id ];
        } else {
            if ( is_array( $attributes['class'] ) ) {
                $attributes['class'][] = $settings[ $old_icon_id ];
            } else {
                $attributes['class'] .= ' ' . $settings[ $old_icon_id ];
            }
        }
        printf( '<i %s></i>', \Elementor\Utils::render_html_attributes( $attributes ) );
    }
}