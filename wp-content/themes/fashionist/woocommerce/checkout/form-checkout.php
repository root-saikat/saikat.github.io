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
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'fashionist' ) );
	return;
}

?>
<div class="content" id="checkout">
	<div class="container">
		<div class="row">
			<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

				<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

					<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

					<div class="row" id="customer_details">
						<div class="col-md-6">
							<?php do_action( 'woocommerce_checkout_billing' ); ?>
						</div>

						<div class="col-md-6">
							<?php do_action( 'woocommerce_checkout_shipping' ); ?>
						</div>
					</div>

					<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				<?php endif; ?>
				
				<div class="margin-top-30px"></div>
				<div class="row">
					<div class="col-md-12">
						<div class="cart-totals">				
								<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
								<div id="order_review" class="woocommerce-checkout-review-order">
									<div class="row">
										<div class="col-md-6">
											<div class="cart-totals">
											<div class="col-md-12">
												<span class="title"><?php esc_html_e( 'Cart totals', 'fashionist' ); ?></span>
											</div>	
											<?php woocommerce_order_review(); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="payment">
											<span class="title"><?php esc_html_e( 'Payment method', 'fashionist' ); ?></span>
											<?php woocommerce_checkout_payment(); //do_action( 'woocommerce_checkout_order_review' ); ?>
											</div>
										</div>
									</div>
								</div>
								<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>				
						</div>
					</div>
				</div>			

			</form>
		</div>
	</div>
</div>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
