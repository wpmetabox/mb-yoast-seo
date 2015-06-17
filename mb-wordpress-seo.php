<?php
/*
 * Plugin Name: Meta Box WordPress Seo
 * Plugin URI: http://metabox.io
 * Description: Add meta-box fields to WordPress SEO Content Analysis
 * Author: ThaoHa, Rilwis
 * Version: 1.0.0
 * Author URI: http://metabox.io
 */

add_filter( 'rwmb_end_html', array( 'MB_WordPress_Seo', 'mb_html' ), 10, 3 );
add_filter( 'rwmb_before_save_post', array( 'MB_WordPress_Seo', 'mb_save' ) );
add_filter( 'wpseo_pre_analysis_post_content', array( 'MB_WordPress_Seo', 'mb_seo' ), 10, 2 );

if ( ! class_exists( 'MB_WordPress_Seo' ) )
{
	class MB_WordPress_Seo
	{
		/**
		 * Add html
		 *
		 * @param $end
		 * @param $field
		 * @param $meta
		 *
		 * @return string
		 */
		static function mb_html( $end, $field, $meta )
		{
			if ( isset( $field['add_to_wpseo_analysis'] ) && $field['add_to_wpseo_analysis'] == true )
			{
				return $end . '<input type="hidden" name="mb_wp_seo[]" value="' . $field['id'] . '">';
			}

			return $end;
		}

		/**
		 * Save to DB
		 *
		 * @param $postId
		 */
		static function mb_save( $postId )
		{
			$fields = isset( $_POST['mb_wp_seo'] ) ? $_POST['mb_wp_seo'] : array();
			delete_post_meta( $postId, 'mb_wp_seo' );

			foreach ( $fields as $field )
			{
				add_post_meta( $postId, 'mb_wp_seo', $field, false );
			}
		}

		/**
		 * Add field value to seo analysis
		 *
		 * @param $content
		 */
		static function mb_seo( $content, $post )
		{
			global $post;

			$pid = $post->ID;
			$custom = get_post_custom( $pid );
			$fields = ! empty( $custom['mb_wp_seo'] ) ? $custom['mb_wp_seo'] : array();

			foreach ( $fields as $field )
			{
				$customContent = implode( ' ', $custom[$field] );
				$content .= ' ' . $customContent;
			}

			return $content;
		}
	}
}