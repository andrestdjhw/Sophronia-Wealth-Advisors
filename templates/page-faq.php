<?php
/**
 * Template Name: FAQs
 *
 * Preguntas frecuentes agrupadas por categoría, con buscador (src/faq.js)
 * y datos estructurados FAQPage para Google. Contenido en inc/faq-data.php.
 */
get_header();
$site = sophronia_site_data();
$faqs = sophronia_faqs();
$c    = $site['contact'];

get_template_part('template-parts/page-hero', null, array(
  'eyebrow'  => 'FAQs',
  'title'    => 'Frequently asked <span class="italic text-gold-400">questions</span>',
  'subtitle' => 'Clear answers about how we work, what we charge and how to get started. No fine print.',
  'image'    => 'about-intro.webp',
  'photo'    => 'why-prudent',
  'image_position'        => 'center 40%',
  'image_position_mobile' => '60% center',
));
?>

<section class="section bg-soft-gradient">
  <div class="container-site grid gap-12 lg:grid-cols-12 lg:items-start">

    <!-- ─── Barra lateral: buscador + categorías + contacto ── -->
    <aside class="reveal reveal-left min-w-0 space-y-6 lg:sticky lg:top-36 lg:col-span-4">
      <div class="rounded-2xl border border-ocean-100 bg-white p-6 shadow-sm">
        <label for="faq-search" class="text-sm font-semibold text-ink-900">Search the FAQs</label>
        <div class="relative mt-3">
          <svg class="pointer-events-none absolute top-1/2 left-4 size-5 -translate-y-1/2 text-ink-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="6.5"/><path d="M16 16l4 4"/></svg>
          <input id="faq-search" type="search" placeholder="e.g. fees, CPA, retirement" autocomplete="off"
            class="w-full rounded-xl border border-ink-100 bg-ocean-50/50 py-3 pr-4 pl-12 text-ink-900 placeholder:text-ink-300 focus:border-ocean-500 focus:bg-white focus:ring-2 focus:ring-ocean-500/20 focus:outline-none">
        </div>
        <p id="faq-search-status" class="mt-2 text-xs text-ink-500" aria-live="polite"></p>

        <nav class="mt-5 border-t border-ink-100 pt-4 lg:mt-6 lg:pt-5" aria-label="FAQ categories">
          <!-- Móvil: fila de chips deslizable · Desktop: lista vertical -->
          <ul class="-mx-6 flex gap-2 overflow-x-auto px-6 pb-1 [scrollbar-width:none] lg:mx-0 lg:block lg:space-y-1 lg:overflow-visible lg:px-0 lg:pb-0">
            <?php foreach ($faqs as $key => $cat) : ?>
              <li class="shrink-0">
                <a href="#faq-<?php echo esc_attr($key); ?>" data-faq-link="<?php echo esc_attr($key); ?>" class="group flex items-center gap-2.5 rounded-full border border-ink-100 py-1.5 pr-4 pl-1.5 text-sm text-ink-700 transition hover:bg-ocean-50 hover:text-ocean-700 lg:gap-3 lg:rounded-xl lg:border-0 lg:px-3 lg:py-2.5 lg:text-base">
                  <span class="grid size-8 shrink-0 place-items-center rounded-lg bg-ocean-50 text-ocean-600 transition group-hover:bg-ocean-600 group-hover:text-white"><?php sophronia_icon($cat['icon'], 'size-4'); ?></span>
                  <span class="flex-1 font-medium"><?php echo esc_html($cat['title']); ?></span>
                  <span class="hidden text-xs text-ink-300 lg:inline"><?php echo count($cat['items']); ?></span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </nav>
      </div>

      <div class="relative hidden overflow-hidden rounded-2xl bg-brand-gradient p-6 text-white shadow-xl shadow-ocean-900/20 lg:block">
        <div class="absolute -top-12 -right-12 size-36 rounded-full bg-gold-500/25 blur-2xl"></div>
        <p class="relative font-serif text-xl">Still have questions?</p>
        <p class="relative mt-2 text-sm leading-relaxed text-ink-100/80">We’re happy to help. Send us a message or give us a call.</p>
        <div class="relative mt-5 flex flex-col gap-2">
          <a href="<?php echo esc_url($c['contactUrl']); ?>" class="btn-gold w-full">Contact us <?php sophronia_icon('arrow-right', 'size-4'); ?></a>
          <a href="<?php echo esc_url($c['phoneHref']); ?>" class="btn-outline-light w-full"><?php sophronia_icon('phone', 'size-4'); ?> <?php echo esc_html($c['phone']); ?></a>
        </div>
      </div>
    </aside>

    <!-- ─── Preguntas por categoría ───────────────────────── -->
    <div class="min-w-0 space-y-14 lg:col-span-8" id="faq-list">
      <?php foreach ($faqs as $key => $cat) : ?>
        <div id="faq-<?php echo esc_attr($key); ?>" class="faq-category scroll-mt-40" data-faq-category="<?php echo esc_attr($key); ?>">
          <div class="reveal flex items-center gap-4">
            <span class="size-12 icon-tile-solid"><?php sophronia_icon($cat['icon'], 'size-6'); ?></span>
            <h2 class="text-2xl sm:text-3xl"><?php echo esc_html($cat['title']); ?></h2>
          </div>
          <div class="reveal-stagger mt-6 space-y-3">
            <?php foreach ($cat['items'] as $q => $ans) : ?>
              <details class="faq-item group rounded-2xl border border-ocean-100 bg-white px-6 shadow-sm transition hover:border-ocean-200 open:shadow-lg open:shadow-ocean-900/5">
                <summary class="flex cursor-pointer items-center justify-between gap-6 py-5 text-left text-lg font-semibold text-ink-900">
                  <?php echo esc_html($q); ?>
                  <span class="faq-icon grid size-8 shrink-0 place-items-center rounded-full bg-ocean-600 text-white transition group-open:bg-gold-500 group-open:text-ink-950">+</span>
                </summary>
                <div class="faq-answer pb-6 leading-relaxed [&_a]:font-semibold [&_a]:text-ocean-600 [&_a]:underline [&_a]:underline-offset-4 [&_a:hover]:text-ocean-700 [&_strong]:text-ink-900"><?php echo wp_kses_post($ans); ?></div>
              </details>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <!-- Sin resultados (lo muestra src/faq.js) -->
      <div id="faq-empty" class="hidden rounded-2xl border border-dashed border-ocean-200 bg-white p-10 text-center">
        <p class="font-serif text-2xl text-ink-900">No matching questions</p>
        <p class="mt-2">Try another word, or <a class="link-brand" href="<?php echo esc_url($c['contactUrl']); ?>">ask us directly</a>.</p>
      </div>

      <!-- Contacto (móvil) -->
      <div class="reveal relative overflow-hidden rounded-2xl bg-brand-gradient p-7 text-white lg:hidden">
        <p class="font-serif text-xl">Still have questions?</p>
        <p class="mt-2 text-sm text-ink-100/80">We’re happy to help. Send us a message or give us a call.</p>
        <div class="mt-5 flex flex-col gap-2 sm:flex-row">
          <a href="<?php echo esc_url($c['contactUrl']); ?>" class="btn-gold">Contact us <?php sophronia_icon('arrow-right', 'size-4'); ?></a>
          <a href="<?php echo esc_url($c['phoneHref']); ?>" class="btn-outline-light"><?php sophronia_icon('phone', 'size-4'); ?> <?php echo esc_html($c['phone']); ?></a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_template_part('template-parts/cta-banner'); ?>

<?php
// Datos estructurados para Google (resultados enriquecidos de preguntas frecuentes)
$schema = array('@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array());
foreach ($faqs as $cat) {
  foreach ($cat['items'] as $q => $ans) {
    $schema['mainEntity'][] = array(
      '@type' => 'Question',
      'name'  => wp_strip_all_tags($q),
      'acceptedAnswer' => array('@type' => 'Answer', 'text' => wp_strip_all_tags($ans)),
    );
  }
}
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>

<?php get_footer();
