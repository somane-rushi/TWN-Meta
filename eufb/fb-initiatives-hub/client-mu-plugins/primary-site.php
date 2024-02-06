<?php
/**
 * Primary Site
 *
 * @package     PrimarySite
 * @author      Jonathan Harris
 * @copyright   2018 Rehab
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Primary Site
 * Plugin URI:  https://www.facebook.com
 * Description: Select the primary site on a domain
 * Version:     1.0.0
 * Author:      Jonathan Harris
 * Author URI:  https://www.spacedmonkey.com
 * Text Domain: facebook-tweaks
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

add_action(
	'admin_init', function () {
		$option_name = 'primary_site';
		// Register a setting and its sanitization callback
		register_setting(
			'general', // Option group
			$option_name // Option name
		);
		//  Add a new section to a settings page.
		add_settings_section(
			$option_name, // ID
			'',
			'',
			'general'
		);
		// Add the post_type_slug field to the section of the settings page
		add_settings_field(
			$option_name, // ID
			__( 'Primary site on domain', 'facebook-initiative' ),
			function () use ( $option_name ) {
				$option  = get_option( $option_name, 0 );
			?>
			<fieldset>
				<p>
					<label>
						<input type="radio" name="<?php echo esc_attr( $option_name ); ?>"
							   value="1" <?php checked( 1, $option, true ); ?>>
						<?php esc_html_e( 'Yes', 'facebook-initiative' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="radio" name="<?php echo esc_attr( $option_name ); ?>"
							   value="0" <?php checked( 0, $option, true ); ?>>
						<?php esc_html_e( 'No', 'facebook-initiative' ); ?>
					</label>
				</p>
			</fieldset>
			<?php
			},
			'general', // Page
			$option_name
		);
	}
);
