<?php
/*
Copy this file into your theme to customize
*/
get_header(); ?>
<section id="primary" class="site-content">
    <div id="content" role="main">
    <?php if ( have_posts() ) : ?>
        <h1 class="page-title"><?php echo $options['title'];?></h1>
        <div class="item-wrapper">
            <div class="row">
            <?php
            $count=0;
            $perrow = (empty($options['perrow']))? 1 : $options['perrow'];
            $item_width = (empty($options['perrow']))? 100 : (100 / $options['perrow'])-1;
            $loop = new WP_Query( array( 'post_type' => 'product', 'posts_per_page' => $options['perpage'] ) );
            while ( $loop->have_posts() ) : $loop->the_post();
            echo ($count % $perrow === 0 && $count > 0)? '</div><div class="row">':'';
            $price = esc_html( get_post_meta( get_the_ID(), 'product_price', true ));
            $sale_price = esc_html( get_post_meta( get_the_ID(), 'product_sale_price', true ));
            ?>
            <div class="item" style="width:<?php echo ceil($item_width);?>%;">
                <a href="<?php the_permalink(); ?>">
                    <?php echo the_post_thumbnail( array( $options['thumbwidth'], $options['thumbheight'] ) ); ?>
                </a>
                <a class="the-title" href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
                <span class="price <?php echo (!empty($sale_price))? 'on-sale':'';?>"><?php echo $options['price'].' '.$options['symbol'].number_format($price, 2, '.', ','); ?></span>
                <?php
                    // TODO: clean this up and use nicer vars.
                    if(!empty($sale_price)){
                        echo '<span class="sale-price">'.$options['saleprice'].' '.$options['symbol'].number_format($sale_price, 2, '.', ',').'</span>';
                    }
                ?>
            </div>
            <?php
            $count++;
            endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
    </div>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
