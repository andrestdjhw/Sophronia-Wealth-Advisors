<?php $site = sophronia_site_data(); ?>
    </main>

    <!-- Footer (React). El contenido interno es un respaldo sin JS (incluye los avisos regulatorios). -->
    <div id="sophronia-footer" class="bg-ink-950 text-ink-300">
      <div class="container-site space-y-4 py-12 text-xs leading-relaxed">
        <p class="font-semibold text-white"><?php echo esc_html($site['legalName']); ?> · Registered Investment Adviser</p>
        <p><?php echo esc_html($site['contact']['addressLine1'] . ', ' . $site['contact']['addressLine2']); ?> · <?php echo esc_html($site['contact']['phone']); ?></p>
        <?php foreach ($site['disclosures'] as $text) : ?>
          <p><?php echo esc_html($text); ?></p>
        <?php endforeach; ?>
        <p class="font-semibold"><?php echo esc_html($site['representativeNote']); ?></p>
      </div>
    </div>

    <?php if (!empty($site['social'])) : ?>
      <!-- Redes sociales flotantes (izquierda). Solo en pantallas anchas (≥1400px), donde hay margen libre.
           Se oculta sobre el hero y el footer: src/social-rail.js -->
      <nav id="social-rail" aria-label="Social media" inert
        class="social-rail pointer-events-none fixed top-1/2 left-5 z-40 hidden -translate-y-1/2 -translate-x-4 flex-col items-center gap-3 opacity-0 transition duration-500 ease-out motion-reduce:transition-none min-[1400px]:flex">
        <span class="mb-1 text-[0.65rem] font-semibold tracking-[0.3em] text-ocean-500 uppercase [writing-mode:vertical-rl] rotate-180">Follow us</span>
        <span class="h-8 w-px bg-gradient-to-b from-transparent to-ocean-400"></span>
        <ul class="flex flex-col gap-2 rounded-full border border-white/10 bg-ink-950/85 p-1.5 shadow-xl shadow-ink-950/25 backdrop-blur-md">
          <?php foreach ($site['social'] as $i => $s) : ?>
            <li class="social-rail-item" style="--i: <?php echo (int) $i; ?>">
              <a href="<?php echo esc_url($s['url']); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr($s['name']); ?> (opens in a new tab)"
                class="group relative grid size-10 place-items-center rounded-full text-white/75 transition hover:bg-gold-500 hover:text-ink-950 focus-visible:bg-gold-500 focus-visible:text-ink-950">
                <?php sophronia_icon($s['icon'], 'size-[18px]'); ?>
                <!-- Etiqueta al pasar el mouse -->
                <span class="pointer-events-none absolute left-full ml-3 rounded-md bg-ink-950 px-2.5 py-1 text-xs font-medium whitespace-nowrap text-white opacity-0 shadow-lg transition group-hover:translate-x-1 group-hover:opacity-100 group-focus-visible:opacity-100"><?php echo esc_html($s['name']); ?></span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
        <span class="h-8 w-px bg-gradient-to-t from-transparent to-ocean-400"></span>
      </nav>
    <?php endif; ?>

    <!-- Chatbot (React) -->
    <div id="sophronia-chatbot"></div>

    <?php wp_footer(); ?>
  </body>
</html>
