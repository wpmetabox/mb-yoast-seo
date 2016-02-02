<?php
/**
 * Plugin Name: Meta Box for Yoast Seo
 * Plugin URI: https://metabox.io/plugins/meta-box-yoast-seo/
 * Description: Add content of custom fields to Yoast SEO Content Analysis.
 * Author: Rilwis, ThaoHa
 * Version: 1.1.0
 * Author URI: http://www.deluxeblogtips.com
 */

/**
 * Plugin main class.
 */
class MB_Yoast_SEO
{
	/**
	 * Add hooks.
	 */
	public function __construct()
	{
		add_action( 'rwmb_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue plugin script.
	 * @param RW_Meta_Box $obj
	 */
	public function enqueue_scripts( RW_Meta_Box $obj )
	{
		wp_enqueue_script( 'mb-yoast-seo', plugins_url( 'script.js', __FILE__ ), array( 'jquery', 'yoast-seo' ), '', true );

		// Get all field IDs that adds content to Yoast SEO analyzer.
		static $data = array();
		foreach ( $obj->fields as $field )
		{
			if ( isset( $field['add_to_wpseo_analysis'] ) && $field['add_to_wpseo_analysis'] )
			{
				$data[] = $field['id'];
			}
		}
		wp_localize_script( 'mb-yoast-seo', 'MBYoastSEO', $data );
	}
}

new MB_Yoast_SEO;
