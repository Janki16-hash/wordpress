<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}
?>
<div id="checkout-progress-bar">
    <div id="progress-bar" style="width: 50%;"></div> 

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

    <div id="step-1" class="checkout-step">
        <h3><?php esc_html_e( 'Billing Information', 'woocommerce' ); ?></h3>
        <?php

        do_action( 'woocommerce_checkout_billing' );
        ?>
        <button type="button" id="next-step" class="button alt"><?php esc_html_e( 'Next Step', 'woocommerce' ); ?></button>
    </div>
    <!-- </div> -->

	<!-- <form name="shiping" method="post" class="shiping woocommerce-shiping" >" enctype="multipart/form-data"> -->

    <div id="step-2" class="checkout-step" style="display: none;">
        <h3><?php esc_html_e( 'Shipping Information', 'woocommerce' ); ?></h3>
        <?php
      
        do_action( 'woocommerce_checkout_shipping' );
        ?>

        <h3><?php esc_html_e( 'Your Order', 'woocommerce' ); ?></h3>
        <div id="order_review" class="woocommerce-checkout-review-order">
            <?php do_action( 'woocommerce_checkout_order_review' ); ?>
        </div>
        <?php

        do_action( 'woocommerce_checkout_payment' );
        ?>
		 <!-- <div class="checkout-buttons">
		  <button type="button" id="previous-step" class="button alt">Previous Step</button> -->
		    <!-- </div> -->
    </div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
