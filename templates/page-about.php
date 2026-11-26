<?php
/**
 * Template Name: About
 */
get_header();
$site = sophronia_site_data();

get_template_part('template-parts/page-hero', null, array(
  'eyebrow'  => 'About us',
  'title'    => 'Fiduciary, flat fee-only wealth management for Latino business owners.',
  'subtitle' => 'Advice built on honesty and integrity — the kind you would expect from someone you trust with your life savings.',
  'image'    => 'about-intro.webp',
  'photo'    => 'about-hero',
  'image_position' => 'center 45%',
));
?>

<!-- ─── Fiduciario ───────────────────────────────────────── -->
<section class="section">
  <div class="container-site grid gap-14 lg:grid-cols-12">
    <div class="reveal reveal-left lg:col-span-5">
      <p class="eyebrow">Our commitment</p>
      <h2 class="mt-5 text-3xl leading-tight sm:text-4xl">What does <em class="text-ocean-600">fiduciary</em> mean?</h2>
      <p class="mt-6 leading-relaxed">
        We believe in placing our clients' best interests first. That's why we are proud to commit to five fiduciary principles. In other words, we will treat you with the honesty and integrity you would expect from someone you are entrusting with your life savings.
      </p>
      <div class="mt-8 rounded-2xl border-l-4 border-gold-500 bg-ink-900 p-6 text-ink-100">
        <p class="text-sm leading-relaxed text-ink-100">
          When you become a client, you'll receive your own copy of the Fiduciary Oath, hand-signed by our President, Miguel Gomez.
        </p>
        <a href="http://www.thefiduciarystandard.org/wp-content/uploads/2015/02/fiduciaryoath_individual.pdf" target="_blank" rel="noopener" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-gold-400 underline decoration-gold-500/50 decoration-2 underline-offset-4 hover:text-gold-300">
          <?php sophronia_icon('document', 'size-4'); ?>
          Print an unbranded copy of the oath to take to any advisor you interview
        </a>
        <p class="mt-2 text-xs text-ink-300">Source: The Committee for the Fiduciary Standard</p>
      </div>
    </div>

    <ol class="reveal-stagger space-y-4 lg:col-span-7">
      <?php
      $principles = array(
        'We will always put your best interests first.',
        'We will act with prudence; that is, with the skill, care, diligence, and good judgment of a professional.',
        'We will not mislead you, and we will provide conspicuous, full and fair disclosure of all important facts.',
        'We will avoid conflicts of interest.',
        'We will fully disclose and fairly manage, in your favor, any unavoidable conflicts.',
      );
      foreach ($principles as $i => $pr) : ?>
        <li class="group flex gap-5 rounded-2xl border border-ink-100 bg-white p-6 shadow-sm transition hover:translate-x-1 hover:border-ocean-200 hover:shadow-md">
          <span class="grid size-10 shrink-0 place-items-center rounded-full bg-ocean-600 font-serif text-lg text-white transition duration-300 group-hover:scale-110 group-hover:bg-gold-500 group-hover:text-ink-950"><?php echo $i + 1; ?></span>
          <p class="self-center text-ink-800"><?php echo esc_html($pr); ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<!-- ─── Tarifa fija ──────────────────────────────────────── -->
<section class="section bg-ocean-50">
  <div class="container-site grid gap-14 lg:grid-cols-2 lg:items-center">
    <div class="reveal">
      <p class="eyebrow">Transparent pricing</p>
      <h2 class="mt-5 text-3xl leading-tight sm:text-4xl">What is flat fee-only?</h2>
      <p class="mt-6 leading-relaxed">
        As flat fee-only financial advisors, we charge a simple, fixed fee for our services. We don't earn commissions from selling financial products, and we don't use assets-under-management (AUM) fees, which vary based on the size of your portfolio.
      </p>
      <p class="mt-4 leading-relaxed">
        While no fee structure is completely free of conflicts of interest, we believe our approach is more transparent and predictable. Depending on your portfolio size, it may also be more cost-effective than AUM fees.
      </p>
      <p class="mt-4 leading-relaxed">
        It also makes our advice accessible to people with a high income but few investable assets — clients who are often turned down by traditional AUM advisors.
      </p>
    </div>

    <div class="reveal reveal-right">
      <div class="relative overflow-hidden rounded-3xl bg-brand-gradient p-10 text-white shadow-2xl shadow-ocean-900/30">
        <?php sophronia_photo('about-flat-fee', 'about-flat-fee.webp', array(
          'alt'   => '',
          'class' => 'absolute inset-0 size-full object-cover opacity-20 mix-blend-luminosity',
          'sizes' => '(min-width: 1024px) 600px, 100vw',
        )); ?>
        <div class="relative">
          <p class="text-sm tracking-widest text-gold-400 uppercase">Our fee starts at</p>
          <p class="mt-3 font-serif text-6xl"><span data-count="16000" data-prefix="$">$16,000</span><span class="text-2xl text-ink-300"> / year</span></p>
          <ul class="mt-8 space-y-3 text-sm text-ink-100">
            <?php foreach (array('No commissions on financial products', 'No percentage-of-assets (AUM) fees', 'Investment management included', 'Predictable and transparent') as $li) : ?>
              <li class="flex items-center gap-3"><span class="text-gold-400"><?php sophronia_icon('check', 'size-5'); ?></span><?php echo esc_html($li); ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="<?php echo esc_url(sophronia_page_url('services')); ?>" class="btn-gold mt-10">See what's included <?php sophronia_icon('arrow-right', 'size-4'); ?></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ─── Equipo ───────────────────────────────────────────── -->
<section class="section" id="team">
  <div class="container-site">
    <div class="reveal max-w-2xl">
      <p class="eyebrow">Our team</p>
      <h2 class="mt-5 text-3xl sm:text-4xl">The people behind your plan</h2>
    </div>

    <!-- Miguel (destacado) -->
    <article class="reveal reveal-zoom mt-14 grid gap-10 overflow-hidden rounded-3xl border border-ink-100 bg-white shadow-sm lg:grid-cols-12">
      <div class="relative aspect-[4/5] lg:col-span-5 lg:aspect-auto">
        <img src="<?php echo esc_url(sophronia_img('team/miguel-gomez.webp')); ?>" alt="Portrait of Miguel Gomez, CFP®, EA" class="absolute inset-0 size-full object-cover object-top" loading="lazy">
      </div>
      <div class="p-8 sm:p-10 lg:col-span-7 lg:py-14 lg:pr-14">
        <p class="text-sm font-semibold tracking-widest text-ocean-600 uppercase">President</p>
        <h3 class="mt-2 text-3xl">Miguel Gomez, CFP®, EA</h3>
        <div class="mt-6 space-y-4 leading-relaxed">
          <p>Miguel is a CERTIFIED FINANCIAL PLANNER™ professional and Enrolled Agent dedicated to helping entrepreneurial families bring clarity and confidence to their financial lives. He works personally with every client.</p>
          <p>With more than 16 years of experience, Miguel guides business owners and professionals through the complexities of tax planning, investment management, retirement preparation, and generational wealth transfer. His approach blends technical expertise with a transparent, fiduciary commitment, so clients know every recommendation is designed solely with their best interests in mind.</p>
          <p>By combining flat-fee wealth management with proactive tax strategies — always in collaboration with clients' CPAs — he helps clients turn their businesses and personal finances into powerful engines for long-term security and opportunity. His mission is simple: to empower families to make smart financial decisions, reduce stress around money, and live their best lives today and for generations to come.</p>
          <p class="text-sm text-ink-500">Outside the office, Miguel enjoys Peloton classes, weightlifting, non-fiction books, and traveling and hiking with his wife and children. He has a growing collection of pre-1900 books and also enjoys baking and building LEGO sets.</p>
        </div>
        <a href="<?php echo esc_url($site['cta']['url']); ?>" class="btn-gold mt-8"><?php echo esc_html($site['cta']['label']); ?> <?php sophronia_icon('arrow-right', 'size-4'); ?></a>
      </div>
    </article>

    <!-- Karina y Antonio -->
    <div class="reveal-stagger mt-8 grid gap-8 md:grid-cols-2">
      <article class="group flex flex-col overflow-hidden rounded-3xl border border-ink-100 bg-white shadow-sm sm:flex-row">
        <img src="<?php echo esc_url(sophronia_img('team/karina-nava.webp')); ?>" alt="Portrait of Karina Nava, EA" class="aspect-square w-full object-cover object-top transition duration-700 group-hover:scale-105 sm:w-48" loading="lazy">
        <div class="p-7">
          <p class="text-sm font-semibold tracking-widest text-ocean-600 uppercase">Founder</p>
          <h3 class="mt-2 text-2xl">Karina Nava, EA</h3>
        </div>
      </article>

      <article class="group flex flex-col overflow-hidden rounded-3xl border border-ink-100 bg-white shadow-sm sm:flex-row">
        <img src="<?php echo esc_url(sophronia_img('team/antonio-nava.webp')); ?>" alt="Portrait of Antonio Nava, EA" class="aspect-square w-full object-cover object-top transition duration-700 group-hover:scale-105 sm:w-48" loading="lazy">
        <div class="p-7">
          <p class="text-sm font-semibold tracking-widest text-ocean-600 uppercase">Shareholder</p>
          <h3 class="mt-2 text-2xl">Antonio Nava, EA, NTPI Fellow</h3>
          <details class="group mt-3">
            <summary class="link-brand cursor-pointer text-sm">Read bio</summary>
            <div class="mt-4 space-y-3 text-sm leading-relaxed">
              <p>Antonio came to the United States at 26. His first job was as a dishwasher; in just three years he became the restaurant's general manager, leading more than 40 employees.</p>
              <p>In 1993 he began his professional career as an accountant and tax preparer after earning his Accounting Certificate from Orange Coast College in California. He is the founder of the NAVA Business Group.</p>
              <p>He has focused on three passions: representing taxpayers before the IRS in audits and tax debt negotiations; scaling the companies that make up the NAVA Business Group; and empowering tax professionals and accountants to turn their profession into a business.</p>
              <p class="text-ink-500">Although Mr. Nava does not have client-facing responsibilities at Sophronia, he brings valuable insight and experience to the team.</p>
            </div>
          </details>
        </div>
      </article>
    </div>
  </div>
</section>

<!-- ─── Nuestro nombre ───────────────────────────────────── -->
<section class="section bg-deep-gradient">
  <div class="container-site grid gap-14 lg:grid-cols-12 lg:items-center">
    <div class="reveal reveal-wipe lg:col-span-5">
      <?php sophronia_photo('about-name', 'about-name.webp', array(
        'class' => 'aspect-[4/5] w-full rounded-3xl object-cover',
        'style' => 'object-position: 40% center',
        // Marco vertical (4:5) sobre foto horizontal (3:2): se muestra ~1.9x más ancha que el marco
        'sizes' => '(min-width: 1024px) 900px, 130vw',
      )); ?>
    </div>
    <div class="reveal reveal-right lg:col-span-7">
      <p class="eyebrow eyebrow-light">The meaning of our name</p>
      <h2 class="mt-5 text-3xl leading-tight text-white sm:text-4xl">
        <span class="italic text-gold-400">Sophronia</span> — wise, prudent, and self-controlled.
      </h2>
      <p class="mt-6 leading-relaxed text-ink-100/80">
        “Sophronia” comes from an ancient Greek word meaning wise, prudent, and self-controlled. These are exactly the qualities we aim to bring to our relationship with you.
      </p>

      <dl class="reveal-stagger mt-10 space-y-6">
        <?php
        $values = array(
          'Wise'         => 'Think of us as your go-to experts for all things financial. We share what we\'ve learned so you can make smart decisions that fit your life, today and for years to come.',
          'Prudent'      => 'We are careful and sensible with your money. As a fiduciary, our advice is about what\'s best for you — not what earns a commission. Our flat fee keeps things simple and transparent.',
          'Self-control' => 'Managing money well often means staying calm and steady when markets are unpredictable. We help you stay focused and disciplined on your long-term goals.',
        );
        foreach ($values as $term => $desc) : ?>
          <div class="border-l-2 border-gold-500 pl-6 transition duration-300 hover:border-ocean-400 hover:pl-8">
            <dt class="font-serif text-xl text-white"><?php echo esc_html($term); ?></dt>
            <dd class="mt-2 text-sm leading-relaxed text-ink-300"><?php echo esc_html($desc); ?></dd>
          </div>
        <?php endforeach; ?>
      </dl>

      <p class="mt-10 leading-relaxed text-ink-100/80">
        Our name is a promise: we will always strive to be wise, prudent, and disciplined in helping you create a plan that works for you — and in bringing it to reality.
      </p>
    </div>
  </div>
</section>

<?php get_template_part('template-parts/cta-banner'); ?>

<?php get_footer();
