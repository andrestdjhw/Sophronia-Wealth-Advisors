<?php
/**
 * Endpoint REST para el formulario de contacto (componente React ContactForm).
 * POST /wp-json/sophronia/v1/contact
 *
 * - Valida campos, honeypot anti-spam y límite de envíos por IP.
 * - Guarda cada mensaje en el admin (menú "Inquiries") para que nunca se pierda.
 * - Envía un correo con wp_mail() al destinatario (por defecto, el email de admin).
 *   En producción se recomienda un plugin SMTP (p. ej. WP Mail SMTP) para que el correo llegue.
 *   Cambiar destinatario: add_filter('sophronia_contact_recipient', fn() => 'correo@dominio.com');
 */

if (!defined('ABSPATH')) exit;

/** Tipo de contenido privado para guardar los mensajes recibidos */
add_action('init', function () {
  register_post_type('sophronia_inquiry', array(
    'labels' => array(
      'name'          => 'Inquiries',
      'singular_name' => 'Inquiry',
      'menu_name'     => 'Inquiries',
      'all_items'     => 'All inquiries',
      'edit_item'     => 'View inquiry',
    ),
    'public'          => false,
    'show_ui'         => true,
    'show_in_menu'    => true,
    'menu_icon'       => 'dashicons-email-alt',
    'menu_position'   => 25,
    'supports'        => array('title', 'editor'),
    'capability_type' => 'post',
    'capabilities'    => array('create_posts' => 'do_not_allow'),
    'map_meta_cap'    => true,
  ));
});

add_action('rest_api_init', function () {
  register_rest_route('sophronia/v1', '/contact', array(
    'methods'             => 'POST',
    'callback'            => 'sophronia_handle_contact',
    'permission_callback' => '__return_true',
  ));
});

function sophronia_handle_contact(WP_REST_Request $request) {
  $p = $request->get_json_params();
  if (!is_array($p)) $p = $request->get_params();

  // Honeypot: los humanos no ven este campo.
  if (!empty($p['company'])) {
    return new WP_REST_Response(array('ok' => true), 200);
  }

  $name    = sanitize_text_field($p['name'] ?? '');
  $email   = sanitize_email($p['email'] ?? '');
  $phone   = sanitize_text_field($p['phone'] ?? '');
  $profile = sanitize_text_field($p['profile'] ?? '');
  $message = sanitize_textarea_field($p['message'] ?? '');

  $errors = array();
  if (mb_strlen($name) < 2)          $errors['name']    = 'Please enter your name.';
  if (!is_email($email))             $errors['email']   = 'Please enter a valid email address.';
  if (mb_strlen($message) < 10)      $errors['message'] = 'Please write a short message (at least 10 characters).';
  if (mb_strlen($message) > 5000)    $errors['message'] = 'Your message is too long.';

  if ($errors) {
    return new WP_REST_Response(array('ok' => false, 'errors' => $errors), 422);
  }

  // Límite: 5 envíos por IP cada 15 minutos.
  $ip_key = 'sophronia_contact_' . md5($_SERVER['REMOTE_ADDR'] ?? 'unknown');
  $count  = (int) get_transient($ip_key);
  if ($count >= 5) {
    return new WP_REST_Response(array('ok' => false, 'message' => 'Too many submissions. Please try again later or call us.'), 429);
  }
  set_transient($ip_key, $count + 1, 15 * MINUTE_IN_SECONDS);

  $to      = apply_filters('sophronia_contact_recipient', get_option('admin_email'));
  $subject = sprintf('[Website] New inquiry from %s', $name);
  $body    = implode("\n", array(
    "Name: {$name}",
    "Email: {$email}",
    'Phone: ' . ($phone ?: '—'),
    'I am a: ' . ($profile ?: '—'),
    '',
    'Message:',
    $message,
    '',
    '— Sent from ' . home_url('/'),
  ));
  $headers = array('Reply-To: ' . $name . ' <' . $email . '>');

  // 1) Guardar en el admin
  $saved = wp_insert_post(array(
    'post_type'    => 'sophronia_inquiry',
    'post_status'  => 'private',
    'post_title'   => sprintf('%s <%s>', $name, $email),
    'post_content' => $body,
  ));

  // 2) Notificar por correo
  $sent = wp_mail($to, $subject, $body, $headers);
  if ($saved && !is_wp_error($saved)) {
    update_post_meta($saved, '_sophronia_mail_sent', $sent ? 'yes' : 'no');
  }

  if (!$sent && (!$saved || is_wp_error($saved))) {
    return new WP_REST_Response(array('ok' => false, 'message' => 'We could not send your message. Please call us instead.'), 500);
  }

  return new WP_REST_Response(array('ok' => true), 200);
}
