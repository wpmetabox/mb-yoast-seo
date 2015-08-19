<?php
/*
 * Plugin Name: Meta Box Yoast Seo
 * Plugin URI: https://metabox.io/plugins/meta-box-yoast-seo/
 * Description: Add content of custom fields to Yoast SEO Content Analysis.
 * Author: Rilwis, ThaoHa
 * Version: 1.0
 * Author URI: http://metabox.io
 */

add_filter( 'wpseo_pre_analysis_post_content', 'mb_wpseo_add_fields_to_analysis', 10, 2 );

/**
 * Add field value to seo analysis
 *
 * @param string  $content Post content
 * @param WP_Post $post    Post object
 *
 * @return string
 */
function mb_wpseo_add_fields_to_analysis( $content, $post )
{
	static $meta_boxes = null;
	if ( null === $meta_boxes )
	{
		$meta_boxes = apply_filters( 'rwmb_meta_boxes', array() );
	}

	foreach ( $meta_boxes as $meta_box )
	{
		foreach ( $meta_box['fields'] as $field )
		{
			if ( isset( $field['add_to_wpseo_analysis'] ) && $field['add_to_wpseo_analysis'] )
			{
				$value = rwmb_get_field( $field['id'], '', $post->ID );
				$content .= ' ' . $value;
			}
		}
	}

	return $content;
}
