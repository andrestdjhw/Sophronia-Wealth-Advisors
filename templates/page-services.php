<?php
/**
 * Template Name: Services
 */
get_header();
$site = sophronia_site_data();

get_template_part('template-parts/page-hero', null, array(
  'eyebrow'        => 'Wealth management services',
  'title'          => 'Fiduciary, flat fee-only wealth management for successful Latinos.',
  'subtitle'       => 'An ongoing financial planning and investment management relationship, for one flat fee starting at $4,000 per quarter.',
  'image'          => 'services.webp',
  'photo'          => 'services-hero',
  'image_position' => 'center 35%',
  'image_position_mobile' => '62% center',
));
?>

<!-- ─── Intro + precio ───────────────────────────────────── -->
<section class="section">
  <div class="container-site grid gap-14 lg:grid-cols-12 lg:items-start">
    <div class="reveal reveal-left lg:col-span-7">
      <p class="eyebrow">Our role</p>
      <h2 class="mt-5 text-3xl leading-tight sm:text-4xl">Thoughtful decisions, coordinated across your entire financial life.</h2>
      <p class="mt-6 text-lg leading-relaxed">
        Our role is to help you make thoughtful financial decisions, coordinate the different areas of your financial life, and make sure important issues are not overlooked as your circumstances evolve.
      </p>
    </div>

    <aside class="reveal reveal-right lg:col-span-5">
      <div class="card border-gold-200 bg-gold-50/60">
        <p class="text-sm font-semibold tracking-widest text-gold-700 uppercase">Flat fee starting at</p>
        <p class="mt-3 font-serif text-5xl text-ink-900"><span data-count="4000" data-prefix="$">$4,000</span><span class="text-xl text-ink-500"> / quarter</span></p>
        <ul class="mt-6 space-y-3 text-sm">
          <?php foreach (array('Ongoing financial planning', 'Investment management with no separate fee', 'No commissions, no AUM fees', 'Fiduciary advice, always') as $li) : ?>
            <li class="flex items-start gap-3"><span class="mt-0.5 text-gold-700"><?php sophronia_icon('check', 'size-5'); ?></span><?php echo esc_html($li); ?></li>
          <?php endforeach; ?>
        </ul>
        <a href="<?php echo esc_url($site['cta']['url']); ?>" class="btn-dark mt-8 w-full">Start with a Clarity Session</a>
      </div>
    </aside>
  </div>
</section>

<!-- ─── Servicios ────────────────────────────────────────── -->
<section class="section bg-soft-gradient">
  <div class="container-site">
    <div class="reveal max-w-2xl">
      <p class="eyebrow">What's included</p>
      <h2 class="mt-5 text-3xl sm:text-4xl">Our wealth management services may include</h2>
      <p class="mt-4 text-lg leading-relaxed">Explore each area to see how we can help. All of them are part of one ongoing relationship and one flat fee.</p>
    </div>

    <!-- Cada tarjeta lleva a su subpágina /services/{slug}/ (datos en inc/services-data.php) -->
    <div class="mt-14 grid gap-8 lg:grid-cols-2">
      <div class="reveal-stagger grid gap-6 sm:grid-cols-2 lg:col-span-2 lg:grid-cols-3">
        <?php foreach (sophronia_services() as $sv_slug => $sv) : ?>
          <a href="<?php echo esc_url(sophronia_service_url($sv_slug)); ?>" class="group relative flex flex-col overflow-hidden rounded-2xl border border-ink-100 bg-white shadow-sm transition hover:-translate-y-1 hover:border-ocean-200 hover:shadow-xl">
            <div class="relative overflow-hidden">
              <?php sophronia_photo($sv['photo'] ?? '', $sv['image'], array(
                'alt'   => '',
                'class' => 'aspect-[16/10] w-full object-cover transition duration-700 group-hover:scale-110',
                'sizes' => '(min-width: 1024px) 400px, (min-width: 640px) 50vw, 100vw',
              )); ?>
              <div class="absolute inset-0 bg-gradient-to-t from-ink-950/40 to-transparent"></div>
              <span class="absolute inset-x-0 bottom-0 h-1 origin-left scale-x-0 line-brand-gradient transition duration-500 group-hover:scale-x-100"></span>
            </div>
            <div class="relative flex flex-1 flex-col p-7 pt-10 lg:px-8">
              <span class="absolute -top-6 left-7 size-12 icon-tile-solid ring-4 ring-white lg:left-8"><?php sophronia_icon($sv['icon'], 'size-6'); ?></span>
              <h3 class="text-2xl"><?php echo esc_html($sv['title']); ?></h3>
              <p class="mt-3 flex-1 leading-relaxed"><?php echo esc_html($sv['summary']); ?></p>
              <span class="mt-6 inline-flex items-center gap-1.5 text-sm font-semibold text-ocean-600 group-hover:text-ocean-700">Learn more <?php sophronia_icon('arrow-right', 'size-4'); ?></span>
            </div>
          </a>
        <?php endforeach; ?>
      </div>

      <!-- Relación a largo plazo -->
      <article class="reveal reveal-zoom group relative overflow-hidden rounded-2xl bg-brand-gradient p-7 text-white shadow-2xl shadow-ocean-900/20 lg:col-span-2 lg:p-10">
        <?php sophronia_photo('financial-planning', 'services.webp', array(
          'alt'   => '',
          'class' => 'absolute inset-0 size-full object-cover opacity-20 transition duration-[1.5s] group-hover:scale-110',
          'sizes' => '(min-width: 1024px) 1200px, 200vw',
        )); ?>
        <div class="relative max-w-3xl">
          <span class="grid size-12 place-items-center rounded-xl bg-gold-500 text-ink-950 transition duration-300 group-hover:scale-110 group-hover:-rotate-6"><?php sophronia_icon('handshake', 'size-6'); ?></span>
          <h3 class="mt-5 text-2xl text-white">A long-term advisory relationship</h3>
          <p class="mt-3 leading-relaxed text-ink-100/85">Our goal is not simply to provide recommendations. We help you evaluate decisions, coordinate implementation, and stay organized so that your financial strategy continues to reflect what matters most to you.</p>
        </div>
      </article>
    </div>
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
      <?php
      $faqs = array(
        'How much does it cost?' => 'Our wealth management services are offered for a flat fee starting at $4,000 per quarter ($16,000 per year). We do not charge commissions or a percentage of your assets.',
        'Is there a separate fee for managing my investments?' => 'No. Investment management is part of the ongoing relationship, with no separate investment management fee. Standard fund expenses and transaction costs may still apply.',
        'Who do you typically work with?' => 'We primarily serve Latino business owners earning at least $300,000 per year in net income, and retirees with at least $1.5 million in investable assets. We also welcome other households looking for a long-term planning relationship.',
        'Do you work with my CPA?' => 'Yes. Our tax planning is proactive and always done in collaboration with your CPA.',
        'How do I get started?' => 'The best first step is a Clarity Session: a 60-minute meeting ($450) via Zoom or phone where you can bring any financial question and get independent, fiduciary advice.',
      );
      foreach ($faqs as $q => $ans) : ?>
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

<?php get_template_part('template-parts/cta-banner'); ?>

<?php get_footer();
