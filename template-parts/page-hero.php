<?php
/**
 * Hero para páginas internas.
 * get_template_part('template-parts/page-hero', null, array(
 *   'eyebrow' => '', 'title' => '', 'subtitle' => '', 'image' => 'about-intro.webp', 'image_position' => 'center',
 *   'photo' => 'about-hero',   // foto de Medios "sw-about-hero.*" (si no existe, usa 'image')
 *   'image_class' => '',       // clases extra para la foto (ej. '-scale-x-100' para voltearla)
 *   'image_position_mobile' => '60% center', // encuadre en móvil (la foto se recorta en vertical)
 * ));
 */
$a = wp_parse_args($args ?? array(), array(
  'eyebrow'        => '',
  'title'          => get_the_title(),
  'subtitle'       => '',
  'image'          => '',
  'image_position' => 'center',
  'photo'          => '',
  'image_class'    => '',
  'image_position_mobile' => '',
));
$pos_mobile = $a['image_position_mobile'] ?: $a['image_position'];
?>
<section class="relative isolate overflow-hidden bg-ink-950">
  <?php if ($a['image']) : ?>
    <?php sophronia_photo($a['photo'], $a['image'], array(
      'alt'           => '',
      'class'         => trim('ken-burns absolute -top-16 left-0 -z-10 h-[calc(100%+8rem)] w-full object-cover opacity-75 [object-position:var(--op-m)] lg:[object-position:var(--op)] ' . $a['image_class']),
      'style'         => '--op: ' . $a['image_position'] . '; --op-m: ' . $pos_mobile,
      'data-parallax' => '0.12',
      'fetchpriority' => 'high',
      // En móvil la foto va detrás de un velo oscuro: basta una versión más liviana
      'sizes'         => '(max-width: 767px) 85vw, 100vw',
    )); ?>
  <?php endif; ?>
  <div class="absolute inset-0 -z-10 bg-gradient-to-r from-ink-950/90 via-ocean-900/70 to-ocean-900/45 lg:via-ocean-900/60 lg:to-ocean-700/15"></div>
  <div class="absolute -top-40 -right-40 -z-10 size-[32rem] rounded-full bg-ocean-500/25 blur-3xl drift"></div>
  <div class="absolute bottom-0 inset-x-0 -z-10 h-px line-brand-gradient"></div>

  <div class="container-site py-24 sm:py-32">
    <div class="hero-stagger max-w-3xl [text-shadow:0_2px_18px_rgb(8_17_29/0.55)]">
      <?php if ($a['eyebrow']) : ?>
        <p class="eyebrow eyebrow-light"><?php echo esc_html($a['eyebrow']); ?></p>
      <?php endif; ?>
      <h1 class="mt-5 text-4xl leading-tight text-white sm:text-5xl lg:text-6xl"><?php echo wp_kses_post($a['title']); ?></h1>
      <?php if ($a['subtitle']) : ?>
        <p class="mt-6 max-w-2xl text-lg leading-relaxed text-ink-100/85"><?php echo wp_kses_post($a['subtitle']); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>
