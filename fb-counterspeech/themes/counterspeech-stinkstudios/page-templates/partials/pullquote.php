<?php if (isset($pullQuoteText) && !empty($pullQuoteText)) {
    ?>
  <div class="pullquote-wrapper">
    <div class="pullquote">
      <div class="quote-mark"></div>
      <?php echo esc_html($pullQuoteText); ?>
    </div>
  </div>
<?php 
} ?>
