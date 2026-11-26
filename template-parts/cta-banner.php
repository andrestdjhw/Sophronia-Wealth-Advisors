<?php
/**
 * Banner de llamada a la acción (Clarity Session), usado al final de las páginas.
 * get_template_part('template-parts/cta-banner', null, array('title' => '', 'text' => ''));
 */
$site = sophronia_site_data();
$a = wp_parse_args($args ?? array(), array(
  'title' => 'Get answers. Get clarity. Know your next step.',
  'text'  => 'Start with a 60-minute Clarity Session: independent, fiduciary advice focused entirely on you. No pressure, no sales pitch.',
));
?>
<section class="section bg-white">
  <div class="container-site">
    <div class="reveal reveal-zoom relative isolate overflow-hidden rounded-3xl bg-brand-gradient shadow-2xl shadow-ocean-900/30 px-8 py-14 sm:px-14 sm:py-16">
      <svg class="spin-slow absolute -top-24 -right-24 -z-10 size-96 text-gold-400/15" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="3" aria-hidden="true">
        <?php for ($i = 0; $i < 8; $i++) : ?>
          <ellipse cx="100" cy="60" rx="22" ry="45" transform="rotate(<?php echo $i * 45; ?> 100 100)"/>
        <?php endfor; ?>
      </svg>
      <div class="flex flex-col gap-10 lg:flex-row lg:items-center lg:justify-between">
        <div class="max-w-2xl">
          <h2 class="text-3xl text-white sm:text-4xl"><?php echo esc_html($a['title']); ?></h2>
          <p class="mt-4 text-lg text-ink-100/80"><?php echo esc_html($a['text']); ?></p>
        </div>
        <div class="reveal-stagger flex shrink-0 flex-col gap-3 sm:flex-row">
          <a href="<?php echo esc_url($site['cta']['url']); ?>" class="btn-gold">
            <?php echo esc_html($site['cta']['label']); ?>
            <?php sophronia_icon('arrow-right', 'size-4'); ?>
          </a>
          <a href="<?php echo esc_url($site['contact']['phoneHref']); ?>" class="btn-outline-light">
            <?php sophronia_icon('phone', 'size-4'); ?>
            <?php echo esc_html($site['contact']['phone']); ?>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
