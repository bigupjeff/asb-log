<?php
// Constants
$descmin = 'ASB Logging Platform';
$sep     = ' - ';
// Site Vars
$site_title = get_bloginfo( 'name', 'display' );
$desc       = get_bloginfo( 'description', 'display' );
$logo       = esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) );
// Archive Vars
$archive_name = post_type_archive_title( '', false );
// Post Vars - returns the last queried post on multi-post pages e.g archives
$post_id    = get_the_ID();
$post_title = get_the_title();
global $wp;
$url       = home_url( add_query_arg( array(), $wp->request ) );
$page_name = str_replace( '-', ' ', get_query_var( 'pagename' ) );
// Post Vars - ACF
$tile_url = get_field( 'asb_tile_image' );
$price    = get_field( 'asb_price' );

// Meta - Title
if ( is_home() || is_front_page() ) {
	$meta_title = ucwords( $site_title . $sep . $desc );
} elseif ( is_singular( 'service' ) ) {
	if ( ! empty( $price ) ) {
		$meta_title = ucwords( $post_title . ' Starting at ' . '£' . $price . $sep . $descmin );
	} else {
		$meta_title = ucwords( $post_title . $sep . $desc );
	}
} elseif ( is_singular( 'page' ) ) {
	if ( strcasecmp( $post_title, $page_name ) == 0 ) {
		$meta_title = ucwords( $post_title . $sep . $site_title );
	} else {
		$meta_title = ucwords( $post_title . $sep . $page_name . ' ' . $site_title );
	}
} elseif ( is_archive() ) {
	$meta_title = ucwords( $archive_name . $sep . $site_title );
} else {
	$meta_title = ucwords( $desc );
}

// Meta - Description
if ( is_archive() ) {
	$meta_desc = wp_trim_words( get_post_field( 'post_content', '76' ), 30 );
} elseif ( is_home() || is_front_page() || is_singular() ) {
	$temp_post = $post; // Storing the object temporarily
	global $wp_query;
	$post        = $wp_query->post;
	$page_id     = $post->ID;
	$page_object = get_page( $page_id );
	$meta_desc   = wp_trim_words( $page_object->post_content, 30 );
	if ( $meta_desc == '' ) {
		$meta_desc = $post_title . $sep . $desc . $site_title;
	}
	$post = $temp_post; // Restore the value of $post to the original
}

// og:image
if ( is_archive() ) {
	$image_url = $logo;
} else {
	if ( ! empty( $tile_url ) ) {
		$image_url = $tile_url;
	} elseif ( has_post_thumbnail( $post_id ) ) {
		$thumbnail_id    = get_post_thumbnail_id( $post_id );
		$thumbnail_array = wp_get_attachment_image_src( $thumbnail_id, 'service-tile' );
		$thumbnail_url   = esc_url( $thumbnail_array[0] );
		$image_url       = $thumbnail_url;
	} else {
		$image_url = $logo;
	}
}

// Meta - canonical
if ( substr( $url, -1 ) !== '/' ) {
	$canon = $url . '/';
} else {
	$canon = $url;
}

?>
<title><?php echo $meta_title; ?></title>
<meta name="description" content="<?php echo $meta_desc; ?>">
<link rel="canonical" href="<?php echo $canon; ?>">
<meta property="og:locale" content="<?php bloginfo( 'language' ); ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo $meta_title; ?>">
<meta property="og:description" content="<?php echo $meta_desc; ?>">
<meta property="og:url" content="<?php echo $url; ?>">
<meta property="og:site_name" content="<?php echo $site_title; ?>">
<meta property="article:published_time" content="<?php echo get_the_date( 'Y-m-d', '', '' ); ?>">
<meta property="article:modified_time" content="<?php the_modified_time( 'Y-m-d' ); ?>">
<meta property="og:image" content="<?php echo $image_url; ?>">
<meta name="twitter:card" content="summary_large_image">
<meta property="og:image:width" content="960">
<meta property="og:image:height" content="960">

<meta name="google-site-verification" content="q7Kj7hYpgaRcXoj-jx9C8iya6HNg1rX2WCfwBnxQBT0" />
<meta name="msvalidate.01" content="0245B24FF2B31489A65C5541B284D4D8" />
