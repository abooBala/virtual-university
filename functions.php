<?php

function pageBanner($args) {

    if (!$args['title']) {
        $args['title'] = get_the_title();
    }

    if (!$args['subtitle']) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }
    if (!$args['photo']) {
        if (get_field('page_banner_image')) {
            $args['photo'] = get_field('page_banner_image')['sizes']['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }
?>

    <div class="page-banner">
        <div class="page-banner__bg-image"
            style="background-image: url(<?php echo $args['photo']; ?>)"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
            <div class="page-banner__intro">
                <p><?php echo $args['subtitle']; ?></p>
            </div>
        </div>
    </div>

    <?php 
}

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
    add_theme_support('post-thumbnails');
    add_image_size('landscape', 400, 250, true);
    add_image_size('portrait', 350, 600, true);
    add_image_size('pageBanner', 1500, 350, true);
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerLocationOne', 'Footer Location One');
    register_nav_menu('footerLocationTwo', 'Footer Location Two');
}

add_action('after_setup_theme', 'theme_features');

// Add Custom Post Types. You may add this to your mu-plugins folder
function school_post_types() {
    // Events custom post type
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

    // Programs custom post type
    register_post_type('program', array(
        'supports' => array('title', 'editor'),
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'programs'),
        'has_archive' => true,
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name'=> 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'singular_name' => 'Program'
        ),
        'menu_icon' => 'dashicons-awards'       
        
    ));

        // Professor custom post type
        register_post_type('professor', array(
            'supports' => array('title', 'editor', 'thumbnail'),
            'show_in_rest' => true,
            'public' => true,
            'show_in_rest' => true,
            'labels' => array(
                'name'=> 'Professors',
                'add_new_item' => 'Add New Professor',
                'edit_item' => 'Edit Professor',
                'singular_name' => 'Professor'
            ),
            'menu_icon' => 'dashicons-welcome-learn-more'       
            
        ));
}

add_action('init', 'school_post_types');

function adjust_queries($query) {

    if (!is_admin() AND is_post_type_archive('event') AND is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }


    if (!is_admin() AND is_post_type_archive('event') AND is_main_query()) {
        $today = date('Ymd');
        $query->set('meta-key', 'event-date');
        $query->set('orderby', 'meta-value-num');
        $query->set('order','ASC');
        $query->set('meta-query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'typer' => 'numberic'
            )
            ));
    }

}

add_action('pre_get_posts', 'adjust_queries' )

?>
