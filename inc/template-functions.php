<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Sub_Rosa
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function subrosa_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'subrosa_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function subrosa_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'subrosa_pingback_header' );


function subrosa_share($current_url=false, $media=false){
	if(!$current_url){
		global $wp;
		$current_url = home_url( add_query_arg( array(), $wp->request ) );
	}
	if(!$media){
    	global $post;
    	$media = get_the_post_thumbnail_url($post, 'medium');
	}
?>
    <div class="subrosa_share">
        <a href="javascript: void(0)" class="share subrosa_share--button">
			<?php echo file_get_contents(site_url().'/wp-content/themes/subrosa/assets/share.svg'); ?>
        </a>
        <div class="subrosa_share--icons">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $current_url; ?>" class="subrosa_share--icon" target="_blank">
				<?php echo file_get_contents(site_url().'/wp-content/themes/subrosa/assets/fb.svg'); ?>
            </a>
            <a href="https://twitter.com/intent/tweet?url=<?php echo $current_url; ?>&text=" class="subrosa_share--icon" target="_blank">
				<?php echo file_get_contents(site_url().'/wp-content/themes/subrosa/assets/twitter.svg'); ?>
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $current_url; ?>" class="subrosa_share--icon" target="_blank">
				<?php echo file_get_contents(site_url().'/wp-content/themes/subrosa/assets/linkedin.svg'); ?>
            </a>
            <a href="mailto:?subject=Secret History&amp;body=Check out this link <?php  echo $current_url; ?>." class="subrosa_share--icon" target="_blank">
				<?php echo file_get_contents(site_url().'/wp-content/themes/subrosa/assets/email.svg'); ?>
            </a>
        </div>
    </div>
<?php
}

function subrosa_follow(){
?>
    <div class="subrosa_share subrosa_follow">
        <a href="javascript: void(0)" class="share subrosa_share--button">
			<?php echo file_get_contents(site_url().'/wp-content/themes/subrosa/assets/follow.svg'); ?>
        </a>
        <div class="subrosa_share--icons">
            <a href="https://spotify.com" class="subrosa_share--link" target="_blank">
				Spotify
            </a>
            <a href="https://itunes.com" class="subrosa_share--link" target="_blank">
				Apple Music
            </a>
            <a href="https://soundcloud.com" class="subrosa_share--link" target="_blank">
				Soundcloud
            </a>
        </div>
    </div>
<?php
}

function subrosa_social_media(){
    ?>
    <div class="subrosa_share--icons">
		<a href="https://www.facebook.com/subrosa" class="subrosa_share--icon" target="_blank">
			<?php echo file_get_contents(site_url().'/wp-content/themes/subrosa/assets/fb.svg'); ?>
		</a>
		<a href="https://www.instagram.com/subrosa/" class="subrosa_share--icon" target="_blank">
			<?php echo file_get_contents(site_url().'/wp-content/themes/subrosa/assets/ig.svg'); ?>
		</a>
		<a href="https://twitter.com/subrosa" class="subrosa_share--icon" target="_blank">
			<?php echo file_get_contents(site_url().'/wp-content/themes/subrosa/assets/twitter.svg'); ?>
		</a>
		<a href="https://www.linkedin.com/company/subrosa" class="subrosa_share--icon" target="_blank">
			<?php echo file_get_contents(site_url().'/wp-content/themes/subrosa/assets/linkedin.svg'); ?>
		</a>
	</div>
    <?php
}

add_filter( 'post_gallery', 'subrosa_gallery_carousel', 10, 2 );
 
function subrosa_gallery_carousel( $string, $attr) {
	$posts_order_string = $attr['ids'];
    $posts_order = explode(',', $posts_order_string);
    $output = '<div class="gallery gallery--post carousel">';
    $posts = get_posts(array(
          'include' => $posts_order,
          'post_type' => 'attachment', 
          'orderby' => 'post__in'
    ));
	$count = count($posts);
    foreach($posts as $imagePost){
        $output .= '<figure class="carousel_item"><img src="' . wp_get_attachment_image_src($imagePost->ID, 'full')[0] . '" alt="" /><figcaption>'.$imagePost->post_excerpt.'</figcaption>';
    }

    $output .= '</div>';
	if($count>2){
		$output.='<div class="gallery_nav">';
		foreach($posts as $imagePost){
			$output .= '<img src="' . wp_get_attachment_image_src($imagePost->ID, 'thumbnail')[0] . '" alt="" />';
		}
		$output.='</div>';
	}
    return $output;
}