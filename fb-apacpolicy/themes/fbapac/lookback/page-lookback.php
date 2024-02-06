<?php
/**
 * Template Name: Lookback (Annual Report)
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

get_header('lookback');

get_template_part( 'lookback/template-parts/global-part_hero' );
get_template_part( 'lookback/template-parts/home-part_longform' );
get_template_part( 'lookback/template-parts/home-part_pillars' );
get_template_part( 'lookback/template-parts/global-part_numbers' );
get_template_part( 'lookback/template-parts/home-part_regions' );

get_footer('lookback');
