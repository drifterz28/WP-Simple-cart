<?php
add_action( 'widgets_init', 'Simple_cart_widget' );

function Simple_cart_widget() {
	register_widget( 'Simple_cart_Widget' );
}

class Simple_cart_Widget extends WP_Widget {

	function Simple_cart_Widget() {
		$widget_ops = array( 'classname' => 'simplecartcart', 'description' => __('Displays items, item count and price of shopping cart', 'simplecartcart') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'simplecartcart-widget' );
		$this->WP_Widget( 'simplecartcart-widget', __('Running Cart', 'simplecartcart'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$cartpage = apply_filters('widget_title', $instance['cart'] );
		$mini_cart = isset( $instance['mini_cart'] ) ? $instance['mini_cart'] : false;
		$show_title = isset( $instance['show_title'] ) ? $instance['show_title'] : false;
		$show_quantity = isset( $instance['show_quantity'] ) ? $instance['show_quantity'] : false;
		$show_subtotal = isset( $instance['show_subtotal'] ) ? $instance['show_subtotal'] : false;
		$post = get_post($post_id);
		$slug = $post->post_name;
	if($cartpage !== $slug):
		echo $before_widget;
?>
<div class="cart-info">

<?php

if ( $show_title ){
	echo $title;
}
if ( $show_quantity ){
	echo ' <span class="simpleCart_quantity"></span> item(s) ';
}
if ( $show_subtotal ){
	echo '<span class="simpleCart_total"></span>';
}
echo '</div>';
if($mini_cart): ?>
	<div id="cartPopover">
		<div id="triangle">&#x25B2;</div>
		<div class="simpleCart_items"></div>
		<div id="cartData" class="clearfix">
			<div class="left"><strong>Items: </strong><span class="simpleCart_quantity"></span></div>
			<div class="right"><strong>Total: </strong><span class="simpleCart_total"></span></div>
		</div>
		<div id="popoverButtons" class="clearfix">
			<a href="/cart" class="hudbtn left">Checkout</a>
		</div>
	</div>
<?php
	endif;
	endif;
	echo $after_widget;
}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['cart'] = strip_tags( $new_instance['cart'] );
		$instance['mini_cart'] = $new_instance['mini_cart'];
		$instance['show_title'] = $new_instance['show_title'];
		$instance['show_quantity'] = $new_instance['show_quantity'];
		$instance['show_subtotal'] = $new_instance['show_subtotal'];
		return $instance;
	}
	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Your Cart', 'simplecartcart'),'cart' => '', 'show_title' => 1, 'show_quantity' => 1, 'show_subtotal' => 1, 'mini_cart' => 1, );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'simplecartcart'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
			<label for="<?php echo $this->get_field_id( 'cart' ); ?>"><?php _e('Cart Page (use slug, aka url):', 'simplecartcart'); ?></label>
			<input id="<?php echo $this->get_field_id( 'cart' ); ?>" name="<?php echo $this->get_field_name( 'cart' ); ?>" value="<?php echo $instance['cart']; ?>" style="width:100%;" />
			
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['show_title'], true ); ?> id="<?php echo $this->get_field_id( 'show_title' ); ?>" name="<?php echo $this->get_field_name( 'show_title' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_title' ); ?>"><?php _e('Show Title?', 'simplecartcart'); ?></label>
			<br>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['show_quantity'], true ); ?> id="<?php echo $this->get_field_id( 'show_quantity' ); ?>" name="<?php echo $this->get_field_name( 'show_quantity' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_quantity' ); ?>"><?php _e('Display Quantity?', 'simplecartcart'); ?></label>
			<br>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['show_subtotal'], true ); ?> id="<?php echo $this->get_field_id( 'show_subtotal' ); ?>" name="<?php echo $this->get_field_name( 'show_subtotal' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_subtotal' ); ?>"><?php _e('Display SubTotal?', 'simplecartcart'); ?></label>
			<br>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['mini_cart'], true ); ?> id="<?php echo $this->get_field_id( 'mini_cart' ); ?>" name="<?php echo $this->get_field_name( 'mini_cart' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'mini_cart' ); ?>"><?php _e('Display Running cart?', 'simplecartcart'); ?></label>
		</p>
		
	<?php
	}
}