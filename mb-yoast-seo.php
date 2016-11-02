<?php
/**
 * Plugin Name: Meta Box for Yoast Seo
 * Plugin URI: https://metabox.io/plugins/meta-box-yoast-seo/
 * Description: Add content of custom fields to Yoast SEO Content Analysis.
 * Author: Rilwis, ThaoHa
 * Version: 1.2
 * Author URI: http://www.deluxeblogtips.com
 */

/**
 * Plugin main class.
 */
class MB_Yoast_SEO {
	/**
	 * Store IDs of fields that need to analyze content.
	 * @var array
	 */
	protected $fields = array();

	/**
	 * Enqueue plugin script.
	 *
	 * @param RW_Meta_Box $meta_box The meta box object.
	 */
	public function enqueue( RW_Meta_Box $meta_box ) {
		wp_enqueue_script( 'mb-yoast-seo', plugins_url( 'script.js', __FILE__ ), array(
			'jquery',
			'yoast-seo-post-scraper',
		), '1.1.2', true );

		// Get all field IDs that adds content to Yoast SEO analyzer.
		$this->add_fields( $meta_box->fields );

		// Send list of fields to JavaScript.
		wp_localize_script( 'mb-yoast-seo', 'MBYoastSEO', $this->fields );
	}

	/**
	 * Add group of fields.
	 *
	 * @param array $fields Array of fields.
	 */
	protected function add_fields( $fields ) {
		array_walk( $fields, array( $this, 'add_field' ) );
	}

	/**
	 * Add a single field.
	 *
	 * @param array $field Field parameters.
	 */
	protected function add_field( $field ) {
		// Add sub-fields recursively.
		if ( isset( $field['fields'] ) ) {
			$this->add_fields( $field['fields'] );
		}

		// Add the single field.
		if ( $this->isAnalyzable( $field ) ) {
			$this->fields[] = $field['id'];
		}
	}

	/**
	 * Check if field content is analyzable by Yoast SEO.
	 *
	 * @param array $field Field parameters.
	 *
	 * @return bool
	 */
	protected function isAnalyzable( $field ) {
		return ! in_array( $field['id'], $this->fields ) && isset( $field['add_to_wpseo_analysis'] ) && $field['add_to_wpseo_analysis'];
	}
}

$mb_yoast_seo = new MB_Yoast_SEO;
add_action( 'rwmb_enqueue_scripts', array( $mb_yoast_seo, 'enqueue' ) );