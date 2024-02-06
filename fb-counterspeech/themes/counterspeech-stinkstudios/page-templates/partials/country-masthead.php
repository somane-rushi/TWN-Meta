
<div class="masthead">

  <div class="map-segment country">
    <div class="map-wrapper">
      <div id="country-map" class="map"
        data-code="<?php echo esc_attr($countryCode) ?>"
        data-lat="<?php echo esc_attr($countryLat) ?>"
        data-lng="<?php echo esc_attr($countryLng) ?>"
        ></div>
    </div>
  </div>
  <div class="masthead-copy-wrapper">
    <h1 class="masthead-copy">
      <?php echo esc_html($mastheadText); ?>
    </h1>
  </div>
</div>
