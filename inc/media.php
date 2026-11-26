<?php
/**
 * Fotos del sitio desde la biblioteca de medios (licencia Envato).
 *
 * Cada foto se identifica por su nombre de archivo: "sw-{clave}.jpg".
 * Ej: sophronia_photo('home-hero', 'about-flat-fee.webp', array('class' => '...'))
 *   → busca sw-home-hero.* en Medios; si existe, imprime <img> con srcset (WebP).
 *   → si no existe todavía, usa la imagen del tema assets/images/{fallback}.
 *
 * Optimización:
 * - Los tamaños que genera WordPress se guardan en WebP (más livianos que JPG).
 * - srcset + sizes: el navegador descarga solo el tamaño que necesita.
 */

if (!defined('ABSPATH')) exit;

/* ─── Optimización de subidas ───────────────────────────── */

// JPG/PNG subidos → sus tamaños generados se guardan como WebP
add_filter('image_editor_output_format', function ($formats) {
  $formats['image/jpeg'] = 'image/webp';
  $formats['image/png']  = 'image/webp';
  return $formats;
});

// Calidad WebP (82 = muy buena calidad visual con buen peso)
add_filter('wp_editor_set_quality', function ($quality, $mime) {
  return $mime === 'image/webp' ? 82 : $quality;
}, 10, 2);

// WP 6.7+ antepone sizes="auto" a las imágenes lazy. Con object-cover (fotos recortadas)
// eso subestima el tamaño y se ven borrosas, así que usamos los "sizes" definidos en el tema.
add_filter('wp_img_tag_add_auto_sizes', '__return_false');

/* ─── Búsqueda por nombre de archivo ────────────────────── */

/** Mapa clave → ID de adjunto de todos los archivos "sw-*". Se guarda en caché. */
function sophronia_media_map() {
  static $map = null;
  if ($map !== null) return $map;

  $map = get_transient('sophronia_media_map');
  if (is_array($map)) return $map;

  global $wpdb;
  $rows = $wpdb->get_results(
    "SELECT post_id, meta_value FROM {$wpdb->postmeta}
     WHERE meta_key = '_wp_attached_file' AND meta_value LIKE '%sw-%'
     ORDER BY post_id ASC"
  );

  $map = array();
  foreach ($rows as $row) {
    // "2026/11/sw-home-hero-scaled.jpg" → "home-hero"
    $name = pathinfo($row->meta_value, PATHINFO_FILENAME);
    $name = preg_replace('/-(scaled|rotated|\d+)$/', '', $name);
    if (strpos($name, 'sw-') === 0) {
      $map[substr($name, 3)] = (int) $row->post_id; // la subida más reciente gana
    }
  }

  set_transient('sophronia_media_map', $map, DAY_IN_SECONDS);
  return $map;
}

// Al subir/borrar/editar un archivo se limpia la caché
foreach (array('add_attachment', 'delete_attachment', 'edit_attachment') as $hook) {
  add_action($hook, function () { delete_transient('sophronia_media_map'); });
}

/** ID del adjunto para una clave (o 0 si aún no se subió). */
function sophronia_media_id($key) {
  $map = sophronia_media_map();
  return $map[$key] ?? 0;
}

/* ─── Salida ────────────────────────────────────────────── */

/**
 * Imprime la foto <img>.
 * $attrs: class, alt, sizes, loading, fetchpriority, style, data-*…
 */
function sophronia_photo($key, $fallback, $attrs = array()) {
  $attrs = array_merge(array(
    'loading'  => 'lazy',
    'decoding' => 'async',
    'sizes'    => '100vw',
  ), $attrs);

  // Si la imagen es prioritaria (hero), no se difiere
  if (($attrs['fetchpriority'] ?? '') === 'high') unset($attrs['loading']);

  $id = $key ? sophronia_media_id($key) : 0;

  if ($id) {
    if (!isset($attrs['alt']) || $attrs['alt'] === null) {
      $attrs['alt'] = (string) get_post_meta($id, '_wp_attachment_image_alt', true);
    }
    echo wp_get_attachment_image($id, 'full', false, $attrs);
    return;
  }

  // Respaldo: imagen incluida en el tema
  unset($attrs['sizes']);
  $attrs['src'] = sophronia_img($fallback);
  $attrs['alt'] = $attrs['alt'] ?? '';
  $html = '<img';
  foreach ($attrs as $name => $value) {
    $html .= ' ' . $name . '="' . esc_attr($value) . '"';
  }
  echo $html . '>';
}

/** URL de la foto (para fondos CSS u otros usos). */
function sophronia_photo_url($key, $fallback, $size = 'large') {
  $id = sophronia_media_id($key);
  if ($id) {
    $src = wp_get_attachment_image_url($id, $size);
    if ($src) return $src;
  }
  return sophronia_img($fallback);
}
