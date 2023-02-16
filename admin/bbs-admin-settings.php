<?php
/**
 * Settings Admin Page - ASB Log Theme
 * Author: Jefferson Real - jeffersonreal.uk
 */

// Move the default posts menu item from 5 to 9
add_action( 'admin_menu', function() {
   global $menu;
   $new_position = 9;
   $cpt_title = 'Posts';
   foreach( $menu as $key => $value )
   {
       if( $cpt_title === $value[0] )
       {
           $copy = $menu[$key];
           unset( $menu[$key] );
           $menu[$new_position] = $copy;
       }
   }
});

class AsbLogThemeSettings {
	private $asb_theme;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'asb_theme_add_settings_menu' ) );
		add_action( 'admin_init', array( $this, 'asb_theme_settings_page_init' ) );
	}

	public function asb_theme_add_settings_menu() {
		add_menu_page(
			"ASB Log Theme Settings", // page_title
			'ASB Settings', // menu_title
			'manage_options', // capability
			'asb-theme-settings', // menu_slug
			array( $this, 'asb_theme_add_settings_page' ), // function
			'dashicons-shield', // icon_url
			5 // position
		);
	}

	public function asb_theme_add_settings_page() {
		$this->asb_theme = get_option( 'asb_theme_array' ); ?>

		<div class="wrap">

			<h2>ASB Log Theme Settings</h2>

			<p>These settings manage content that appears on the front end of the ASB Log theme.</p>
            <p>After updating content in these fields, don't forget to click SAVE at the bottom of the page!</strong></p>
            <p>In case of problems, contact Jeff: <a href="mailto:me@jeffersonreal.uk">me@jeffersonreal.uk</a></p>

			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'asb_theme_group' );
					do_settings_sections( 'asb_theme_page' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function asb_theme_settings_page_init() {
		register_setting(
			'asb_theme_group', // option_group
			'asb_theme_array', // option_name
			array( $this, 'asb_theme_sanitize' ) // sanitize_callback
		);

//============================================================= Contact Section
	add_settings_section(
		'asb_theme_contact_section', // id
		'Contact Information', // title
		array( $this, 'asb_theme_contact_section_callback' ), // callback
		'asb_theme_page' // page
	);

    	add_settings_field(
    		'asb_email_address', // id
    		'Email Address', // title
    		array( $this, 'asb_email_address_callback' ), // callback
    		'asb_theme_page', // page
    		'asb_theme_contact_section' // section
    	);

    	add_settings_field(
    		'asb_phone_number', // id
    		'Phone Number', // title
    		array( $this, 'asb_phone_number_callback' ), // callback
    		'asb_theme_page', // page
    		'asb_theme_contact_section' // section
    	);

        add_settings_field(
            'asb_street_address', // id
            'Street Address', // title
            array( $this, 'asb_street_address_callback' ), // callback
            'asb_theme_page', // page
            'asb_theme_contact_section' // section
        );

        add_settings_field(
            'asb_openstreetmap', // id
            'OpenStreetMap URL', // title
            array( $this, 'asb_openstreetmap_callback' ), // callback
            'asb_theme_page', // page
            'asb_theme_contact_section' // section
        );

//============================================== Social Media and External Links

    add_settings_section(
        'asb_theme_social_section', // id
        'Social Media and External Links', // title
        array( $this, 'asb_theme_social_section_section_callback' ), // callback
        'asb_theme_page' // page
    );

    	add_settings_field(
    		'asb_social_url_facebook', // id
    		'Social URL - Facebook', // title
    		array( $this, 'asb_social_url_facebook_callback' ), // callback
    		'asb_theme_page', // page
    		'asb_theme_social_section' // section
    	);

        add_settings_field(
    		'asb_social_url_instagram', // id
    		'Social URL - Instagram', // title
    		array( $this, 'asb_social_url_instagram_callback' ), // callback
    		'asb_theme_page', // page
    		'asb_theme_social_section' // section
    	);

        add_settings_field(
    		'asb_url_cityguilds', // id
    		'External URL - City & Guilds', // title
    		array( $this, 'asb_url_cityguilds_callback' ), // callback
    		'asb_theme_page', // page
    		'asb_theme_social_section' // section
    	);

//============================================================= Homepage Section

    add_settings_section(
        'asb_theme_homepage_section', // id
        'Homepage Settings', // title
        array( $this, 'asb_theme_homepage_section_callback' ), // callback
        'asb_theme_page' // page
    );

        add_settings_field(
            'asb_other_services_count', // id
            'Number of Other Services to Display', // title
            array( $this, 'asb_other_services_count_callback' ), // callback
            'asb_theme_page', // page
            'asb_theme_homepage_section' // section
        );

        add_settings_field(
            'asb_review_count', // id
            'Number of Reviews to Display', // title
            array( $this, 'asb_review_count_callback' ), // callback
            'asb_theme_page', // page
            'asb_theme_homepage_section' // section
        );

        add_settings_field(
			'asb_title_secondary_services', // id
			'Section Title - Secondary Services Grid', // title
			array( $this, 'asb_title_secondary_services_callback' ), // callback
			'asb_theme_page', // page
			'asb_theme_homepage_section' // section
		);

		add_settings_field(
			'asb_title_pricelist_cta', // id
			'Section Title - View all Prices Button', // title
			array( $this, 'asb_title_pricelist_cta_callback' ), // callback
			'asb_theme_page', // page
			'asb_theme_homepage_section' // section
		);

		add_settings_field(
			'asb_title_reviews', // id
			'Section Title - Customer Reviews', // title
			array( $this, 'asb_title_reviews_callback' ), // callback
			'asb_theme_page', // page
			'asb_theme_homepage_section' // section
		);

		add_settings_field(
			'asb_title_subscribe', // id
			'Section Title - Subscribe Form', // title
			array( $this, 'asb_title_subscribe_callback' ), // callback
			'asb_theme_page', // page
			'asb_theme_homepage_section' // section
		);

		add_settings_field(
			'asb_title_gallery', // id
			'Section Title - Photo Gallery', // title
			array( $this, 'asb_title_gallery_callback' ), // callback
			'asb_theme_page', // page
			'asb_theme_homepage_section' // section
		);

	}

	public function asb_theme_sanitize($input) {
		$sanitary_values = array();

		if ( isset( $input['asb_email_address'] ) ) {
			$sanitary_values['asb_email_address'] = sanitize_email( $input['asb_email_address'] );
		}

		if ( isset( $input['asb_phone_number'] ) ) {
			$sanitary_values['asb_phone_number'] = sanitize_text_field( $input['asb_phone_number'] );
		}

        if ( isset( $input['asb_street_address'] ) ) {
			$sanitary_values['asb_street_address'] = sanitize_textarea_field( $input['asb_street_address'] );
		}

		if ( isset( $input['asb_openstreetmap'] ) ) {
			$sanitary_values['asb_openstreetmap'] = sanitize_text_field( urldecode ( $input['asb_openstreetmap'] ) );
		}

        if ( isset( $input['asb_social_url_facebook'] ) ) {
			$sanitary_values['asb_social_url_facebook'] = sanitize_text_field( $input['asb_social_url_facebook'] );
		}

		if ( isset( $input['asb_social_url_instagram'] ) ) {
			$sanitary_values['asb_social_url_instagram'] = sanitize_text_field( $input['asb_social_url_instagram'] );
		}

		if ( isset( $input['asb_url_cityguilds'] ) ) {
			$sanitary_values['asb_url_cityguilds'] = sanitize_text_field( $input['asb_url_cityguilds'] );
		}

        if ( isset( $input['asb_other_services_count'] ) ) {
			$sanitary_values['asb_other_services_count'] = sanitize_text_field( $input['asb_other_services_count'] );
		}

		if ( isset( $input['asb_review_count'] ) ) {
			$sanitary_values['asb_review_count'] = sanitize_text_field( $input['asb_review_count'] );
		}

		if ( isset( $input['asb_title_secondary_services'] ) ) {
			$sanitary_values['asb_title_secondary_services'] = sanitize_text_field( $input['asb_title_secondary_services'] );
		}

		if ( isset( $input['asb_title_pricelist_cta'] ) ) {
			$sanitary_values['asb_title_pricelist_cta'] = sanitize_text_field( $input['asb_title_pricelist_cta'] );
		}

		if ( isset( $input['asb_title_reviews'] ) ) {
			$sanitary_values['asb_title_reviews'] = sanitize_text_field( $input['asb_title_reviews'] );
		}

		if ( isset( $input['asb_title_subscribe'] ) ) {
			$sanitary_values['asb_title_subscribe'] = sanitize_text_field( $input['asb_title_subscribe'] );
		}

		if ( isset( $input['asb_title_gallery'] ) ) {
			$sanitary_values['asb_title_gallery'] = sanitize_text_field( $input['asb_title_gallery'] );
		}

		return $sanitary_values;
	}

//========================================================= Section Descriptions

	public function asb_theme_contact_section_callback() {
        echo '<p>Contact Information displayed across the website. Put each line
                 of the street address on a new line as it will appear this way
                 on the front end.</p>';
	}

    public function asb_theme_social_section_section_callback() {
        echo '<p>Configure external links for social accounts and accreditations.</p>';
	}

    public function asb_theme_homepage_section_callback() {
        echo '<p>Set the quantity of services and reviews to be displayed. Note
                 that if the quantity is greater than the number available, it
                 will simply display all. Set the order of the content using the
                 position setting in the individual posts.</p>
              <p>The section titles appear on the homepage. After updating a
                 title, check how it appears on the website to make sure it fits
                 the space.</p>';
	}

	public function asb_email_address_callback() {
		printf(
			'<input class="regular-text" type="email" name="asb_theme_array[asb_email_address]" id="asb_email_address" value="%s">',
			isset( $this->asb_theme['asb_email_address'] ) ? esc_attr( $this->asb_theme['asb_email_address']) : ''
		);
	}

	public function asb_phone_number_callback() {
		printf(
			'<input class="regular-text" type="tel" pattern="[0-9 ]+" name="asb_theme_array[asb_phone_number]" id="asb_phone_number" value="%s">',
			isset( $this->asb_theme['asb_phone_number'] ) ? esc_attr( $this->asb_theme['asb_phone_number']) : ''
		);
	}

    public function asb_street_address_callback() {
		printf(
			'<textarea class="large-text" rows="4" cols="50" name="asb_theme_array[asb_street_address]" id="asb_street_address">%s</textarea>',
			isset( $this->asb_theme['asb_street_address'] ) ? esc_textarea( $this->asb_theme['asb_street_address']) : ''
		);
	}

    public function asb_openstreetmap_callback() {
		printf(
			'<input class="regular-text" type="url" name="asb_theme_array[asb_openstreetmap]" id="asb_openstreetmap" value="%s">',
			isset( $this->asb_theme['asb_openstreetmap'] ) ? esc_url_raw( $this->asb_theme['asb_openstreetmap']) : ''
		);
	}

    public function asb_social_url_facebook_callback() {
		printf(
			'<input class="regular-text" type="url" name="asb_theme_array[asb_social_url_facebook]" id="asb_social_url_facebook" value="%s">',
			isset( $this->asb_theme['asb_social_url_facebook'] ) ? esc_url( $this->asb_theme['asb_social_url_facebook']) : ''
		);
	}

	public function asb_social_url_instagram_callback() {
		printf(
			'<input class="regular-text" type="url" name="asb_theme_array[asb_social_url_instagram]" id="asb_social_url_instagram" value="%s">',
			isset( $this->asb_theme['asb_social_url_instagram'] ) ? esc_url( $this->asb_theme['asb_social_url_instagram']) : ''
		);
	}

	public function asb_url_cityguilds_callback() {
		printf(
			'<input class="regular-text" type="url" name="asb_theme_array[asb_url_cityguilds]" id="asb_url_cityguilds" value="%s">',
			isset( $this->asb_theme['asb_url_cityguilds'] ) ? esc_url( $this->asb_theme['asb_url_cityguilds']) : ''
		);
	}

    public function asb_other_services_count_callback() {
		printf(
			'<input class="small-text" type="number" min="0" max="20" name="asb_theme_array[asb_other_services_count]" id="asb_other_services_count" value="%s">',
			isset( $this->asb_theme['asb_other_services_count'] ) ? esc_attr( $this->asb_theme['asb_other_services_count']) : ''
		);
	}

    public function asb_review_count_callback() {
        printf(
            '<input class="small-text" type="number" min="0" max="20" name="asb_theme_array[asb_review_count]" id="asb_review_count" value="%s">',
            isset( $this->asb_theme['asb_review_count'] ) ? esc_attr( $this->asb_theme['asb_review_count']) : ''
        );
    }

	public function asb_title_secondary_services_callback() {
		printf(
			'<input class="regular-text" type="text" name="asb_theme_array[asb_title_secondary_services]" id="asb_title_secondary_services" value="%s">',
			isset( $this->asb_theme['asb_title_secondary_services'] ) ? esc_attr( $this->asb_theme['asb_title_secondary_services']) : ''
		);
	}

	public function asb_title_pricelist_cta_callback() {
		printf(
			'<input class="regular-text" type="text" name="asb_theme_array[asb_title_pricelist_cta]" id="asb_title_pricelist_cta" value="%s">',
			isset( $this->asb_theme['asb_title_pricelist_cta'] ) ? esc_attr( $this->asb_theme['asb_title_pricelist_cta']) : ''
		);
	}

	public function asb_title_reviews_callback() {
		printf(
			'<input class="regular-text" type="text" name="asb_theme_array[asb_title_reviews]" id="asb_title_reviews" value="%s">',
			isset( $this->asb_theme['asb_title_reviews'] ) ? esc_attr( $this->asb_theme['asb_title_reviews']) : ''
		);
	}

	public function asb_title_subscribe_callback() {
		printf(
			'<input class="regular-text" type="text" name="asb_theme_array[asb_title_subscribe]" id="asb_title_subscribe" value="%s">',
			isset( $this->asb_theme['asb_title_subscribe'] ) ? esc_attr( $this->asb_theme['asb_title_subscribe']) : ''
		);
	}

	public function asb_title_gallery_callback() {
		printf(
			'<input class="regular-text" type="text" name="asb_theme_array[asb_title_gallery]" id="asb_title_gallery" value="%s">',
			isset( $this->asb_theme['asb_title_gallery'] ) ? esc_attr( $this->asb_theme['asb_title_gallery']) : ''
		);
	}

}
if ( is_admin() )
	$asb_log_theme_settings = new AsbLogThemeSettings();

/*
 * Retrieve this value with:
 *
 * $asb_settings = get_option( 'asb_theme_array' ); // Serialized array of all Options
 * $asb_email_address = $asb_settings['asb_email_address']; // Email Address
 * $asb_phone_number = $asb_settings['asb_phone_number']; // Phone Number

 * $asb_street_address = $asb_settings['asb_street_address']; // Business Address
 * $asb_openstreetmap = $asb_settings['asb_openstreetmap']; // OSM URL

 * $asb_social_url_facebook = $asb_settings['asb_social_url_facebook']; // Facebook URL
 * $asb_social_url_instagram = $asb_settings['asb_social_url_instagram']; // Instagram URL
 * $asb_url_cityguilds = $asb_settings['asb_url_cityguilds']; // City and Guilds URL

 * $asb_other_services_count = $asb_settings['asb_other_services_count']; // Other Services Count
 * $asb_review_count = $asb_settings['asb_review_count']; // Review Count

 * $asb_title_secondary_services = $asb_settings['asb_title_secondary_services']; // Secondary Services Title
 * $asb_title_pricelist_cta = $asb_settings['asb_title_pricelist_cta']; // Pricelist CTA Title
 * $asb_title_reviews = $asb_settings['asb_title_reviews']; // Reviews Title
 * $asb_title_subscribe = $asb_settings['asb_title_subscribe']; // Subscribe Form Title
 * $asb_title_gallery = $asb_settings['asb_title_gallery']; // Gallery Title

 */
