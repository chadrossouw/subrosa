<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sub_Rosa
 */

            $subtitle = carbon_get_post_meta( $id, 'sr_subtitle' );
            $ampersand = carbon_get_post_meta( $id, 'sr_display_amp');
?>

<article id="post-<?php the_ID(); ?>" class="type-podcast">
	<?php
	$id = get_the_ID();
	$title = get_the_title();
	$subtitle = carbon_get_post_meta( $id, 'sr_subtitle' );
	$ampersand = carbon_get_post_meta( $id, 'sr_display_amp');
	$permalink = get_the_permalink($id);
	?><div class="podcasts <?php echo $class; ?>">
		<h3><?php echo $title.': '; ?><a href="/podcasts">A Podcast</a></h3>
		<div class="podcast" data-id="<?php echo carbon_get_the_post_meta('podcast_embed'); ?>">
			<?php echo wp_get_attachment_image(carbon_get_the_post_meta('featured_image'),'full'); ?>
			<?php echo file_get_contents(get_template_directory_uri().'/assets/play.svg'); ?>
			<?php echo file_get_contents(get_template_directory_uri().'/assets/pause.svg'); ?>
			<div class="loader"><?php echo file_get_contents(get_template_directory_uri().'/assets/loader.svg'); ?></div>
			<a href="<?php echo $permalink; ?>" >
				<h2 class="title title--first"><?php echo $title; ?><?php
					if($subtitle):
						echo $ampersand?' & '.$subtitle:': '.$subtitle; 
					endif;
				?></h2>
				</a>
			
		</div>
		<div class="podcast_sm">
			<?php subrosa_share($permalink,wp_get_attachment_image_url(carbon_get_the_post_meta('featured_image'),'full')); ?>
			<?php subrosa_follow(); ?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
<div class="related_posts grid"><?php
	get_related_media(get_post_type(),get_the_ID());
?></div>