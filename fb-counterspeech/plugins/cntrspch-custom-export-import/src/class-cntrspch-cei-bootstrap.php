<?php

/**
 * Creates a new instance of each class that is necessary
 * for the plugin to run.
 */
class CNTRSPCH_CEI_Bootstrap {

	public function __construct() {

		new CNTRSPCH_CEI_PO_Strings;
		new CNTRSPCH_CEI_Menu;

	}
}
