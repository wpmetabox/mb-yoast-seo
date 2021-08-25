/* global jQuery, YoastSEO, MBYoastSEO */
( ( $, fields, rwmb, document ) => {
	/**
	 * The analyze module for Yoast SEO.
	 */
	var module = {
		timeout: undefined,

		// Load plugin and add hooks.
		load: () => {

			// Make sure clone fields are added.
			getClonedFields();

			// Update Yoast SEO analyzer when fields are updated.
			fields.map( module.listenToField );

			YoastSEO.app.registerPlugin( 'MetaBox', { status: 'loading' } );
			YoastSEO.app.pluginReady( 'MetaBox' );
			YoastSEO.app.registerModification( 'content', module.addContent, 'MetaBox', 5 );

			// Make the Yoast SEO analyzer works for existing content when page loads.
			module.update();
		},

		onClone: () => {
			setTimeout( () => {

				// Make sure clone fields are added.
				getClonedFields();

				// Update SEO By Rank Math analyzer when fields are updated.
				fields.map( module.listenToField );

			}, 500 );
		},
		// Add content to Yoast SEO Analyzer.
		addContent: ( content ) => {
			fields.map( ( fieldId ) => {
				content += ' ' + getFieldContent( fieldId );
			} );
			return content;
		},

		// Listen to field change and update Yoast SEO analyzer.
		listenToField: ( fieldId ) => {
			if ( isEditor( fieldId ) ) {
				tinymce.get( fieldId ).on( 'keyup', module.update );
				return;
			}
			var field = document.getElementById( fieldId );
			if ( field ) {
				field.addEventListener( 'keyup', module.update );
			}
		},

		// Update the YoastSEO result. Use debounce technique, which triggers only when keys stop being pressed.
		update: () => {
			clearTimeout( module.timeout );
			module.timeout = setTimeout( () => {
				YoastSEO.app.refresh();
			}, 250 );
		},

		/**
		 * Add new cloned field to the list and listen to its change.
		 */
		addNewField: () => {
			if ( -1 === fields.indexOf( this.id ) ) {
				fields.push( this.id );
				module.listenToField( this.id );
			}
		}
	};

	/**
	 * Get clone fields.
	 */
	getClonedFields = () => {
		fields.map( ( fieldId ) => {
			var elements = document.querySelectorAll( '[id^=' + fieldId + '_]' );
			Array.prototype.forEach.call( elements, ( element ) => {
				if ( -1 === fields.indexOf( element.id ) ) {
					fields.push( element.id );
				}
			} );
		} );
	};

	/**
	 * Get field content.
	 * Works for normal inputs and TinyMCE editors.
	 *
	 * @param fieldId The field ID
	 * @returns string
	 */
	getFieldContent = ( fieldId ) => {
		var field = document.getElementById( fieldId );
		if ( field ) {
			var content = isEditor( fieldId ) ? tinymce.get( fieldId ).getContent() : field.value;
			return content ? content : '';
		}
		return '';
	};

	/**
	 * Check if the field is a TinyMCE editor.
	 *
	 * @param fieldId The field ID
	 * @returns boolean
	 */
	isEditor = fieldId => typeof tinymce !== 'undefined' && tinymce.get( fieldId ) !== null;

	// Run on document ready.
	if ( typeof YoastSEO !== "undefined" && typeof YoastSEO.app !== "undefined" ) {
		$( module.load );
	} else {
		$( window ).on(
			"YoastSEO:ready",
			() => {
				$( module.load );
			}
		);
	}
	// Run on add/remove clone fields
	rwmb.$document
		.on( 'click', '.add-clone', module.onClone )
		.on( 'click', '.remove-clone', module.onClone );
} )( jQuery, MBYoastSEO, rwmb, document );
