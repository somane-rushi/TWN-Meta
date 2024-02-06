var MultilingualPress = window.MultilingualPress || {};
var MultilingualPressRedirectorSettings = window.MultilingualPressRedirectorSettings || {};

MultilingualPress.RedirectorSettings = MultilingualPressRedirectorSettings;
delete window.MultilingualPressRedirectorSettings;

languageManager = window.languageManager || {};

( function ( $, M, ajaxurl, languageManager ) {

	'use strict';

	/**
	 * MultilingualPress Language Manager
	 *
	 * @constructor
	 */
	M.LanguageManager = function () {

		var init;
		var $table;

		var $latestRow;
		var languageNameRegExp = /\[(\d+)\]/i;
		var languageIdRegExp = /-(\d+)-/i;
		var negativeLanguageNameRegExp = /\[-(\d+)\]/i;

		/**
		 * Create a new language row.
		 *
		 * @returns {*|HTMLElement}
		 */
		var createNewLanguageButton = function () {
			var button = $(
				'<p class="mlp-new-language"><button class="button">' + languageManager.newLanguageButtonLabel + '</button></p>'
			);

			button.insertAfter( $table );

			return button;
		};

		/**
		 * Create a language delete action button.
		 *
		 * @returns {*|HTMLElement}
		 */
		var createLanguageDeletor = function () {
			var $deletor = $(
				'<td data-label="Deletor"><button class="mlp-language-deletor button dashicons dashicons-trash" data-action="delete"><span class="screen-reader-text">' + languageManager.languageDeleteButtonLabel + '</span></button></td>'
			);
			var deletorHead = $(
				'<th scope="col" data-label="Deletor">' + languageManager.languageDeleteTableHeadLabel + '</th>'
			);

			$table.find( 'thead > tr th:last-of-type' ).after( deletorHead.clone() );
			$table.find( 'tfoot > tr th:last-of-type' ).after( deletorHead.clone() );
			$table.find( 'tbody > tr td:last-of-type' ).after( $deletor );

			return $( '.mlp-language-deletor' );
		};

		/**
		 * Clone the latest table so it's possible to add more than one language at a time.
		 *
		 * @returns void
		 */
		var cloneLatestTableRow = function () {
			var $clone = $latestRow.clone();
			$clone
				.hide()
				.insertAfter( $latestRow );

			$latestRow = $clone;

			$latestRow.find( 'input' ).each( function ( index, input ) {
				$( input ).val( '' );
				$( input ).removeAttr( 'checked' );
			} );
		};

		/**
		 * @returns void
		 */
		var hideLatestTableRow = function () {
			$latestRow && $latestRow.hide();
		};

		/**
		 * @returns void
		 */
		var showLatestTableRow = function () {
			$latestRow && $latestRow.show();
		};

		/**
		 * Get the next language id to create the new language item.
		 *
		 * @returns {number}
		 */
		var nextLanguageId = function () {
			var invalidId = -1;
			var input = $latestRow.find( 'input' );

			if ( !input ) {
				return invalidId;
			}

			var regexp = ( new RegExp( languageNameRegExp ) ).exec( input[0].getAttribute( 'name' ) );

			return Array.isArray( regexp ) ? ++regexp[1] : invalidId;
		};

		/**
		 * @param $inputs
		 * @param number
		 */
		var incrementLanguageId = function ( $inputs, number ) {
			$inputs.each( function ( index, input ) {
				var nameAttribute = input.getAttribute( 'name' );
				var idAttribute = input.getAttribute( 'id' );
				input.setAttribute(
					'name',
					nameAttribute.replace( languageNameRegExp, '[' + number + ']' )
				);
				input.setAttribute(
					'id',
					idAttribute.replace( languageIdRegExp, '-' + number + '-' )
				);
			} );
		};

		/**
		 * Negative numbers means the language will be deleted from the database, positive numbers
		 * means language will be updated or created.
		 *
		 * @param $inputs
		 * @param positive
		 */
		var changeSignToLanguageId = function ( $inputs, positive ) {
			$inputs.each( function ( index, input ) {
				var nameAttribute = input.getAttribute( 'name' );
				input.setAttribute(
					'name',
					nameAttribute.replace(
						positive ? negativeLanguageNameRegExp : languageNameRegExp,
						positive ? '[$1]' : '[-$1]'
					)
				);
			} );
		}

		/**
		 * @returns void
		 */
		var addLanguage = function () {
			showLatestTableRow();

			var nextId = nextLanguageId();
			if ( -1 === nextId ) {
				return;
			}

			cloneLatestTableRow();
			incrementLanguageId( $latestRow.find( 'input' ), nextId );
		};

		/**
		 * @param $deletor
		 */
		var deleteUndoLanguage = function ( $deletor ) {
			if ( !$deletor ) {
				return;
			}

			var $row = $deletor.parents( 'tr' );
			if ( !$row ) {
				return;
			}

			var $undo = $deletor.attr( 'data-action' ) === 'undo';
			var callback = $undo
				? function ( index, input ) {
					$( input )
						.removeAttr( 'readonly' )
						.css( 'opacity', 1 );
				}
				: function ( index, input ) {
					$( input )
						.attr( 'readonly', 'readonly' )
						.css( 'opacity', .2 );
				};
			var label = $undo
				? languageManager.languageDeleteButtonLabel
				: languageManager.languageUndoDeleteButtonLabel;

			var $inputs = $row.find( 'input' );
			$inputs.each( callback );

			$deletor
				.attr( 'data-action', $undo ? 'delete' : 'undo' )
				.find( 'span' )
				.text( label );

			$row
				.find( 'button' )
				.toggleClass( 'dashicons-undo dashicons-trash' );

			changeSignToLanguageId( $inputs, $undo );
		};

		/**
		 * @returns void
		 */
		var setupAutocomplete = function () {
			window.addEventListener( 'load', function () {
				$table.find( '.ui-autocomplete-input' ).on( "autocompleteselect", function ( event, ui ) {
					var item = 'item' in ui && ui.item;
					var language = 'language' in item && item.language;
					var $input = $( this );

					if ( !language ) {
						return;
					}

					// Let LanguageSearch do his stuffs before.
					setTimeout( function () {
						fillNewLanguageField( $input.parents( 'tr' ), language );
					}, 0 );
				} );
			} );
		};

		/**
		 * @param $container
		 * @param language
		 */
		var fillNewLanguageField = function ( $container, language ) {
			$container.find( '.native-name' ).val( language.nativeName );
			$container.find( '.english-name' ).val( language.englishName );
			$container.find( '.iso-639-1' ).val( language.iso639Code1 );
			$container.find( '.iso-639-2' ).val( language.iso639Code2 );
			$container.find( '.iso-639-3' ).val( language.iso639Code3 );
			$container.find( '.iso-639-3' ).val( language.iso639Code3 );
			$container.find( '.locale' ).val( language.locale );
			$container.find( '.http-code' ).val( language.httpCode );

			language.isRtl
				? $container.find( '.is-rtl' ).attr( 'checked', 'checked' )
				: $container.find( '.is-rtl' ).removeAttr( 'checked' );
		};

		/**
		 * @returns {M}
		 */
		this.init = function () {

			if ( init ) {
				return this;
			}

			$table = $( '#mlp-language-manager-table' );
			if ( !$table ) {
				return this;
			}

			$latestRow = $table.find( 'tbody tr:last-of-type' );

			hideLatestTableRow( $latestRow );

			var $deletor = createLanguageDeletor();
			$deletor.live( 'click', function ( evt ) {
				evt.preventDefault();
				evt.stopPropagation();

				deleteUndoLanguage( $( this ) );
			} );

			var $button = createNewLanguageButton( $table );
			$button.click( function ( evt ) {
				evt.preventDefault();
				evt.stopPropagation();

				addLanguage();
			} );

			setupAutocomplete();

			init = true;

			return this;
		};
	};

}( jQuery, MultilingualPress, ajaxurl, languageManager ) );( function ( $, M, ajaxurl ) {

	'use strict';

	/**
	 * @param {jQuery} $langInput
	 * @constructor
	 */
	M.LanguageSearch = function ( $langInput ) {

		var init = false;
		var $row;
		var $tagInput;
		var $currentSelection;
		var $removeSelection;
		var noneLabel;
		var cache = {};

		/**
		 * Send AJAX request and call given response callback with the results.
		 *
		 * @param {string} searchQuery
		 * @param {function} responseCallback
		 */
		var sendSearchRequest = function ( searchQuery, responseCallback ) {

			$.ajax( {
				url: ajaxurl,
				method: 'POST',
				dataType: 'json',
				data: {
					action: $langInput.data( 'action' ),
					search: searchQuery
				}
			} )
				.done( function ( data ) {
					if ( data.success && data.data && $.isArray( data.data ) ) {
						cache[searchQuery] = data.data;

						return responseCallback( data.data );
					}

					return [];
				} )
				.fail( function () {

					return responseCallback( [] );
				} );
		};

		/**
		 * Init the class by setting events callbacks on the jQuery element.
		 *
		 * @return {MultilingualPress.NewSiteLanguage}
		 */
		this.init = function () {

			if ( !init ) {
				$row = $langInput.closest( 'td' );
				$tagInput = $( $langInput.data( 'connected' ) );
				$currentSelection = $row.find( '.current-selection' );
				$removeSelection = $row.find( '.remove-selection' );
				noneLabel = $langInput.data( 'none' );

				$langInput.autocomplete( {
					minLength: 2,
					select: function ( event, ui ) {
						$currentSelection && $currentSelection.text( ui.item.label );
						$tagInput && $tagInput.val( ui.item.value );
						$removeSelection && $removeSelection.show();
						$( this ).val( '' );

						return false;
					},
					source: function ( request, response ) {
						if ( request.term in cache ) {
							response( cache[request.term] );

							return;
						}

						sendSearchRequest( request.term, response );
					}
				} );

				$removeSelection.click( function ( e ) {
					e.preventDefault();
					$currentSelection.text( noneLabel );
					$tagInput.val( '' );
					$langInput.val( '' );
					$removeSelection.hide();
				} );

				init = true;
			}

			return this;
		};
	};

}( jQuery, MultilingualPress, ajaxurl ) );
( function ( $, M, adminpage ) {

	'use strict';

	$( function () {

		var languageSearch;
		var languageManager;

		if ( adminpage === 'multilingualpress_page_language-manager' ) {
			languageManager = new M.LanguageManager();
			languageManager.init();
			languageSearch = new M.LanguageSearch( $( '#mlp-language-manager-table' ).find( 'td:first-child' ).find( 'input' ) );
			languageSearch.init();
		}
	} );

}( jQuery, MultilingualPress, adminpage ) );
