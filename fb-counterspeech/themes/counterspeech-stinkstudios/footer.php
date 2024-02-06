<footer class="footer-section">
      <hr>
        <div class="footer-nav">
          <ul>
              <li>
              <a href="<?php echo esc_url(get_option('cntrspch_link_privacy')) ?>" target="_blank">
                <?php echo wp_kses(get_option('cntrspch_label_privacy'),counterspace_allowed_html()); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo esc_url(get_option('cntrspch_link_terms')) ?>" target="_blank">
                <?php echo wp_kses(get_option('cntrspch_label_terms'),counterspace_allowed_html()); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo esc_url(get_option('cntrspch_link_cookies')) ?>" target="_blank">
                <?php echo wp_kses(get_option('cntrspch_label_cookies'),counterspace_allowed_html()); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo esc_url(get_option('cntrspch_link_help')) ?>" target="_blank">
                <?php echo wp_kses(get_option('cntrspch_label_help'),counterspace_allowed_html()); ?>
              </a>
            </li>
            </ul>
            <p>Facebook &copy; <?php echo esc_html(date('Y')); ?></p>
        </div>
        <?php

        /*

        ?>
        <div class="language-nav">
            <a href="#"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/frontend/public/assets/flag1.jpg" alt=""> English</a>
            <a href="#"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/frontend/public/assets/flag2.jpg" alt=""> Urdu</a>
            <a href="#"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/frontend/public/assets/flag3.jpg" alt=""> Hindi</a>
            <a href="#"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/frontend/public/assets/flag4.jpg" alt=""> German</a>
            <a href="#"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/frontend/public/assets/flag5.jpg" alt=""> French</a>
            <a href="#"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/frontend/public/assets/flag6.jpg" alt=""> Spanish</a>
        </div>
           <?php

       */

        ?>
    </footer>
    <?php wp_footer(); ?>
    <!-- FBA -->
    <script type="text/javascript">

      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window,document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');

      fbq('init', '788411397995666');
      fbq('track', 'PageView');
    </script>
    <!-- /FBA -->
    <!-- FBA noscript -->
    <noscript>
      <img height="1" width="1" left="-999" src="https://www.facebook.com/tr?id=788411397995666&ev=PageView&noscript=1"/>
    </noscript>
    <!-- /FBA -->
  </body>
  </html>
