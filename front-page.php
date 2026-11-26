<?php
/**
 * Página de inicio
 */
get_header();
$site = sophronia_site_data();
?>

<!-- ─── Hero ─────────────────────────────────────────────── -->
<section class="relative isolate overflow-hidden bg-ink-950">
  <?php sophronia_photo('home-hero', 'about-flat-fee.webp', array(
    'alt'           => '',
    'class'         => 'ken-burns absolute -top-16 left-0 -z-10 h-[calc(100%+8rem)] w-full object-cover opacity-90',
    'style'         => 'object-position: center 55%',
    'data-parallax' => '0.12',
    'fetchpriority' => 'high',
    'sizes'         => '(max-width: 767px) 85vw, 100vw',
  )); ?>
  <div class="absolute inset-0 -z-10 bg-gradient-to-r from-ink-950/90 via-ink-950/65 to-ink-950/40 lg:via-ink-950/55 lg:to-ocean-900/10"></div>
  <div class="absolute -top-40 -right-40 -z-10 size-[36rem] rounded-full bg-ocean-500/25 blur-3xl drift"></div>
  <div class="absolute bottom-0 inset-x-0 -z-10 h-px line-brand-gradient"></div>

  <div class="container-site grid gap-14 py-20 sm:py-24 lg:grid-cols-12 lg:items-center">
    <div class="hero-stagger lg:col-span-7 [text-shadow:0_2px_18px_rgb(8_17_29/0.55)]">
      <p class="eyebrow eyebrow-light">El Paso, Texas · Fiduciary Wealth Management</p>
      <h1 class="mt-6 text-4xl leading-[1.1] text-white sm:text-5xl lg:text-6xl">
        The only <span class="whitespace-nowrap text-gold-400 italic">flat fee-only</span> fiduciary wealth management firm in El Paso.
      </h1>
      <p class="mt-6 max-w-xl text-lg leading-relaxed text-ink-100/85">
        Comprehensive wealth management for successful Latino and Latina business owners. One transparent fee, no commissions, and advice that works only for you.
      </p>
      <div class="mt-10 flex flex-col gap-3 sm:flex-row">
        <a href="<?php echo esc_url($site['cta']['url']); ?>" class="btn-gold">
          <?php echo esc_html($site['cta']['label']); ?>
          <?php sophronia_icon('arrow-right', 'size-4'); ?>
        </a>
        <a href="<?php echo esc_url(sophronia_page_url('services')); ?>" class="btn-outline-light">Explore our services</a>
      </div>
    </div>

    <!-- Formulario de contacto translúcido (React) -->
    <div class="fade-in-late lg:col-span-5">
      <div class="relative overflow-hidden rounded-3xl border border-white/15 bg-ink-950/55 p-7 shadow-2xl shadow-ink-950/50 backdrop-blur-xl sm:p-8">
        <div class="pointer-events-none absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-white/[0.08] to-transparent" aria-hidden="true"></div>
        <div class="relative">
          <p class="text-xs font-semibold tracking-[0.18em] text-gold-400 uppercase">Let's talk</p>
          <h2 class="mt-2 text-2xl text-white">Start the conversation</h2>
          <p class="mt-2 text-sm text-ink-100/70">Send us a note and we'll get back to you. Meetings are by appointment only.</p>
          <div id="sophronia-hero-form" data-variant="glass" data-compact="true" data-id-prefix="hero" class="mt-6 min-h-[22rem]">
            <noscript><p class="text-sm text-ink-100">Call us at <?php echo esc_html($site['contact']['phone']); ?>.</p></noscript>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Cinta en movimiento con datos clave -->
  <?php
  $ribbon = array(
    array('value' => '100%',  'label' => 'Fiduciary, always in your best interest'),
    array('value' => '$0',    'label' => 'Commissions or AUM fees'),
    array('value' => '16+',   'label' => 'Years of planning experience'),
    array('value' => 'CFP®',  'label' => 'Certified Financial Planner™'),
    array('value' => 'EA',    'label' => 'Enrolled Agent'),
    array('value' => 'Flat',  'label' => 'Fee-only, transparent pricing'),
    array('value' => 'NAPFA', 'label' => 'Member firm'),
    array('value' => 'XYPN',  'label' => 'XY Planning Network member'),
  );
  $render_ribbon = function ($hidden) use ($ribbon) {
    printf('<ul class="marquee-track flex shrink-0 items-center gap-10 py-5 pr-10"%s>', $hidden ? ' aria-hidden="true"' : '');
    foreach ($ribbon as $r) {
      echo '<li class="flex shrink-0 items-center gap-10">';
      echo '<span class="flex items-baseline gap-3 whitespace-nowrap">';
      echo '<span class="font-serif text-2xl text-gold-400">' . esc_html($r['value']) . '</span>';
      echo '<span class="text-sm text-ink-100/75">' . esc_html($r['label']) . '</span>';
      echo '</span>';
      echo '<svg class="size-4 text-ocean-300/60" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><ellipse cx="10" cy="5.5" rx="2.6" ry="4.5"/><ellipse cx="10" cy="14.5" rx="2.6" ry="4.5"/><ellipse cx="5.5" cy="10" rx="4.5" ry="2.6"/><ellipse cx="14.5" cy="10" rx="4.5" ry="2.6"/></svg>';
      echo '</li>';
    }
    echo '</ul>';
  };
  ?>
  <div class="fade-in-late relative border-t border-white/10 bg-white/[0.04] backdrop-blur-md" aria-label="Key facts">
    <div class="marquee flex overflow-hidden [mask-image:linear-gradient(90deg,transparent,#000_6%,#000_94%,transparent)]">
      <?php $render_ribbon(false); $render_ribbon(true); ?>
    </div>
  </div>
</section>

<!-- ─── Qué hacemos ──────────────────────────────────────── -->
<section class="section">
  <div class="container-site grid gap-14 lg:grid-cols-2 lg:items-center">
    <div class="reveal reveal-left">
      <p class="eyebrow">What we do</p>
      <h2 class="mt-5 text-3xl leading-tight sm:text-4xl">Turning the wealth your business creates into lasting security for your family.</h2>
      <p class="mt-6 text-lg leading-relaxed">
        Sophronia Wealth Advisors provides comprehensive wealth management to successful Latino and Latina business owners who want to bring greater structure and intention to their financial lives.
      </p>
      <p class="mt-4 leading-relaxed">
        You've built something valuable. We help you decide how much to keep in the business, how much to move outside of it, how to invest for the future, how to plan for taxes and retirement, and how to protect what you're building for yourself and your family.
      </p>
      <a href="<?php echo esc_url(sophronia_page_url('services')); ?>" class="btn-dark mt-8">
        Learn more about our services <?php sophronia_icon('arrow-right', 'size-4'); ?>
      </a>
    </div>

    <ul class="reveal-stagger grid gap-4 sm:grid-cols-2">
      <?php
      $areas = array(
        array('icon' => 'compass',   'title' => 'Cash flow planning',     'text' => 'Structure between business and personal finances.'),
        array('icon' => 'chart',     'title' => 'Investment management',  'text' => 'Portfolios aligned with your plan. No extra fee.'),
        array('icon' => 'sun',       'title' => 'Retirement planning',    'text' => 'A clear path to the life you want after work.'),
        array('icon' => 'document',  'title' => 'Tax planning',           'text' => 'Proactive strategies, coordinated with your CPA.'),
        array('icon' => 'shield',    'title' => 'Risk management',        'text' => 'Insurance and protection for what you\'ve built.'),
        array('icon' => 'users',     'title' => 'Estate planning',        'text' => 'Generational wealth, passed on with intention.'),
      );
      foreach ($areas as $ar) : ?>
        <li class="group rounded-2xl border border-ink-100 bg-white p-6 transition hover:-translate-y-1 hover:border-ocean-200 hover:shadow-lg hover:shadow-ocean-900/10">
          <span class="size-11 icon-tile-solid"><?php sophronia_icon($ar['icon'], 'size-5'); ?></span>
          <h3 class="mt-4 font-sans text-base font-semibold"><?php echo esc_html($ar['title']); ?></h3>
          <p class="mt-1 text-sm text-ink-500"><?php echo esc_html($ar['text']); ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- ─── Perfil de cliente ────────────────────────────────── -->
<section class="section bg-ocean-700 text-ocean-50">
  <div class="container-site grid gap-14 lg:grid-cols-12 lg:items-center">
    <div class="reveal reveal-left relative lg:col-span-6">
      <?php sophronia_photo('client-profile', 'client-profile.webp', array(
        'class' => 'aspect-[4/3] w-full rounded-3xl object-cover shadow-xl',
        'style' => 'object-position: 55% 30%',
        'sizes' => '(min-width: 1024px) 600px, 100vw',
      )); ?>
      <div class="float absolute -bottom-6 left-6 right-6 rounded-2xl bg-white p-5 shadow-lg sm:left-auto sm:w-72">
        <p class="border-l-4 border-gold-500 pl-4 text-sm text-ink-600">Our clients are entrepreneurs who want help making better decisions about the wealth their businesses create.</p>
      </div>
    </div>

    <div class="reveal reveal-right lg:col-span-6 lg:pl-8">
      <p class="eyebrow eyebrow-light">Typical client profile</p>
      <h2 class="mt-5 text-3xl leading-tight text-white sm:text-4xl">Who we work best with</h2>
      <p class="mt-6 leading-relaxed text-ocean-100">
        Because our planning is detailed and highly personalized, we tend to work best with:
      </p>

      <div class="reveal-stagger mt-8 grid gap-4 sm:grid-cols-2">
        <div class="card p-6">
          <span class="text-ocean-600"><?php sophronia_icon('briefcase', 'size-7'); ?></span>
          <p class="mt-4 font-serif text-3xl text-ink-900" data-count="300" data-prefix="$" data-suffix="K+">$300K+</p>
          <p class="mt-1 text-sm text-ink-600">Business owners earning at least $300,000 per year in net income</p>
        </div>
        <div class="card p-6">
          <span class="text-ocean-600"><?php sophronia_icon('sun', 'size-7'); ?></span>
          <p class="mt-4 font-serif text-3xl text-ink-900" data-count="1.5" data-decimals="1" data-prefix="$" data-suffix="M+">$1.5M+</p>
          <p class="mt-1 text-sm text-ink-600">Retirees with at least $1.5 million in investable assets</p>
        </div>
      </div>

      <p class="mt-8 text-sm leading-relaxed text-ocean-100/85">
        Serving Latino families is an important part of who we are, but our services are not limited to the Latino community. We also welcome retirees and other households looking for a long-term financial planning relationship built around thoughtful advice, coordination, and implementation.
      </p>
    </div>
  </div>
</section>

<!-- ─── Por qué elegirnos ────────────────────────────────── -->
<section class="section bg-soft-gradient">
  <div class="container-site">
    <div class="reveal mx-auto max-w-2xl text-center">
      <p class="eyebrow">Why Sophronia</p>
      <h2 class="mt-5 text-3xl sm:text-4xl">Why choose Sophronia Wealth Advisors?</h2>
    </div>

    <div class="reveal-stagger mt-16 grid gap-8 md:grid-cols-3">
      <?php
      $why = array(
        array(
          'key'   => 'why-latino',
          'img'   => 'why-latino.webp',
          'title' => 'Latino-focused financial planning',
          'text'  => 'Our shareholders are Latinos and immigrants. We understand and cherish the values of our community and have the expertise to address the financial planning considerations important to Latino households.',
        ),
        array(
          'key'   => 'why-prudent',
          'img'   => 'why-prudent.webp',
          'title' => 'Sensible and prudent advice',
          'text'  => 'We meet you where you are, without judgment. We look at how every area of your financial life interacts — cash flow, taxes, debt, estate planning — including strategies to support family members in the US and abroad.',
        ),
        array(
          'key'   => 'why-fiduciary',
          'img'   => 'why-fiduciary.webp',
          'title' => 'Fee-only, fiduciary advice',
          'text'  => 'As a flat fee-only advisor, we are committed to acting as a fiduciary: every recommendation is solely in your best interest. We are compensated only by our clients, and our only product is our advice.',
        ),
      );
      foreach ($why as $i => $w) : ?>
        <article class="group overflow-hidden rounded-3xl border border-ink-100 bg-white shadow-sm transition hover:-translate-y-2 hover:shadow-2xl hover:shadow-ocean-900/10">
          <div class="overflow-hidden">
            <?php sophronia_photo($w['key'], $w['img'], array(
              'class' => 'aspect-[3/2] w-full object-cover transition duration-700 group-hover:scale-110',
              'sizes' => '(min-width: 768px) 400px, 100vw',
            )); ?>
          </div>
          <div class="p-7">
            <h3 class="text-xl"><?php echo esc_html($w['title']); ?></h3>
            <p class="mt-3 text-sm leading-relaxed"><?php echo esc_html($w['text']); ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ─── Afiliaciones ─────────────────────────────────────── -->
<section class="section bg-ocean-50" aria-labelledby="affiliations-title">
  <div class="container-site">
    <div class="reveal mx-auto max-w-2xl text-center">
      <p class="eyebrow justify-center">Credentials &amp; affiliations</p>
      <h2 id="affiliations-title" class="mt-5 text-3xl sm:text-4xl">Held to the highest professional standards</h2>
      <p class="mt-4 text-lg leading-relaxed">Certified, fee-only and accountable to the organizations that set the bar for independent financial advice.</p>
    </div>
  </div>

  <?php
  // Cinta continua de logos (izquierda → derecha). Cada pista lleva los logos 2 veces
  // para cubrir pantallas anchas; la 2ª pista es una copia para que el bucle no tenga corte.
  $render_logos = function ($hidden) use ($site) {
    printf('<ul class="marquee-track flex shrink-0 items-center gap-6 pr-6"%s>', $hidden ? ' aria-hidden="true"' : '');
    for ($round = 0; $round < 2; $round++) {
      foreach ($site['affiliations'] as $af) {
        $copy = $hidden || $round > 0; // copias: fuera del orden de tabulación y del lector de pantalla
        $img  = '<img src="' . esc_url($af['img']) . '" alt="' . ($copy ? '' : esc_attr($af['name'])) . '" class="max-h-24 w-auto max-w-full object-contain grayscale opacity-90 transition duration-300 group-hover:scale-105 group-hover:grayscale-0 group-hover:opacity-100" loading="lazy">';
        $box  = 'group flex h-40 w-56 items-center justify-center rounded-2xl border border-ocean-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-ocean-200 hover:shadow-xl hover:shadow-ocean-900/10 sm:w-64';
        printf('<li class="shrink-0%s"%s>', $round > 0 ? ' marquee-dup' : '', ($round > 0 && !$hidden) ? ' aria-hidden="true"' : '');
        if ($af['url']) {
          printf('<a href="%s" target="_blank" rel="noopener" class="%s"%s>%s</a>', esc_url($af['url']), $box, $copy ? ' tabindex="-1"' : '', $img);
        } else {
          printf('<div class="%s">%s</div>', $box, $img);
        }
        echo '</li>';
      }
    }
    echo '</ul>';
  };
  ?>
  <div class="reveal marquee marquee-reverse mt-14 flex overflow-hidden py-4 [mask-image:linear-gradient(90deg,transparent,#000_8%,#000_92%,transparent)]" style="--marquee-duration: 60s">
    <?php $render_logos(false); $render_logos(true); ?>
  </div>
</section>

<!-- ─── Cómo empezar ─────────────────────────────────────── -->
<section class="section relative isolate overflow-hidden bg-ink-900 text-ink-100">
  <!-- Brillos de color detrás de las tarjetas (para el efecto vidrio) -->
  <div class="drift absolute top-10 -left-32 -z-10 size-[28rem] rounded-full bg-ocean-600/40 blur-3xl" aria-hidden="true"></div>
  <div class="drift absolute -right-24 bottom-0 -z-10 size-[26rem] rounded-full bg-ocean-500/30 blur-3xl [animation-delay:-8s]" aria-hidden="true"></div>
  <div class="absolute top-1/2 left-1/2 -z-10 h-40 w-[40rem] -translate-x-1/2 rounded-full bg-gold-500/10 blur-3xl" aria-hidden="true"></div>

  <div class="container-site">
    <div class="reveal max-w-2xl">
      <p class="eyebrow eyebrow-light">How it works</p>
      <h2 class="mt-5 text-3xl text-white sm:text-4xl">A simple path to financial clarity</h2>
    </div>

    <ol class="reveal-stagger mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
      <?php
      $steps = array(
        array('icon' => 'calendar', 'title' => 'Clarity Session', 'text' => 'A 60-minute meeting to answer your most pressing questions and see your full financial picture.'),
        array('icon' => 'compass',  'title' => 'Build your plan', 'text' => 'We develop a clear strategy across cash flow, taxes, investments, retirement and estate.'),
        array('icon' => 'chart',    'title' => 'Implement',       'text' => 'We coordinate implementation and manage your portfolio in line with your plan.'),
        array('icon' => 'refresh',  'title' => 'Monitor & adjust','text' => 'As your business, family and goals evolve, we revisit your plan and adjust.'),
      );
      foreach ($steps as $i => $st) : ?>
        <li class="step-line group relative overflow-hidden rounded-2xl border border-white/10 bg-white/[0.06] p-7 shadow-xl shadow-ink-950/30 backdrop-blur-xl transition hover:-translate-y-2 hover:border-white/25 hover:bg-white/[0.1]">
          <!-- Brillo interno superior -->
          <div class="pointer-events-none absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-white/[0.07] to-transparent" aria-hidden="true"></div>

          <div class="relative flex items-start justify-between">
            <span class="grid size-12 place-items-center rounded-xl border border-white/15 bg-white/10 text-gold-300 transition duration-300 group-hover:scale-110 group-hover:-rotate-6 group-hover:bg-gold-500 group-hover:text-ink-950">
              <?php sophronia_icon($st['icon'], 'size-6'); ?>
            </span>
            <span class="font-serif text-5xl leading-none text-white/15 transition duration-300 group-hover:text-gold-400/60"><?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></span>
          </div>
          <h3 class="relative mt-8 font-sans text-lg font-semibold text-white"><?php echo esc_html($st['title']); ?></h3>
          <p class="relative mt-2 text-sm leading-relaxed text-ink-100/75"><?php echo esc_html($st['text']); ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<!-- ─── Preguntas frecuentes + mapa ──────────────────────── -->
<section class="section bg-ocean-50" aria-labelledby="home-faq-title">
  <div class="container-site grid gap-14 lg:grid-cols-12 lg:items-start">

    <!-- FAQs -->
    <div class="lg:col-span-7">
      <div class="reveal">
        <p class="eyebrow">FAQ</p>
        <h2 id="home-faq-title" class="mt-5 text-3xl sm:text-4xl">Questions we hear often</h2>
        <p class="mt-4 text-lg leading-relaxed">Clear answers, no fine print. <a class="link-brand" href="<?php echo esc_url(sophronia_page_url('faqs')); ?>">See all FAQs</a> or <a class="link-brand" href="<?php echo esc_url($site['contact']['contactUrl']); ?>">ask us directly</a>.</p>
      </div>

      <div class="reveal-stagger mt-10 space-y-3">
        <?php
        $home_faqs = array(
          'What does “flat fee-only fiduciary” mean?' => 'We are paid only by our clients, with one transparent flat fee. We don’t earn commissions or a percentage of your assets, and as a fiduciary we are committed to acting in your best interest.',
          'How much does it cost?' => 'Our wealth management services are offered for a flat fee starting at $4,000 per quarter ($16,000 per year). Investment management is included, with no separate investment management fee.',
          'Who do you typically work with?' => 'We primarily serve Latino business owners earning at least $300,000 per year in net income, and retirees with at least $1.5 million in investable assets.',
          'Do you work with my CPA?' => 'Yes. Our tax planning is proactive and always done in collaboration with your CPA.',
          'Can we meet in person?' => 'Yes. Our office is in El Paso, Texas, and meetings are by appointment only. Clarity Sessions are held via Zoom or phone, so you can meet with us from anywhere.',
          'How do I get started?' => 'The best first step is a Clarity Session: a 60-minute meeting ($450) where you can bring any financial question and get independent, fiduciary advice.',
        );
        $first = true;
        foreach ($home_faqs as $q => $ans) : ?>
          <details class="group rounded-2xl border border-ocean-100 bg-white px-6 shadow-sm transition hover:border-ocean-200 open:shadow-lg open:shadow-ocean-900/5" <?php echo $first ? 'open' : ''; ?>>
            <summary class="flex cursor-pointer items-center justify-between gap-6 py-5 text-left text-lg font-semibold text-ink-900">
              <?php echo esc_html($q); ?>
              <span class="faq-icon grid size-8 shrink-0 place-items-center rounded-full bg-ocean-600 text-white transition group-open:bg-gold-500 group-open:text-ink-950">+</span>
            </summary>
            <p class="pb-6 leading-relaxed"><?php echo esc_html($ans); ?></p>
          </details>
        <?php $first = false; endforeach; ?>
      </div>
    </div>

    <!-- Mapa + datos de la oficina -->
    <div class="reveal reveal-right lg:sticky lg:top-36 lg:col-span-5">
      <div class="overflow-hidden rounded-3xl border border-ocean-100 bg-white shadow-xl shadow-ocean-900/10">
        <div class="relative">
          <iframe
            title="Map: <?php echo esc_attr($site['contact']['addressLine1'] . ', ' . $site['contact']['addressLine2']); ?>"
            src="https://www.google.com/maps?q=<?php echo rawurlencode($site['contact']['addressLine1'] . ', ' . $site['contact']['addressLine2']); ?>&hl=en&output=embed"
            class="h-80 w-full grayscale-[30%] lg:h-96"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
          <div class="pointer-events-none absolute inset-x-0 bottom-0 h-1 line-brand-gradient"></div>
        </div>

        <div class="p-7">
          <p class="eyebrow">Visit our office</p>
          <ul class="mt-5 space-y-4">
            <li class="flex items-start gap-4">
              <span class="size-10 shrink-0 icon-tile-solid"><?php sophronia_icon('map-pin', 'size-5'); ?></span>
              <span class="text-ink-800">
                <strong class="block font-semibold text-ink-900"><?php echo esc_html($site['legalName']); ?></strong>
                <?php echo esc_html($site['contact']['addressLine1']); ?><br><?php echo esc_html($site['contact']['addressLine2']); ?>
              </span>
            </li>
            <li class="flex items-center gap-4">
              <span class="size-10 shrink-0 icon-tile-solid"><?php sophronia_icon('clock', 'size-5'); ?></span>
              <span class="text-ink-800"><?php echo esc_html($site['contact']['hours']); ?></span>
            </li>
            <li class="flex items-center gap-4">
              <span class="size-10 shrink-0 icon-tile-solid"><?php sophronia_icon('phone', 'size-5'); ?></span>
              <a class="font-semibold text-ink-900 hover:text-ocean-600" href="<?php echo esc_url($site['contact']['phoneHref']); ?>"><?php echo esc_html($site['contact']['phone']); ?></a>
            </li>
          </ul>
          <div class="mt-7 flex flex-col gap-3 sm:flex-row">
            <a href="<?php echo esc_url($site['contact']['mapUrl']); ?>" target="_blank" rel="noopener" class="btn-dark flex-1">
              Get directions <?php sophronia_icon('arrow-right', 'size-4'); ?>
            </a>
            <a href="<?php echo esc_url($site['contact']['contactUrl']); ?>" class="btn-outline-dark flex-1">Contact us</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_template_part('template-parts/cta-banner'); ?>

<?php get_footer();
