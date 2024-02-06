<?php


/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * PHP Version 5.4
 *
 * @category  MyClass
 * @package   Fb_Csv_Importer
 * @author    Claudio Meira <claudiom@njimedia.com>
 * @copyright 2020 NJI Media
 * @license   GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link      http://dev-fb-apac.pantheonsite.io/
 * @since     1.0.0
 */
 
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @category  MyClass
 * @package   Fb_Csv_Importer
 * @author    Claudio Meira <claudiom@njimedia.com>
 * @copyright 2020 NJI Media
 * @license   GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link      http://dev-fb-apac.pantheonsite.io/
 * @since     1.0.0
 */



class Fb_Csv_Importer_I18n
{


    /**
     * Load the plugin text domain for translation.
     *
     * @since  1.0.0
     * @return void
     */
    public function load_plugin_textdomain()
    {

        load_plugin_textdomain(
            'fb_csv_importer',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );

    }



}
