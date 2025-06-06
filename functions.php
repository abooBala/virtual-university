<?php

function style_files(){
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('style', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('style', get_theme_file_uri('/build/index.css'));
    wp_enqueue_script('jquery');
    wp_enqueue_script('js-script', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'style_files');

function theme_features() {
    add_theme_support('title-tag');
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerLocationOne', 'Footer Location One');
    register_nav_menu('footerLocationTwo', 'Footer Location Two');
}

add_action('after_setup_theme', 'theme_features');

// Add Custom Post Types. You may add this to your mu-plugins folder
function school_post_types() {
    register_post_type('event', array(
        'supports' => array('title', 'editor','excerpt'),
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name'=> 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'singular_name' => 'Event'
        ),
        'menu_icon' => 'dashicons-calendar'
    ));
}

add_action('init', 'school_post_types');

?>
