<?php
/**
 * Builds the admin options
 */

function simple_cart_menu() {
    add_options_page( 'Simple Cart Options', 'Simple Cart', 'manage_options', 'simplecartecomm', 'simple_cart_options' );
}

function simple_cart_options() {
    global $option_name,$options,$wp_rewrite;
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    $rules = get_option( 'rewrite_rules' );
    simplecart_custom_permalinks( $rules );
    $wp_rewrite->flush_rules();

    // simple handle, take settings and trun to JSON
    add_option($option_name);
    if(isset($_POST['submit'])){
        $simplesettings = json_encode($_POST);
        update_option($option_name, $simplesettings);

        // reset with new values
        $simple_options = get_option($option_name);
        $options = json_decode($simple_options,true);
    }
    // add to view file for easy editing
    include 'views/settings.php';
}

function add_simplejs_options() {
    global $options;
    include 'views/simplecart-setup.php';
}
