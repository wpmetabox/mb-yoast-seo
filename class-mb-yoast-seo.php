<?php
class MB_Yoast_SEO {
	/**
	 * Store IDs of fields that need to analyze content.
	 *
	 * @var array
	 */
	protected $fields = array();

	/**
	 * Enqueue plugin script.
	 *
	 * @param RW_Meta_Box $meta_box The meta box object.
	 */
	public function enqueue( RW_Meta_Box $meta_box ) {
		if ( ! defined( 'WPSEO_VERSION' ) ) {
			return;
		}

		// Only for posts.
		if ( !function_exists( 'get_current_screen' ) ) {
			return;
		}
		$screen = get_current_screen();
		if ( ! is_object( $screen ) || 'post' !== $screen->base ) {
			return;
		}

		// Get all field IDs that adds content to Yoast SEO analyzer.
		$this->add_fields( $meta_box->fields );

		if ( empty( $this->fields ) ) {
			return;
		}

		// Use helper function to get correct URL to current folder, which can be used in themes/plugins.
		list( , $url ) = RWMB_Loader::get_path( dirname( __FILE__ ) );
		wp_enqueue_script( 'mb-yoast-seo', $url . 'script.js', array( 'jquery', 'rwmb' ), '1.3.2', true );

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
		if ( empty( $field['id_attr'] ) ) {
			$field['id_attr'] = $field['id'];
		}

		// Add sub-fields recursively.
		if ( isset( $field['fields'] ) ) {
			foreach ( $field['fields'] as &$sub_field ) {
				$sub_field['id_attr'] = $field['id_attr'] . '_' . $sub_field['id'];
			}
			$this->add_fields( $field['fields'] );
		}

		// Add the single field.
		if ( $this->is_analyzable( $field ) ) {
			$this->fields[] = $field['id_attr'];
		}
	}

	/**
	 * Check if field content is analyzable by Yoast SEO.
	 *
	 * @param array $field Field parameters.
	 *
	 * @return bool
	 */
	protected function is_analyzable( $field ) {
		return ! in_array( $field['id'], $this->fields, true ) && ! empty( $field['add_to_wpseo_analysis'] );
	}
}
