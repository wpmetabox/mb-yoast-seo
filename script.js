/* global jQuery, YoastSEO, MBYoastSEO */
(function ( $, fields, document ) {
	var module = {
		// Initialize
		init: function () {
			addEventListener( 'load', module.load );

			// For cloned fields: re-bind for new cloned fields
			$( document ).on( 'clone', ':input[class|="rwmb"]', module.bind );
		},

		// Load plugin and add hooks.
		load: function () {
			YoastSEO.app.registerPlugin( 'MetaBox', {status: 'loading'} );
			module.bind();
			YoastSEO.app.pluginReady( 'MetaBox' );
			YoastSEO.app.registerModification( 'content', module.addContent, 'MetaBox', 5 );
		},

		// Add content to Yoast SEO Analyzer.
		addContent: function ( content ) {
			fields.map( function ( fieldId ) {
				content += ' ' + document.getElementById( fieldId ).value;
			} );
			return content;
		},

		// Update Yoast SEO analyzer when fields are updated.
		bind: function () {
			// Use debounce technique, which triggers refresh only when keys stop being pressed.
			var timeout;
			function refresh() {
				clearTimeout( timeout );
				timeout = setTimeout( function () {
					YoastSEO.app.refresh();
				}, 250 );
			}

			// Make sure clone fields are added.
			module.getClonedFields();

			fields.map( function ( fieldId ) {
				document.getElementById( fieldId ).addEventListener( 'keyup', refresh );
			} );
		},

		// Get clone fields.
		getClonedFields: function () {
			fields.map( function ( fieldId ) {
				$( '[id^=' + fieldId + '_]' ).each( function () {
					if ( - 1 === $.inArray( this.id, fields ) ) {
						fields.push( this.id );
					}
				} );
			} );
		}
	};

	// Run on document ready.
	$( module.init );
})( jQuery, MBYoastSEO, document );
