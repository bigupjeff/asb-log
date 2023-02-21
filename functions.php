<?php
/**
 * ASB Log functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ASB_Log
 */

/**
 * Dependcency Check
 * 
 * All theme and no dependencies makes WordPress a dull WSOD.
 * 
 * If the dependency check fails, switch back to the previous theme $oldtheme which is passed by
 * after_switch_theme.
 * 
 */
function dependency_check() {

	$plugin_dependencies = [
		"Advanced Custom Fields" => 'advanced-custom-fields/acf.php',
		"SVG Support"			 => 'svg-support/svg-support.php',
	];

	if (!function_exists('is_plugin_active')) {
		include_once(ABSPATH . 'wp-admin/includes/plugin.php');
	}

	$missing_plugins = [];
	$active_plugins = get_option( 'active_plugins' );

	foreach( $plugin_dependencies as $plugin => $path ) {
		if ( ! in_array( $path , $active_plugins ) ) {
			array_push( $missing_plugins, "<li><b>{$plugin}</b></li>\n" );
		}
	}

	if ( 1 <= count( $missing_plugins ) ) {
		
		$plugin_string  = implode( $missing_plugins );
		$plugin_list    = "<ul>{$plugin_string}</ul>\n";
		$title          = "Missing Theme Dependencies";
		$message        = "<h1>{$title}</h1>\n";
		$message       .= "<p>The following plugins must be installed and activated to use this theme:</p>\n";
		$message       .= $plugin_list;
		$message       .=  "<p>Please visit the plugin page to install these plugins.</p>\n";

		// If this is not a preview and the theme has been activated, fallback to default theme.
		global $wp_customize;
		if ( ! isset( $wp_customize ) ) {
			switch_theme( WP_DEFAULT_THEME );
			$warning_styles  = 'style="color:#fff;font-weight:800;background:red;padding:0 5px;width:fit-content;"';
			$message        .=  "<p {$warning_styles}>The default theme has been activated to prevent errors.</p>\n";
		}

		wp_die(
			$message,
			$title,
			$args = [
				"link_text" => "Go to WordPress Plugin Directory",
				"link_url" 	=> "/wp-admin/plugin-install.php"
			]
		);
	}
}
dependency_check();



 // ASB Log admin settings
include get_theme_file_path() . '/admin/asb-admin-settings.php';

 // ASB Log custom post type - services
include get_theme_file_path() . '/admin/asb-custom-post-types.php';

// Turn off theme and plugin auto-updates
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );

/**
* Enqueue scripts and styles.
*/
function asb_log_scripts() {
    wp_enqueue_style( 'bbs-base', get_stylesheet_uri() );
    wp_enqueue_style( 'bbs-main', get_template_directory_uri() . '/css/asb.css');
    wp_enqueue_style( 'bbs-fonts', get_template_directory_uri() . '/css/fonts.css');
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/fontawesome/css/all.css');
    wp_enqueue_script( 'bbs-nav-js', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'gsap', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js', array (), '3.6.1', true );
    wp_enqueue_script( 'gsap_cssrule', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/CSSRulePlugin.min.js', array (), '3.6.1', true );
    wp_enqueue_script( 'gsap_scrolltrigger', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/ScrollTrigger.min.js', array (), '3.6.1', true );
    wp_enqueue_script( 'bbs-reveal-js', get_template_directory_uri() . '/js/reveal-animation.js', array( 'gsap', 'gsap_cssrule', 'gsap_scrolltrigger', 'jquery' ), '1.0', true );
    wp_enqueue_script( 'bbs-header-js', get_template_directory_uri() . '/js/header-animation.js', array( 'gsap', 'gsap_cssrule', 'gsap_scrolltrigger', 'jquery' ), '1.0', true );
    wp_enqueue_script( 'bbs-nav-backup-js', get_template_directory_uri() . '/js/nav-backup.js', array( 'jquery' ), '1.0', true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    if (!is_admin() && $GLOBALS['pagenow'] != 'wp-login.php') {
        wp_deregister_script('jquery');
        wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', false, '1.11.2');
        wp_enqueue_script('jquery');
    }
}
add_action( 'wp_enqueue_scripts', 'asb_log_scripts' );

 // Tell WordPress to dynamically use the page title as the meta title tag
 add_theme_support( 'title-tag' );

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'asb_log_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function asb_log_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ASB Log, use a find and replace
		 * to change 'asb-log' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'asb-log', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

        // Enable custom image sizes and set the sizes required for the theme
        add_theme_support( 'pop-up-banner' );
        add_image_size( 'service-tile', 960, 960, TRUE );
        add_image_size( 'review-avatar', 150, 150, TRUE );
        add_image_size( 'full-width-banner', 1920, 480, TRUE );
        add_image_size( 'page-featured', 615, 615, TRUE );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'asb-log' ),
                'menu-2' => esc_html__( 'Footer', 'asb-log' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'asb_log_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'asb_log_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function asb_log_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'asb_log_content_width', 640 );
}
add_action( 'after_setup_theme', 'asb_log_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function asb_log_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'asb-log' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'asb-log' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'asb_log_widgets_init' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Return an alternate title, without prefix, for every type used in the get_the_archive_title().
add_filter('get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_year() ) {
        $title = get_the_date( _x( 'Y', 'yearly archives date format' ) );
    } elseif ( is_month() ) {
        $title = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
    } elseif ( is_day() ) {
        $title = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
    } elseif ( is_tax( 'post_format' ) ) {
        if ( is_tax( 'post_format', 'post-format-aside' ) ) {
            $title = _x( 'Asides', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
            $title = _x( 'Galleries', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
            $title = _x( 'Images', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
            $title = _x( 'Videos', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
            $title = _x( 'Quotes', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
            $title = _x( 'Links', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
            $title = _x( 'Statuses', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
            $title = _x( 'Audio', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
            $title = _x( 'Chats', 'post format archive title' );
        }
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } else {
        $title = __( 'Archives' );
    }
    return $title;
});

// Add Google Tag Manager code in <head>
function google_tag_manager_head() { ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P8N792F');</script>
<!-- End Google Tag Manager --><?php
}
add_action( 'wp_head', 'google_tag_manager_head' );

// Add Google Tag Manager code immediately below opening <body> tag
function google_tag_manager_body() { ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P8N792F"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) --><?php
}
add_action( 'genesis_before', 'google_tag_manager_body' );

// Remove TAX type CATEGORY from sitemap
function remove_tax_from_sitemap( $taxonomies ) {
     unset( $taxonomies['category'] );
     return $taxonomies;
}
add_filter( 'wp_sitemaps_taxonomies', 'remove_tax_from_sitemap' );

// Remove USERS from sitemap
add_filter( 'wp_sitemaps_add_provider', function ($provider, $name) {
  return ( $name == 'users' ) ? false : $provider;
}, 10, 2);


// Clean bloat from wp_head hook
// misc
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
// related page links
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
// old emoji support
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
// rss feeds
remove_action( 'wp_head', 'feed_links', 2 );
remove_action('wp_head', 'feed_links_extra', 3);
// shortlink
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Remove default title meta function
remove_action( 'wp_head', '_wp_render_title_tag', 1 );
