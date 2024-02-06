<?php
add_action('rest_api_init', 'cntrspch_get_countries_for_map');


function cntrspch_get_countries_for_map()
{
    register_rest_route('counterspeech', 'map', array(
        'methods'  => WP_REST_Server::READABLE,
        'callback' => 'cntrspch_send_countries_for_map',
    ));
}

function cntrspch_send_countries_for_map()
{
    $countriesJson = wp_cache_get('cntrspch_country_json');
    if (false === $countriesJson) {
        $countryPosts = get_posts(array(
        'post_type' => 'cntrspch_country',
        'post_status' => 'publish',
        'posts_per_page' => 200,
        'suppress_filters' => false,
        'offset' => 0
    ));
        $countriesJson = array();
        foreach ($countryPosts as $countryPost) {
            $countryTitle = $countryPost->post_title;
            $countryPostMeta = get_post_meta($countryPost->ID);
            if (isset($countryPostMeta['latitude_and_longitude'])) {
                $latLongGroup = unserialize($countryPostMeta['latitude_and_longitude'][0]);
                $countryLat = $latLongGroup['latitude'];
                $countryLong = $latLongGroup['longitude'];
                $countryDataPoint = $latLongGroup['datapoint'];
                $countryCode = $latLongGroup['country_code'];
                $countryDataPointMustache = $latLongGroup['datapoint_mustache'];
                $permalink = get_permalink($countryPost->ID);

                $countryObj = array(
                'permalink' => $permalink,
                'country' => $countryTitle,
                'lat' => $countryLat,
                'lon' => $countryLong,
                'data_point' => $countryDataPoint,
                'mustache' => $countryDataPointMustache,
                'country_code' => $countryCode,
            );
                $countriesJson[] = $countryObj;
            }
        }
        $countriesJson =  new WP_REST_Response($countriesJson);
        wp_cache_set('cntrspch_country_json', $countriesJson);
    }
    return $countriesJson;
}
