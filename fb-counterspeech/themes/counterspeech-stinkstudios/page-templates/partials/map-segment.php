
<?php

  $regionsAndCountries = regionsAndCountries();

  $initiatives = get_posts(array(
    'post_type' => 'cntrspch_gi',
    'posts_per_page' => 200,
    'suppress_filters' => false
  ));
?>

<div class="map-container">
  <div class="map-segment">
    <div class="data-sidebar">
      <div class="map-intro-copy default">
        <h4 class="map-copy"><?php echo esc_html($introText) ?></h4>
        <div class="header-line-left white"></div>
        <p class="map-copy small"><?php echo esc_html($explainerText) ?></p>
        <div class="map-intro-icon">
        </div>
      </div>
      <div class="map-intro-copy data-points">
        <h4 id="data-country" class="map-copy"></h4>
        <div class="header-line-left white"></div>
        <p id="data-body" class="map-copy map-copy-bottom small"></p>
        <div id="data-icon" class="map-data-icon">
          <div id="data-mustache"></div>
        </div>
      </div>
    </div>
    <div class="map-wrapper">
      <button type="button" name="btn-zoom-in" class="btn-zoom-in" data-id="zoom_in"></button>
      <button type="button" name="btn-zoom-out" class="btn-zoom-out" data-id="zoom_out"></button>
      <div id="global-map" class="map">

      </div>
      <div class="carousel-wrapper">

        <div class="carousel-header"><?php echo esc_html($mobileCarouselHeader) ?></div>
        <div class="carousel">
          <?php
            foreach ($mobileCountries as $mobileCountry) {
                $countryName = get_the_title($mobileCountry);
                $countryMapData = get_post_meta($mobileCountry, 'latitude_and_longitude', true);
                $countryDataPoint = $countryMapData['datapoint'];
                $countryDataPointMustache = $countryMapData['datapoint_mustache']; ?>
            <div class="carousel-item active">

              <div class="carousel-content carousel-top-row">
                <div class="icon">
                  <?php include(locate_template('/svg-templates/home-map-carousel-mobile.php')); ?>
                </div>
                <p class="title">
                  <?php echo esc_html($countryName) ?>
                </p>
              </div>

              <div class="carousel-content datapoint">
                <?php echo esc_html($countryDataPoint) ?>
              </div>
              <div class="carousel-content mustache">
                <?php echo esc_html($countryDataPointMustache) ?>
              </div>
            </div>
          <?php
            } ?>
        </div>

        <div class="carousel-indicators-container">
            <ul class="carousel-indicators">
              <?php
                foreach ($mobileCountries as $key => $mobileCountry) {
                    $countryName = get_the_title($mobileCountry);
                    $countryMapData = get_post_meta($mobileCountry, 'latitude_and_longitude', true);
                    $countryDataPoint = $countryMapData['datapoint'];
                    $countryDataPointMustache = $countryMapData['datapoint_mustache']; ?>
                <li class="indicator" data-id="<?php echo esc_attr($key) ?>">
                    <button></button>
                </li>
              <?php
                } ?>
            </ul>
        </div>
      </div>
    </div>

    <div class="dropdown-wrapper">
      <?php foreach ($regionsAndCountries as $regionAndCountries) {
                    ?>
        <div class="section-wrapper">
          <div class="section map-copy small">
            <?php echo esc_html($regionAndCountries['region']) ?>
            <span class="section-icon"></span>
            <span class="section-icon open"></span>
          </div>
          <ul class="country-list">
            <?php foreach ($regionAndCountries['countries'] as $country) {
                        ?>
              <li class="list-item">
                <a class="list-link map-copy small" href="<?php echo esc_url(get_permalink($country->ID)); ?>">
                  <?php echo esc_html($country->post_title) ?>
                </a>
              </li>
            <?php
                    } ?>
          </ul>
        </div>
      <?php
                } ?>
    </div>

  </div>
</div>
