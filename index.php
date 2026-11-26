<?php
/**
 * Fallback: listado de entradas (blog / archivos)
 */
get_header();

get_template_part('template-parts/page-hero', null, array(
  'eyebrow' => 'Insights',
  'title'   => is_home() ? 'Insights &amp; news' : esc_html(get_the_archive_title()),
));
?>

<section class="section">
  <div class="container-site">
    <?php if (have_posts()) : ?>
      <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        <?php while (have_posts()) : the_post(); ?>
          <article class="card flex flex-col">
            <p class="text-xs font-semibold tracking-widest text-gold-700 uppercase"><?php echo esc_html(get_the_date()); ?></p>
            <h2 class="mt-3 text-xl"><a href="<?php the_permalink(); ?>" class="hover:text-gold-700"><?php the_title(); ?></a></h2>
            <div class="mt-3 text-sm leading-relaxed"><?php the_excerpt(); ?></div>
            <a href="<?php the_permalink(); ?>" class="mt-auto pt-6 text-sm font-semibold text-ink-900 underline decoration-gold-500 decoration-2 underline-offset-4">Read more</a>
          </article>
        <?php endwhile; ?>
      </div>
      <div class="mt-12"><?php the_posts_pagination(); ?></div>
    <?php else : ?>
      <p class="text-center">Nothing here yet.</p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer();
