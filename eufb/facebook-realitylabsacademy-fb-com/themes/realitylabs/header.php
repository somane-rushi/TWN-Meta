<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package realitylabs
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" name="viewport">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class('page-brand'); ?> >
<?php wp_body_open(); ?>
	<header class="header header-waterfall ui-header headerFRL bgwhite headBoxShadow">
		<div class="container-full ">
			<div class="mainNavFlex">
				<ul class="nav nav-list pull-left hidden-lg hidden-md hidden-sm">
					<li>
                    	<a data-toggle="menu" href="#ui_menu"><span class="icon icon-lg">menu</span></a>
					</li>
				</ul>
                <a class="header-logo margin-left-no margin-right-no" href="index.html">
                    <img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/meta-reality-labs-academy-logo.png" alt="" class="margin-left margin-right frlLogo hidden-xx hidden-xs" />
                    <img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/meta-reality-labs-academy-logo.png" alt="" class="margin-left-no margin-right frlLogoMob hidden-lg hidden-md hidden-sm" />
                </a>
                <nav class="tab-nav pull-right hidden-xx">
					<ul class="nav nav-list fontTxt font14">
						<li class="dropdown active">
                                <a href="#" class="dropdown-toggle txtNavBlue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Learn Skills&nbsp;<span class="icon">keyboard_arrow_down</span></a>
                                <ul class="dropdown-menu txtGrey">
                                    <li><a href="page2.html">101 Foundation +</a></li>
                                    <li><a href="#">201 Foundation</a></li>
                                    <li><a href="#">301 Accelerator +</a></li>
                                    <li><a href="#">401 Foundation ++ (VR)</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="waves-attach waves-light" data-toggle="tab" href=""><span class="txtGrey">Showcase Work</span></a>
                            </li>
                            <li>
                                <a class="waves-attach waves-light" data-toggle="tab" href=""><span class="txtGrey">Connect With Clients</span></a>
                            </li>
                            <li>
                                <a class="waves-attach waves-light" data-toggle="tab" href=""><span class="txtGrey">Exchange Ideas</span></a>
                            </li>
                        </ul>
                    </nav>
                    <nav class="pull-right hidden-xx">
                        <ul class="nav nav-list fontTxt font14 navbar-right">
                            <!--<li>
                                <a class="btn loginButton waves-attach waves-light waves-effect padding-right-lg padding-left-lg txtWhite" href="login.html">Login</a>
                            </li>-->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle txtGrey padding-right-no padding-left-no" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="icon icon-lg margin-right-sm margin-left-sm">translate</span>English&nbsp;<span class="icon">keyboard_arrow_down</span></a>
                                <ul class="dropdown-menu txtGrey">
                                    <li><a href="#">Japanese</a></li>
                                    <li><a href="#">Thai</a></li>
                                    <li><a href="#">Korean</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--container-full-->
        </header>
        <nav aria-hidden="true" class="menu" id="ui_menu" tabindex="-1">
            <div class="menu-scroll">
                <div class="menu-content">
                    <ul class="nav">
                        <li>
                            <a class="waves-attach txtDarkGrey fontXtraLight font18" data-toggle="collapse" href="#skills">Learn Skills&nbsp;<span class="icon">keyboard_arrow_down</span></a>
                            <ul class="menu-collapse collapse in" id="skills">
                                <li>
                                    <a class="waves-attach txtGrey fontXtraLight font14" href="#">101 Foundation +</a>
                                </li>
                                <li>
                                    <a class="waves-attach txtGrey fontXtraLight font14" href="#">201 Foundation</a>
                                </li>
                                <li>
                                    <a class="waves-attach txtGrey fontXtraLight font14" href="#">301 Accelerator +</a>
                                </li>
                                <li>
                                    <a class="waves-attach txtGrey fontXtraLight font14" href="#">401 Foundation ++ (VR)</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="waves-attach txtDarkGrey fontXtraLight font18" href="#">Showcase Work</a>						
                        </li>
                        <li>
                            <a class="waves-attach txtDarkGrey fontXtraLight font18" href="#">Connect with Clients</a>						
                        </li>
                        <li>
                            <a class="waves-attach txtDarkGrey fontXtraLight font18" href="#">Exchange Ideas</a>						
                        </li>
                        <li>
                            <a class="waves-attach txtDarkGrey fontXtraLight font18" href="">&nbsp;</a>						
                        </li>
                        <!--<li>
                            <a class="waves-attach txtRed fontXtraLight font18" href="#">Login</a>						
                        </li>-->
                        <li>
                            <a class="waves-attach txtDarkGrey fontXtraLight font18" data-toggle="collapse" href="#lang"><span class="icon icon-sm margin-right-sm margin-left-sm txtGrey">translate</span>Select Language&nbsp;<span class="icon">keyboard_arrow_down</span></a>
                            <ul class="menu-collapse collapse in" id="lang">
                                <li>
                                    <a class="waves-attach txtGrey fontXtraLight font14" href="#">English</a>
                                </li>
                                <li>
                                    <a class="waves-attach txtGrey fontXtraLight font14" href="#">Thai</a>
                                </li>
                                <li>
                                    <a class="waves-attach txtGrey fontXtraLight font14" href="#">Korean</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
<div id="page" class="site">
	<main class="content">
	
	
