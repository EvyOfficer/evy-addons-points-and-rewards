<?php

trait ProductEditorStringsTrait {

	public function get_point_description() {
		return __( 'This can be either a fixed number of points earned for purchasing this product, or a percentage which assigns points based on the price. For example, if you want to award points equal to double the normal rate, enter 200%.  This setting modifies the global Points Conversion Rate and overrides any category value.  Use 0 to assign no points for this product, and empty to use the global/category settings.', 'woocommerce-points-and-rewards' );
	}

	public function get_max_discount_description() {
		return __( 'Enter either a fixed maximum discount amount or percentage which restricts the amount of points that can be redeemed for a discount based on the product price. For example, if you want to restrict the discount on this product to a maximum of 50%, enter 50%, or enter 5 to restrict the maximum discount to $5.  This setting overrides the global/category defaults, use 0 to disable point discounts for this product, and blank to use the global/category default.', 'woocommerce-points-and-rewards' );
	}
}
