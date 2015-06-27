<?php
/*
 * Plugin Name: Meta Box WordPress Seo
 * Plugin URI: http://metabox.io
 * Description: Add meta-box fields to WordPress SEO Content Analysis
 * Author: ThaoHa, Rilwis
 * Version: 1.0.0
 * Author URI: http://metabox.io
 */

add_filter( 'wpseo_pre_analysis_post_content', array( 'MB_WordPress_Seo', 'add_custom_field' ) );

if ( ! class_exists( 'MB_WordPress_Seo' ) )
{
	class MB_WordPress_Seo
	{
		/**
		 * Add field value to seo analysis
		 *
		 * @param $content
		 */
		static function add_custom_field( $content )
		{
			$meta_boxes = apply_filters( 'rwmb_meta_boxes', array() );

		    foreach ( $meta_boxes as $meta_box )
		    {
		        foreach ( $meta_box['fields'] as $field )
		        {
		            if ( isset( $field['add_to_wpseo_analysis'] ) && $field['add_to_wpseo_analysis'] )
		            {
		            	$value = rwmb_meta( $field['id'], $field['type'] );
		            	$value = is_array( $value ) ? implode( ' ', $value ) : $value;
		                $content .= ' ' . $value;
		            }
		        }
		    }

		    return $content;
		}
	}
}