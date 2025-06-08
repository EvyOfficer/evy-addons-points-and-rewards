<?php
/**
 * WordPress Plugin Uninstall
 *
 * Uninstalling WordPress Plugin.
 */

// if uninstall.php is not called by WordPress, die
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

// Get the "Delete plugin data" settings.
$delete_plugin_data = get_option( 'wc_points_rewards_delete_plugin_data' );

if ( 'yes' === $delete_plugin_data ) {
	// Delete the plugin settings.
	// These are found from wp_options table, ordered by option_id.
	delete_option( 'wc_points_rewards_version' );
	delete_option( 'wc_points_rewards_earn_points_ratio' );
	delete_option( 'wc_points_rewards_earn_points_rounding' );
	delete_option( 'wc_points_rewards_redeem_points_ratio' );
	delete_option( 'wc_points_rewards_partial_redemption_enabled' );
	delete_option( 'wc_points_rewards_cart_min_discount' );
	delete_option( 'wc_points_rewards_cart_max_discount' );
	delete_option( 'wc_points_rewards_max_discount' );
	delete_option( 'wc_points_rewards_points_tax_application' );
	delete_option( 'wc_points_rewards_points_label' );
	delete_option( 'wc_points_rewards_single_product_message' );
	delete_option( 'wc_points_rewards_variable_product_message' );
	delete_option( 'wc_points_rewards_earn_points_message' );
	delete_option( 'wc_points_rewards_redeem_points_message' );
	delete_option( 'wc_points_rewards_thank_you_message' );
	delete_option( 'wc_points_rewards_points_expire_points_since' );
	delete_option( 'wc_points_rewards_points_expiry' );
	delete_option( 'wc_points_rewards_account_signup_points' );
	delete_option( 'wc_points_rewards_write_review_points' );

	// Delete the users' points and points log.
	global $wpdb;
	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wc_points_rewards_user_points" );
	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wc_points_rewards_user_points_log" );

	// Delete the point settings for products and coupons.
	delete_post_meta_by_key( '_wc_points_earned' );
	delete_post_meta_by_key( '_wc_points_max_discount' );
	delete_post_meta_by_key( '_wc_points_modifier' );
	delete_post_meta_by_key( '_wc_points_renewal_points' );
	delete_post_meta_by_key( '_wc_points_include_bundled_product_points' );
	delete_post_meta_by_key( '_wc_max_points_earned' );
	delete_post_meta_by_key( '_wc_min_points_earned' );

	// Delete the point settings for product categories.
	delete_metadata( 'term', 0, '_wc_points_earned', '', true );
	delete_metadata( 'term', 0, '_wc_points_max_discount', '', true );
	delete_metadata( 'term', 0, '_wc_points_renewal_points', '', true );

	// Delete points for product reviews.
	delete_metadata( 'comment', 0, 'wc_points_reward_points_rewarded', '', true );

	// Delete the "Delete plugin data" settings last.
	delete_option( 'wc_points_rewards_delete_plugin_data' );
}
