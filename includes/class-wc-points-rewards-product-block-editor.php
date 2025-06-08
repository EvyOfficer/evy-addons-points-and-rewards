<?php
/**
 * WooCommerce Points and Rewards
 *
 * @package WC-Points-Rewards/Classes
 */

require_once __DIR__ . '/trait-product-editor-field-strings.php';

use Automattic\WooCommerce\Admin\BlockTemplates\BlockInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Product Block editor class
 *
 * Implements the product block editor fields for points earned and maximum discount.
 *
 * @since 1.8.3
 */
class WC_Points_Rewards_Product_Block_Editor {

	use ProductEditorStringsTrait;

	/**
	 * Add hooks / filters
	 *
	 * @since 1.8.3
	 * @version 1.6.11
	 */
	public function __construct() {
		add_action( 'woocommerce_block_template_area_product-form_after_add_block_product-pricing-group-pricing-columns', array( $this, 'add_block_editor_fields' ) );
	}


	/**
	 * Render simple product points earned / maximum discount fields
	 *
	 * @since 1.8.3
	 * @version 1.6.11
	 *
	 * @param BlockInterface $product_pricing_block BlockInterface instance for pricing block.
	 */
	public function add_block_editor_fields( BlockInterface $product_pricing_block ) {
		$parent          = $product_pricing_block->get_parent();
		$points_columns  = $parent->add_block(
			array(
				'id'        => 'product-points-group-points-columns',
				'blockName' => 'core/columns',
				'order'     => $product_pricing_block->get_order() + 5,
			)
		);
		$points_column_1 = $points_columns->add_block(
			array(
				'id'         => 'product-points-group-points-column-1',
				'blockName'  => 'core/column',
				'order'      => 10,
				'attributes' => array(
					'templateLock' => 'all',
				),
			)
		);
		$points_column_1->add_block(
			array(
				'id'                => 'product-points-regular-points',
				'blockName'         => 'woocommerce/product-text-field',
				'order'             => 10,
				'attributes'        => array(
					'label'    => __( 'Points Earned', 'woocommerce-points-and-rewards' ),
					'property' => 'meta_data._wc_points_earned',
					'pattern'  => array(
						'value'   => '\d+(\.\d+)?%?',
						'message' => __( 'Please enter only a number or percentage.', 'woocommerce-points-and-rewards' ),
					),
					'tooltip'  => $this->get_point_description(),
				),
				'disableConditions' => array(
					array(
						'expression' => 'editedProduct.type === "variable"',
					),
				),
			)
		);
		$points_column_2 = $points_columns->add_block(
			array(
				'id'         => 'product-points-group-points-column-2',
				'blockName'  => 'core/column',
				'order'      => 20,
				'attributes' => array(
					'templateLock' => 'all',
				),
			)
		);
		$points_column_2->add_block(
			array(
				'id'                => 'product-points-max-points',
				'blockName'         => 'woocommerce/product-text-field',
				'order'             => 10,
				'attributes'        => array(
					'label'    => __( 'Maximum Discount', 'woocommerce-points-and-rewards' ),
					'property' => 'meta_data._wc_points_max_discount',
					'tooltip'  => $this->get_max_discount_description(),
					'pattern'  => array(
						'value'   => '\d+(\.\d+)?%?',
						'message' => __( 'Please enter only a number or percentage.', 'woocommerce-points-and-rewards' ),
					),
				),
				'disableConditions' => array(
					array(
						'expression' => 'editedProduct.type === "variable"',
					),
				),
			)
		);
	}
}
