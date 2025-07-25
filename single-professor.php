<?php

get_header();

while(have_posts()) {
    the_post(); 
    pageBanner(array(
        'title' => '',
        'subtitle' => '',
        'photo'=> '',

    ));
    ?>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
        </div>

        <div class="generic-content">
            <div class="row group">
                <div class="one-third">
                    <?php the_post_thumbnail('portrait'); ?>
                </div>
                <div class="two-third">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>

        <?php

        $relatedPrograms = get_field('related_programs');

        if($relatedPrograms) {
            echo '<hr class="section-break">';
            echo ('<h2 class="headline headline--medium">Subject(s) taught</h2>');
            echo '<ul>';
            foreach($relatedPrograms as $program) { ?>
                <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>            
            <?php }
        echo '</ul>';
        }

        

        ?>

    </div>

    <?php
}

get_footer();

?>