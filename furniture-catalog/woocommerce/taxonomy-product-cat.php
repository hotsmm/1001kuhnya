<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Выбераем шаблон для категории
$product_cat = get_queried_object();
if ( $product_cat->name == 'Шкафы-купе' ) {
	wc_get_template( 'archive-product-shkafy-cupe.php' );
} else if ( ( $product_cat->name == 'Кухни' ) or ( $product_cat->name == 'Новинки' ) or ( $product_cat->name == 'Кухни из пленки' ) or ( $product_cat->name == 'Кухни из эмали' ) or ( $product_cat->name == 'Кухни из пластика' ) or ( $product_cat->name == 'Кухни AGT' ) or ( $product_cat->name == 'Кухни из массива' ) ) {
	wc_get_template( 'archive-kitchens.php' );
} else {
	wc_get_template( 'archive-product.php' );
}
