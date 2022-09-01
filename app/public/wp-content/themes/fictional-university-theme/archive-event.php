<?php

get_header();
pageBanner(array(
  'title' => 'All Events',
  'subtitle' => 'See whats up with us.'
));
 ?>

    <div class="container container--narrow page-section">
    <?php

    while (have_posts()) {
      the_post();
      get_template_part('template-parts/content-event');
    }
    echo paginate_links();
    ?>
    <hr class="section-break" />
    <p>Looking for a recap? <a href="<?php echo site_url('/past-events') ?>">Check this out >></a></p>

    </div>

<?php
get_footer();

?>