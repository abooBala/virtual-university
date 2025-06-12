<?php 
get_header();
pageBanner(array(
  "title" => "All Events",
  'subtitle' => "See what we have been up to.",
  'photo' => ''
)); ?>

<div class="container container--narrow page-section">
  <?php
  while (have_posts()) {
    the_post();  
    get_template_part('template-parts/content', 'event');
  }
  echo paginate_links();
  ?>
  <hr class="section-break">
  
  <p>Check out <a href="<?php echo site_url('/past-events') ?>">our past events archives</a></p>
</div>

<?php get_footer(); ?>