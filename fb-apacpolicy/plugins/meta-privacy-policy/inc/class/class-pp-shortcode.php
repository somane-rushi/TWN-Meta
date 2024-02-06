<?php
function pp_shortcode()
{
	$global_fields 			= get_option('privacy_option_fields');

	$main_settings 			= $global_fields['main_settings'];
	$public_doc_header 		= $main_settings['public_doc_header'] ?  $main_settings['public_doc_header'] : '';
	$company 				= $main_settings['company'] ? $main_settings['company'] : '[Company]';
	$date_field 			= $main_settings['date_field'] ? $main_settings['date_field'] : '[Date]';

	$strictly_necessary_cookies_group	= $global_fields['strictly_necessary_cookies_group'];
	$display_strictly_necessary_section	= $strictly_necessary_cookies_group['display_strictly_necessary_section'];
	$strictly_necessary_cookies_block	= $strictly_necessary_cookies_group['strictly_necessary_cookies_block'];

	$analytic_cookies_group		= $global_fields['analytic_cookies_group'];
	$display_analytic_section	= $analytic_cookies_group['display_analytic_section'];
	$analytic_cookies_block		= $analytic_cookies_group['analytic_cookies_block'];

	$functional_cookies_group	= $global_fields['functional_cookies_group'];
	$display_functional_section	= $functional_cookies_group['display_functional_section'];
	$functional_cookies_block	= $functional_cookies_group['functional_cookies_block'];

	$advertising_cookies_group		= $global_fields['advertising_cookies_group'];
	$display_advertising_section	= $advertising_cookies_group['display_advertising_section'];
	$advertising_cookies_block		= $advertising_cookies_group['advertising_cookies_block'];

	$social_media_cookies_group		= $global_fields['social_media_cookies_group'];
	$display_social_media_section	= $social_media_cookies_group['display_social_media_section'];
	$social_media_cookies_block		= $social_media_cookies_group['social_media_cookies_block'];

	$data ='


	<!--  Privacy Policy Style Sheet -->
	
	<style>
	
		#meta-privacy-policy {
			padding: 20px 50px;
			max-width:1200px;
			margin: auto;
			padding-bottom:100px;
		}


		#meta-privacy-policy p {

			line-height: 1.5;
			margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;

		}

		#meta-privacy-policy table {
			margin: 25px 0 40px 0;
			width: 100%;
			text-align: center;
			border: 1px solid black;
			border-collapse: collapse;
		}

		#meta-privacy-policy table tr th {
			padding: 12px 10px;
			background-color: #ccc;
			border: 1px solid black;
			border-collapse: collapse;
		}

		#meta-privacy-policy th.name {
			width:15%;
		}

		#meta-privacy-policy th.purpose {
			width:55%;
		}

		#meta-privacy-policy th.lifespan {
			width:15%;
		}

		#meta-privacy-policy th.provider {
			width:15%;
		}

		#meta-privacy-policy table tr td {
			padding: 12px 10px;
			background-color: white;
			border: 1px solid black;
			border-collapse: collapse;
		}

		#meta-privacy-policy a {
			text-decoration: none;
			display: inline-block;
			margin-bottom: 6px;
		}

		#meta-privacy-policy h4 {
			margin: 40px 0;
		}
	</style>

	<div id="meta-privacy-policy">
		<center>
			<h2>'.esc_html($public_doc_header).'</h2>
			<h3>'.esc_html($company).' Cookie Notice</h3>
			<h5>Last updated: '.esc_html($date_field).'</h5>
		</center>

		<h4>1. INTRODUCTION</h4>
		<p>This notice ("<strong>Cookie Notice</strong>") explains how '.esc_html($company).' ("<strong>'.esc_html($company).'</strong>" or "<strong>we</strong>") our website, mobile application
			and similar services (<strong>Services</strong>) use cookies. The notice also sets out how you can manage your cookie settings and withdraw your given consent
			in relation to the use of cookies and other technologies. </p>
		<p>We encourage you to read this Cookie Notice closely. If you have any questions in this regard or otherwise in relation to our handling of cookies and other
			technologies, please don\'t hesitate to contact us by using the contact details in Section 6. </p>
		<p>If you want to have more information on how we process your personal information, please read our Privacy Notice.</p>

		<h4>2. WHAT ARE COOKIES?</h4>
		<p>A cookie is a small text file that is placed on your device when you visit a website or use an application. Cookies are widely used to make websites or mobile
			applications work or to improve their efficiency, as well as to provide a better experience, for instance by allowing the website or mobile application to
			recognize when a visitor returns to the website. When we talk about cookies in this Cookie Notice, this term also includes these similar technologies such as
			pixel tags and web beacons. </p>
		<p><strong>First-party cookies</strong> refer to cookies that we have placed on your device when you use our Services.</p>
		<p><strong>Third-Party Cookies</strong> refer to cookies that another party has placed on your device when you use our Services.</p>
		<p><strong>Permanent cookies</strong> refer to cookies that remain on your device when our Services are closed but are to be used on subsequent visits to or uses of
			our Services.</p>
		<p><strong>Session cookies</strong> refer to cookies that are temporary and disappear after our Services are closed.</p>


		<h4>3. THE PURPOSES FOR WHICH WE USE COOKIES</h4>
		<p>When you use our Services, cookies and similar technologies are placed on your device for the following purposes.</p>

		<!-- Strictly necessary cookies -->';
		
		if ($display_strictly_necessary_section) : 
			$data .='<p><strong>Strictly necessary cookies</strong> are indispensable for using our Services and all its functionalities. These cookies cannot be switched off as some
				parts of your Services will not function as intended. </p>';
			if ($strictly_necessary_cookies_block) : 
				$data .='<table width="0" cellspacing="0" cellpadding="0">
					<tr>
						<th class="name">Cookie name</th>
						<th class="purpose">Cookie purpose</th>
						<th class="lifespan">Cookie lifespan</th>
						<th class="provider">Cookie Provider</th>
					</tr>';
					foreach ($strictly_necessary_cookies_block as $sncb) :
						$data .='<tr>
							<td>'.esc_html($sncb['cookie_name']).'</td>
							<td>'.esc_html($sncb['cookie_purpose']).'</td>
							<td>'.esc_html($sncb['cookie_lifespan']).'</td>
							<td>'.esc_html($sncb['cookie_provider']).'</td>
						</tr>';
					endforeach;
					$data .='</table>';
			endif;
		endif;

		$data .='<!-- Analytic cookies -->';
		if ($display_analytic_section) : 
			$data .='<p><strong>Analytic cookies</strong> help us improve and optimize the experience we provide. They allow us to measure how users interact with the Services and how we
				use this information to improve the user experience and performance of the Services.</p>';
			if ($analytic_cookies_block) : 
				$data .='<table width="0" cellspacing="0" cellpadding="0">
					<tr>
						<th class="name">Cookie name</th>
						<th class="purpose">Cookie purpose</th>
						<th class="lifespan">Cookie lifespan</th>
						<th class="provider">Cookie Provider</th>
					</tr>';
					foreach ($analytic_cookies_block as $sncb) : 
						$data .='<tr>
							<td>'.esc_html($sncb['cookie_name']).'</td>
							<td>'.esc_html($sncb['cookie_purpose']).'</td>
							<td>'.esc_html($sncb['cookie_lifespan']).'</td>
							<td>'.esc_html($sncb['cookie_provider']).'</td>
						</tr>';
					endforeach;
					$data .='</table>';
			endif;
		endif; 

		$data .='<!-- Functional cookies -->';
		if ($display_functional_section) :
			$data .='<p><strong>Functional cookies</strong> collect information about your interaction with functionalities provided on our Services and may be used to remember your preferences
				(such as your language preference), your interests and the presentation of the website (such as the font size). Without these cookies the Services may
				not perform properly.</p>';
			if ($functional_cookies_block) : 
				$data .='<table width="0" cellspacing="0" cellpadding="0">
					<tr>
						<th class="name">Cookie name</th>
						<th class="purpose">Cookie purpose</th>
						<th class="lifespan">Cookie lifespan</th>
						<th class="provider">Cookie Provider</th>
					</tr>';
					foreach ($functional_cookies_block as $sncb) : 
						$data .='<tr>
							<td>'.esc_html($sncb['cookie_name']).'</td>
							<td>'.esc_html($sncb['cookie_purpose']).'</td>
							<td>'.esc_html($sncb['cookie_lifespan']).'</td>
							<td>'.esc_html($sncb['cookie_provider']).'</td>
						</tr>';
					endforeach;
					$data .='</table>';
			endif;
		 endif; 

		$data .='<!-- Advertising cookies -->';
		if ($display_advertising_section) : 
			$data .='<p><strong>Advertising cookies</strong> offer you personalized and more relevant ads, measure the performance of ads and provide insights about how you use our Services. They are used on our Services and generally placed on your device by our service providers or advertisers belonging to their advertising network.</p>';
			if ($advertising_cookies_block) : 
				$data .='<table width="0" cellspacing="0" cellpadding="0">
					<tr>
						<th class="name">Cookie name</th>
						<th class="purpose">Cookie purpose</th>
						<th class="lifespan">Cookie lifespan</th>
						<th class="provider">Cookie Provider</th>
					</tr>';
					foreach ($advertising_cookies_block as $sncb) : 
						$data .='<tr>
							<td>'.esc_html($sncb['cookie_name']).'</td>
							<td>'.esc_html($sncb['cookie_purpose']).'</td>
							<td>'.esc_html($sncb['cookie_lifespan']).'</td>
							<td>'.esc_html($sncb['cookie_provider']).'</td>
						</tr>';
					endforeach;
					$data .='</table>';
			endif;
		endif;


		$data .='<!-- Social media cookies -->';
		if ($display_social_media_section) : 
			$data .='<p><strong>Social media cookies</strong> allow you to share the content of our Services on social media and to enable other social media functionalities via our Services.</p>';
			if ($social_media_cookies_block) : 
				$data .='<table width="0" cellspacing="0" cellpadding="0">
					<tr>
						<th class="name">Cookie name</th>
						<th class="purpose">Cookie purpose</th>
						<th class="lifespan">Cookie lifespan</th>
						<th class="provider">Cookie Provider</th>
					</tr>';
					foreach ($social_media_cookies_block as $sncb) : 
						$data .='<tr>
							<td>'.esc_html($sncb['cookie_name']).'</td>
							<td>'.esc_html($sncb['cookie_purpose']).'</td>
							<td>'.esc_html($sncb['cookie_lifespan']).'</td>
							<td>'.esc_html($sncb['cookie_provider']).'</td>
						</tr>';
					endforeach;
					$data .='</table>';
			endif;
		endif;

		$data .='<h4>4. HOW TO MANAGE COOKIES </h4>
		<p>When you use our Services, you are given the option to fully or partially agree to placing cookies and similar technologies on your devices. However, you cannot decline cookies that are strictly necessary. If you have given your consent to the use of other cookies, you can withdraw it at any time by changing your preferences. </p>
		<p>In addition, you can configure your internet browser to prevent certain cookies or similar technologies from being placed on your devices. You may also delete cookies that have been set on your devices at any time. In the links below you can find guidance on how to delete or block cookies in the most common browsers.</p>

		<p>
			<a href="https://support.google.com/accounts/answer/32050?co=GENIE.Platform%3DDesktop&hl=en" target="_blank">Chrome</a><br>
			<a href="https://support.mozilla.org/en-US/kb/clear-cookies-and-site-data-firefox" target="_blank">Firefox</a><br>
			<a href="https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac" target="_blank">Safari</a><br>
			<a href="https://support.microsoft.com/en-us/help/4027947/microsoft-edge-delete-cookies" target="_blank">Microsoft Edge</a>
		</p>

		<h4>5. UPDATING THIS COOKIE POLICY</h4>
		<p>This Cookie Notice may be updated as considered necessary from time to time. In case any changes will be significant, we will inform you in an appropriate manner before the changes will come into effect, for example by sending you an email or by providing you with a notice when you use our Services. </p>
		<p>We recommend that you read such information carefully and keep yourself up to date by periodically re-visiting the Cookie Notice.</p>

		<h4>6. CONTACT INFORMATION</h4>
		<p>If you have any questions in relation to this Cookie Notice or our handling of cookies and similar technologies please feel free to contact us:</p>
		<p>
			'.esc_html($company).'
		</p>

	</div>';

	return $data;						

}


add_shortcode('privacy-policy', 'pp_shortcode');
