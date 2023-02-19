<?php
// The Welcome Template Part for ASB Log
// 2023 © ASB Log
// Author: Jefferson Real
// URL: https://jeffersonreal.uk

// Home page vars
$homepage_post_id = '17';
?>

    <div class="site-intro">
        <h1 class="site-title title">Welcome to <?php bloginfo( 'name' ); ?></h1>
		<span id="clock"></span>
    </div>

	<?php if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ): ?>
    <div class="buttonWrap" method="get" action="#contactForm">
        <a href="<?php echo admin_url( 'post-new.php?post_type=incident' ); ?>" class="button button-outline"><i class="fas fa-pencil-alt"></i>Log a new incident</a>
	</div>
	<?php endif ?>
