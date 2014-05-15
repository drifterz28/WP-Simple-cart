<?php
// check slug and update if not set
if(empty($options['slug'])){
    $options['slug'] = 'products';
}

/**
 * Remove the slug from published post permalinks. Only affect our CPT though.
 */
function remove_cpt_slug( $post_link, $post, $leavename ) {
    if ( ! in_array( $post->post_type, array( 'product' ) ) || 'publish' != $post->post_status )
        return $post_link;
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    return $post_link;
}

function simplecart_parse_request_tricksy( $query ) {

    // Only noop the main query
    if ( ! $query->is_main_query() )
        return;

    // Only noop our very specific rewrite rule match
    if ( 2 != count( $query->query )
        || ! isset( $query->query['page'] ) )
        return;

    // 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
    if ( ! empty( $query->query['name'] ) )
        $query->set( 'post_type', array( 'post', 'product', 'page' ) );
}

// create post type
function create_post_type() {
    global $options;
    register_post_type( 'product',
        array(
            'labels' => array(
                'name' => __( 'Products' ),
                'singular_name' => __( 'Product' )
            ),
        'public' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'show_in_nav_menus' => true,
        'rewrite'       => array( 'slug' => $options['slug'],'with_front' => true),
        'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes')
        )
    );
}

// add meta boxes to post type
function simplecart_admin() {
    add_meta_box( 'product_details_meta_box',
        'Product Details',
        'product_options_meta_box',
        'product', 'normal', 'high'
    );
}

// create custom meta data fields in post type
function product_options_meta_box( $product_detail ) {
    $product_sku = esc_html( get_post_meta( $product_detail->ID, 'product_sku', true ) );
    $product_price = esc_html( get_post_meta( $product_detail->ID, 'product_price', true ) );
    $product_sale_price = esc_html( get_post_meta( $product_detail->ID, 'product_sale_price', true ) );
    ?>
    <table>
        <tr>
            <td>SKU</td>
            <td><input type="text" size="20" name="product_sku" value="<?php echo $product_sku; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 150px">Price</td>
            <td>
                <input type="text" name="product_price"  value="<?php echo @number_format($product_price, 2, '.', ','); ?>" />
            </td>
        </tr>
        <tr>
            <td style="width: 150px">Sale Price</td>
            <td>
                <input type="text" name="product_sale_price"  value="<?php echo @number_format($product_sale_price, 2, '.', ','); ?>" />
            </td>
        </tr>
    </table>
    <?php
}

// Update post meta data for custom fields
function add_product_fields( $product_id, $product_detail ) {
    // Check post type for movie reviews
    if ( $product_detail->post_type == 'product' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['product_sku'] ) && $_POST['product_sku'] != '' ) {
            update_post_meta( $product_id, 'product_sku', $_POST['product_sku'] );
        }
        if ( isset( $_POST['product_price'] ) && $_POST['product_price'] != '' ) {
            update_post_meta( $product_id, 'product_price', $_POST['product_price'] );
        }
        if ( isset( $_POST['product_sale_price'] ) && $_POST['product_sale_price'] != '' ) {
            update_post_meta( $product_id, 'product_sale_price', $_POST['product_sale_price'] );
        }
    }
}

function product_categories_taxonomies() {
    register_taxonomy(
        'product-categories',
        'product',
        array(
            'labels' => array(
                'name' => 'Product Categories',
                'add_new_item' => 'Add New Category',
                'new_item_name' => "New Category name"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}

// Create custom permalinks for portfolio post type
function simplecart_custom_permalinks( $rules ) {
    $newrules = array();
        $newrules['products/page/([^/]+)/?$'] = 'index.php?pagename=products&paged=$matches[1]';
        $newrules['products/page/([^/]+)?$'] = 'index.php?pagename=products&paged=$matches[1]';
    // return $newrules + $rules;
    if ( $rules ) {
        return array_merge( $newrules, $rules );
    }
}

// flush_rules() if our rules are not yet included
function simplecart_flush_rules(){
    $rules = get_option( 'rewrite_rules' );
    if ( ! isset( $rules['products/page/([^/]+)/?$'] ) ) {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }
}



add_action( 'init', 'create_post_type' );
add_action( 'admin_init', 'simplecart_admin' );
add_action( 'save_post', 'add_product_fields', 10, 3 );
add_action( 'init', 'product_categories_taxonomies', 0 );

// credit to http://vip.wordpress.com/documentation/remove-the-slug-from-your-custom-post-type-permalinks/
add_filter( 'post_type_link', 'remove_cpt_slug', 10, 3 );
add_action( 'pre_get_posts', 'simplecart_parse_request_tricksy' );