<?php
/**
 * Plugin Name: MB Yoast SEO Integration
 * Plugin URI:  https://metabox.io/plugins/meta-box-yoast-seo/
 * Description: Add content of custom fields to Yoast SEO Content Analysis.
 * Author:      MetaBox.io
 * Version:     1.3.10
 * Author URI:  https://metabox.io
 * License:     GPL-2
 */

if ( ! class_exists( 'MB_Yoast_SEO' ) ) {
	require_once __DIR__ . '/class-mb-yoast-seo.php';
	$mb_yoast_seo = new MB_Yoast_SEO;
	add_action( 'rwmb_enqueue_scripts', [ $mb_yoast_seo, 'enqueue' ] );
}