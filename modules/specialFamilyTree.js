jQuery( function ( $ ) {
	function initAutocomplete() {
		$( 'input.smg-input-page' ).autocomplete( {
			source: function ( request, response ) {
				$.getJSON(
					mw.util.wikiScript( 'api' ), {
						action: 'opensearch',
						search: request.term
					}, function ( data ) {
						if ( Array.isArray( data ) && 1 in data ) {
							response( $.map( data[ 1 ], function ( item ) {
								return {
									label: item,
									value: item
								};
							} ) );
						}
					}
				);
			},
			minLength: 2,
			select: function ( event, ui ) {
				this.value = ui.item.value;
			}
		} );
	}

	function showFields() {
		if ( $( 'select#type' ).val() == 'link' ) {
			$( 'tr#smg-form-entry-gen' ).hide();
			$( 'tr#smg-form-entry-page2' ).show();
		} else {
			$( 'tr#smg-form-entry-gen' ).show();
			$( 'tr#smg-form-entry-page2' ).hide();
		}
	}

	showFields();
	initAutocomplete();
	$( 'select#type' ).on( 'change', function () {
		showFields();
	} );
} );
