<?php

/**
 * Class for handling the storing and reading of PO Strings
 */
class CNTRSPCH_CEI_PO_Strings {

	const name = '_cntrspch_cei_po_strings';

	public function __construct()
	{
		add_site_option( self::name, '' );
	}

	public function get()
	{
		return get_site_option( self::name );
	}

	public function set( $value )
	{
		$value = sanitize_text_field( $value );

		return update_site_option( self::name, $value );
	}
}
