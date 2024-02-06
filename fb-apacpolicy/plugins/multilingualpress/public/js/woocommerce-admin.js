var MultilingualPress = window.MultilingualPress || {};
var MultilingualPressRedirectorSettings = window.MultilingualPressRedirectorSettings || {};

MultilingualPress.RedirectorSettings = MultilingualPressRedirectorSettings;
delete window.MultilingualPressRedirectorSettings;

( function ( $, M ) {

	'use strict';

	/**
	 * MultilingualPress Language Manager
	 *
	 * @constructor
	 */
	M.WooCommerce = function () {

		var init;
		var $productTypeSelectField;

		var productDataTabType = 'tab-product';
		var wpEditorSettings = {
			quicktags: {
				buttons: 'strong,em,link'
			},
			tinymce: {
				wpautop: true,
				plugins: [
					'charmap',
					'colorpicker',
					'hr',
					'lists',
					'media',
					'paste',
					'tabfocus',
					'textcolor',
					'wordpress',
					'wpautoresize',
					'wpeditimage',
					'wpemoji',
					'wpgallery',
					'wplink',
					'wpdialogs',
					'wptextpattern',
					'wpview',
				].join( ' ' ),
				toolbar1: [
					'formatselect',
					'bold',
					'italic',
					'bullist',
					'numlist',
					'blockquote',
					'alignleft',
					'aligncenter',
					'alignright',
					'link',
					'wp_more',
					'spellchecker',
					'wp_adv'
				].join( ',' ),
				toolbar2: [
					'strikethrough',
					'hr',
					'forecolor',
					'pastetext',
					'removeformat',
					'charmap',
					'outdent',
					'indent',
					'undo',
					'redo'
				].join( ',' )
			},
			mediaButtons: true
		};

		/**
		 * Select the first visible tabbed panel item
		 *
		 * @returns void
		 */
		var selectFirstVisiblePanelMenuItem = function () {
			$( this ).find( 'ul.wc-tabs li:visible' ).eq( 0 ).find( 'a' ).click();
		};

		/**
		 * Activate the first tab nav item for the product data tab when product type change
		 *
		 * @returns void
		 */
		var activateFirstTabNavItemOnProductTypeChange = function () {
			$( 'select#product-type' ).on( 'change', function () {
				$( '.mlp-translation-metabox' ).each( selectFirstVisiblePanelMenuItem );
			} );
		};

		/**
		 * Activate the first tab nav item for the product data tab on page load
		 *
		 * @returns void
		 */
		var activateFirstTabNavItemOnTranslationTabActivate = function () {
			$( '.mlp-translation-metabox' ).each( function ( index, metabox ) {
				var $metabox = $( metabox );
				$metabox.on(
					'translation-metabox-tab-activated',
					selectFirstVisiblePanelMenuItem
				);
				$metabox.parent().on( 'translation-metabox-tab-activated', function () {
					var $visibleMetabox = $( this ).find( '.wp-tab-panel' ).filter( ':visible' );
					if ( !$visibleMetabox ) {
						return;
					}

					var tabType = $visibleMetabox.data( 'tab-id' );
					if ( tabType === productDataTabType ) {
						var remoteSiteId = $visibleMetabox.parent( '.mlp-translation-metabox' ).data( 'remote-site' );

						reinitializeProductDataTabs();
						reinitializeShortDescriptionEditor(
							'multilingualpress-site-' + remoteSiteId + '-product_short_description'
						)
					}
				} );
			} );
		};

		/**
		 * Reinitialize the WooCommerce Product Data Tabs
		 */
		var reinitializeProductDataTabs = function () {
			$( document.body ).trigger( 'wc-init-tabbed-panels' );
		};

		/**
		 * Reinitialize the Short Description Editor
		 * @param editorId
		 */
		var reinitializeShortDescriptionEditor = function ( editorId ) {
			wp.editor.remove( editorId );
			wp.editor.initialize( editorId, wpEditorSettings );
		};

		/**
		 * @returns {M}
		 */
		this.init = function () {
			if ( init ) {
				return this;
			}

			$productTypeSelectField = $( 'select#product-type' );
			if ( !$productTypeSelectField.length ) {
				return this;
			}

			activateFirstTabNavItemOnTranslationTabActivate();
			activateFirstTabNavItemOnProductTypeChange();

			init = true;

			return this;
		};
	};

}( jQuery, MultilingualPress ) );
( function ( $, M, adminpage ) {

	'use strict';
	$( function () {

		var wooCommerce;

		if ( -1 !== $.inArray( adminpage, ['post-php', 'post-new-php'] ) ) {
			wooCommerce = new M.WooCommerce();
			wooCommerce.init();
		}
	} );

}( jQuery, MultilingualPress, adminpage ) );
