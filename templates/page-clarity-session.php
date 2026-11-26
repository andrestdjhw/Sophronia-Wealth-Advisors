<?php
/**
 * Template Name: Clarity Session
 */
get_header();
$site = sophronia_site_data();

get_template_part('template-parts/page-hero', null, array(
  'eyebrow'  => 'Clarity Session',
  'title'    => 'Get answers. Get clarity. <span class="italic text-gold-400">Know your next step.</span>',
  'subtitle' => 'A 60-minute session designed to help you make informed financial decisions, wherever you are in your financial journey.',
  'image'    => 'about-intro.webp',
  'photo'    => 'clarity-hero',
  'image_class' => '-scale-x-100', // volteada: la persona queda a la derecha, lejos del texto
  'image_position' => 'center 30%',
));
?>

<section class="section">
  <div class="container-site grid gap-14 lg:grid-cols-12 lg:items-start">

    <div class="reveal reveal-left lg:col-span-7">
      <p class="eyebrow">What to expect</p>
      <h2 class="mt-5 text-3xl leading-tight sm:text-4xl">Bring any financial question or concern.</h2>
      <p class="mt-6 text-lg leading-relaxed">
        Investments, taxes, retirement, cash flow — or maybe you just want to see your financial picture from an independent point of view. This session is for you.
      </p>

      <h3 class="mt-12 font-sans text-sm font-semibold tracking-widest text-ink-900 uppercase">You'll walk away with</h3>
      <ul class="reveal-stagger mt-6 space-y-4">
        <?php
        $outcomes = array(
          array('icon' => 'compass', 'text' => 'Clear, actionable guidance tailored to your situation'),
          array('icon' => 'chart',   'text' => 'A better understanding of your current financial landscape'),
          array('icon' => 'shield',  'text' => 'Confidence to move forward, knowing you\'re making well-informed decisions'),
        );
        foreach ($outcomes as $o) : ?>
          <li class="group flex items-center gap-5 rounded-2xl border border-ink-100 bg-white p-5 shadow-sm transition hover:translate-x-1 hover:border-ocean-200 hover:shadow-md">
            <span class="size-11 icon-tile-solid"><?php sophronia_icon($o['icon'], 'size-5'); ?></span>
            <span class="text-ink-800"><?php echo esc_html($o['text']); ?></span>
          </li>
        <?php endforeach; ?>
      </ul>

      <p class="mt-10 border-l-2 border-gold-500 pl-6 font-serif text-xl italic text-ink-900">
        There's no pressure and no sales pitch — just thoughtful, independent advice focused entirely on you.
      </p>
    </div>

    <!-- Tarjeta de reserva -->
    <aside class="reveal reveal-right lg:sticky lg:top-28 lg:col-span-5">
      <div class="overflow-hidden rounded-3xl bg-brand-gradient text-white shadow-2xl shadow-ocean-900/30">
        <div class="p-8 sm:p-10">
          <p class="text-sm tracking-widest text-gold-400 uppercase">Clarity Session</p>
          <p class="mt-3 font-serif text-6xl" data-count="450" data-prefix="$">$450</p>
          <dl class="mt-8 space-y-5 text-sm">
            <div class="flex gap-4">
              <span class="text-gold-400"><?php sophronia_icon('clock', 'size-5'); ?></span>
              <div><dt class="font-semibold text-white">Length</dt><dd class="text-ink-300">60 minutes</dd></div>
            </div>
            <div class="flex gap-4">
              <span class="text-gold-400"><?php sophronia_icon('video', 'size-5'); ?></span>
              <div><dt class="font-semibold text-white">Format</dt><dd class="text-ink-300">Via Zoom or phone</dd></div>
            </div>
            <div class="flex gap-4">
              <span class="text-gold-400"><?php sophronia_icon('users', 'size-5'); ?></span>
              <div><dt class="font-semibold text-white">Who it's for</dt><dd class="text-ink-300">Business owners, professionals, and families seeking high-quality, fiduciary advice</dd></div>
            </div>
          </dl>
          <a href="<?php echo esc_url($site['bookingUrl']); ?>" target="_blank" rel="noopener" class="btn-gold mt-10 w-full">
            <?php sophronia_icon('calendar', 'size-4'); ?> Book your Clarity Session
          </a>
          <p class="mt-4 text-center text-xs text-ink-300">
            Prefer to talk first? Call <a class="underline hover:text-white" href="<?php echo esc_url($site['contact']['phoneHref']); ?>"><?php echo esc_html($site['contact']['phone']); ?></a>
          </p>
        </div>
      </div>
    </aside>
  </div>
</section>

<!-- Con quién te reunirás -->
<section class="section bg-ocean-700">
  <div class="container-site">
    <div class="reveal reveal-zoom mx-auto grid max-w-4xl items-center gap-10 sm:grid-cols-[200px_1fr]">
      <img src="<?php echo esc_url(sophronia_img('team/miguel-gomez.webp')); ?>" alt="Portrait of Miguel Gomez, CFP®, EA" class="aspect-square w-48 rounded-full object-cover object-top shadow-lg ring-4 ring-gold-500 sm:w-full" loading="lazy">
      <div>
        <p class="eyebrow eyebrow-light">Who you'll meet</p>
        <h2 class="mt-4 text-3xl text-white">Miguel Gomez, CFP®, EA</h2>
        <p class="mt-4 leading-relaxed text-ocean-100">A CERTIFIED FINANCIAL PLANNER™ professional and Enrolled Agent with more than 16 years of experience helping entrepreneurial families with tax planning, investments, retirement, and generational wealth transfer.</p>
        <a href="<?php echo esc_url(sophronia_page_url('about')); ?>#team" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-gold-400 underline decoration-gold-500/60 decoration-2 underline-offset-4 hover:text-gold-300">Meet our team <?php sophronia_icon('arrow-right', 'size-4'); ?></a>
      </div>
    </div>
  </div>
</section>

<?php get_footer();
