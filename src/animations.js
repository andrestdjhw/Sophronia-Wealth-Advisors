/**
 * Animaciones del sitio (vanilla JS, complementa src/animations.css)
 *
 * - .reveal / .reveal-stagger  → aparición al hacer scroll (se repite cada vez que vuelves a la sección)
 * - [data-count]               → contador animado. Ej: <span data-count="300" data-prefix="$" data-suffix="K+">$300K+</span>
 * - [data-parallax="0.15"]     → desplazamiento parallax al hacer scroll
 */

const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches

/* ─── Aparición al hacer scroll ─────────────────────────── */
function initReveal() {
  // Los hijos de .reveal-stagger se animan uno tras otro
  document.querySelectorAll(".reveal-stagger").forEach(parent => {
    Array.from(parent.children).forEach((child, i) => {
      child.classList.add("reveal")
      child.style.setProperty("--i", i)
    })
  })

  const items = document.querySelectorAll(".reveal")
  if (!items.length || !("IntersectionObserver" in window) || reducedMotion) return

  // Muestra el elemento y fuerza la carga de sus imágenes lazy
  const show = el => {
    el.querySelectorAll('img[loading="lazy"]').forEach(img => (img.loading = "eager"))
    el.classList.add("is-visible")
  }

  // .reveal-wipe arranca 100% recortado (clip-path), así que el navegador lo considera
  // invisible: ni el observer ni la carga lazy de su imagen se activarían nunca.
  // Por eso se observa su contenedor (que no está recortado) en lugar del elemento.
  const targets = new Map() // elemento observado → elementos a mostrar
  items.forEach(el => {
    const watched = el.classList.contains("reveal-wipe") ? el.parentElement : el
    if (!targets.has(watched)) targets.set(watched, [])
    targets.get(watched).push(el)
  })

  // Entra en pantalla → se anima
  const showObserver = new IntersectionObserver(
    entries => entries.forEach(entry => entry.isIntersecting && targets.get(entry.target).forEach(show)),
    { rootMargin: "0px 0px -8% 0px", threshold: 0.12 }
  )

  // Sale COMPLETAMENTE de la pantalla → se resetea, para que se anime de nuevo al volver.
  // (Solo cuando ya no se ve nada del elemento, así no parpadea en los bordes.)
  const hideObserver = new IntersectionObserver(
    entries =>
      entries.forEach(entry => {
        if (!entry.isIntersecting) targets.get(entry.target).forEach(el => el.classList.remove("is-visible"))
      }),
    { threshold: 0 }
  )

  targets.forEach((_, watched) => {
    showObserver.observe(watched)
    hideObserver.observe(watched)
  })
  document.documentElement.classList.add("reveal-ready")
}

/* ─── Contadores ────────────────────────────────────────── */
function formatNumber(value, decimals) {
  return value.toLocaleString("en-US", { minimumFractionDigits: decimals, maximumFractionDigits: decimals })
}

function animateCounter(el) {
  const target = parseFloat(el.dataset.count)
  const decimals = parseInt(el.dataset.decimals || "0", 10)
  const prefix = el.dataset.prefix || ""
  const suffix = el.dataset.suffix || ""
  const duration = parseInt(el.dataset.duration || "1800", 10)
  const start = performance.now()

  cancelAnimationFrame(el._countFrame) // si ya estaba contando, empieza de nuevo
  const tick = now => {
    const progress = Math.min((now - start) / duration, 1)
    const eased = 1 - Math.pow(1 - progress, 4) // easeOutQuart
    el.textContent = prefix + formatNumber(target * eased, decimals) + suffix
    if (progress < 1) el._countFrame = requestAnimationFrame(tick)
  }
  el._countFrame = requestAnimationFrame(tick)
}

function initCounters() {
  const counters = document.querySelectorAll("[data-count]")
  if (!counters.length || reducedMotion || !("IntersectionObserver" in window)) return

  // Cuenta al entrar en pantalla, y vuelve a contar cada vez que regresas a él
  // (se "re-arma" solo cuando sale por completo de la pantalla).
  const armed = new WeakSet(counters)

  const showObserver = new IntersectionObserver(
    entries =>
      entries.forEach(entry => {
        if (entry.isIntersecting && armed.has(entry.target)) {
          armed.delete(entry.target)
          animateCounter(entry.target)
        }
      }),
    { threshold: 0.6 }
  )
  const hideObserver = new IntersectionObserver(
    entries => entries.forEach(entry => !entry.isIntersecting && armed.add(entry.target)),
    { threshold: 0 }
  )
  counters.forEach(el => {
    showObserver.observe(el)
    hideObserver.observe(el)
  })
}

/* ─── Parallax ──────────────────────────────────────────── */
function initParallax() {
  const items = Array.from(document.querySelectorAll("[data-parallax]"))
  if (!items.length || reducedMotion) return

  let ticking = false
  const update = () => {
    const vh = window.innerHeight
    items.forEach(el => {
      const rect = el.parentElement.getBoundingClientRect()
      if (rect.bottom < 0 || rect.top > vh) return
      const speed = parseFloat(el.dataset.parallax) || 0.15
      const offset = (rect.top + rect.height / 2 - vh / 2) * -speed
      el.style.translate = `0 ${offset.toFixed(1)}px`
    })
    ticking = false
  }

  window.addEventListener(
    "scroll",
    () => {
      if (!ticking) {
        requestAnimationFrame(update)
        ticking = true
      }
    },
    { passive: true }
  )
  update()
}

export default function initAnimations() {
  initReveal()
  initCounters()
  initParallax()
}
