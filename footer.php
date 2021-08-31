<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sub_Rosa
 */

?>

	<footer id="colophon" class="site-footer">
			<?php subrosa_social_media(); ?>
			<p>&copy; Copyright <?php echo wp_date('Y'); ?>. Secret History. <a href="/contact">Contact Us</a></p>
	</footer><!-- #colophon -->
</div><!-- #page -->
<div class="player_container">
	<iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=0&color=%23521406&auto_play=false&hide_related=true&show_comments=false&show_user=true&show_reposts=false&show_teaser=false"></iframe>
</div>
<?php wp_footer(); ?>

</body>
</html>

