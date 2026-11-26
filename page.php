<?php
/**
 * Template genérico para páginas creadas desde el editor de WordPress.
 */
get_header();

while (have_posts()) {
  the_post();
  get_template_part('template-parts/page-hero', null, array('title' => esc_html(get_the_title())));
  ?>
  <section class="section">
    <div class="container-site">
      <div class="prose prose-lg mx-auto prose-headings:font-serif prose-a:text-gold-700">
        <?php the_content(); ?>
      </div>
    </div>
  </section>
<?php }

get_footer();
