<?php
/*
Copy this file into your theme to customize
*/
get_header(); ?>
<div id="primary" class="site-content">
    <div id="content" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-header simpleCart_shelfItem">
                <div class="image-wrapper">
                <?php
                if ( has_post_thumbnail()) {
                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
                    echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
                    echo the_post_thumbnail( array( $options['imgwidth'], $options['imgheight'] ) );
                    echo '</a>';
                    // hide thumbnail for cart.
                    the_post_thumbnail('thumbnail',array('class' => 'item_thumb', 'style' => 'display:none'));
                }
                $sale_price = esc_html( get_post_meta( get_the_ID(), 'product_sale_price', true ) );
                ?>
                </div>
                <div class="product-details">
                    <header class="entry-header">
                        <h1 class="item_name"><?php the_title(); ?></h1>
                    </header>
                    <table class="details-table">
                        <tr>
                            <td>Item# </td>
                            <td><?php echo esc_html( get_post_meta( get_the_ID(), 'product_sku', true ) ); ?> </td>
                        </tr>
                        <tr>
                            <td>Categories: </td>
                            <td><?php echo get_the_term_list( get_the_ID(), 'product-categories', "","<br>" ) ?> </td>
                        </tr>
                        <tr>
                            <td class="table-price<?php echo (!empty($sale_price))? '':' item_price';?>">Price: </td>
                            <td class="table-price<?php echo (!empty($sale_price))? ' on-sale':'item_price';?>"><?php echo esc_html( get_post_meta( get_the_ID(), 'product_price', true ) ); ?></td>
                        </tr>
                        <?php if(!empty($sale_price)): ?>
                        <tr>
                            <td class="table-sale-price">Sale Price: </td>
                            <td class="table-sale-price item_price"><?php echo esc_html( get_post_meta( get_the_ID(), 'product_sale_price', true ) ); ?> </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td>Quantity: </td>
                            <td><input value="1" type="number" class="item_Quantity"></td>
                        </tr>
                    </table>
                    <input value="1" type="hidden" class="item_weight">
                    <input type="button" class="item_add" value="add to cart" />
                </div>
            </div>
            <div class="product-content">
                <?php get_the_content(); ?>
            </div>
        </div>
    <?php endwhile; ?>
    </div>
</div>
<?php wp_reset_query(); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
