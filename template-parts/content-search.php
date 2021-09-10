<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sub_Rosa
 */
$id = get_the_ID();
$title = get_the_title();
$subtitle = carbon_get_post_meta( $id, 'sr_subtitle' );
$ampersand = carbon_get_post_meta( $id, 'sr_display_amp');
$author = tag_author_names($id);
$permalink = get_the_permalink($id);
$type = get_post_type();
?>
<?php if ( 'post' === $type) : ?>
	<div class="grid--posts grid--search grid_item">
		<a href="<?php echo $permalink; ?>" class="grid_item--image">
			<?php echo get_the_post_thumbnail($id,'full'); ?>
		</a>
		<div class="grid_item--title">
			<a href="<?php echo $permalink; ?>" >
				<h3 class="title title--first"><?php echo $title; ?><?php
				if($subtitle){
				echo $ampersand?' & '.$subtitle:': '.$subtitle; 
				}
		?></h3></a>
		<?php if($author){
				?><div class="author">
					<?php echo $author; ?>
				</div><?php
				}
				?>
		</div>
	</div>
<?php elseif( 'podcast' === $type): ?>
	<div class="podcasts podcasts--grid grid--search grid_item">
		<h3><a href="/podcasts">Podcast</a></h3>
		<div class="podcast">
			<?php echo wp_get_attachment_image(carbon_get_the_post_meta('featured_image'),'full'); ?>
			<a href="<?php echo $permalink; ?>" >
				<h2 class="title title--first"><?php echo $title; ?><?php
					if($subtitle):
						echo $ampersand?' & '.$subtitle:': '.$subtitle; 
					endif;
				?></h2>
				</a>			
		</div>
	</div>
<?php elseif('gallery' === $type): 
	$slides = carbon_get_post_meta( $id,'gallery_images' );
		?><div class="galleries galleries--grid grid--search grid_item">
		<h3><a href="/galleries">Picture Gallery</a></h3>
		<?php
			?><div class="picture_gallery carousel no-flickity">
				<div class="carousel_item first_slide">
					<div class="picture_gallery_image">
						<a href="<?php echo $permalink; ?>" >
							<?php echo wp_get_attachment_image(carbon_get_the_post_meta('featured_image'),'full'); ?>
						</a>
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
			</div>
        </div>
<?php endif; ?>
	


