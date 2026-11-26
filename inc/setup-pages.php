<?php
/**
 * Crea las páginas del sitio (si no existen) y les asigna su template.
 * Se ejecuta al activar el tema y una vez en el admin cuando cambia la versión.
 */

if (!defined('ABSPATH')) exit;

define('SOPHRONIA_PAGES_VERSION', '3');

function sophronia_pages_definition() {
  $pages = array(
    'home'            => array('title' => 'Home',                       'template' => ''), // usa front-page.php
    'about'           => array('title' => 'About Us',                   'template' => 'templates/page-about.php'),
    'services'        => array('title' => 'Services',                   'template' => 'templates/page-services.php'),
    'faqs'            => array('title' => 'FAQs',                       'template' => 'templates/page-faq.php'),
    'contact-us'      => array('title' => 'Contact Us',                 'template' => 'templates/page-contact.php'),
    'clarity-session' => array('title' => 'Schedule a Clarity Session', 'template' => 'templates/page-clarity-session.php'),
  );

  // Subpáginas de servicios: /services/{slug}/
  foreach (sophronia_services() as $slug => $sv) {
    $pages['services/' . $slug] = array('title' => $sv['title'], 'template' => 'templates/page-service.php', 'parent' => 'services');
  }

  return $pages;
}

function sophronia_setup_pages() {
  // Las páginas padre van antes que sus hijas en la definición.
  foreach (sophronia_pages_definition() as $path => $def) {
    $page = get_page_by_path($path);
    $slug = basename($path);

    if (!$page) {
      $parent = !empty($def['parent']) ? get_page_by_path($def['parent']) : null;
      $id = wp_insert_post(array(
        'post_title'  => $def['title'],
        'post_name'   => $slug,
        'post_status' => 'publish',
        'post_type'   => 'page',
        'post_parent' => $parent ? $parent->ID : 0,
      ));
    } else {
      $id = $page->ID;
    }

    if ($id && !is_wp_error($id) && $def['template']) {
      update_post_meta($id, '_wp_page_template', $def['template']);
    }

    if ($slug === 'home' && $id && !is_wp_error($id) && get_option('show_on_front') !== 'page') {
      update_option('show_on_front', 'page');
      update_option('page_on_front', $id);
    }
  }

  update_option('sophronia_pages_version', SOPHRONIA_PAGES_VERSION);
}

add_action('after_switch_theme', 'sophronia_setup_pages');

add_action('admin_init', function () {
  if (get_option('sophronia_pages_version') !== SOPHRONIA_PAGES_VERSION && current_user_can('manage_options')) {
    sophronia_setup_pages();
  }
});
