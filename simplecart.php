<?php
/**
 * @package WP Simple Cart
 * @version 0.6
 */
/*
Plugin Name: WP Simple Cart
Plugin URI: https://github.com/drifterz28/WP-Simple-cart
Description: Create a simple cart with paypal checkout
Author: E-comm Solution
Version: 0.6
Author URI: http://e-commsolution.com
GitHub Plugin URI: https://github.com/drifterz28/WP-Simple-cart
*/

/*  Copyright 2014 E-comm Solution info@e-commsolution.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// get set options for global settings
$option_name = 'simplecartop';
$simple_options = get_option($option_name);
$options = json_decode($simple_options,true);

// creates the post type in wp-admin
include 'includes/post-type.php';
include 'includes/updater.php';
include 'includes/cart-widget.php';
include 'includes/settings-options.php';

function include_template_function( $template_path ) {
    if ( get_post_type() == 'product' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-products.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/templates/single-products.php';
            }
        }else if( is_archive() ){
            if ($theme_file = locate_template(array ('archive-products.php'))) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/templates/archive-products.php';
            }
        }
    }
    return $template_path;
}

function simplecart_func( $atts ) {
    extract( shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts ) );
    return file_get_contents('includes/views/cart.html', FILE_USE_INCLUDE_PATH);
}

function simplecart_set_activate() {
    global $option_name;
    $defaults = '{"title": "", "slug": "items", "imgwidth": "300", "imgheight": "300", "thumbwidth": "200", "thumbheight": "200", "price": "Price", "saleprice": "Sale Price", "perrow": "3", "perpage": "12", "currency": "USD", "symbol": "$", "taxRate": "", "type": "PayPal", "email": "you@example.com", "success": "index.php", "cancel": "index.php"}';
    update_option($option_name, $defaults);
}

// add styles and scripts
wp_enqueue_script('simpleCartjs', plugins_url('/assets/js/simpleCart.js',__FILE__));
wp_enqueue_style('simpleCartcss', plugins_url('/assets/css/styles.css',__FILE__));

// add actions
add_action( 'admin_menu', 'simple_cart_menu');
add_action('wp_head', 'add_simplejs_options');
add_filter( 'template_include', 'include_template_function', 1 );
register_activation_hook( __FILE__, 'simplecart_set_activate' );

add_shortcode( 'cart', 'simplecart_func' );
