<?php
/*
* Automatically add a gift product when customer purchase anything.
* Use: Add this code in your theme's function.php file
*/

function fida_add_gift_product_to_cart() {
	global $woocommerce;
	
	$cart_total	= 1;	

	if ( $woocommerce->cart->total >= $cart_total ) {
		if ( ! is_admin() ) {
	        $gift_product_id = 40;  // Gift product ID
	        $found 		= false;

	        //check if product already in cart
	        if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
	            foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
	                $_product = $values['data'];
	                if ( $_product->get_id() == $gift_product_id )
	                	$found = true;	                
	            }
	            // if product not found, add it
	            if ( ! $found )
	                WC()->cart->add_to_cart( $gift_product_id );
	        } else {
	            // if no products in cart, add it
	            WC()->cart->add_to_cart( $gift_product_id );
	        }        
	    }
	}        
}

add_action( 'template_redirect', 'fida_add_gift_product_to_cart' );
?>
