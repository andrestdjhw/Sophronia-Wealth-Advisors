<?php

require_once get_theme_file_path('inc/site-data.php');
require_once get_theme_file_path('inc/services-data.php');
require_once get_theme_file_path('inc/faq-data.php');
require_once get_theme_file_path('inc/icons.php');
require_once get_theme_file_path('inc/media.php');
require_once get_theme_file_path('inc/contact-endpoint.php');
require_once get_theme_file_path('inc/setup-pages.php');

function sophronia_load_assets() {
  $asset_file = get_theme_file_path('/build/index.asset.php');
  $asset = file_exists($asset_file)
    ? include $asset_file
    : array('dependencies' => array('react', 'react-dom', 'react-jsx-runtime'), 'version' => '1.0.0');

  wp_enqueue_style('sophronia-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500&display=swap', array(), null);
  wp_enqueue_style('sophronia-main', get_theme_file_uri('/build/index.css'), array('sophronia-fonts'), filemtime(get_theme_file_path('/build/index.css')));

  wp_enqueue_script('sophronia-main', get_theme_file_uri('/build/index.js'), $asset['dependencies'], $asset['version'], true);
  wp_add_inline_script('sophronia-main', 'window.sophroniaData = ' . wp_json_encode(sophronia_site_data()) . ';', 'before');
}
add_action('wp_enqueue_scripts', 'sophronia_load_assets');

/** Preconnect para Google Fonts */
add_filter('wp_resource_hints', function ($urls, $relation) {
  if ($relation === 'preconnect') {
    $urls[] = 'https://fonts.googleapis.com';
    $urls[] = array('href' => 'https://fonts.gstatic.com', 'crossorigin');
  }
  return $urls;
}, 10, 2);

function sophronia_theme_support() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', array('search-form', 'gallery', 'caption', 'style', 'script'));
}
add_action('after_setup_theme', 'sophronia_theme_support');

/** Favicon (si no se configuró un ícono del sitio en el Customizer) */
add_action('wp_head', function () {
  if (!has_site_icon()) {
    echo '<link rel="icon" type="image/webp" href="' . esc_url(sophronia_img('favicon.webp')) . '">' . "\n";
  }
});

/** Meta description por página */
add_action('wp_head', function () {
  $descriptions = array(
    'about'           => 'Meet the team behind Sophronia Wealth Advisors — fiduciary, flat fee-only wealth management for Latino business owners in El Paso, Texas.',
    'services'        => 'Ongoing financial planning and investment management for a flat fee starting at $4,000 per quarter. No commissions, no AUM fees.',
    'contact-us'      => 'Contact Sophronia Wealth Advisors in El Paso, Texas. Meetings by appointment only.',
    'faqs'            => 'Answers to common questions about our flat fee, fiduciary advice, services and how to get started with Sophronia Wealth Advisors.',
    'clarity-session' => 'A 60-minute, $450 Clarity Session with a fiduciary CFP® professional. Get answers, get clarity, know your next step.',
  );
  $desc = 'The only flat fee-only fiduciary wealth management firm in El Paso, Texas, serving successful Latino and Latina business owners.';
  if (is_page()) {
    $slug = get_post_field('post_name', get_queried_object_id());
    if (isset($descriptions[$slug])) {
      $desc = $descriptions[$slug];
    } elseif ($service = sophronia_service($slug)) {
      $desc = wp_strip_all_tags($service['subtitle']);
    }
  }
  echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
}, 1);
