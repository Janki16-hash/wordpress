<?php

function storefront_child_enqueue_scripts() {
    wp_enqueue_style( 'storefront-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'storefront-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'storefront-style' ), wp_get_theme()->get( 'Version' ) );

}

add_action( 'wp_enqueue_scripts', 'storefront_child_enqueue_scripts' );

function storefront_child_enqueue_scripts1() {
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'storefront-child-custom-script', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), null, true );
    wp_localize_script('custom-checkout-script', 'wc_checkout_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}

add_action( 'wp_enqueue_scripts', 'storefront_child_enqueue_scripts1' );


add_theme_support('woocommerce');
//  AJAX actions
// add_action( 'wp_ajax_update_cart_quantity', 'update_cart_quantity_callback' );
// add_action( 'wp_ajax_nopriv_update_cart_quantity', 'update_cart_quantity_callback' );

// function update_cart_quantity_callback() {


//     // Update the cart quantity if cart_item_key and quantity are passed
//     if ( isset( $_POST['cart_item_key'] ) && isset( $_POST['quantity'] ) ) {
//         $cart_item_key = sanitize_text_field( $_POST['cart_item_key'] );
//         $quantity = intval( $_POST['quantity'] );

//         // If quantity is 0, remove the item from the cart
//         if ( $quantity === 0 ) {
//             WC()->cart->remove_cart_item( $cart_item_key );
//         } else {
//             // Update the quantity of the item
//             WC()->cart->set_quantity( $cart_item_key, $quantity );
//         }

//         // Recalculate cart totals after the quantity update
//         WC()->cart->calculate_totals();
//     }

//     // Handle billing data if provided
//     if ( isset( $_POST['billing_data'] ) && is_array( $_POST['billing_data'] ) ) {
//         $billing_data = $_POST['billing_data'];

//         // Update the billing data (example: update the WooCommerce session or user meta)
//         // For example, saving billing address to session (not recommended for saving permanent data)
//         if ( is_user_logged_in() ) {
//             $user_id = get_current_user_id();
//             update_user_meta( $user_id, '_billing_address', $billing_data );
//         } else {
//             WC()->session->set( 'billing_address', $billing_data );
//         }

//         // Optionally, you could trigger WooCommerce hooks for saving billing info if needed.
//     }

//     // Send a success response back to the frontend
//     wp_send_json_success();
// }

    // Filter to add quantity input and delete icon in classic checkout
add_filter('woocommerce_checkout_cart_item_quantity', 'ts_checkout_item_quantity_input', 10, 3);
function ts_checkout_item_quantity_input($product_quantity, $cart_item, $cart_item_key) {
    $product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
    if (!$product->is_sold_individually()) {
    $product_quantity = '<div class="quantity-and-remove">';
    $product_quantity .= woocommerce_quantity_input(array(
    'input_name' => 'shipping_method_qty_' . $product_id,
    'input_value' => $cart_item['quantity'],
    'max_value' => $product->get_max_purchase_quantity(),
    'min_value' => '0',
    ), $product, false);
    $product_quantity .= '<input type="hidden" name="product_key_' . $product_id . '" value="' . $cart_item_key . '">';
    $product_quantity .= sprintf(
    '<a href="%s" class="delete" title="%s" data-product_id="%s" data-product_sku="%s"><span class="fas fa-trash-alt"></span></a>',
    esc_url(wc_get_cart_remove_url($cart_item_key)),
    __('Remove this item', 'woocommerce'),
    esc_attr($product_id),
    esc_attr($product->get_sku())
    );
    $product_quantity .= '</div>';
    }
return $product_quantity;
}

add_action('woocommerce_checkout_update_order_review', 'ts_update_item_quantity_checkout');
function ts_update_item_quantity_checkout($post_data) {
    parse_str($post_data, $post_data_array);
    $updated_qty = false;
    foreach ($post_data_array as $key => $value) {
    if (substr($key, 0, 20) === 'shipping_method_qty_') {
    $id = substr($key, 20);
    WC()->cart->set_quantity($post_data_array['product_key_' . $id], $post_data_array[$key], false);
    $updated_qty = true;
    }
    }
    if ($updated_qty) WC()->cart->calculate_totals();
}

// Remove default "Place Order" button from the checkout page
// remove_action( 'woocommerce_review_order_before_submit', 'woocommerce_checkout_payment', 20 );
// Add the "Previous Step" button and replace the privacy text

// Add "Previous Step" and "Place Order" buttons before the submit button
add_action( 'woocommerce_review_order_before_submit', 'add_previous_and_place_order_buttons', 10 );

function add_previous_and_place_order_buttons() {
    ?>
    <div class="checkout-buttons">
        <button type="button" id="previous-step" class="button alt"><?php esc_html_e( 'Previous Step', 'woocommerce' ); ?></button>
    <!-- </div> -->
    <?php
}

add_action( 'woocommerce_review_order_after_submit', 'woocommerce_review_order_after_submit', 10 );

function woocommerce_review_order_after_submit() {
    ?>
    </div>
    <?php
}



