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

if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
    $config = array(
        'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
        'proper_folder_name' => 'WP-Simple-cart', // this is the name of the folder your plugin lives in
        'api_url' => 'https://api.github.com/repos/drifterz28/WP-Simple-cart', // the github API url of your github repo
        'raw_url' => 'https://raw.github.com/drifterz28/WP-Simple-cart/master', // the github raw url of your github repo
        'github_url' => 'https://github.com/drifterz28/WP-Simple-cart', // the github url of your github repo
        'zip_url' => 'https://github.com/drifterz28/WP-Simple-cart/zipball/master', // the zip url of the github repo
        'sslverify' => true, // wether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
        'requires' => '3.0', // which version of WordPress does your plugin require?
        'tested' => '3.3', // which version of WordPress is your plugin tested up to?
        'readme' => 'readme.md', // which file to use as the readme for the version number
        'access_token' => '', // Access private repositories by authorizing under Appearance > Github Updates when this example plugin is installed
    );
    $github_updater = new wp_github_updater( $config );
}
