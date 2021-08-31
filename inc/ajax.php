<?php 
add_action('wp_ajax_subrosa_next', 'subrosa_next_function'); 
add_action('wp_ajax_nopriv_subrosa_next', 'subrosa_next_function');

function subrosa_next_function(){
    
    $offset=$_POST['listcount'];
    $post_type=$_POST['post_type'];
    if($post_type=='histories'){
        blocks_history($offset);
    }
    elseif($post_type=='galleries'){
        blocks_gallery(9, true, $offset);
    }
    elseif($post_type=='podcasts'){
        blocks_podcasts(9, true, $offset);
    }
    die();
}