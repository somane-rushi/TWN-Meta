<?php
/**
 * GLOBAL HEADER (every template)
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="<?php echo esc_attr( get_bloginfo('charset') ); ?>">
  <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/fonts/Optimistic_Display_W_XLt.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/fonts/Optimistic_Display_W_Lt.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/fonts/Optimistic_Display_W_Md.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/fonts/Optimistic_Display_W_Bd.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/fonts/Optimistic_Display_W_XBd.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/fonts/Optimistic_Text_W_Lt.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/fonts/Optimistic_Text_W_Rg.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/fonts/Optimistic_Text_W_Md.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/fonts/Optimistic_Text_W_Bd.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/fonts/Optimistic_Text_W_XBd.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() . '/img/favicon.ico' ); ?>" >
  <?php wp_head(); ?>

  <script>
    window.gdprSafeTrack('https://www.googletagmanager.com/gtag/js?id=G-8NKT7BLB52');
  </script>
  <script>
    if (window.gdprSafeTrack) {
      window.gdprSafeTrack(function() {
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-8NKT7BLB52');
      });
    }
  </script>

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

  <div id="the--menu--blur"></div>

  <header class="header main-header">

    <div class="header-container">

      <div class="header-inner">
      
        <!--header-inner-top-->
        <div class="header-inner-top">

          <div class="logo on-search-hover">
            <a href="<?php echo esc_url( home_url() ); ?>" title="Lookback Home" rel="noopener">
              <img class="desktop" src="<?php echo esc_url( get_template_directory_uri() . '/img/logo-header.png' ); ?>" alt="Facebook" />
              <img class="mob" src="<?php echo esc_url( get_template_directory_uri() . '/img/logo-mobile.png' ); ?>" alt="Facebook" />
            </a>
          </div>
            
          <div class="header-right">

          <?php
            $global_fields = get_option('global_fields');
            $search_placeholder = (!empty(fbsafety_fm_get_data($global_fields, 'default_search_term'))) ? fbsafety_fm_get_data($global_fields, 'default_search_term') : 'Search';
          ?>
            <div class="search-btn">
              <i><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/search-icon.jpg' ); ?>" alt="Search icon"></i>
              <div class="search-inputs autocomplete autocomplete-header">
                <form role="search" method="get" id="sf--header" class="search-form" action="<?php echo esc_url( home_url( '/search/' ) ); ?>">
                  <input type="search" class="search-field" id="search--query-h" value="" name="ss" placeholder="<?php echo esc_attr($search_placeholder); ?>" autocomplete="off">
                  <!--<button type="submit" class="search-submit">search</button>-->
                </form>
              </div>
        <?php
          if ( '1' === fbsafety_fm_get_data($global_fields, 'autocomplete_toggle') ) :
            $autocomplete_search_terms = fbsafety_fm_get_data($global_fields, 'autocomplete_search_terms');
            if ( ! empty($autocomplete_search_terms) ) :
              $search_terms_explode = array_map('trim', explode(',', $autocomplete_search_terms)) ?: array();
              if ( ! empty($search_terms_explode) ) :
        ?>
              <script>
                var the__list_h = JSON.parse( decodeURIComponent( '<?php echo rawurlencode( wp_json_encode($search_terms_explode ) ); ?>' ) );
                fbsafety_autocomplete(document.getElementById("search--query-h"), the__list_h);
              </script>
        <?php
              endif;
            endif;
          endif;
        ?>
            </div>
               
             <div class="select-language">
              <span class="select-language-label">Language</span>
             </div>
                
          </div>
            
        </div>
        
        <div class="header-inner-bottom">

          <div class="header-inner-bottom-left">
            <div class="header-inner-bottom-logo">
              <a href="<?php echo esc_url( home_url() ); ?>" <?php body_class( $post->post_name ) ; ?>>
              </a>
            </div>       
          </div>
   
          <div <?php body_class( array( 'header-inner-bottom-right', $post->post_name ) ); ?>>
            
            <div class="header-menu desktop">
              <button class="mega-button"></button>
                <?php
                  wp_nav_menu(
                    array(
                      'theme_location' => 'header-main',
                      'menu_class'     => 'header-main',
                      'menu_id'        => 'header-main',
                      //'walker'         => new Add_button_of_Sublevel_Walker(),
                    )
                  );
                ?>
            </div>
    
          </div>
            
          <div class="burger-menu on-search-hover">
            <span class="burger-inner top"></span>
            <span class="burger-inner center"></span>
            <span class="burger-inner bottom"></span>
            <a href="#" data-target="mobile-menu" data-action="toggle" class="hamburger-link slide-menu__control"></a>
         </div>

        </div>

        <nav class="slide-menu" id="mobile-menu">
       
          <div class="controls clearfix">

            <div class="logo">
              <a href="<?php echo esc_url( home_url() ); ?>" title="Lookback Home" rel="noopener">
                <img class="desktop" src="<?php echo esc_url( get_template_directory_uri() . '/img/logo-header.png' ); ?>" alt="Facebook" />
                <img class="mob" src="<?php echo esc_url( get_template_directory_uri() . '/img/logo-mobile.png' ); ?>" alt="Facebook" />
                <img class="mob-tag" src="<?php echo ('/wp-content/themes/fb-safety/img/DT_logo_Gray.svg'); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
              </a>
            </div>

            <div class="burger-menu active">
              <span class="burger-inner top"></span>
              <span class="burger-inner center"></span>
              <span class="burger-inner bottom"></span>
              <a href="#" data-target="mobile-menu" data-action="toggle" class="hamburger-link slide-menu__control"></a>
            </div>

          </div>

          <?php
              wp_nav_menu(
                array(
                  'theme_location' => 'header-mobile',
                  'menu_class'     => 'header-mobile',
                  'menu_id'        => 'header-mobile'
                )
              );
            ?>
  
        </nav>

      </div>

    </div>

  </header>
