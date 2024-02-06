<?php
if (!class_exists('META_Privacy_Policy')) :

	class META_Privacy_Policy
	{

		private static $instance;

		private function __construct()
		{
			/* Don't do anything, needs to be initialized via instance() method */
		}

		public static function instance()
		{
			if (!isset(self::$instance)) {
				self::$instance = new META_Privacy_Policy;
				self::$instance->setup();
			}
			return self::$instance;
		}

		public function setup()
		{
			// When registering a submenu page, the field name is the cable that
			// connects everything. In this case, 'meta_fields' needs to appear as
			// the first arg passed to `fm_register_submenu_page()`, it needs to be
			// in the action (prefixed with `fm_submenu_`), and then it needs to be
			// the field's name.

			fm_register_submenu_page('privacy_option_fields', 'options-general.php', 'Privacy Policy Settings', 'Meta Privacy Policy');
			add_action('fm_submenu_privacy_option_fields', array($this, 'options_init'));
			
		}


		public function options_init()
		{

			$fm = new Fieldmanager_Group(array(
				'name'           => 'privacy_option_fields',
				'sortable'       => true,
				'label'          => '', //Main Settings
				'children'       => array(
					'main_settings' => new Fieldmanager_Group(array(
						'label' => 'Main Settings',
						'children' => array(
							'public_doc_header' 	=> new Fieldmanager_Textfield('Public Doc Header'),
							'company' 				=> new Fieldmanager_Textfield('Company'),
							'date_field' 			=> new Fieldmanager_Textfield('Date')
						)
					)),
					'strictly_necessary_cookies_group' => new Fieldmanager_Group(array(
						'label'		=> 'Strictly Necessary Cookies',
						'children'	=> array(
							'display_strictly_necessary_section' => new Fieldmanager_Checkbox('Display Strictly Necessary Section', array('default_value' => 'checked')),
							'strictly_necessary_cookies_block' => new Fieldmanager_Group(array(
								'limit'          => 0,
								'extra_elements' => 0,
								'add_more_label' => 'Add Cookie',
								'sortable'       => true,
								'collapsible'    => true,
								'label' 		 => 'Strictly Necessary Cookies Block',
								//'label_macro'  => array( 'Strictly Necessary Cookies: %s', 'cookie_name' ),
								'children' => array(
									'cookie_name' 	  => new Fieldmanager_Textfield('Cookie Name'),
									'cookie_purpose'  => new Fieldmanager_Textfield('Cookie Purpose'),
									'cookie_lifespan' => new Fieldmanager_Textfield('Cookie Lifespan'),
									'cookie_provider' => new Fieldmanager_Textfield('Cookie Provider')
								)
							))

						)
					)),
					'analytic_cookies_group' => new Fieldmanager_Group(array(
						'label'		=> 'Analytic Cookies',
						'children'	=> array(
							'display_analytic_section' => new Fieldmanager_Checkbox('Display Analytic Section', array('default_value' => 'checked')),
							'analytic_cookies_block' => new Fieldmanager_Group(array(
								'limit'          => 0,
								'extra_elements' => 0,
								'add_more_label' => 'Add Cookie',
								'sortable'       => true,
								'collapsible'    => true,
								'label' 		 => 'Analytic Cookies Block',
								'children' => array(
									'cookie_name' 	  => new Fieldmanager_Textfield('Cookie Name'),
									'cookie_purpose'  => new Fieldmanager_Textfield('Cookie Purpose'),
									'cookie_lifespan' => new Fieldmanager_Textfield('Cookie Lifespan'),
									'cookie_provider' => new Fieldmanager_Textfield('Cookie Provider')
								)
							))

						)
					)),
					'functional_cookies_group' => new Fieldmanager_Group(array(
						'label'		=> 'Functional Cookies',
						'children'	=> array(
							'display_functional_section' => new Fieldmanager_Checkbox('Display Functional Section', array('default_value' => 'checked')),
							'functional_cookies_block' => new Fieldmanager_Group(array(
								'limit'          => 0,
								'extra_elements' => 0,
								'add_more_label' => 'Add Cookie',
								'sortable'       => true,
								'collapsible'    => true,
								'label' 		 => 'Functional Cookies Block',
								'children' => array(
									'cookie_name' 	  => new Fieldmanager_Textfield('Cookie Name'),
									'cookie_purpose'  => new Fieldmanager_Textfield('Cookie Purpose'),
									'cookie_lifespan' => new Fieldmanager_Textfield('Cookie Lifespan'),
									'cookie_provider' => new Fieldmanager_Textfield('Cookie Provider')
								)
							))

						)
					)),
					'advertising_cookies_group' => new Fieldmanager_Group(array(
						'label'		=> 'Advertising Cookies',
						'children'	=> array(
							'display_advertising_section' => new Fieldmanager_Checkbox('Display Advertising Section', array('default_value' => 'checked')),
							'advertising_cookies_block' => new Fieldmanager_Group(array(
								'limit'          => 0,
								'extra_elements' => 0,
								'add_more_label' => 'Add Cookie',
								'sortable'       => true,
								'collapsible'    => true,
								'label' 		 => 'Advertising Cookies Block',
								'children' => array(
									'cookie_name' 	  => new Fieldmanager_Textfield('Cookie Name'),
									'cookie_purpose'  => new Fieldmanager_Textfield('Cookie Purpose'),
									'cookie_lifespan' => new Fieldmanager_Textfield('Cookie Lifespan'),
									'cookie_provider' => new Fieldmanager_Textfield('Cookie Provider')
								)
							))

						)
					)),
					'social_media_cookies_group' => new Fieldmanager_Group(array(
						'label'		=> 'Social Media Cookies',
						'children'	=> array(
							'display_social_media_section' => new Fieldmanager_Checkbox('Display Social Media Section', array('default_value' => 'checked')),
							'social_media_cookies_block' => new Fieldmanager_Group(array(
								'limit'          => 0,
								'extra_elements' => 0,
								'add_more_label' => 'Add Cookie',
								'sortable'       => true,
								'collapsible'    => true,
								'label' 		 => 'Social Media Cookies Block',
								'children' => array(
									'cookie_name' 	  => new Fieldmanager_Textfield('Cookie Name'),
									'cookie_purpose'  => new Fieldmanager_Textfield('Cookie Purpose'),
									'cookie_lifespan' => new Fieldmanager_Textfield('Cookie Lifespan'),
									'cookie_provider' => new Fieldmanager_Textfield('Cookie Provider')
								)
							))

						)
					))
				)
			));
			$fm->activate_submenu_page();

		}

	}

	META_Privacy_Policy::instance();

endif;
