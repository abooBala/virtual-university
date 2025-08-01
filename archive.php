<?php get_header();
pageBanner(array(
  'title' => get_the_archive_title(),
  'subtitle' => get_the_archive_description(),
  'photo' => ''
));

?>


    <div class="container container--narrow page-section">
      <?php
      while (have_posts()) {
        the_post(); ?>
        <div class="post-item">
          <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="metabox"><p>Posted by: <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></p></div>
          <div class="generic-content"><p><?php the_excerpt(); ?></p></div>
          <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
        </div>
      <?php }
      echo paginate_links();
      ?>
    </div>

<?php get_footer(); ?>