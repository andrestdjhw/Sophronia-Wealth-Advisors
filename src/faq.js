/**
 * Página de FAQs (templates/page-faq.php)
 * - Buscador: filtra preguntas mientras escribes (ignora mayúsculas y acentos)
 * - Resalta en la barra lateral la categoría que estás leyendo
 */

const normalize = text =>
  text
    .toLowerCase()
    .normalize("NFD")
    .replace(/[̀-ͯ]/g, "")

function initSearch() {
  const input = document.getElementById("faq-search")
  if (!input) return

  const status = document.getElementById("faq-search-status")
  const empty = document.getElementById("faq-empty")
  const categories = Array.from(document.querySelectorAll("[data-faq-category]"))
  const items = Array.from(document.querySelectorAll(".faq-item")).map(el => ({
    el,
    text: normalize(el.textContent),
    autoOpened: false
  }))

  const run = () => {
    const words = normalize(input.value).trim().split(/\s+/).filter(Boolean)
    let matches = 0

    items.forEach(item => {
      const match = words.every(w => item.text.includes(w))
      item.el.hidden = !match
      if (match) matches++

      // Al buscar: las coincidencias se muestran abiertas (y sin esperar la animación de scroll)
      if (words.length) {
        item.el.classList.add("is-visible")
        if (match && !item.el.open) {
          item.el.open = true
          item.autoOpened = true
        }
      } else if (item.autoOpened) {
        item.el.open = false
        item.autoOpened = false
      }
    })

    categories.forEach(cat => {
      cat.hidden = !cat.querySelector(".faq-item:not([hidden])")
      cat.querySelectorAll(".reveal").forEach(el => el.classList.add("is-visible"))
    })

    empty.classList.toggle("hidden", matches > 0)
    status.textContent = words.length ? `${matches} ${matches === 1 ? "question" : "questions"} found` : ""
  }

  input.addEventListener("input", run)
}

function initActiveCategory() {
  const links = Array.from(document.querySelectorAll("[data-faq-link]"))
  if (!links.length || !("IntersectionObserver" in window)) return

  const setActive = key =>
    links.forEach(link => {
      const active = link.dataset.faqLink === key
      link.classList.toggle("bg-ocean-50", active)
      link.classList.toggle("text-ocean-700", active)
      if (active) link.setAttribute("aria-current", "true")
      else link.removeAttribute("aria-current")
    })

  const observer = new IntersectionObserver(
    entries => entries.forEach(e => e.isIntersecting && setActive(e.target.dataset.faqCategory)),
    { rootMargin: "-35% 0px -55% 0px" }
  )
  document.querySelectorAll("[data-faq-category]").forEach(el => observer.observe(el))
}

export default function initFaq() {
  initSearch()
  initActiveCategory()
}
