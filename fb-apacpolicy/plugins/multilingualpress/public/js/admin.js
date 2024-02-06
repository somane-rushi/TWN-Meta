var MultilingualPress = window.MultilingualPress || {};
var MultilingualPressRedirectorSettings = window.MultilingualPressRedirectorSettings || {};

MultilingualPress.RedirectorSettings = MultilingualPressRedirectorSettings;
delete window.MultilingualPressRedirectorSettings;

( function ( $, M, ajaxurl ) {

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

( function ( $, M, ajaxurl ) {

	'use strict';

	/**
	 * @param {jQuery} $langInput
	 * @param {jQuery} $menuToEdit
	 * @param {jQuery} $menuInput
	 * @constructor
	 */
	M.NavMenu = function ( $submitButton, $menuToEdit, $menuInput ) {

		var init = false;
		var $languageInputs;
		var $selectAll;
		var $spinner;

		/**
		 * Shows or hide the spinner.
		 *
		 * @param {bool} enable
		 */
		var spinner = function ( enable ) {

			$spinner.css( 'visibility', enable ? 'visible' : 'hidden' );
		};

		/**
		 * The currently selected languages.
		 *
		 * @return {number[]}
		 */
		var languageIds = function () {

			var langIds = [];
			$languageInputs.filter( ':checked' ).each( function () {
				langIds.push( Number( $( this ).val() || 0 ) );
			} );

			return langIds;
		};

		/**
		 * Enable or disable the sumbit button based on languages being selected.
		 */
		var updateSumbit = function () {

			$submitButton.prop( 'disabled', ! ( $menuToEdit.length && languageIds().length ) );
		};

		/**
		 * Executes on AJAX error.
		 */
		var onAjaxError = function () {

			alert( 'AJAX error.' );
		};

		/**
		 * Executes on AJAX success and append the menu markup received via AJAX, which is passed as parameter,
		 * to the current menu.
		 *
		 * @param {jQuery} $menu
		 */
		var onAjaxSuccess = function ( $menu ) {

			if ( ! $menu.length ) {
				onAjaxError();

				return;
			}

			$menuToEdit.append( $menu );
		};

		/**
		 * @param {number[]} ids
		 * @return {{action, mlp_sites: *, menu: *}}
		 */
		var ajaxData = function ( ids ) {

			var nonceAction = $submitButton.data( 'nonce-action' );
			var nonceValue = $submitButton.data( 'nonce' );
			var ajaxAction = $submitButton.data( 'action' );
			var data = {
				action: ajaxAction,
				mlp_sites: ids,
				menu: $menuInput.val(),
			};
			data[ nonceAction ] = nonceValue;

			return data;
		};

		/**
		 * Send the AJAX request to update the menu for the given languages ids.
		 *
		 * @param {number[]} ids
		 */
		var sendRequest = function ( ids ) {

			spinner( true );
			$submitButton.prop( 'disabled', true );
			$languageInputs.prop( 'disabled', true );

			$.ajax( {
				url: ajaxurl,
				method: 'POST',
				dataType: 'json',
				data: ajaxData( ids )
			} ).done( function ( response ) {

				if ( response.success && response.data && typeof response.data === 'string' ) {
					onAjaxSuccess( $( response.data ) );

					return;
				}

				onAjaxError();

			} ).fail( function () {

				onAjaxError();

			} ).always( function () {
				spinner( false );
				$languageInputs.prop( 'checked', false );
				$languageInputs.prop( 'disabled', false );
				$submitButton.prop( 'disabled', true );
			} );
		};

		/**
		 * Init the class by setting events callbacks on the jQuery element.
		 *
		 * @return {MultilingualPress.NewSiteLanguage}
		 */
		this.init = function () {

			if ( ! init ) {

				$languageInputs = $( $submitButton.data( 'languages' ) );
				$selectAll = $( $submitButton.data( 'select-all' ) );
				$spinner = $submitButton.siblings( '.spinner' );

				$languageInputs.click( function () {

					updateSumbit();
				} );

				$selectAll.click( function ( e ) {

					e.preventDefault();
					$languageInputs.prop( 'checked', true );
					updateSumbit();
				} );

				$submitButton.click( function () {

					var ids = languageIds();
					if ( ids && $menuToEdit.length ) {
						sendRequest( ids );
					}
				} );

				updateSumbit();

				init = true;
			}

			return this;
		};
	};

}( jQuery, MultilingualPress, ajaxurl ) );

( function ( $, M ) {

	'use strict';

	/**
	 * Handle the update of MultilingualPress language dropdown when WP language dropdown is changed.
	 *
	 * @param {jQuery} $wpLangInput
	 * @param {jQuery} $mlpLangInput
	 * @constructor
	 */
	M.NewSiteLanguage = function ( $wpLangInput, $mlpLangInput ) {

		var init = false;

		/**
		 * Find a MultilingualPress language by locale.
		 *
		 * @param {string} locale
		 * @return {string|null}
		 */
		var findByLocale = function ( locale ) {

			var $option = $mlpLangInput.find( 'option[data-locale="' + locale + '"]' );
			if ( $option.length ) {
				return $option.attr( 'value' );
			}

			return null;
		};

		/**
		 * Find a MultilingualPress language by ISO code.
		 *
		 * @param {string} code
		 * @return {string|null}
		 */
		var findByIso = function ( code ) {

			var $option = $mlpLangInput.find( 'option[data-iso="' + code + '"]' );
			if ( $option.length ) {
				return $option.attr( 'value' );
			}

			return null;
		};

		/**
		 * Find the MultilingualPress language that best matches given locale.
		 *
		 * @param {string} code
		 * @return {string|null}
		 */
		var findBestMatch = function ( locale ) {

			var pieces = locale.split( '_' );
			var $option;
			while ( pieces.length ) {
				pieces.pop();
				$option = $mlpLangInput.find( 'option[data-locale="' + pieces.join( '_' ) + '"]' );
				if ( $option.length ) {
					return $option.attr( 'value' );
				}
			}

			return null;
		};

		/**
		 * Run on WordPress language dropdown change and try to sync MultilingualPress language dropdown.
		 */
		var onWpLanguageChange = function () {

			var locale = $( this ).val();
			var byLocale;
			var byIso;
			var bestMatch;

			byLocale = findByLocale( locale );
			if ( byLocale ) {
				$mlpLangInput.val( byLocale );

				return;
			}

			byIso = findByIso( locale );
			if ( byIso ) {
				$mlpLangInput.val( byIso );

				return;
			}

			bestMatch = findBestMatch( locale );
			if ( bestMatch ) {
				$mlpLangInput.val( bestMatch );
			}

		};

		/**
		 * Init the class by setting events callbacks on the jQuery elements.
		 *
		 * @return {MultilingualPress.NewSiteLanguage}
		 */
		this.init = function () {

			if ( ! init ) {
				$wpLangInput.change( onWpLanguageChange );
				init = true;
			}

			return this;
		};
	};

}( jQuery, MultilingualPress ) );

( function ( $, M ) {

	'use strict';

	/**
	 * Data type object for post relation context.
	 *
	 * @param {jQuery} $box - The jQuery element for the box.
	 * @constructor
	 */
	M.PostTranslationContext = function ( $box ) {

		var init = false;
		var data = {};

		/**
		 * Initilizes the class by retrieving information from HTML data attributes.
		 *
		 * @return {MultilingualPress.TermTranslationContext}
		 */
		this.init = function () {
			if ( ! init ) {
				data.source_site_id = $box.data( 'source-site' );
				data.source_post_id = $box.data( 'source-post' );
				data.remote_site_id = $box.data( 'remote-site' );
				data.remote_post_id = $box.data( 'remote-post' );
				data.post_type = $box.data( 'post-type' );
				init = true;
			}

			return this;
		};

		/**
		 * @return {number}
		 */
		this.sourceSiteId = function () {
			return Number( data.source_site_id || 0 );
		};

		/**
		 * @return {number}
		 */
		this.sourcePostId = function () {
			return Number( data.source_post_id || 0 );
		};

		/**
		 * @return {number}
		 */
		this.remoteSiteId = function () {
			return Number( data.remote_site_id || 0 );
		};

		/**
		 * @return {number}
		 */
		this.remotePostId = function () {
			return Number( data.remote_post_id || 0 );
		};

		/**
		 * @return {string}
		 */
		this.postType = function () {
			return String( data.post_type || '' );
		};
	};

}( jQuery, MultilingualPress ) );

( function ( $, M ) {

	'use strict';

	/**
	 * Handlee the toggling of taxonomies inpupts on post translation box when the "Sync taxonomies"
	 * checkbox is checked.
	 *
	 * @param {jQuery} $syncInput
	 * @param {jQuery} $targetInputs
	 * @constructor
	 */
	M.PostTranslationTaxonomies = function ( $syncInput, $targetInputs ) {

		var init = false;

		/**
		 * Init the class by setting events callbacks on the jQuery elements.
		 *
		 * @return {MultilingualPress.PostTranslationTaxonomies}
		 */
		this.init = function () {
			if ( ! init ) {
				init = true;
				if ( $targetInputs.length ) {
					$syncInput.change( function () {
						$targetInputs.toggle( ! $( this ).is( ':checked' ) );
					} );
				}
			}

			return this;
		};
	};

}( jQuery, MultilingualPress ) );

( function ( $, M ) {

	'use strict';

	M.SitesRelationshipBulkSelection = function () {

		var init = false;

		/**
		 * @param evt
		 */
		var bulkAction = function ( evt ) {
			evt.preventDefault();
			evt.stopImmediatePropagation();

			var languages = $( '.mlp-relationships-languages' );

			if ( !languages.length ) {
				return;
			}

			languages
				.find( 'input[type="checkbox"]' )
				.each(
					function ( index, checkbox ) {
						checkbox.checked = ( $( evt.currentTarget ).data( 'action' ) === 'select' );
					}
				);
		};

		/**
		 * @return {MultilingualPress.NewSiteLanguage}
		 */
		this.init = function () {

			if ( !init ) {
				$( '.mlp-site-bulk-relations' )
					.on( 'click', bulkAction );

				init = true;
			}

			return this;
		};

	};

}( jQuery, MultilingualPress ) );

( function ( $, M ) {

	'use strict';

	/**
	 * Data type object for term relation context.
	 *
	 * @param {jQuery} $box - The jQuery element for the box.
	 * @constructor
	 */
	M.TermTranslationContext = function ( $box ) {

		var init = false;
		var data = {};

		/**
		 * Initilizes the class by retrieving information from HTML data attributes.
		 *
		 * @return {MultilingualPress.TermTranslationContext}
		 */
		this.init = function () {
			if ( ! init ) {
				data.source_site_id = $box.data( 'source-site' );
				data.source_term_id = $box.data( 'source-term' );
				data.remote_site_id = $box.data( 'remote-site' );
				data.remote_term_id = $box.data( 'remote-term' );
				data.taxonomy = $box.data( 'taxonomy' );
				init = true;
			}

			return this;
		};

		/**
		 * @return {number}
		 */
		this.sourceSiteId = function () {
			return Number( data.source_site_id || 0 );
		};

		/**
		 * @return {number}
		 */
		this.sourceTermId = function () {
			return Number( data.source_term_id || 0 );
		};

		/**
		 * @return {number}
		 */
		this.remoteSiteId = function () {
			return Number( data.remote_site_id || 0 );
		};

		/**
		 * @return {number}
		 */
		this.remoteTermId = function () {
			return Number( data.remote_term_id || 0 );
		};

		/**
		 * @return {string}
		 */
		this.taxonomy = function () {
			return String( data.taxonomy || '' );
		};
	};

}( jQuery, MultilingualPress ) );

( function ( $, M ) {

	'use strict';

	/**
	 * Factory for post and term box object.
	 */
	M.TranslationBoxFactory = {

		/**
		 * Creates relationship context object for translation box basd on given type.
		 *
		 * @param {string} type - The box type, either "post" or "term".
		 * @param {jQuery} $box - The jQuery element for the box.
		 */
		createContext: function ( type, $box ) {

			if ( type === 'term' ) {
				return new M.TermTranslationContext( $box );
			}

			return new M.PostTranslationContext( $box );
		},

		/**
		 * Creates and initiliazes objects for translation box.
		 *
		 * @param {string} type - The box type, either "post" or "term".
		 * @param {jQuery} $box - The jQuery element for the box.
		 */
		create: function ( type, $box ) {

			var $relationTab = $box.find( '.tab-relation' );
			var $searchInputRow = $relationTab.find( '.search-input-row' );
			var $relUpdateButton = $relationTab.find( '.update-relationship' );
			var $relInputs = $relationTab.find( '.main-row input' );

			var context = M.TranslationBoxFactory.createContext( type, $box );
			var tabs = new M.TraslationBoxTabs( $box );
			var search = new M.TranslationSearch( type, context, $searchInputRow, $relUpdateButton );
			var relUpdater = new M.TranslationRelationshipUpdater( type, search, context, $box );
			var relationship = new M.TranslationRelationship( relUpdater, tabs, search, $relInputs, $relUpdateButton );
			var postTaxonomies;

			context.init();
			tabs.init();
			search.init();
			relationship.init();

			if ( type === 'post' ) {
				postTaxonomies = new M.PostTranslationTaxonomies(
					$box.find( '.mlp-taxonomy-sync input' ),
					$box.find( '.mlp-taxonomy-box' )
				);
				postTaxonomies.init();
			}
		}
	};

}( jQuery, MultilingualPress ) );

( function ( $, M, adminpage ) {

	'use strict';

	/**
	 * Handle the action for the "Relationship" tab on post and term translation metabox.
	 *
	 * @param {MultilingualPress.TranslationRelationshipUpdater} updater
	 * @param {MultilingualPress.TraslationBoxTabs} tabs
	 * @param {MultilingualPress.TranslationSearch} search
	 * @param {jQuery} $relationInputs - The jQuery elements for the relationship radio inputs.
	 * @param {jQuery} $button - The jQuery element for the submit button.
	 * @constructor
	 */
	M.TranslationRelationship = function ( updater, tabs, search, $relationInputs, $button ) {

		var init = false;
		var $tabsInputs;
		var $spinner;

        var newRelationTasks = [
            'existing',
            'new'
        ];

		/**
		 * Return a jQuery selector for all the inputs that belong to all the tabs excluding relationship tab.
		 *
		 * @return {jQuery}
		 */
		var tabsInputs = function () {
			var $exclude;
			if ( !$tabsInputs ) {
				$exclude = tabs.findInPanel( 'relation', 'input, select, textarea' );
				$tabsInputs = tabs.findInAllPanels( 'input, select, textarea' ).not( $exclude );
			}

			return $tabsInputs;
		};

		/**
		 * Return the currently selected value for the relation radio inputs.
		 *
		 * @return {string|null}
		 */
		var selectedRelationTask = function () {

			return $relationInputs.filter( ':checked' ).val();
		};

		/**
		 * Exectued when relation radio button selected value change.
		 *
		 * Hide/show elements and enable/disable tabs based on currently selected value.
		 *
		 * @param {string} value
		 */
		var updateInputs = function ( value ) {
			var task = value || selectedRelationTask();
			search.hideResults();
			if ( task === 'new' || task === 'leave' ) {
				tabsInputs().attr( 'disabled', false );
				tabs.enable();
				$button.hide().attr( 'disabled', true );
				search.showField( false );

				return;
			}

			if ( task === 'nothing' ) {
				$button.hide().attr( 'disabled', true );
			}

			search.showField( task === 'existing' );
			tabs.activate( 'relation' );
			tabs.disable();
			tabsInputs().attr( 'disabled', true );
			if ( task === 'existing' || task === 'remove' ) {
				$button.attr( 'disabled', task === 'existing' ).show();
			}
		};

		/**
		 * Show (or hide) a spinner next to submit button.
		 *
		 * @param {bool} enable
		 */
		var spinner = function ( enable ) {
			if ( !$spinner ) {
				$spinner = $( '<span class="spinner" style="float: none; margin: 0 10px 5px;"></span>' )
					.appendTo( $button.parent() );
			}

			$spinner.css( 'visibility', enable ? 'visible' : 'hidden' );
		};

		/**
		 * Run before AJAX request.
		 */
		var onBeforeAjax = function (task, data) {

			$relationInputs.attr( 'disabled', true );
			$button.attr( 'disabled', true );
			search.hideResults();
			search.showField( false );
			spinner( true );
		};

		/**
		 * Run on AJAX update fail.
		 */
		var onAjaxFail = function (task, data) {

			updateInputs();
			$relationInputs.attr( 'disabled', false );
			spinner( false );
		};

        /**
         * Return on AJAX success
         *
         * @param task
         * @param data
         * @param $box
         */
        var onAjaxSuccess = function (task, data, $box) {
            updateInputs();
            $relationInputs = $box.find('.tab-relation').find('.main-row input');
            spinner(false);

            mayBuildEditLink(task, $box);
        };

        /**
         * Build the Edit target link for the remote entity when the relationship is updated
         *
         * @param task
         * @param $box
         */
        var mayBuildEditLink = function (task, $box) {
            var remoteLink;
            var remoteLinkLabel;
            var $metaboxTitle;
            var $metaboxRemoteEditLink;
            var $translationMetabox;
            var $metaboxContainer = $box.parents('.postbox');

            if (!$metaboxContainer.length) {
                return;
            }

            $translationMetabox = $metaboxContainer.find('.mlp-translation-metabox');
            if (!$translationMetabox.length) {
                return;
            }

            $metaboxTitle = $metaboxContainer.find('h2 span');
            $metaboxRemoteEditLink = $metaboxContainer.find('.mlp-entity-edit-link');

            $metaboxRemoteEditLink.remove();

            var metaboxTitleInnerHtml = $metaboxTitle.html();
            metaboxTitleInnerHtml = metaboxTitleInnerHtml.replace(/\s-\s$/, '');
            $metaboxTitle.html(metaboxTitleInnerHtml);

            if (newRelationTasks.indexOf(task) === -1) {
                return;
            }

            remoteLink = $translationMetabox.data('remote-link');
            remoteLinkLabel = $translationMetabox.data('remote-link-label');

            if (!remoteLink || !remoteLinkLabel) {
                return;
            }

            metaboxTitleInnerHtml += ' - ';
            $metaboxTitle.html(metaboxTitleInnerHtml);

            $metaboxTitle.length && $metaboxTitle.append(
                $('<a class="mlp-entity-edit-link" href="' + remoteLink + '">' + remoteLinkLabel + '</a>')
            );
        };

		/**
		 * Check if classic editor or Gutenberg page
		 *
		 * @returns {boolean}
		 */
		var isClassicEditor = function () {
			var url = window.location.href;
			return -1 !== url.indexOf( '&classic-editor' );
		};

		/**
		 * Post Edit update relation for Gutenberg
		 */
		var subscribeForEditPost = function () {
			if ( typeof wp.data === 'undefined' ) {
				return;
			}

			var editPost = wp.data.select( 'core/edit-post' );
			if ( typeof editPost === 'undefined' ) {
				return;
			}

			var lastIsSaving = false;

			wp.data.subscribe( function () {
				if ( isClassicEditor() ) {
					return;
				}

				var isSaving = editPost.isSavingMetaBoxes();
				if ( isSaving !== lastIsSaving && !isSaving ) {
					lastIsSaving = isSaving;
					updater.updateRelation( selectedRelationTask(), onBeforeAjax, onAjaxSuccess, onAjaxFail );
				}

				lastIsSaving = isSaving;
			} );
		};

		/**
		 * Initialize the class by setting events callbacks to inputs.
		 *
		 * @return {MultilingualPress.TranslationRelationship}
		 */
		this.init = function () {
			if ( !init ) {
				$relationInputs.on( 'change', function () {
					updateInputs( $( this ).val() );
				} );
				$button.on( 'click', function ( e ) {
					e.preventDefault();
					updater.updateRelation( selectedRelationTask(), onBeforeAjax, onAjaxSuccess, onAjaxFail );
				} );
				if ( ['post-php', 'post-new-php'].indexOf( adminpage ) !== -1 ) {
					subscribeForEditPost();
				}
				updateInputs();
				init = true;
			}

			return this;
		};

	};

}( jQuery, MultilingualPress, adminpage ) );

( function ( $, M, ajaxurl ) {

	'use strict';

	/**
	 * Handle the update of post/term relationship, including the complete rebuild of the metabox on relation update.
	 *
	 * @param {string} type - Box type, either "post" or "term"
	 * @param {MultilingualPress.TranslationSearch} search
	 * @param {MultilingualPress.PostTranslationContext|MultilingualPress.TermTranslationContext} context
	 * @param {jQuery} $box - The jQuery element for the box container.
	 * @constructor
	 */
	M.TranslationRelationshipUpdater = function ( type, search, context, $box ) {

		/**
		 * Build the data object ot send via AJAX for the update relationship request.
		 *
		 * @param {string} task
		 * @param {number|null} remoteItemId
		 * @return {{task: *, source_site_id: *, remote_site_id: *}}
		 */
		var ajaxData = function ( task, remoteItemId ) {

			var data = {
				task: task,
				source_site_id: context.sourceSiteId(),
				remote_site_id: context.remoteSiteId(),
			};

			if ( type === 'term' ) {
				if ( !remoteItemId ) {
					remoteItemId = context.remoteTermId();
				}

				data.source_term_id = context.sourceTermId();
				data.remote_term_id = remoteItemId;
				data.action = 'multilingualpress_update_term_relationship';

				return data;
			}

			if ( !remoteItemId ) {
				remoteItemId = context.remotePostId();
			}

			data.source_post_id = context.sourcePostId();
			data.remote_post_id = remoteItemId;
			data.action = 'multilingualpress_update_post_relationship';

			return data;
		};

		/**
		 * Remove the current metabox and rebuild the metabox by replacing it with the markup returned via AJAX
		 * passed in the response.
		 *
		 * @param {object} response
		 * @return {object} $box The new metabox jQuery object
		 */
		var rebuildMetabox = function ( response ) {

			var $parent;
			var $newBox;

			if ( !response.success || !response.data || typeof response.data !== 'string' ) {
				return null;
			}

			$newBox = $( response.data );
			if ( !$newBox.length ) {
				return null;
			}

			$parent = $box.parent();
			$parent.find( '.mlp-warning' ).remove();
			$box.remove();
			$newBox.appendTo( $parent );

			M.TranslationBoxFactory.create( type, $newBox );

			return $newBox;
		};

		/**
		 * Build the data to send via AJAX or null in case of failure.
		 *
		 * @param {string} task
		 * @return {object|null}
		 */
		var updateRelationData = function ( task ) {

			var selectedExisting;
			var remoteItemId;
			var allowedTasks = ['existing', 'remove', 'new'];

			if ( -1 === allowedTasks.indexOf( task ) ) {
				return null;
			}

			if ( task === 'existing' ) {
				selectedExisting = search.selectedResult();
				if ( !selectedExisting ) {
					return null;
				}
			}

			remoteItemId = task === 'existing' ? selectedExisting : null;

			return ajaxData( task, remoteItemId );
		};

		/**
		 * Executed when submit button is clicked.
		 *
		 * Sends an AJAX request which perform the currently selected action and on success
		 * rebuild the metabox by replacing it with the markup returned via AJAX.
		 *
		 * @param {string} task
		 * @param {function} onBeforeAjax
		 * @param {function} onSuccess
		 * @param {function} onFail
		 */
		this.updateRelation = function ( task, onBeforeAjax, onSuccess, onFail ) {

			var data = updateRelationData( task );
			if ( !data ) {
				return;
			}

			onBeforeAjax(task, data);

			$.ajax( {
				url: ajaxurl,
				method: 'POST',
				dataType: 'json',
				data: data
			} ).done( function ( response ) {
				var $newBox = rebuildMetabox( response );

				if ( !$newBox.length ) {
					onFail(task, data);
					return;
				}

				onSuccess( task, data, $newBox );
			} ).fail( function () {
				onFail(task, data);
			} );
		};

	};

}( jQuery, MultilingualPress, ajaxurl ) );

( function ( $, M, ajaxurl ) {

	'use strict';

	/**
	 * Handle search button in search translation box.
	 *
	 * @param {string} type - Type of search, either "post" or "term"
	 * @param {MultilingualPress.TermTranslationContext|MultilingualPress.PostTranslationContext} context
	 * @param {jQuery} $inputContainer
	 * @param {jQuery} $submitButton
	 * @constructor
	 */
	M.TranslationSearch = function ( type, context, $inputContainer, $submitButton ) {

		var self = this;
		var $input;
		var $resultsRow;
		var $resultsContainer;
		var $resultsRowSample;
		var $resultsRowNone;
		var currentText;
		var timer;
		var appended = 0;
		var cache = {};

		/**
		 * Create a row form AJAX response data.
		 *
		 * @param {object} data
		 * @return {jQuery}
		 */
		var createRow = function ( data ) {

			var id;
			var title;
			var $row;
			var $radio;
			if ( typeof data !== 'object' || ! data ) {
				return null;
			}
			id = data.id || 0;
			title = data.title || '';
			if ( ! id || ! title ) {
				return null;
			}
			$row = $resultsRowSample.clone();
			$radio = $row.find( 'input' );
			$radio.val( id );
			$radio.attr( 'aria-label', title );
			$row.find( 'span' ).text( title + ' (ID: ' + id + ')' );

			return $row;
		};

		/**
		 * Creates and append a results table row.
		 *
		 * @param {object} data
		 */
		var appendRow = function ( data ) {

			var $row = createRow( data );
			if ( ! $row ) {
				return;
			}

			$row.find( 'input' ).on( 'change', function () {
				var $radio = $( this );
				if ( $radio.is( ':checked' ) ) {
					$submitButton.attr( 'disabled', false );
					$row.closest( 'table' ).find( 'td' ).removeClass( 'selected' );
					$radio.closest( 'td' ).addClass( 'selected' );
				}
			} );

			$row.appendTo( $resultsContainer );
			appended++;
		};

		/**
		 * Creates and append all results rows or the "nothing found" row when it's the case.
		 *
		 * @param {object} data
		 */
		var fillResults = function ( data ) {

			appended = 0;
			$resultsContainer.empty();
			$submitButton.attr( 'disabled', true );
			if ( typeof data !== 'object' || ! data || ! data.map ) {
				$resultsRowNone.clone().appendTo( $resultsContainer );

				return;
			}

			data.map( appendRow );
			if ( appended < 1 ) {
				$resultsRowNone.clone().appendTo( $resultsContainer );
			}
		};

		/**
		 * Create the data object to be sent via AJAX.
		 *
		 * @param {string} dataType - Either "post" or "term"
		 * @param {string} searchQuery
		 * @return {{action: *, search: *, source_site_id: *, remote_site_id: *}}
		 */
		var ajaxData = function ( dataType, searchQuery ) {

			var data = {
				action: $input.data( 'action' ),
				search: searchQuery,
				source_site_id: context.sourceSiteId(),
				remote_site_id: context.remoteSiteId(),
			};

			if ( dataType === 'term' ) {
				data.source_term_id = context.sourceTermId();
				data.remote_term_id = context.remoteTermId();

				return data;
			}

			data.source_post_id = context.sourcePostId();
			data.remote_post_id = context.remotePostId();

			return data;
		};

		/**
		 * Executes the AJAX request for the search query.
		 *
		 * @param {string} searchQuery
		 */
		var searchFor = function ( searchQuery ) {

			var dataTypeCache = cache[ type ] || {};
			if ( searchQuery in dataTypeCache ) {
				self.showResults( dataTypeCache[ searchQuery ] );

				return;
			}

			if ( ! ( type in cache ) ) {
				cache[ type ] = {};
			}

			$input.addClass( 'ui-autocomplete-loading' );

			$.ajax( {
				url: ajaxurl,
				method: 'POST',
				dataType: 'json',
				data: ajaxData( type, searchQuery )
			} ).done( function ( response ) {

				var responseData = response.success && response.data ? response.data : false;
				if ( responseData ) {
					cache[ type ][ searchQuery ] = responseData;
				}
				self.showResults( responseData );

			} ).fail( function () {

				self.showResults( false );
			} ).always( function () {

				$input.removeClass( 'ui-autocomplete-loading' );
			} );
		};

		/**
		 * Callabck executed when user type int search field.
		 *
		 * Set a timer to run the search query via AJAX.
		 *
		 * @param {Event} e
		 */
		var onTyping = function ( e ) {

			var text;
			if ( e.which === 13 ) {
				return;
			}

			if ( timer ) {
				clearTimeout( timer );
			}

			text = $input.val();

			if ( text === currentText ) {
				return;
			}

			if ( text.length < 2 ) {
				self.hideResults( false );

				return;
			}

			currentText = text;

			timer = setTimeout(
				function () {
					searchFor( text );
					currentText = null;
				},
				300
			);
		};

		/**
		 * Initialize the class.
		 */
		this.init = function () {

			var $resultsRowSampleTemp;
			var $resultsRowNoneTemp;

			if ( ! $input ) {
				$input = $inputContainer.find( 'input' );
				$input.val( '' );
				$input.keyup( onTyping ).keydown( function ( e ) {
					if ( e.which === 13 ) {
						e.preventDefault();
					}
				} );
				$resultsRow = $( $input.data( 'results' ) );
				$resultsContainer = $resultsRow.find( 'table tbody' );
				$resultsRowSampleTemp = $resultsContainer.find( '.search-results-row' );
				$resultsRowNoneTemp = $resultsContainer.find( '.search-results-none' );
				$resultsRowSample = $resultsRowSampleTemp.clone().show();
				$resultsRowNone = $resultsRowNoneTemp.clone().show();
				$resultsRowSampleTemp.remove();
				$resultsRowNoneTemp.remove();
			}
		};

		/**
		 * Show (or hide) the search input field.
		 *
		 * @param {bool} enable
		 */
		this.showField = function ( enable ) {
			$inputContainer.toggle( enable );
		};

		/**
		 * Fill the results table based on provided data and then show it.
		 *
		 * @param {{id:string, title:string}[]} data
		 */
		this.showResults = function ( data ) {
			fillResults( data );
			$resultsRow.show();
		};

		/**
		 * Hide the results table and optionally reset the search field input.
		 *
		 * @param {bool} resetInput
		 */
		this.hideResults = function ( resetInput ) {
			$resultsContainer.empty();
			$resultsRow.hide();
			if ( resetInput !== false ) {
				$input.val( '' );
			}
		};

		/**
		 * Return the currently selected result, or null if nothing selected.
		 *
		 * @return {string|null}
		 */
		this.selectedResult = function () {
			var $el = $resultsContainer.find( 'input:checked' ).eq( 0 );
			if ( $el.length ) {
				return $el.val();
			}

			return null;
		};
	};

}( jQuery, MultilingualPress, ajaxurl ) );

( function ( $, M ) {

	'use strict';

	/**
	 * Hnadle the tab UI for post and term translation box.
	 *
	 * @param {jQuery} $box
	 * @constructor
	 */
	M.TraslationBoxTabs = function ( $box ) {

		var $panels;
		var $anchors;
		var $activeTab;
		var $activePanel;

		/**
		 * Return the jQuery selector for all the tabs panels.
		 *
		 * @return {jQuery}
		 */
		var allPanels = function () {
			if ( ! $panels ) {
				$panels = $box.find( '.wp-tab-panel' );
			}

			return $panels;
		};

		/**
		 * Return the jQuery selector for all the tabs anchors.
		 *
		 * @return {jQuery}
		 */
		var allAnchors = function () {
			if ( ! $anchors ) {
				$anchors = $box.find( '.nav-tab' );
			}

			return $anchors;
		};

		/**
		 * Initialize the class by initiliazing jQuery UI tabs.
		 *
		 * @return {MultilingualPress.TraslationBoxTabs}
		 */
		this.init = function () {
			$box.tabs( {
				active: 0,
				activate: function ( event, ui ) {
					$activeTab = ui.newTab;
					$activePanel = ui.newPanel;

					$( this ).trigger( 'translation-metabox-tab-activated', ui );
				},
				create: function ( event, ui ) {
					$activeTab = ui.tab;
					$activePanel = ui.panel;

					$( this ).trigger( 'translation-metabox-tab-created', ui );
				}
			} );

			return this;
		};

		/**
		 * Disable the tab naviagation.
		 */
		this.disable = function () {
			this.init();
			$box.tabs( 'disable' );
		};

		/**
		 * Enable the tab naviagation.
		 */
		this.enable = function () {
			this.init();
			$box.tabs( 'enable' );
		};

		/**
		 * Makes the given tab active.
		 *
		 * @param {string} tab - The name of the tab to activate.
		 */
		this.activate = function ( tab ) {
			var i = 0;
			this.init();
			if ( !tab ) {
				return;
			}

			allAnchors().each( function () {
				var match = $( this ).attr( 'id' ).match( /tab-([a-z-]+)$/ );
				if ( match[1] === tab ) {
					$box.tabs( 'option', 'active', i );
				}
				i++;
			} );
		};

		/**
		 * Return a jQuery object for elements that match the given selector inside the panel of the given tab.
		 *
		 * @param {string} tab - The name of the tab where to search in.
		 * @param {string} selector - The jQuery selector to search for.
		 * @return {jQuery}
		 */
		this.findInPanel = function ( tab, selector ) {
			var $panel;
			if ( !$panels ) {
				$panels = $box.find( '.wp-tab-panel' );
			}
			$panel = $panels.find( '.tab-' + tab );
			if ( !$panel.length ) {
				return $panel;
			}

			return $panel.find( selector );
		};

		/**
		 * Return a jQuery object for elements that match the given selector inside all the tab panels.
		 *
		 * @param {string} selector - The jQuery selector to search for.
		 * @return {jQuery}
		 */
		this.findInAllPanels = function ( selector ) {
			return allPanels().find( selector );
		};
	};

}( jQuery, MultilingualPress ) );

( function ( $, M, adminpage ) {

	'use strict';

	$( function () {

		var newSiteLanguage;
		var languageSearch;
		var bulkRelationships;
		var navMenu;

		if ( adminpage === 'post-new-php' || adminpage === 'post-php' ) {
			$( '.mlp-translation-metabox' ).each( function () {
				M.TranslationBoxFactory.create( 'post', $( this ) );
			} );
		}
		if ( adminpage === 'term-php' ) {
			$( '.mlp-translation-metabox' ).each( function () {
				M.TranslationBoxFactory.create( 'term', $( this ) );
			} );
		}

		if ( adminpage === 'site-new-php' ) {
			newSiteLanguage = new M.NewSiteLanguage( $( '#site-language' ), $( '#mlp-site-language' ) );
			newSiteLanguage.init();
		}

		if ( adminpage === 'sites_page_multilingualpress-site-settings' ) {
			languageSearch = new M.LanguageSearch( $( '#mlp-site-language' ) );
			languageSearch.init();
		}

		if ( adminpage === 'site-new-php' || adminpage === 'sites_page_multilingualpress-site-settings' ) {
			bulkRelationships = new M.SitesRelationshipBulkSelection();
			bulkRelationships.init();
		}

		if ( adminpage === 'nav-menus-php' ) {
			navMenu = new M.NavMenu( $( '#mlp-languages-submit' ), $( '#menu-to-edit' ), $( '#menu' ) );
			navMenu.init();
		}
	} );

}( jQuery, MultilingualPress, adminpage ) );
