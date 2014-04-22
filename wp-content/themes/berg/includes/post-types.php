<?php 
add_action( 'init', 'register_posts' );

function register_posts() {

    /*gallery_post*/
    register_post_type( 'gallery_post',
        array(
            'labels' => array(
                'name' => __( "Galleries","um_lang"),
                'singular_name' => __( "Gallery" ,"um_lang")
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => "galleries", 'with_front' => TRUE),
            'supports' => array('title','editor','thumbnail','page-attributes')
        )
    );

    register_taxonomy('gallery_category',
        array (0 => 'gallery_post',),
        array( 'hierarchical' => true, 'label' => __('Gallery Category',"um_lang"),'show_ui' => true,'query_var' => true,'singular_label' => __('Gallery Category',"um_lang")) );
}
?>