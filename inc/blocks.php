<?php
/*Functions for displaying blocks*/

function blocks_home(){
    $args=array(
        'posts_per_page'=>1,
        'meta_key' => '_sr_home_feature',
        'meta_value'=>'yes',
    );
    $first_post = '';
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
        ?><div class="feature feature--home"><?php
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $id = get_the_ID();
            $first_post = $id;
            $title = get_the_title();
            $subtitle = carbon_get_post_meta( $id, 'sr_subtitle' );
            $ampersand = carbon_get_post_meta( $id, 'sr_display_amp');
            $author = tag_author_names($id);
            $permalink = get_the_permalink($id);
            ?>
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
                <?php } ?></div><a href="<?php echo $permalink; ?>"><?php
                
                $extract = carbon_get_post_meta( $id, 'sr_extract');
                if($extract){
                ?>
                <div class="extract">
                    <?php echo apply_filters('the_content',$extract); ?>
                </div>
                <?php
                }
                ?>
            </a>
        <?php
        }
        ?></div><?php
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
                    <h3 class="title title--first"><?php echo $title; ?>
                    <?php
                    if($subtitle){
                        ?><?php echo $ampersand?' & '.$subtitle:': '.$subtitle; ?></h3><?php
                    }
            ?></a>
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

function blocks_gallery(){

}

function blocks_podcast(){

}