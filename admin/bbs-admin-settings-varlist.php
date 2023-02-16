<?php

// Load ASB Log Theme settings

// They must be loaded from the serialized array string, deserialized, then
// assigned to variables for ease of retrieval throughout templates. This file
// must be loaded on each page the settings are required.


$asb_settings = get_option( 'asb_theme_array' ); // Serialized array of all Options
$asb_email_address = $asb_settings['asb_email_address']; // Email Address
$asb_phone_number = $asb_settings['asb_phone_number']; // Phone Number

$asb_street_address = $asb_settings['asb_street_address']; // Business Address
$asb_openstreetmap = $asb_settings['asb_openstreetmap']; // OSM URL

$asb_social_url_facebook = $asb_settings['asb_social_url_facebook']; // Facebook URL
$asb_social_url_instagram = $asb_settings['asb_social_url_instagram']; // Instagram URL
$asb_url_cityguilds = $asb_settings['asb_url_cityguilds']; // City and Guilds URL

$asb_other_services_count = $asb_settings['asb_other_services_count']; // Other Services Count
$asb_review_count = $asb_settings['asb_review_count']; // Review Count

$asb_title_secondary_services = $asb_settings['asb_title_secondary_services']; // Secondary Services Title
$asb_title_pricelist_cta = $asb_settings['asb_title_pricelist_cta']; // Pricelist CTA Title
$asb_title_reviews = $asb_settings['asb_title_reviews']; // Reviews Title
$asb_title_subscribe = $asb_settings['asb_title_subscribe']; // Subscribe Form Title
$asb_title_gallery = $asb_settings['asb_title_gallery']; // Gallery Title
