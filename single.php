<?php
/**
 * Entrada individual del blog
 */
get_header();

while (have_posts()) {
  the_post();
  get_template_part('template-parts/page-hero', null, array(
    'eyebrow'  => get_the_date(),
    'title'    => esc_html(get_the_title()),
  ));
  ?>
  <article class="section">
    <div class="container-site">
      <?php if (has_post_thumbnail()) : ?>
        <div class="mx-auto mb-12 max-w-4xl overflow-hidden rounded-3xl"><?php the_post_thumbnail('large', array('class' => 'w-full h-auto')); ?></div>
      <?php endif; ?>
      <div class="prose prose-lg mx-auto prose-headings:font-serif prose-a:text-gold-700">
        <?php the_content(); ?>
      </div>
    </div>
  </article>
<?php }

get_footer();
