<?php
/**
 * Template Name: Grids
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sub_Rosa
 */

get_header();
$type = $post->post_name;
?>

	<main id="primary" class="site-main" data-type="<?php echo $type; ?>">
        <h1><?php echo $post->post_title; ?></h1>
        <div class="grid">
            <?php
            if('histories'==$type){
                blocks_history();
            }
            elseif('galleries'==$type){
                blocks_gallery(9, true);
            }
            elseif('podcasts'==$type){
                blocks_podcast(9,true);	
            }
            
            ?>
        </div>
        <div id="more" class="grid">
        </div>
        <div class="page-load-status page-load-status_load" style="display: none;">
            <div class="loader-ellipse loader-ellipse_load infinite-scroll-request" style="display: none;">
            <span class="loader-ellipse__dot"></span>
            <span class="loader-ellipse__dot"></span>
            <span class="loader-ellipse__dot"></span>
            <span class="loader-ellipse__dot"></span>
            </div>
        </div>
        <button class="button--more" id="next">
            Load more <?php echo $type; ?>
        </button
	</main><!-- #main -->

<?php

get_footer();