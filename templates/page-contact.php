<?php
/**
 * Template Name: Contact
 */
get_header();
$site = sophronia_site_data();
$c = $site['contact'];

get_template_part('template-parts/page-hero', null, array(
  'eyebrow'  => 'Contact us',
  'title'    => 'Let\'s talk about your financial future.',
  'subtitle' => 'Send us your questions and we\'ll get back to you. Meetings are by appointment only.',
  'image'    => 'about-flat-fee.webp',
  'photo'    => 'contact-hero',
  'image_position' => 'center 60%',
));
?>

<section class="section">
  <div class="container-site grid gap-14 lg:grid-cols-12">

    <!-- Información de contacto -->
    <div class="reveal reveal-left space-y-8 lg:col-span-5">
      <div>
        <h2 class="text-3xl">Get in touch</h2>
        <p class="mt-4 leading-relaxed">Use the form to send us any questions. To schedule a meeting, book a time directly on our calendar.</p>
      </div>

      <ul class="reveal-stagger space-y-5">
        <li class="group flex gap-4">
          <span class="size-11 icon-tile-solid"><?php sophronia_icon('map-pin', 'size-5'); ?></span>
          <div>
            <p class="text-sm font-semibold text-ink-900">Office</p>
            <a href="<?php echo esc_url($c['mapUrl']); ?>" target="_blank" rel="noopener" class="text-ink-600 hover:text-ocean-600">
              <?php echo esc_html($site['legalName']); ?><br><?php echo esc_html($c['addressLine1']); ?><br><?php echo esc_html($c['addressLine2']); ?>
            </a>
          </div>
        </li>
        <li class="group flex gap-4">
          <span class="size-11 icon-tile-solid"><?php sophronia_icon('phone', 'size-5'); ?></span>
          <div>
            <p class="text-sm font-semibold text-ink-900">Phone</p>
            <a href="<?php echo esc_url($c['phoneHref']); ?>" class="text-ink-600 hover:text-ocean-600"><?php echo esc_html($c['phone']); ?></a>
          </div>
        </li>
        <li class="group flex gap-4">
          <span class="size-11 icon-tile-solid"><?php sophronia_icon('clock', 'size-5'); ?></span>
          <div>
            <p class="text-sm font-semibold text-ink-900">Hours</p>
            <p class="text-ink-600"><?php echo esc_html($c['hours']); ?></p>
          </div>
        </li>
      </ul>

      <div class="rounded-2xl bg-ink-900 p-6">
        <p class="font-serif text-xl text-white">Ready to meet?</p>
        <p class="mt-2 text-sm text-ink-300">Pick a time that works for you on our online calendar.</p>
        <a href="<?php echo esc_url($site['bookingUrl']); ?>" target="_blank" rel="noopener" class="btn-gold mt-5">
          <?php sophronia_icon('calendar', 'size-4'); ?> Book a meeting
        </a>
      </div>

      <div>
        <p class="text-sm font-semibold text-ink-900">Follow Miguel on social media</p>
        <ul class="mt-3 flex gap-3">
          <?php foreach ($site['social'] as $s) : ?>
            <li><a href="<?php echo esc_url($s['url']); ?>" target="_blank" rel="noopener" class="inline-flex rounded-full bg-ocean-50 px-4 py-2 text-sm font-medium text-ocean-700 transition hover:bg-ocean-600 hover:text-white"><?php echo esc_html($s['name']); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <!-- Formulario (React) -->
    <div class="reveal reveal-right lg:col-span-7">
      <div class="card sm:p-10">
        <h2 class="text-2xl">Send us a message</h2>
        <p class="mt-2 text-sm text-ink-500">Please don't submit trade or money movement instructions through this form.</p>
        <div id="sophronia-contact-form" class="mt-8">
          <noscript><p>Please enable JavaScript to use the contact form, or call us at <?php echo esc_html($c['phone']); ?>.</p></noscript>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Mapa -->
<section class="pb-20 sm:pb-28">
  <div class="container-site">
    <div class="reveal reveal-zoom overflow-hidden rounded-3xl border border-ink-100">
      <iframe
        title="Map: <?php echo esc_attr($c['addressLine1'] . ', ' . $c['addressLine2']); ?>"
        src="https://www.google.com/maps?q=<?php echo rawurlencode($c['addressLine1'] . ', ' . $c['addressLine2']); ?>&hl=en&output=embed"
        class="h-96 w-full grayscale-[30%]"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</section>

<?php get_footer();
