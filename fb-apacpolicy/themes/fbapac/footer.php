<?php
/**
 * The template for displaying the footer
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
        
    <!--footer-wrap-->
    <div class="footer-wrap site-footer" id="colophon">    
        <div class="wrapper">
        
            <div class="footer_logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">FACEBOOK <!--<span>Policy Asset Library, APAC</span>--></a>
            </div>
        
            <div class="footer-right">
               <h6>Questions?</h6>
                  <p>For non policy assets, access the <a href="<?php echo esc_url('https://www.internalfb.com/intern/marketingcontent/gmshub'); ?>" target="_blank">GMS hub</a>.</p>
                  <p>Questions? Ask <a href="<?php echo esc_url('https://fb.workplace.com/profile.php?id=100051713231511'); ?>" target="_blank">Aanchal Mehta</a> (<a href="mailto:aanchalm@fb.com">aanchalm@fb.com</a>) or consult our <a href="/faq">FAQ</a></p>
           </div>
           
            <div class="footer-left"> 
           
               <!--footer-nav-->
               <div class="footer-nav">
                    <ul>
                        <li><a href="https://www.facebook.com/about/basics" target="_blank">PRIVACY</a></li>
                        <li><a href="https://www.facebook.com/legal/terms" target="_blank">TERMS</a></li>
                        <li><a href="https://www.facebook.com/policies/cookies" target="_blank" > COOKIES</a></li>
                    </ul>
               </div>
               <!--footer-nav-->
               
                <!--footer-logo--> 
                <div class="footer-logo">
                      <?php echo esc_attr( gmdate( ' Y' ) ); ?> FACEBOOK
                </div>
               <!--footer-logo-->
            
           </div>
            
        </div>
            
          
           
    </div>
    <!--footer-wrap-->
        
    
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
