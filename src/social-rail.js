/**
 * Barra flotante de redes sociales (markup en footer.php)
 *
 * Se muestra mientras navegas el contenido y se oculta cuando la franja
 * de pantalla donde está la barra se encuentra sobre el hero o el footer.
 */
export default function initSocialRail() {
  const rail = document.getElementById("social-rail")
  if (!rail) return

  // El hero es la primera sección de <main> (inicio y páginas internas)
  const hero = document.querySelector("main > section:first-child")
  const footer = document.getElementById("sophronia-footer")

  let ticking = false
  const update = () => {
    ticking = false
    // Si la barra no se muestra (pantallas angostas), no hay nada que calcular
    if (getComputedStyle(rail).display === "none") return

    const r = rail.getBoundingClientRect()
    const overHero = hero ? hero.getBoundingClientRect().bottom > r.top : false
    const overFooter = footer ? footer.getBoundingClientRect().top < r.bottom : false
    const show = !overHero && !overFooter

    rail.classList.toggle("is-shown", show)
    rail.inert = !show // oculta = fuera del orden de tabulación
  }

  const request = () => {
    if (!ticking) {
      ticking = true
      requestAnimationFrame(update)
    }
  }

  window.addEventListener("scroll", request, { passive: true })
  window.addEventListener("resize", request)
  update()
}
