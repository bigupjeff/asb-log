<?php
namespace Jefferson\AsbLog;

/**
 * ASB Log Custom Post Types and Fields.
 */
class Custom_Post_Types {

	public function __construct() {
		add_action( 'init', array( $this, 'asb_register_post_type_incident' ) );
		if ( function_exists( 'acf_add_local_field_group' ) ) {
			$this->add_acf_custom_fields_to_cpt();
		}
		add_filter( 'acf/fields/google_map/api', array( $this, 'my_acf_google_map_api' ) );
		add_filter( 'manage_incident_posts_columns', array( $this, 'add_acf_columns' ) );
		add_action( 'manage_incident_posts_custom_column', array( $this, 'incident_custom_column' ), 10, 2 );
	}

	/**
	 * Add custom post type - Incident
	 */
	public function asb_register_post_type_incident() {
		register_post_type(
			'incident',
			array(
				// Define semantic menu labels for the new post type
				'labels'           => array(
					'name'               => 'Incidents',
					'singular_name'      => 'Incident',
					'add_new'            => 'New Incident',
					'add_new_item'       => 'Add New Incident',
					'edit_item'          => 'Edit Incident',
					'new_item'           => 'New Incident',
					'view_item'          => 'View Incidents',
					'search_items'       => 'Search Incidents',
					'not_found'          => 'No Incidents Found',
					'not_found_in_trash' => 'No Incidents found in Trash',
				),
				// WP features the post type supports
				'supports'         => array(
					'title',
					'editor',
				),
				'rewrite'          => array(
					'slug'       => 'incidents', // URI to rewrite from the 'ugly' post type
					'with_front' => 'false', // Don't prepend URI with default 'posts'
				),
				'description'      => 'Here are the logged incidents.',
				'has_archive'      => true,
				'public'           => true,
				'show_in_menu'     => true,
				'menu_position'    => 6,
				'menu_icon'        => 'dashicons-warning',
				'hierarchical'     => false,
				'taxonomies'       => array( 'category' ),
				'show_in_rest'     => false,
				'delete_with_user' => false,
			)
		);
		register_taxonomy_for_object_type( 'category', 'incident' );
	}

	/**
	 * Add Advanced Custom Fields (ACF) to custom post types
	 */
	private function add_acf_custom_fields_to_cpt() {
		acf_add_local_field_group(
			array(
				'key'                   => 'group_63eda689a3178',
				'title'                 => 'Incident Details',
				'fields'                => array(
					array(
						'key'               => 'field_63f0199f18d76',
						'label'             => 'Date',
						'name'              => 'date',
						'aria-label'        => '',
						'type'              => 'date_picker',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'display_format'    => 'd/m/Y',
						'return_format'     => 'd/m/Y',
						'first_day'         => 1,
					),
					array(
						'key'               => 'field_63f019da18d77',
						'label'             => 'Time started',
						'name'              => 'time_started',
						'aria-label'        => '',
						'type'              => 'time_picker',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'display_format'    => 'g:i a',
						'return_format'     => 'g:i a',
					),
					array(
						'key'               => 'field_63f019fe18d78',
						'label'             => 'Time stopped',
						'name'              => 'time_stopped',
						'aria-label'        => '',
						'type'              => 'time_picker',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'display_format'    => 'g:i a',
						'return_format'     => 'g:i a',
					),
					array(
						'key'               => 'field_63f01b2e18d7a',
						'label'             => 'What happened?',
						'name'              => 'what_happened',
						'aria-label'        => '',
						'type'              => 'wysiwyg',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'tabs'              => 'all',
						'toolbar'           => 'full',
						'media_upload'      => 1,
						'delay'             => 0,
					),
					array(
						'key'               => 'field_63f01b4b18d7b',
						'label'             => 'How did this affect you?',
						'name'              => 'how_did_this_affect_you',
						'aria-label'        => '',
						'type'              => 'textarea',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'new_lines'         => '',
						'maxlength'         => '',
						'placeholder'       => '',
						'rows'              => '',
					),
					array(
						'key'               => 'field_63f01a3118d79',
						'label'             => 'Location',
						'name'              => 'location',
						'aria-label'        => '',
						'type'              => 'google_map',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'center_lat'        => '50.98889028037231',
						'center_lng'        => '-1.498425930850076',
						'zoom'              => '',
						'height'            => '',
					),
					array(
						'key'               => 'field_63f01b5d18d7c',
						'label'             => 'Witness details',
						'name'              => 'witness_details',
						'aria-label'        => '',
						'type'              => 'textarea',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'maxlength'         => '',
						'rows'              => '',
						'placeholder'       => '',
						'new_lines'         => '',
					),
					array(
						'key'               => 'field_63f01b7718d7d',
						'label'             => 'Images',
						'name'              => 'images',
						'aria-label'        => '',
						'type'              => 'image',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'return_format'     => 'url',
						'library'           => 'uploadedTo',
						'min_width'         => '',
						'min_height'        => '',
						'min_size'          => '',
						'max_width'         => '',
						'max_height'        => '',
						'max_size'          => '',
						'mime_types'        => '',
						'preview_size'      => 'medium',
					),
					array(
						'key'               => 'field_63f01bd618d7e',
						'label'             => 'Video URL',
						'name'              => 'video_url',
						'aria-label'        => '',
						'type'              => 'link',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'return_format'     => 'url',
					),
					array(
						'key'               => 'field_63f01c0118d7f',
						'label'             => 'File attachement',
						'name'              => 'file_attachement',
						'aria-label'        => '',
						'type'              => 'file',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'return_format'     => 'url',
						'library'           => 'uploadedTo',
						'min_size'          => '',
						'max_size'          => '',
						'mime_types'        => '',
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'incident',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => array(
					0 => 'the_content',
					1 => 'excerpt',
					2 => 'discussion',
					3 => 'comments',
					4 => 'page_attributes',
					5 => 'featured_image',
				),
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 0,
			)
		);
	}

	/**
	 * Setup Google Maps API Key for ACF Map field.
	 */
	public function my_acf_google_map_api( $api ) {
		$asb_theme_options = get_option( 'asb_theme_array' );
		if ( isset( $asb_theme_options['asb_gmaps_api_key'] ) ) {
			$api['key'] = $asb_theme_options['asb_gmaps_api_key'];
			return $api;
		} else {
			return null;
		}
	}

	/**
	 * Add ACF meta field columns to incident post list in admin area.
	 */
	public function add_acf_columns( $columns ) {
		return array_merge(
			$columns,
			array(
				'asb_position' => __( 'Position' ),
			)
		);
	}

	/**
	 * Populate ACF meta field columns with meta data.
	 */
	public function incident_custom_column( $column, $post_id ) {
		switch ( $column ) {
			case 'asb_position':
				echo get_post_meta( $post_id, 'asb_position', true );
				break;
		}
	}
}
