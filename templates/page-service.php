<?php
/**
 * Template Name: Service Detail
 *
 * Plantilla única para todas las subpáginas /services/{slug}/.
 * El contenido sale de inc/services-data.php según el slug de la página.
 */
get_header();
$site     = sophronia_site_data();
$slug     = get_post_field('post_name', get_queried_object_id());
$service  = sophronia_service($slug);
$services = sophronia_services();

// Si la página no tiene datos en el catálogo, se muestra como página normal.
if (!$service) {
  get_template_part('template-parts/page-hero');
  echo '<section class="section"><div class="container-site prose prose-lg max-w-3xl">';
  while (have_posts()) { the_post(); the_content(); }
  echo '</div></section>';
  get_footer();
  return;
}

get_template_part('template-parts/page-hero', null, array(
  'eyebrow'        => 'Services · ' . $service['title'],
  'title'          => $service['hero'],
  'subtitle'       => $service['subtitle'],
  'image'          => $service['image'],
  'photo'          => $service['photo'] ?? '',
  'image_class'    => !empty($service['flip']) ? '-scale-x-100' : '',
  'image_position' => $service['image_position'],
  'image_position_mobile' => $service['image_position_mobile'] ?? '',
));
?>

<!-- ─── Migas de pan ─────────────────────────────────────── -->
<nav class="border-b border-ink-100 bg-white" aria-label="Breadcrumb">
  <ol class="container-site flex flex-wrap items-center gap-2 py-4 text-sm text-ink-500">
    <li><a class="hover:text-ocean-600" href="<?php echo esc_url($site['homeUrl']); ?>">Home</a></li>
    <li aria-hidden="true">/</li>
    <li><a class="hover:text-ocean-600" href="<?php echo esc_url(sophronia_page_url('services')); ?>">Services</a></li>
    <li aria-hidden="true">/</li>
    <li class="font-medium text-ink-900" aria-current="page"><?php echo esc_html($service['title']); ?></li>
  </ol>
</nav>

<!-- ─── Intro + tarjeta de precio ────────────────────────── -->
<section class="section">
  <div class="container-site grid gap-14 lg:grid-cols-12 lg:items-start">
    <div class="reveal reveal-left lg:col-span-7">
      <span class="size-14 icon-tile-solid"><?php sophronia_icon($service['icon'], 'size-7'); ?></span>
      <h2 class="mt-6 text-3xl leading-tight sm:text-4xl"><?php echo esc_html($service['summary']); ?></h2>
      <?php foreach ($service['intro'] as $p) : ?>
        <p class="mt-6 text-lg leading-relaxed"><?php echo esc_html($p); ?></p>
      <?php endforeach; ?>
      <?php if (!empty($service['note'])) : ?>
        <p class="mt-8 border-l-2 border-gold-500 pl-4 text-sm text-ink-500"><?php echo esc_html($service['note']); ?></p>
      <?php endif; ?>
    </div>

    <aside class="reveal reveal-right lg:sticky lg:top-36 lg:col-span-5">
      <div class="relative overflow-hidden rounded-2xl bg-brand-gradient p-8 text-white shadow-2xl shadow-ocean-900/25">
        <div class="absolute -top-16 -right-16 size-48 rounded-full bg-gold-500/20 blur-2xl"></div>
        <p class="relative text-sm font-semibold tracking-widest text-gold-300 uppercase">Included in one flat fee</p>
        <p class="relative mt-3 font-serif text-5xl text-white"><span data-count="4000" data-prefix="$">$4,000</span><span class="text-xl text-ink-100/70"> / quarter</span></p>
        <p class="relative mt-4 text-sm leading-relaxed text-ink-100/80"><?php echo esc_html($service['title']); ?> is part of our ongoing wealth management relationship. No commissions, no AUM fees.</p>
        <a href="<?php echo esc_url($site['cta']['url']); ?>" class="btn-gold relative mt-8 w-full">
          Start with a Clarity Session <?php sophronia_icon('arrow-right', 'size-4'); ?>
        </a>
        <a href="<?php echo esc_url($site['contact']['contactUrl']); ?>" class="relative mt-3 block text-center text-sm text-ink-100/80 underline-offset-4 hover:text-white hover:underline">or send us a message</a>
      </div>
    </aside>
  </div>
</section>

<!-- ─── Áreas de enfoque ─────────────────────────────────── -->
<section class="section bg-soft-gradient">
  <div class="container-site">
    <div class="reveal max-w-2xl">
      <p class="eyebrow">How we help</p>
      <h2 class="mt-5 text-3xl sm:text-4xl">What <?php echo esc_html(strtolower($service['title'])); ?> can include</h2>
    </div>
    <ul class="reveal-stagger mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($service['focus'] as $i => $f) : ?>
        <li class="group card relative overflow-hidden transition hover:-translate-y-1 hover:border-ocean-200 hover:shadow-xl">
          <span class="absolute top-5 right-6 font-serif text-5xl text-ocean-100 transition group-hover:text-gold-200"><?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></span>
          <span class="size-11 icon-tile"><?php sophronia_icon('check', 'size-5'); ?></span>
          <h3 class="relative mt-5 text-xl"><?php echo esc_html($f['title']); ?></h3>
          <p class="relative mt-2 leading-relaxed"><?php echo esc_html($f['text']); ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- ─── Cómo trabajamos (tarjetas translúcidas) ──────────── -->
<section class="section relative isolate overflow-hidden bg-ink-900">
  <div class="absolute -top-32 -left-32 -z-10 size-[28rem] rounded-full bg-ocean-500/25 blur-3xl drift"></div>
  <div class="absolute -right-32 -bottom-32 -z-10 size-[24rem] rounded-full bg-gold-500/10 blur-3xl drift" style="animation-delay:-8s"></div>
  <div class="container-site">
    <div class="reveal max-w-2xl">
      <p class="eyebrow eyebrow-light">Our process</p>
      <h2 class="mt-5 text-3xl text-white sm:text-4xl">How we work together</h2>
    </div>
    <ol class="reveal-stagger mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
      <?php
      $steps = array(
        array('icon' => 'calendar', 'title' => 'Get to know you',  'text' => 'We start with your goals, your family, your business and your questions.'),
        array('icon' => 'compass',  'title' => 'Build the plan',   'text' => 'We design a strategy that connects every area of your financial life.'),
        array('icon' => 'chart',    'title' => 'Put it to work',   'text' => 'We help coordinate implementation with you and your other advisors.'),
        array('icon' => 'refresh',  'title' => 'Adjust over time', 'text' => 'As life changes, we revisit the plan and adjust when appropriate.'),
      );
      foreach ($steps as $i => $st) : ?>
        <li class="step-line group relative overflow-hidden rounded-2xl border border-white/10 bg-white/[0.06] p-7 backdrop-blur-xl transition hover:-translate-y-2 hover:border-white/20 hover:bg-white/[0.09]">
          <span class="absolute top-4 right-5 font-serif text-6xl text-white/[0.07]"><?php echo $i + 1; ?></span>
          <span class="grid size-12 place-items-center rounded-xl bg-ocean-600 text-white transition group-hover:scale-110 group-hover:bg-gold-500 group-hover:text-ink-950"><?php sophronia_icon($st['icon'], 'size-6'); ?></span>
          <h3 class="mt-6 text-xl text-white"><?php echo esc_html($st['title']); ?></h3>
          <p class="mt-2 leading-relaxed text-ink-100/75"><?php echo esc_html($st['text']); ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<!-- ─── Preguntas frecuentes ─────────────────────────────── -->
<section class="section bg-ocean-50">
  <div class="container-site grid gap-14 lg:grid-cols-12">
    <div class="reveal lg:col-span-4">
      <p class="eyebrow">FAQ</p>
      <h2 class="mt-5 text-3xl sm:text-4xl">Common questions</h2>
      <p class="mt-4 leading-relaxed">Still have questions? <a class="link-brand" href="<?php echo esc_url($site['contact']['contactUrl']); ?>">Contact us</a>.</p>
    </div>
    <div class="reveal-stagger divide-y divide-ocean-100 border-y border-ocean-100 lg:col-span-8">
      <?php foreach ($service['faqs'] as $q => $ans) : ?>
        <details class="group py-6">
          <summary class="flex cursor-pointer items-center justify-between gap-6 text-left text-lg font-semibold text-ink-900">
            <?php echo esc_html($q); ?>
            <span class="faq-icon grid size-8 shrink-0 place-items-center rounded-full bg-ocean-600 text-white transition-transform">+</span>
          </summary>
          <p class="mt-4 max-w-2xl leading-relaxed"><?php echo esc_html($ans); ?></p>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ─── Otros servicios ──────────────────────────────────── -->
<section class="section">
  <div class="container-site">
    <div class="reveal flex flex-wrap items-end justify-between gap-6">
      <div>
        <p class="eyebrow">Explore more</p>
        <h2 class="mt-5 text-3xl sm:text-4xl">Other services</h2>
      </div>
      <a href="<?php echo esc_url(sophronia_page_url('services')); ?>" class="link-brand inline-flex items-center gap-2">All services <?php sophronia_icon('arrow-right', 'size-4'); ?></a>
    </div>
    <!-- Móvil: carrusel horizontal deslizable · sm+: cuadrícula -->
    <div class="reveal-stagger -mx-5 mt-12 flex snap-x snap-mandatory scroll-px-5 gap-4 overflow-x-auto px-5 pb-4 [scrollbar-width:none] sm:mx-0 sm:grid sm:grid-cols-2 sm:gap-6 sm:overflow-visible sm:px-0 sm:pb-0 lg:grid-cols-5">
      <?php foreach ($services as $other_slug => $other) :
        if ($other_slug === $slug) continue; ?>
        <a href="<?php echo esc_url(sophronia_service_url($other_slug)); ?>" class="group flex w-[78%] shrink-0 snap-start flex-col overflow-hidden rounded-2xl border border-ink-100 bg-white shadow-sm transition hover:-translate-y-1 hover:border-ocean-200 hover:shadow-xl sm:w-auto">
          <div class="relative overflow-hidden">
            <?php sophronia_photo($other['photo'] ?? '', $other['image'], array(
              'alt'   => '',
              'class' => 'aspect-[4/3] w-full object-cover transition duration-700 group-hover:scale-110',
              'sizes' => '(min-width: 1024px) 260px, (min-width: 640px) 50vw, 80vw',
            )); ?>
            <span class="absolute bottom-3 left-3 size-10 icon-tile-solid"><?php sophronia_icon($other['icon'], 'size-5'); ?></span>
          </div>
          <div class="flex flex-1 flex-col p-5">
            <h3 class="text-lg"><?php echo esc_html($other['title']); ?></h3>
            <p class="mt-2 flex-1 text-sm leading-relaxed"><?php echo esc_html($other['summary']); ?></p>
            <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-ocean-600">Learn more <?php sophronia_icon('arrow-right', 'size-4'); ?></span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php get_template_part('template-parts/cta-banner', null, array(
  'title' => 'Not sure where to start?',
  'text'  => 'A 60-minute Clarity Session is the best first step: bring any financial question and get independent, fiduciary advice.',
)); ?>

<?php get_footer();
