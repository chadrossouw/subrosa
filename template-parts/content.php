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
		<div class="header-text">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			?><h3 class="title title--first"><?php echo $title; ?>
			<?php
			if($subtitle){
				?><?php echo $ampersand?' & '.$subtitle:': '.$subtitle; ?></h3><?php
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
		</div>
	</header><!-- .entry-header -->

	

	<div class="entry-content">
	<?php if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<p>Histories</p>
					<p>Long Form</p>
					<p>Nick Dall</p>
					<p>27 May 2021</p>
				</div><!-- .entry-meta -->
			<?php endif;
		
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'subrosa' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'subrosa' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php subrosa_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
