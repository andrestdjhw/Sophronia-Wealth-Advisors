import React from "react"
import ReactDOM from "react-dom/client"

import Navbar from "./components/Navbar"
import Footer from "./components/Footer"
import ContactForm from "./components/ContactForm"
import Chatbot from "./components/Chatbot"
import initAnimations from "./animations"
import initFaq from "./faq"
import initSocialRail from "./social-rail"

// Monta un componente de React en el elemento con el id dado, si existe en la página.
// Los atributos data-* del elemento se pasan como props (ej. data-variant="glass" → variant="glass").
function mount(id, Component) {
  const el = document.getElementById(id)
  if (el) ReactDOM.createRoot(el).render(<Component {...el.dataset} />)
}

mount("sophronia-navbar", Navbar)
mount("sophronia-footer", Footer)
mount("sophronia-contact-form", ContactForm)
mount("sophronia-hero-form", ContactForm)
mount("sophronia-chatbot", Chatbot)

// Animaciones (scroll, contadores, parallax)
initAnimations()

// Buscador de la página de FAQs
initFaq()

// Redes sociales flotantes (se ocultan sobre el hero y el footer)
initSocialRail()
