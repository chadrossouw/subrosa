<?php
/*Functions for displaying blocks*/

function blocks_home(){
    $args=array(
        'posts_per_page'=>1,
        'post_type'=>'post',
        'meta_key' => '_sr_home_feature',
        'meta_value'=>'yes',
    );
    $first_post = '';
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $id = get_the_ID();
            $first_post = $id;
            $title = get_the_title();
            $subtitle = carbon_get_post_meta( $id, 'sr_subtitle' );
            $ampersand = carbon_get_post_meta( $id, 'sr_display_amp');
            $author = tag_author_names($id);
            $permalink = get_the_permalink($id);
            $template = carbon_get_post_meta($id, 'sr_template');
            ?>
            <div class="feature feature--home <?php echo $template; ?>">
                <a href="<?php echo $permalink; ?>">
                    <?php 
                    if(carbon_get_post_meta( $id, 'sr_secondary_feature')){
                        $image = wp_get_attachment_image(carbon_get_post_meta( $id, 'sr_secondary_feature'),'full');
                    }
                    else{
                        $image=get_the_post_thumbnail($id,'full'); 
                    }
                    echo $image; ?>
                </a>
                <div class="title_block">
                    <a href="<?php echo $permalink; ?>">
                    <h2 class="title title--first"><?php echo $title; ?></h2>
                    <?php
                    
                    if($subtitle){
                        ?><h3 class="title title-subtitle"><?php echo $ampersand?'<span class="ampersand"> & </span>':''; echo $subtitle; ?></h3><?php
                    }
                    ?></a><?php
                    if($author){
                    ?><div class="author">
                        <?php echo $author; ?>
                    </div>
                    <?php } 
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
                
            </div>
        <?php
        }
    }
    wp_reset_postdata();

    $args_grid=array(
        'posts_per_page'=>10,
        'post__not_in' => array($first_post),
    );
    $grid_query = new WP_Query( $args_grid );

    if ( $grid_query->have_posts() ) {
        ?><div class="grid grid--home"><?php
        while ( $grid_query->have_posts() ) {
            $grid_query->the_post();
            $id = get_the_ID();
            $title = get_the_title();
            $subtitle = carbon_get_post_meta( $id, 'sr_subtitle' );
            $ampersand = carbon_get_post_meta( $id, 'sr_display_amp');
            $author = tag_author_names($id);
            $permalink = get_the_permalink($id);
            ?>
            <div class="grid_item">
            <a href="<?php echo $permalink; ?>" class="grid_item--image">
                <?php echo get_the_post_thumbnail($id,'medium'); ?>
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
            <?php
        }
        ?></div><?php
    }
    wp_reset_postdata();
}

function blocks_gallery($posts_per_page = 3, $pagination = false, $offset = 0){
      $args=array(
        'posts_per_page'=>$posts_per_page,
        'post_type'=>'gallery',
        'offset'=>$offset,
    );
    if(!$pagination){
        $args['meta_key']= '_sr_home_feature';
        $args['meta_value']='yes';
        $class='galleries--home home_block';
    }
    
    else{
        $class='galleries--grid grid_item';
    }
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) :
            $the_query->the_post();
            $id = get_the_ID();
            $title = get_the_title();
            $subtitle = carbon_get_post_meta( $id, 'sr_subtitle' );
            $ampersand = carbon_get_post_meta( $id, 'sr_display_amp');
            $author = tag_author_names($id);
            $permalink = get_the_permalink($id);
            $slides = carbon_get_the_post_meta( 'gallery_images' );
            ?><div class="galleries <?php echo $class; ?>">
            <?php echo !$pagination?'<h3><a href="/galleries">Picture Gallery</a></h3>':''; ?>
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
                    <?php if(!$pagination): ?>
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
                    <?php endif; ?>
                </div><?php
            endif;
            ?></div><?php
        endwhile;
        
    endif;
    wp_reset_postdata();
}

function blocks_podcast($posts_per_page=3,$pagination=false,$offset=0){
    $args=array(
        'posts_per_page'=>$posts_per_page,
        'post_type'=>'podcast',
        'offset'=>$offset,
    );
    if(!$pagination){
        $args['meta_key']= '_sr_home_feature';
        $args['meta_value']='yes';
        $class='podcasts--home home_block';
    }

    else{
        $class='podcasts--grid grid_item';
    }

    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) :
            $the_query->the_post();
            $id = get_the_ID();
            $title = get_the_title();
            $subtitle = carbon_get_post_meta( $id, 'sr_subtitle' );
            $ampersand = carbon_get_post_meta( $id, 'sr_display_amp');
            $permalink = get_the_permalink($id);
            ?><div class="podcasts <?php echo $class; ?>">
                <?php echo !$pagination?'<h3><a href="/podcasts">Podcast</a></h3>':''; ?>
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
            <?php
        endwhile;
    endif;
    wp_reset_postdata();
}

function blocks_history($offset=0,$posts_per_page=9){
    $args_grid=array(
        'posts_per_page'=>$posts_per_page,
        'offset'=>$offset,
    );
    $grid_query = new WP_Query( $args_grid );

    if ( $grid_query->have_posts() ) {
        while ( $grid_query->have_posts() ) {
            $grid_query->the_post();
            $id = get_the_ID();
            $title = get_the_title();
            $subtitle = carbon_get_post_meta( $id, 'sr_subtitle' );
            $ampersand = carbon_get_post_meta( $id, 'sr_display_amp');
            $author = tag_author_names($id);
            $permalink = get_the_permalink($id);
            ?>
            <div class="grid--posts grid_item">
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
            <?php
        }
        ?><?php
    }
    wp_reset_postdata();
}

function get_related_stories($id){
    /*Currently by Author, but will need to be a proper related posts when there is enough content*/
    $names = get_the_terms($id,'sr_author');
    $args=array(
        'post_type'=>array('post','gallery','podcast'),
        'numberposts'=>2,
        'fields'=>'ids',
        'orderby'=>'rand',
        'post__not_in' => array($id),
        'tax_query'=>array(
            array(
                'taxonomy'=>'sr_author',
                'field'=>'term_id',
                'terms'=>$names[0]->term_id,
            )
        ),
    );
    $related_posts = get_posts($args);
    if($related_posts){
        ?><h3>More from <?php echo tag_author_names($id); ?></h3>
        <?php
        foreach($related_posts as $related_id){
            $title = get_the_title($related_id);
            $subtitle = carbon_get_post_meta( $related_id, 'sr_subtitle' );
            $ampersand = carbon_get_post_meta( $related_id, 'sr_display_amp');
            $permalink = get_the_permalink($related_id);
            ?>
            <div class="grid--related_post grid_item">
                <a href="<?php echo $permalink; ?>" class="grid_item--image">
                    <?php echo get_the_post_thumbnail($related_id,'full'); ?>
                </a>
                <div class="grid_item--title">
                    <a href="<?php echo $permalink; ?>" >
                        <h3 class="title title--first"><?php echo $title; ?><?php
                        if($subtitle){
                        echo $ampersand?' & '.$subtitle:': '.$subtitle; 
                        }
                ?></h3></a>
                </div>
            </div><?php
        }
    }
}

function get_recent(){
    ?><h3>Recently on Secret Histories</h3><div class="grid"><?php
    $args=array(
        'post_type'=>array('post','gallery','podcast'),
        'numberposts'=>1,
        'fields'=>'ids'
    );
    $recent_post = get_posts($args);
   
    $type = get_post_type($recent_post[0]);
    if('post'==$type){
        blocks_history(0,1);
    }
    elseif('gallery'==$type){
        blocks_gallery(1, true, 0);
    }
    elseif('podcast'==$type){
        blocks_podcast(1, true, 0);
    }
    ?></div><?php
}