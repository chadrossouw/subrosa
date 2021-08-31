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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php subrosa_post_thumbnail(); ?>
		
			<h2 class="title title--first"><?php echo get_the_title();  echo !$ampersand?': ':''; ?></h2>
			<?php
			if($subtitle){
				?><h3><?php echo $ampersand?' & '.$subtitle:$subtitle; ?></h3><?php
			}
			$extract = carbon_get_post_meta( $id, 'sr_extract');
			if($extract){
			?>
			<div class="extract">
				<?php echo apply_filters('the_content',$extract); ?>
			</div>
			<?php
			}
			?>
		
	</header><!-- .entry-header -->

	

	<div class="entry-content">
	<?php if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<p><a href="/histories">Histories</a></p>
					<p><?php echo tag_author_names(get_the_ID()); ?></p>
					<p><?php echo get_the_category_list( ' | '); ?></p>
					<p><?php echo get_the_date('j F Y'); ?></p>
				</div><!-- .entry-meta -->
			<?php endif;
		?><div class="extract">
			<?php echo apply_filters('the_content',$extract); ?>
		</div><?php 
		the_content();
		?><div class="related_posts grid"><?php
		get_related_stories(get_the_ID());
		?></div>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
