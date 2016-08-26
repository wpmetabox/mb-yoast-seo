<?php
/**
 * Plugin Name: Meta Box for Yoast Seo
 * Plugin URI: https://metabox.io/plugins/meta-box-yoast-seo/
 * Description: Add content of custom fields to Yoast SEO Content Analysis.
 * Author: Rilwis, ThaoHa
 * Version: 1.1.2
 * Author URI: http://www.deluxeblogtips.com
 */

/**
 * Plugin main class.
 */
class MB_Yoast_SEO {
	/**
	 * Add hooks.
	 */
	public function __construct() {
		add_action( 'rwmb_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue plugin script.
	 *
	 * @param object $obj
	 */
	public function enqueue_scripts( $obj ) {
		wp_enqueue_script( 'mb-yoast-seo', plugins_url( 'script.js', __FILE__ ), array(
			'jquery',
			'yoast-seo-post-scraper'
		), '1.1.2', true );

		// Get all field IDs that adds content to Yoast SEO analyzer.
		static $data = array();
		foreach ( $obj->fields as $field ) {
			// If is a group of fields
			if ( isset( $field['fields'] ) ) {
				foreach ( $field['fields'] as $child_field ) {
					if ( isset( $child_field['add_to_wpseo_analysis'] ) && $child_field['add_to_wpseo_analysis'] ) {
						$data[] = $child_field['id'];
					}
				}
			} elseif ( isset( $field['add_to_wpseo_analysis'] ) && $field['add_to_wpseo_analysis'] ) {
				$data[] = $field['id'];
			}
		}

		wp_localize_script( 'mb-yoast-seo', 'MBYoastSEO', $data );
	}
}

new MB_Yoast_SEO;
