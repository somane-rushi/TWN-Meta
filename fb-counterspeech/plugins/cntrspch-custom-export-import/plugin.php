<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Couterspeech Custom Export/Import
 * Plugin URI:        http://facebook.com/
 * Description:       Custom export for the purpose of using in the XHTML translation tool.
 * Version:           2.0.0
 * Author:            Stink Studios
 * License:           GPL2+
 */

// Include autoloader which will pull in all the necessary plugin files.
require_once __DIR__ . '/autoload.php';

// Call the Bootstrap class which sets up the plugin.
new CNTRSPCH_CEI_Bootstrap;
