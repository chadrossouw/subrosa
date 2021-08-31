<?php
// create new post type for events
function sh_init(){
    $labels = array(
		'name'               => __( 'Podcast', 'secret_history' ),
		'singular_name'      => __( 'Podcast', 'secret_history' ),
		'menu_name'          => __( 'Podcasts', 'secret_history' ),
		'name_admin_bar'     => __( 'Podcasts', 'secret_history' ),
		'add_new'            => __( 'Add New', 'secret_history' ),
		'add_new_item'       => __( 'Add New Podcast', 'secret_history' ),
		'new_item'           => __( 'New Podcast', 'secret_history' ),
		'edit_item'          => __( 'Edit Podcast', 'secret_history' ),
		'view_item'          => __( 'View Podcast', 'secret_history' ),
		'all_items'          => __( 'All Podcast', 'secret_history' ),
		'search_items'       => __( 'Search Podcasts', 'secret_history' ),
		'parent_item_colon'  => __( 'Parent Podcasts:', 'secret_history' ),
		'not_found'          => __( 'No Podcasts found.', 'secret_history' ),
		'not_found_in_trash' => __( 'No Podcasts found in Trash.', 'secret_history' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'A post type for Secret History Podcasts.', 'secret_history' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
        'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'podcasts' ),
		'capability_type'    => 'post',
		'taxonomies' 		 => array('category','post_tag'),
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 4,
        'menu_icon'           => 'dashicons-controls-volumeon',
        'supports'           => array( 'title', 'editor', 'author' ),
        
	);

	
	register_post_type( 'podcast', $args );

    $labels_gallery = array(
		'name'               => __( 'Gallery', 'secret_history' ),
		'singular_name'      => __( 'Gallery', 'secret_history' ),
		'menu_name'          => __( 'Galleries', 'secret_history' ),
		'name_admin_bar'     => __( 'Galleries', 'secret_history' ),
		'add_new'            => __( 'Add New', 'secret_history' ),
		'add_new_item'       => __( 'Add New Gallery', 'secret_history' ),
		'new_item'           => __( 'New Gallery', 'secret_history' ),
		'edit_item'          => __( 'Edit Gallery', 'secret_history' ),
		'view_item'          => __( 'View Gallery', 'secret_history' ),
		'all_items'          => __( 'All Galleries', 'secret_history' ),
		'search_items'       => __( 'Search Galleries', 'secret_history' ),
		'parent_item_colon'  => __( 'Parent Galleries:', 'secret_history' ),
		'not_found'          => __( 'No Galleries found.', 'secret_history' ),
		'not_found_in_trash' => __( 'No Galleries found in Trash.', 'secret_history' )
	);

	$args_gallery = array(
		'labels'             => $labels_gallery,
        'description'        => __( 'A post type for Secret History galleries.', 'secret_history' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
        'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'galleries' ),
		'capability_type'    => 'post',
		'taxonomies' 		 => array('category','post_tag'),
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 4,
        'menu_icon'           => 'dashicons-format-image',
        'supports'           => array( 'title', 'author',  ),
        
	);

	
	register_post_type( 'gallery', $args_gallery );

  
	$labels_tax= array(
		'name' => _x( 'Author', 'taxonomy general name' ),
		'singular_name' => _x( 'Author', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Authors' ),
		'all_items' => __( 'All Authors' ),
		'parent_item' => __( 'Parent Author' ),
		'parent_item_colon' => __( 'Parent Author:' ),
		'edit_item' => __( 'Edit Author' ), 
		'update_item' => __( 'Update Author' ),
		'add_new_item' => __( 'Add New Author' ),
		'new_item_name' => __( 'New Author Name' ),
		'menu_name' => __( 'Authors' ),
	  ); 
	  register_taxonomy('sr_author',array('post','podcast','gallery'), array(
		'hierarchical' => false,
		'labels' => $labels_tax,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'authors' ),
	  ));

	  
    }
    
    add_action( 'init', 'sh_init' );