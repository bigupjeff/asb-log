<?php

// Load ASB Log Theme settings

// They must be loaded from the serialized array string, deserialized, then
// assigned to variables for ease of retrieval throughout templates. This file
// must be loaded on each page the settings are required.

$asb_settings = get_option( 'asb_theme_array' ); // Serialized array of all Options
$asb_email_address = $asb_settings['asb_email_address']; // Email Address
$asb_phone_number = $asb_settings['asb_phone_number']; // Phone Number
$asb_gmaps_api_key = $asb_settings['asb_gmaps_api_key']; // OSM URL
$asb_social_url_facebook = $asb_settings['asb_social_url_facebook']; // Facebook URL
$asb_social_url_instagram = $asb_settings['asb_social_url_instagram']; // Instagram URL
$asb_incident_feed_count = $asb_settings['asb_incident_feed_count']; // Other Services Count
$asb_incident_feed_title = $asb_settings['asb_incident_feed_title']; // Secondary Services Title
