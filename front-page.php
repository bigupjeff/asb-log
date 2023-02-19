<?php
// The Homepage Template for ASB Log
// 2023 © ASB Log
// Author: Jefferson Real
// URL: https://jeffersonreal.uk

get_header();
?>

<!-- front-page GRID START -->
<main class="frontPage-main" id="primary" >

	<section class="welcome">
		<?php get_template_part( 'template-parts/fp-welcome', 'none' );?>
	</section>
	<section class="incidentFeed">
		<?php get_template_part( 'template-parts/incident-feed', 'none' );?>
	</section>

</main>
<!-- front-page GRID END -->

<?php
get_footer();
