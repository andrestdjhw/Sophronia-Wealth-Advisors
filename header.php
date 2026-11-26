<?php $site = sophronia_site_data(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100] focus:rounded-full focus:bg-gold-500 focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-ink-950">Skip to content</a>

    <!-- Navbar (React). El contenido interno es un respaldo sin JS; React lo reemplaza. -->
    <div id="sophronia-navbar" class="sticky top-0 z-50 min-h-20 bg-ink-950 lg:min-h-29">
      <nav class="container-site flex h-20 items-center justify-between lg:grid lg:grid-cols-[1fr_auto_1fr]">
        <a href="<?php echo esc_url($site['homeUrl']); ?>"><img src="<?php echo esc_url($site['logo']); ?>" alt="<?php echo esc_attr($site['name']); ?>" class="h-[66px] w-auto"></a>
        <ul class="hidden items-center gap-8 text-sm text-white/80 lg:flex">
          <?php foreach ($site['nav'] as $item) : ?>
            <li><a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a></li>
          <?php endforeach; ?>
          <li><a class="btn-gold" href="<?php echo esc_url($site['cta']['url']); ?>"><?php echo esc_html($site['cta']['label']); ?></a></li>
        </ul>
      </nav>
    </div>

    <main id="main">
