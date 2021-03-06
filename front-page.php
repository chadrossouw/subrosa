<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sub_Rosa
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="home_scroll_container">
			<div id="top"></div>
		<?php

		blocks_home();
		?>
		</div>
		<?php 
		blocks_gallery();
		blocks_podcast();	
		?>

	</main><!-- #main -->

<?php

get_footer();
