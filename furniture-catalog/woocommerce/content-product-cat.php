<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="col-lg-4 col-md-6 mt-5 project-entry" style=""> <!-- max-height: 250px; overflow: hidden; -->
	
	<h3 class="mb-3">
		<?php
			/**
			 * The woocommerce_shop_loop_subcategory_title hook.
			 *
			 * @hooked woocommerce_template_loop_category_title - 10
			 */
			do_action( 'woocommerce_shop_loop_subcategory_title', $category );
		?>
	</h3>
	<?php
		/**
		 * The woocommerce_before_subcategory hook.
		 *
		 * @hooked woocommerce_template_loop_category_link_open - 10
		 */
		do_action( 'woocommerce_before_subcategory', $category );
	?>
	<div class="d-block figure rounded shadow" style="" onClick="galleryOn('num1');">
		<?php
		/**
		 * The woocommerce_before_subcategory_title hook.
		 *
		 * @hooked woocommerce_subcategory_thumbnail - 10
		 */
		do_action( 'woocommerce_before_subcategory_title', $category );
		?>
	</div>
	<?php
		/**
		 * The woocommerce_after_subcategory hook.
		 *
		 * @hooked woocommerce_template_loop_category_link_close - 10
		 */
		do_action( 'woocommerce_after_subcategory', $category );
	?>
</div>

	<?php
	/**
	 * The woocommerce_after_subcategory_title hook.
	 */
	//do_action( 'woocommerce_after_subcategory_title', $category );

	
	?>
