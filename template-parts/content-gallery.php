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

<article id="post-<?php the_ID(); ?>" class="type-gallery">
	<?php
	$id = get_the_ID();
	$title = get_the_title();
	$subtitle = carbon_get_post_meta( $id, 'sr_subtitle' );
	$ampersand = carbon_get_post_meta( $id, 'sr_display_amp');
	$author = tag_author_names($id);
	$permalink = get_the_permalink($id);
	$slides = carbon_get_the_post_meta( 'gallery_images' );
	?><div class="galleries">
	<h3><?php echo $title.': '; ?><a href="/galleries">A Picture Gallery</a></h3>
	<?php
	if($slides):
		?><div class="picture_gallery carousel">
			<div class="carousel_item first_slide">
				<div class="picture_gallery_image">
					<?php echo wp_get_attachment_image(carbon_get_the_post_meta('featured_image'),'full'); ?>
				</div>
				<div class="picture_gallery_image_teaser">
					<?php echo wp_get_attachment_image(carbon_get_the_post_meta('secondary_featured_image'),'medium'); ?>
				</div>
				<div class="picture_gallery_image_teaser">
					<?php echo wp_get_attachment_image(carbon_get_the_post_meta('tertiary_featured_image'),'medium'); ?>
				</div>
				<a href="<?php echo $permalink; ?>" >
					<h2 class="title title--first"><?php echo $title; ?><?php
						if($subtitle):
							echo $ampersand?' & '.$subtitle:': '.$subtitle; 
						endif;
					?></h2>
				</a>
			</div>
			<?php 
			$count = count($slides);
			$current = 1;
			foreach($slides as $slide):
				?><div class="carousel_item">
					<div class="picture_gallery_image">
						<?php echo wp_get_attachment_image($slide['gallery_image'],'full'); ?>
					</div>
					<div class="carousel_index"><h5><?php echo $title ; ?></h5><h5><?php echo $current.' | '.$count; ?></h5></div>
					<?php if ($slide['gallery_image_caption']): ?>
						<div class="picture_gallery_caption">
							<?php echo apply_filters('the_content',$slide['gallery_image_caption']); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php 
			$current++;
			endforeach; ?>
			<div class="carousel_item share_slide">
				<div class="picture_gallery_image">
					<?php echo wp_get_attachment_image(carbon_get_the_post_meta('featured_image'),'full'); ?>
				</div>
				<?php subrosa_share($permalink,  wp_get_attachment_image_url(carbon_get_the_post_meta('featured_image'),'full')); ?>
			</div>
			<div class="carousel_item last_slide">
				<?php $galleries = get_posts(array('fields'=>'ids','numberposts'=>4,'post_type'=>'gallery', 'orderby'=>'rand'));
				foreach($galleries as $gallery):
					?><a href="<?php echo get_permalink($gallery); ?>">
					<?php echo wp_get_attachment_image(carbon_get_post_meta($gallery,'featured_image'),'medium');  ?>
					</a><?php
				endforeach;
				?>
				<a href="/galleries"><h2>See All Our Galleries</h2></a>
			</div>
		</div><?php
	endif;
	?></div>
</article><!-- #post-<?php the_ID(); ?> -->
<div class="related_posts grid"><?php
	get_related_media(get_post_type(),get_the_ID());
?></div>