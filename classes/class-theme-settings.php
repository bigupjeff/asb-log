<?php
namespace Jefferson\AsbLog;

/**
 * Settings Admin Page - ASB Log Theme.
 *
 * Retrieve values with:
 *
 * $asb_settings = get_option( 'asb_theme_array' ); // Serialized array of all Options
 * $asb_email_address = $asb_settings['asb_email_address']; // Email Address
 * $asb_phone_number = $asb_settings['asb_phone_number']; // Phone Number
 * $asb_gmaps_api_key = $asb_settings['asb_gmaps_api_key']; // Google Maps API Key
 * $asb_facebook_url = $asb_settings['asb_facebook_url']; // Facebook URL
 * $asb_instagram_url = $asb_settings['asb_instagram_url']; // Instagram URL
 * $asb_incident_feed_count = $asb_settings['asb_incident_feed_count']; // Incident Pagination Count
 * $asb_incident_feed_title = $asb_settings['asb_incident_feed_title']; // Incident Feed Title
 */
class Theme_Settings {
	private $asb_theme;

	public function __construct() {
		// Move the default posts menu item from 5 to 9
		add_action(
			'admin_menu',
			function() {
				global $menu;
				$new_position = 9;
				$cpt_title    = 'Posts';
				foreach ( $menu as $key => $value ) {
					if ( $cpt_title === $value[0] ) {
						$copy = $menu[ $key ];
						unset( $menu[ $key ] );
						$menu[ $new_position ] = $copy;
					}
				}
			}
		);
		add_action( 'admin_menu', array( $this, 'asb_theme_add_settings_menu' ) );
		add_action( 'admin_init', array( $this, 'asb_theme_settings_page_init' ) );
	}

	public function asb_theme_add_settings_menu() {
		add_menu_page(
			'ASB Log Theme Settings', // Page title.
			'ASB Settings', // Menu title.
			'manage_options', // Capability.
			'asb-theme-settings', // Slug.
			array( $this, 'asb_theme_add_settings_page' ), // Callback.
			'dashicons-shield', // Icon.
			5 // Position.
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
		<?php
	}

	public function asb_theme_settings_page_init() {
		register_setting(
			'asb_theme_group',
			'asb_theme_array',
			array( $this, 'asb_theme_sanitize' )
		);

		// ============================================================= Contact Section
		add_settings_section(
			'asb_theme_contact_section',
			'Contact Information',
			array( $this, 'asb_theme_contact_section_callback' ),
			'asb_theme_page'
		);

		add_settings_field(
			'asb_email_address',
			'Email Address',
			array( $this, 'asb_email_address_callback' ),
			'asb_theme_page',
			'asb_theme_contact_section'
		);

		add_settings_field(
			'asb_phone_number',
			'Phone Number',
			array( $this, 'asb_phone_number_callback' ),
			'asb_theme_page',
			'asb_theme_contact_section'
		);

		add_settings_field(
			'asb_gmaps_api_key',
			'Google Maps API Key',
			array( $this, 'asb_gmaps_api_key_callback' ),
			'asb_theme_page',
			'asb_theme_contact_section'
		);

		// ============================================== Social Media and External Links

		add_settings_section(
			'asb_theme_social_section',
			'Social Media and External Links',
			array( $this, 'asb_theme_social_section_section_callback' ),
			'asb_theme_page'
		);

		add_settings_field(
			'asb_facebook_url',
			'Social URL - Facebook',
			array( $this, 'asb_facebook_url_callback' ),
			'asb_theme_page',
			'asb_theme_social_section'
		);

		add_settings_field(
			'asb_instagram_url',
			'Social URL - Instagram',
			array( $this, 'asb_instagram_url_callback' ),
			'asb_theme_page',
			'asb_theme_social_section'
		);

		// ============================================================= Homepage Section

		add_settings_section(
			'asb_theme_homepage_section',
			'Homepage Settings',
			array( $this, 'asb_theme_homepage_section_callback' ),
			'asb_theme_page'
		);

		add_settings_field(
			'asb_incident_feed_count',
			'Number of incidents per page',
			array( $this, 'asb_incident_feed_count_callback' ),
			'asb_theme_page',
			'asb_theme_homepage_section'
		);

		add_settings_field(
			'asb_incident_feed_title',
			'Incidents feed title',
			array( $this, 'asb_incident_feed_title_callback' ),
			'asb_theme_page',
			'asb_theme_homepage_section'
		);

	}

	public function asb_theme_sanitize( $input ) {
		$sanitary_values = array();

		if ( isset( $input['asb_email_address'] ) ) {
			$sanitary_values['asb_email_address'] = sanitize_email( $input['asb_email_address'] );
		}

		if ( isset( $input['asb_phone_number'] ) ) {
			$sanitary_values['asb_phone_number'] = sanitize_text_field( $input['asb_phone_number'] );
		}

		if ( isset( $input['asb_gmaps_api_key'] ) ) {
			$sanitary_values['asb_gmaps_api_key'] = sanitize_text_field( $input['asb_gmaps_api_key'] );
		}

		if ( isset( $input['asb_facebook_url'] ) ) {
			$sanitary_values['asb_facebook_url'] = sanitize_text_field( $input['asb_facebook_url'] );
		}

		if ( isset( $input['asb_instagram_url'] ) ) {
			$sanitary_values['asb_instagram_url'] = sanitize_text_field( $input['asb_instagram_url'] );
		}

		if ( isset( $input['asb_incident_feed_count'] ) ) {
			$sanitary_values['asb_incident_feed_count'] = sanitize_text_field( $input['asb_incident_feed_count'] );
		}

		if ( isset( $input['asb_incident_feed_title'] ) ) {
			$sanitary_values['asb_incident_feed_title'] = sanitize_text_field( $input['asb_incident_feed_title'] );
		}

		return $sanitary_values;
	}

	// ========================================================= Section Descriptions

	public function asb_theme_contact_section_callback() {
		echo '<p>Contact Information displayed across the website. Put each line
                 of the street address on a new line as it will appear this way
                 on the front end.</p>';
	}

	public function asb_theme_social_section_section_callback() {
		echo '<p>Configure external links for social accounts.</p>';
	}

	public function asb_theme_homepage_section_callback() {
		echo '<p>Set the quantity of incidents to be displayed. Note
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
			isset( $this->asb_theme['asb_email_address'] ) ? esc_attr( $this->asb_theme['asb_email_address'] ) : ''
		);
	}

	public function asb_phone_number_callback() {
		printf(
			'<input class="regular-text" type="tel" pattern="[0-9 ]+" name="asb_theme_array[asb_phone_number]" id="asb_phone_number" value="%s">',
			isset( $this->asb_theme['asb_phone_number'] ) ? esc_attr( $this->asb_theme['asb_phone_number'] ) : ''
		);
	}

	public function asb_gmaps_api_key_callback() {
		printf(
			'<input class="regular-text" type="text" name="asb_theme_array[asb_gmaps_api_key]" id="asb_gmaps_api_key" value="%s">',
			isset( $this->asb_theme['asb_gmaps_api_key'] ) ? esc_attr( $this->asb_theme['asb_gmaps_api_key'] ) : ''
		);
	}

	public function asb_facebook_url_callback() {
		printf(
			'<input class="regular-text" type="url" name="asb_theme_array[asb_facebook_url]" id="asb_facebook_url" value="%s">',
			isset( $this->asb_theme['asb_facebook_url'] ) ? esc_url( $this->asb_theme['asb_facebook_url'] ) : ''
		);
	}

	public function asb_instagram_url_callback() {
		printf(
			'<input class="regular-text" type="url" name="asb_theme_array[asb_instagram_url]" id="asb_instagram_url" value="%s">',
			isset( $this->asb_theme['asb_instagram_url'] ) ? esc_url( $this->asb_theme['asb_instagram_url'] ) : ''
		);
	}

	public function asb_incident_feed_count_callback() {
		printf(
			'<input class="small-text" type="number" min="0" max="20" name="asb_theme_array[asb_incident_feed_count]" id="asb_incident_feed_count" value="%s">',
			isset( $this->asb_theme['asb_incident_feed_count'] ) ? esc_attr( $this->asb_theme['asb_incident_feed_count'] ) : ''
		);
	}

	public function asb_incident_feed_title_callback() {
		printf(
			'<input class="regular-text" type="text" name="asb_theme_array[asb_incident_feed_title]" id="asb_incident_feed_title" value="%s">',
			isset( $this->asb_theme['asb_incident_feed_title'] ) ? esc_attr( $this->asb_theme['asb_incident_feed_title'] ) : ''
		);
	}

}
