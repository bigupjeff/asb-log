<?php
/*
ASB Log Custom Post Types and Fields
Version: 1.0
Author: Jefferson Real
Author URI: https://jeffersonreal.uk
License: GPLv2
*/


// Add custom post type - Incident
function asb_register_post_type_incident() {
   register_post_type( 'incident',
       array(
           // Define semantic menu labels for the new post type
           'labels' => array(
               'name' => 'Incidents',
               'singular_name' => 'Incident',
               'add_new' => 'New Incident',
               'add_new_item' => 'Add New Incident',
               'edit_item' => 'Edit Incident',
               'new_item' => 'New Incident',
               'view_item' => 'View Incidents',
               'search_items' => 'Search Incidents',
               'not_found' => 'No Incidents Found',
               'not_found_in_trash' => 'No Incidents found in Trash',
           ),
           // WP features the post type supports
           'supports' => array(
               'title',
               'editor',
           ),
           'rewrite' => array(
               'slug' => 'incidents', // URI to rewrite from the 'ugly' post type
               'with_front' => 'false' // Don't prepend URI with default 'posts'
           ),
           'description' => 'Here are the logged incidents.',
           'has_archive' => true,
           'public' => true,
           'show_in_menu' => true,
           'menu_position' => 6,
           'menu_icon' => 'dashicons-warning',
           'hierarchical' => false,
           'taxonomies' => ['category'],
           'show_in_rest' => false,
           'delete_with_user' => false
       )
   );
   register_taxonomy_for_object_type( 'category', 'incident' );
}
add_action( 'init', 'asb_register_post_type_incident' );



// Add Advanced Custom Fields (ACF) to custom post types
if ( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_609e7a975a390',
	'title' => 'Incident Details',
	'fields' => array(
		array(
			'key' => 'field_609e86fcb5781',
			'label' => 'Position',
			'name' => 'asb_position',
			'type' => 'number',
			'instructions' => 'Enter a position for the service to be displayed in its respective area. For the top services, position 1 is in the middle, then 2 and 3 are left and right respectively - like a podium.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => 'asb_position',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => 1,
		),
		array(
			'key' => 'field_609e7cfd5a2f1',
			'label' => 'Price',
			'name' => 'asb_price',
			'type' => 'number',
			'instructions' => 'Enter the price you will charge for this service.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => 'asb_price',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 0,
			'max' => 999,
			'step' => '0.01',
		),
		array(
			'key' => 'field_60b10c812aea7',
			'label' => 'Show Price on Homepage?',
			'name' => 'show_homepage_price',
			'type' => 'true_false',
			'instructions' => 'If this is turned on, the service tile on the homepage will display the price set. If no price is set, and/or this option is disabled, a \'see pricelist\' link will be shown instead.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_60b10f2d2aea8',
			'label' => 'Show Price on Price List Table?',
			'name' => 'show_pricelist_price',
			'type' => 'true_false',
			'instructions' => 'If this is turned on, the table on the pricelist page will display the price set. If no price is set, and/or this option is disabled, a \'see pricelist\' link will be shown instead.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_609e7abc5a2f0',
			'label' => 'Icon',
			'name' => 'asb_icon',
			'type' => 'image',
			'instructions' => 'Select an icon to be displayed with the service.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => 'asb_icon',
				'id' => '',
			),
			'return_format' => 'id',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => 10,
			'min_height' => 10,
			'min_size' => '0.0001',
			'max_width' => 5000,
			'max_height' => 5000,
			'max_size' => '0.5',
			'mime_types' => 'svg',
		),
		array(
			'key' => 'field_609e7ea21b97b',
			'label' => 'Large Tile Image',
			'name' => 'asb_tile_image',
			'type' => 'image',
			'instructions' => 'Select the image that will be displayed next to this service when displayed in the \'Other Services\' grid on the homepage.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => 'asb_tile_image',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'large',
			'library' => 'all',
			'min_width' => 300,
			'min_height' => 300,
			'min_size' => '0.01',
			'max_width' => 3000,
			'max_height' => 3000,
			'max_size' => 2,
			'mime_types' => 'jpg',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'service',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;


// Add ACF meta field columns to incident post list in admin area
 function add_acf_columns ( $columns ) {
   return array_merge ( $columns, array (
     'asb_position' => __ ( 'Position' )
   ) );
 }
 add_filter ( 'manage_incident_posts_columns', 'add_acf_columns' );

// Populate ACF meta field columns with meta data
function incident_custom_column ( $column, $post_id ) {
  switch ( $column ) {
    case 'asb_position':
      echo get_post_meta ( $post_id, 'asb_position', true );
      break;
  }
}
add_action ( 'manage_incident_posts_custom_column', 'incident_custom_column', 10, 2 );
