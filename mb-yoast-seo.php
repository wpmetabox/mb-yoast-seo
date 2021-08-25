<?php
/**
 * Plugin Name: Meta Box for Yoast SEO
 * Plugin URI:  https://metabox.io/plugins/meta-box-yoast-seo/
 * Description: Add content of custom fields to Yoast SEO Content Analysis.
 * Author:      MetaBox.io
 * Version:     1.3.9
 * Author URI:  https://metabox.io
 */

if ( ! class_exists( 'MB_Yoast_SEO' ) ) {
	require_once __DIR__ . '/class-mb-yoast-seo.php';
	$mb_yoast_seo = new MB_Yoast_SEO;
	add_action( 'rwmb_enqueue_scripts', [ $mb_yoast_seo, 'enqueue' ] );
}