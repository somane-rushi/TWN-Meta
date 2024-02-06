<?php 
/*
	Plugin Name: Meta Tracking
	Description: Install Google Analytics, Google Analytics 4, Google Tag Manager and Facebook Pixel.
	Tags: Google Analytics, Google Analytics 4, Google Tag Manager, Facebook Pixel
	Author: NJI Media
	Author URI: https://njimedia.com/
	Version: 1.0.0
	License: GPL v2 or later
*/

if (!defined('ABSPATH')) die();

class MetaTracking {
	private $meta_tracking_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'meta_tracking_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'meta_tracking_backend' ) );
		add_action('wp_enqueue_scripts', array( $this, 'meta_tracking_head' ) );
		add_action('wp_footer', array( $this, 'meta_tracking_footer' ) );
		add_filter('script_loader_tag', array( $this, 'filter_script_loader_tag' ), 10, 3);
	}

	public function meta_tracking_add_plugin_page() {
		add_options_page(
			'Meta Tracking', // page_title
			'Meta Tracking', // menu_title
			'manage_options', // capability
			'meta-tracking', // menu_slug
			array( $this, 'meta_tracking_create_admin_page' ) // function
		);
	}

	public function meta_tracking_create_admin_page() {
		$this->meta_tracking_options = get_option( 'meta_tracking_option_name' ); ?>

		<div class="wrap">
			<h2>Meta Tracking</h2>
			<form method="post" action="options.php">
				<?php
					settings_fields( 'meta_tracking_option_group' );
					do_settings_sections( 'meta-tracking-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function meta_tracking_backend() {
		register_setting(
			'meta_tracking_option_group', // option_group
			'meta_tracking_option_name', // option_name
			array( $this, 'meta_tracking_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'meta_tracking_setting_section', // id
			'Settings', // title
			array(), // callback
			'meta-tracking-admin' // page
		);

		add_settings_field(
			'google_analytics_ua', // id
			'Google Analytics (UA)', // title
			array( $this, 'google_analytics_ua_callback' ), // callback
			'meta-tracking-admin', // page
			'meta_tracking_setting_section' // section
		);

		add_settings_field(
			'google_analytics_g4', // id
			'Google Analytics (G4)', // title
			array( $this, 'google_analytics_g4_callback' ), // callback
			'meta-tracking-admin', // page
			'meta_tracking_setting_section' // section
		);

		add_settings_field(
			'google_tag_manager', // id
			'Google Tag Manager', // title
			array( $this, 'google_tag_manager_callback' ), // callback
			'meta-tracking-admin', // page
			'meta_tracking_setting_section' // section
		);

		add_settings_field(
			'facebook_pixel', // id
			'Facebook Pixel', // title
			array( $this, 'facebook_pixel_callback' ), // callback
			'meta-tracking-admin', // page
			'meta_tracking_setting_section' // section
		);
	}

	public function meta_tracking_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['google_analytics_ua'] ) ) {
			$sanitary_values['google_analytics_ua'] = sanitize_text_field( $input['google_analytics_ua'] );
		}

		if ( isset( $input['google_analytics_g4'] ) ) {
			$sanitary_values['google_analytics_g4'] = sanitize_text_field( $input['google_analytics_g4'] );
		}

		if ( isset( $input['google_tag_manager'] ) ) {
			$sanitary_values['google_tag_manager'] = sanitize_text_field( $input['google_tag_manager'] );
		}

		if ( isset( $input['facebook_pixel'] ) ) {
			$sanitary_values['facebook_pixel'] = sanitize_text_field( $input['facebook_pixel'] );
		}

		return $sanitary_values;
	}

	public function google_analytics_ua_callback() {
		printf(
			'<input class="regular-text" type="text" name="meta_tracking_option_name[google_analytics_ua]" id="google_analytics_ua" value="%s">',
			isset( $this->meta_tracking_options['google_analytics_ua'] ) ? esc_attr( $this->meta_tracking_options['google_analytics_ua']) : ''
		);
	}

	public function google_analytics_g4_callback() {
		printf(
			'<input class="regular-text" type="text" name="meta_tracking_option_name[google_analytics_g4]" id="google_analytics_g4" value="%s">',
			isset( $this->meta_tracking_options['google_analytics_g4'] ) ? esc_attr( $this->meta_tracking_options['google_analytics_g4']) : ''
		);
	}

	public function google_tag_manager_callback() {
		printf(
			'<input class="regular-text" type="text" name="meta_tracking_option_name[google_tag_manager]" id="google_tag_manager" value="%s">',
			isset( $this->meta_tracking_options['google_tag_manager'] ) ? esc_attr( $this->meta_tracking_options['google_tag_manager']) : ''
		);
	}

	public function facebook_pixel_callback() {
		printf(
			'<input class="regular-text" type="text" name="meta_tracking_option_name[facebook_pixel]" id="facebook_pixel" value="%s">',
			isset( $this->meta_tracking_options['facebook_pixel'] ) ? esc_attr( $this->meta_tracking_options['facebook_pixel']) : ''
		);
	}

	public function filter_script_loader_tag($tag, $handle, $src) {
		foreach ( array( 'async', 'defer' ) as $attr ) {
			if ( ! wp_scripts()->get_data( $handle, $attr ) ) {
				continue;
			}
			if ( ! preg_match( ":\s$attr(=|>|\s):", $tag ) ) {
				$tag = preg_replace( ':(?=></script>):', " $attr", $tag, 1 );
			}
			break;
		}
		return $tag;
	}

	public function meta_tracking_head(){
		$meta_tracking_options = get_option( 'meta_tracking_option_name' ); // Array of All Options
		$google_analytics_ua = $meta_tracking_options['google_analytics_ua']; // Google Analytics (UA)
		$google_analytics_g4 = $meta_tracking_options['google_analytics_g4']; // Google Analytics (G4)
		$google_tag_manager = $meta_tracking_options['google_tag_manager']; // Google Tag Manager
		$facebook_pixel = $meta_tracking_options['facebook_pixel']; // Facebook Pixel
		
		if($google_analytics_ua){
			//<!-- Google Analytics by Meta Tracking -->
			wp_register_script( 'google-analytics-ua', '');
			wp_add_inline_script(
				'google-analytics-ua',
				"
				var google_analytics_ua  = decodeURIComponent( '".rawurlencode( (string) $google_analytics_ua )."' );
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
				ga('create', google_analytics_ua, 'auto');
				ga('send', 'pageview');"
			);
			wp_enqueue_script('google-analytics-ua');
		}

		if($google_analytics_g4){
			//<!-- Google Analytics 4 by Meta Tracking -->
			wp_register_script( 'google-analytics-g4', 'https://www.googletagmanager.com/gtag/js?id='.rawurlencode($google_analytics_g4));
			wp_add_inline_script(
				'google-analytics-g4',
				"
				var google_analytics_g4  = decodeURIComponent( '".rawurlencode( (string) $google_analytics_g4 )."' );
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());
				gtag('config', google_analytics_g4);"
			);
			wp_enqueue_script('google-analytics-g4');
			wp_script_add_data( 'google-analytics-g4', 'async', true );
		}

		if($google_tag_manager){
			//<!-- Google Tag Manager by Meta Tracking -->
			wp_register_script( 'google-tag-manager', '');
			wp_add_inline_script(
				'google-tag-manager',
				"
				var google_tag_manager  = decodeURIComponent( '".rawurlencode( (string) $google_tag_manager )."' );
				(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer',google_tag_manager);"
			);
			wp_enqueue_script('google-tag-manager');
		}

		if($facebook_pixel){
			//<!-- Facebook Pixel by Meta Tracking -->
			wp_register_script( 'facebook-pixel', '');
			wp_add_inline_script(
				'facebook-pixel',
				"
				var facebook_pixel  = decodeURIComponent( '".rawurlencode( (string) $facebook_pixel )."' );
				!function(f,b,e,v,n,t,s)
				{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
				n.callMethod.apply(n,arguments):n.queue.push(arguments)};
				if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
				n.queue=[];t=b.createElement(e);t.async=!0;
				t.src=v;s=b.getElementsByTagName(e)[0];
				s.parentNode.insertBefore(t,s)}(window, document,'script',
				'https://connect.facebook.net/en_US/fbevents.js');
				fbq('init', facebook_pixel);
				fbq('track', 'PageView');"
			);
			wp_enqueue_script('facebook-pixel');
		}
	}

	public function meta_tracking_footer(){
		$meta_tracking_options = get_option( 'meta_tracking_option_name' ); // Array of All Options
		$google_tag_manager = $meta_tracking_options['google_tag_manager']; // Google Tag Manager
		$facebook_pixel = $meta_tracking_options['facebook_pixel']; // Facebook Pixel
		?>

		<?php if($google_tag_manager){?>
			<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo rawurlencode($google_tag_manager);?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<?php }?>

		<?php if($facebook_pixel){?>
			<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo rawurlencode($facebook_pixel);?>&ev=PageView&noscript=1"/></noscript>
		<?php }
	}
}

$meta_tracking = new MetaTracking();
