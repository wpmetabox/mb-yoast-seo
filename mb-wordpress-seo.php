<?php
/*
 * Plugin Name: Meta Box WordPress Seo
 * Plugin URI: http://metabox.io/plugins/wordpress-seo/
 * Description: Add custom fields to WordPress SEO Content Analysis
 * Author: ThaoHa, Rilwis
 * Version: 1.0
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
		public static function add_custom_field( $content )
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
		            	$value = rwmb_get_value( $field['id'] );
		                $content .= ' ' . $value;
		            }
		        }
		    }

		    return $content;
		}
	}
}
