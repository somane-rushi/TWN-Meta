<?php
/**
 * The header for our theme (LOOKBACK pages)
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

nocache_headers();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta http-equiv="cache-control" content="no-cache" />
  <meta charset="<?php echo esc_attr( get_bloginfo('charset') ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="shortcut icon" href="<?php echo esc_url(get_stylesheet_directory_uri(). '/images/favicon.ico'); ?>" >
  <?php wp_head(); ?>
</head>

<body <?php body_class('thailand--sections'); ?>>
<?php wp_body_open(); ?>

	<div class="main-wrapper">
		<header class="header-section">
                <div class="container-fluid">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-8">
                        <div class="header-logo">
                            <a href="<?php echo esc_url( home_url( '/thailand/' ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/thailand/images/fb-thai-logo.png' ); ?>" alt="Thailand"></a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-6 col-xs-4">
                        <div class="site-nav hidden-xs">
                        	<ul>
                        		<li><a href="<?php echo esc_url( home_url( '/thailand/' ) ); ?>economic-opportunity">Economic Opportunity</a></li>
                        		<li><a href="#">Digital Citizenship</a></li>
                        		<li><a href="#">Communities &amp; Innovation</a></li>
                        		<li><a href="#">COVID-19, Safety and Wellbeing</a></li>
                        		<li><a href="#">Thought Leadership</a></li>
                        	</ul>                        
                        </div>
                       	<nav class="navbar navbar-default hidden-lg hidden-md visible-sm">
                        	<div class="navbar-header">
			                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navDropDown" aria-expanded="false">
			                    <span class="sr-only">Toggle navigation</span>
			                    <span class="icon-bar"></span>
			                    <span class="icon-bar"></span>
			                    <span class="icon-bar"></span>
			                    </button>
			                </div>
			        	</nav>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-lg hidden-md hidden-sm">
                    	<!-- Collect the nav links, forms, and other content for toggling -->
			            <div class="collapse navbar-collapse" id="navDropDown">
			            	<ul class="nav navbar-nav">
			            		<li><a href="#">Economic Opportunity</a></li>
	                        	<li><a href="#">Digital Citizenship</a></li>
	                        	<li><a href="#">Communities &amp; Innovation</a></li>
	                        	<li><a href="#">COVID-19, Safety and Wellbeing</a></li>
	                        	<li><a href="#">Thought Leadership</a></li>
			                </ul>
			            </div>
                    </div>
                </div>
		</header>

    