<?php
if ( ! class_exists( 'WC_Abstract_Privacy' ) ) {
	return;
}

class WC_Points_Rewards_Privacy extends WC_Abstract_Privacy {
	/**
	 * Constructor
	 *
	 */
	public function __construct() {
		parent::__construct();
		add_action( 'init', array( $this, 'register_name' ) );
	}

	/**
	 * Register the name of the privacy.
	 */
	public function register_name() {
		$this->name = __( 'Points & Rewards', 'woocommerce-points-and-rewards' );
	}

	/**
	 * Gets the message of the privacy to display.
	 *
	 */
	public function get_privacy_message() {
		/* translators: %s is the privacy policy URL */
		return wpautop( sprintf( __( 'By using this extension, you may be storing personal data or sharing data with an external service. <a href="%s" target="_blank">Learn more about how this works, including what you may want to include in your privacy policy.</a>', 'woocommerce-points-and-rewards' ), 'https://woocommerce.com/document/marketplace-privacy/#woocommerce-points-and-rewards' ) );
	}
}

new WC_Points_Rewards_Privacy();
