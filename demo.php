<?php
add_filter( 'rwmb_meta_boxes', function ( $meta_boxes ) {
	$meta_boxes[] = [
		'title'  => 'Test Yoast SEO',
		'fields' => [
			[
				'id'                    => 'text',
				'name'                  => 'Text',
				'type'                  => 'textarea',
				'add_to_wpseo_analysis' => true,
			],
			[
				'id'                    => 'text_clone',
				'name'                  => 'Text Clone',
				'type'                  => 'textarea',
				'clone'                 => true,
				'add_to_wpseo_analysis' => true,
			],
			[
				'id'     => 'group',
				'name'   => 'Group',
				'type'   => 'group',
				'fields' => [
					[
						'id'                    => 'text2',
						'name'                  => 'Text',
						'type'                  => 'textarea',
						'add_to_wpseo_analysis' => true,
					],
					[
						'id'                    => 'text_clone2',
						'name'                  => 'Text Clone',
						'type'                  => 'textarea',
						'add_to_wpseo_analysis' => true,
					],
				],
			],
		],
	];

	return $meta_boxes;
} );