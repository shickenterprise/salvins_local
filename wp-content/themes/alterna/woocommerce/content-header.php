<?php
/**
 * The template for displaying header menu
 */
global $woocommerce;

?>
<div class="wc-header">
	<div class="wc-login">
		<?php if ( is_user_logged_in() ) { ?>
		<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e( 'View your account', 'alterna' ); ?>"><?php 
			global $current_user;
            get_currentuserinfo();
            if($current_user->user_firstname)
				echo __('Welcome, ','alterna') . $current_user->user_firstname;
            elseif($current_user->display_name)
				echo __('Welcome, ','alterna') . $current_user->display_name;
		?></a>&nbsp;&nbsp;<?php _e('|','alterna'); ?>&nbsp;&nbsp;<a href="<?php echo wp_logout_url(get_permalink()); ?>"><?php _e('Log out','alterna'); ?></a>
		<?php }	else { ?>
		<a class="wc-login-in" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e( 'Login', 'alterna' ); ?>"><?php _e( 'Login', 'alterna' ); ?></a>
		<?php } ?>
    </div>
    <div class="wc-cart">
    <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'alterna' ); ?>"><i class="icon-shopping-cart icon-large"></i><?php echo sprintf( _n( '%d item in cart - ', '%d items in cart - ', $woocommerce->cart->cart_contents_count, 'alterna' ), $woocommerce->cart->cart_contents_count); ?><?php echo $woocommerce->cart->get_cart_total(); ?></a>
    </div>
</div>