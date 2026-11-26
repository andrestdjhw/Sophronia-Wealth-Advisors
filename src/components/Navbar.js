import React, { useEffect, useRef, useState } from "react"
import site from "../lib/siteData"
import Icon from "./Icon"
import MegaMenu from "./MegaMenu"

// Compara rutas ignorando dominio y "/" final, para marcar el link activo.
const normalize = url => {
  try {
    return new URL(url, window.location.origin).pathname.replace(/\/+$/, "") || "/"
  } catch {
    return url
  }
}

export default function Navbar() {
  const [open, setOpen] = useState(false) // menú móvil
  const [megaOpen, setMegaOpen] = useState(false) // mega menú (desktop)
  const [mobileSub, setMobileSub] = useState(false) // submenú de servicios (móvil)
  const [scrolled, setScrolled] = useState(false)
  const [progress, setProgress] = useState(0)
  const closeTimer = useRef(null)
  const headerRef = useRef(null)
  const current = normalize(window.location.href)

  useEffect(() => {
    const onScroll = () => {
      setScrolled(window.scrollY > 8)
      const max = document.documentElement.scrollHeight - window.innerHeight
      setProgress(max > 0 ? Math.min(window.scrollY / max, 1) : 0)
    }
    onScroll()
    window.addEventListener("scroll", onScroll, { passive: true })
    return () => window.removeEventListener("scroll", onScroll)
  }, [])

  // Bloquea el scroll del body cuando el menú móvil está abierto
  useEffect(() => {
    document.body.style.overflow = open ? "hidden" : ""
  }, [open])

  // Escape cierra cualquier menú; clic fuera cierra el mega menú
  useEffect(() => {
    const onKey = e => {
      if (e.key === "Escape") {
        setOpen(false)
        setMegaOpen(false)
      }
    }
    const onClick = e => {
      if (headerRef.current && !headerRef.current.contains(e.target)) setMegaOpen(false)
    }
    window.addEventListener("keydown", onKey)
    document.addEventListener("click", onClick)
    return () => {
      window.removeEventListener("keydown", onKey)
      document.removeEventListener("click", onClick)
    }
  }, [])

  // Abrir/cerrar el mega menú con un pequeño retraso al salir (evita parpadeos)
  const openMega = () => {
    clearTimeout(closeTimer.current)
    setMegaOpen(true)
  }
  const closeMega = () => {
    clearTimeout(closeTimer.current)
    closeTimer.current = setTimeout(() => setMegaOpen(false), 250)
  }

  const isActive = url => normalize(url) === current
  // Un item con submenú está activo si estamos en él o en una de sus subpáginas
  const isSectionActive = item => isActive(item.url) || current.startsWith(normalize(item.url) + "/")

  const linkClass = active =>
    `relative py-2 text-sm font-medium transition-colors after:absolute after:inset-x-0 after:-bottom-0.5 after:h-0.5 after:origin-left after:bg-gold-500 after:transition-transform ${
      active ? "text-white after:scale-x-100" : "text-white/70 after:scale-x-0 hover:text-white hover:after:scale-x-100"
    }`

  return (
    <header ref={headerRef} className={`relative transition-shadow duration-300 ${scrolled ? "shadow-lg shadow-ink-950/20" : ""}`}>
      {/* Barra de progreso de lectura */}
      <div
        className="absolute inset-x-0 bottom-0 z-10 h-0.5 origin-left bg-gradient-to-r from-gold-500 to-ocean-400 transition-transform duration-150 ease-out"
        style={{ transform: `scaleX(${progress})` }}
        aria-hidden="true"
      />
      {/* Franja superior (azul original) */}
      <div className="hidden bg-ocean-600 text-xs text-ocean-50 lg:block">
        <div className="container-site flex h-9 items-center justify-between">
          <p className="flex items-center gap-2">
            <Icon name="map-pin" className="size-3.5 text-gold-300" />
            {site.contact.addressLine1}, {site.contact.addressLine2}
            <span className="mx-2 text-ocean-300">·</span>
            {site.contact.hours}
          </p>
          <a href={site.contact.phoneHref} className="flex items-center gap-2 font-semibold text-white hover:text-gold-300">
            <Icon name="phone" className="size-3.5 text-gold-300" />
            {site.contact.phone}
          </a>
        </div>
      </div>

      {/* En desktop: grid de 3 columnas (logo | links centrados | CTA) */}
      <nav className="container-site flex h-20 items-center justify-between lg:grid lg:grid-cols-[1fr_auto_1fr]" aria-label="Main">
        <a href={site.homeUrl} className="shrink-0 justify-self-start" aria-label={`${site.name} – Home`}>
          <img src={site.logo} alt={site.name} className="h-[66px] w-auto" width="200" height="66" />
        </a>

        {/* Desktop: links centrados */}
        <ul className="hidden items-center gap-8 lg:flex">
          {site.nav.map(item =>
            item.children?.length ? (
              <li key={item.url} className="flex items-center gap-1" onMouseEnter={openMega} onMouseLeave={closeMega}>
                <a href={item.url} aria-current={isActive(item.url) ? "page" : undefined} className={linkClass(isSectionActive(item) || megaOpen)}>
                  {item.label}
                </a>
                <button
                  type="button"
                  className="grid size-6 place-items-center rounded-full text-white/70 transition hover:text-white"
                  aria-expanded={megaOpen}
                  aria-controls="mega-services"
                  aria-label={`${item.label} menu`}
                  onClick={() => (megaOpen ? setMegaOpen(false) : openMega())}
                >
                  <Icon name="chevron-down" className={`size-4 transition-transform duration-300 ${megaOpen ? "rotate-180 text-gold-400" : ""}`} />
                </button>
              </li>
            ) : (
              <li key={item.url}>
                <a href={item.url} aria-current={isActive(item.url) ? "page" : undefined} className={linkClass(isActive(item.url))}>
                  {item.label}
                </a>
              </li>
            )
          )}
        </ul>

        {/* Desktop: CTA a la derecha */}
        <div className="hidden justify-self-end lg:block">
          <a href={site.cta.url} className="btn-gold">
            {site.cta.label}
          </a>
        </div>

        {/* Botón móvil */}
        <button
          type="button"
          className="grid size-11 place-items-center rounded-full text-white hover:bg-white/10 lg:hidden"
          aria-expanded={open}
          aria-controls="mobile-menu"
          aria-label={open ? "Close menu" : "Open menu"}
          onClick={() => setOpen(o => !o)}
        >
          <Icon name={open ? "close" : "menu"} className="size-6" />
        </button>
      </nav>

      {/* Mega menú de Services (desktop) */}
      {site.nav
        .filter(item => item.children?.length)
        .map(item => (
          <MegaMenu key={item.url} item={item} open={megaOpen} onEnter={openMega} onLeave={closeMega} isActive={isActive} />
        ))}

      {/* Menú móvil */}
      <div
        id="mobile-menu"
        className={`fixed inset-x-0 top-20 bottom-0 overflow-y-auto bg-deep-gradient transition-all duration-300 lg:hidden ${
          open ? "visible opacity-100" : "invisible opacity-0"
        }`}
      >
        <div className="container-site flex min-h-full flex-col py-8">
          <ul className="space-y-1">
            {site.nav.map((item, i) => (
              <li
                key={item.url}
                className={`border-b border-white/10 transition-all duration-500 ${open ? "translate-x-0 opacity-100" : "-translate-x-6 opacity-0"}`}
                style={{ transitionDelay: open ? `${100 + i * 70}ms` : "0ms" }}
              >
                <div className="flex items-center justify-between">
                  <a
                    href={item.url}
                    aria-current={isActive(item.url) ? "page" : undefined}
                    className={`block flex-1 py-4 font-serif text-2xl ${isSectionActive(item) ? "text-gold-400" : "text-white"}`}
                    onClick={() => setOpen(false)}
                  >
                    {item.label}
                  </a>
                  {item.children?.length > 0 && (
                    <button
                      type="button"
                      className="grid size-10 place-items-center rounded-full text-white hover:bg-white/10"
                      aria-expanded={mobileSub}
                      aria-controls="mobile-services"
                      aria-label={`${item.label} submenu`}
                      onClick={() => setMobileSub(s => !s)}
                    >
                      <Icon name="chevron-down" className={`size-5 transition-transform duration-300 ${mobileSub ? "rotate-180 text-gold-400" : ""}`} />
                    </button>
                  )}
                </div>

                {/* Submenú de servicios (acordeón) */}
                {item.children?.length > 0 && (
                  <div id="mobile-services" className={`grid transition-all duration-300 ${mobileSub ? "grid-rows-[1fr] pb-4" : "grid-rows-[0fr]"}`}>
                    <ul className="space-y-1 overflow-hidden">
                      {item.children.map(child => (
                        <li key={child.url}>
                          <a
                            href={child.url}
                            tabIndex={mobileSub ? 0 : -1}
                            aria-current={isActive(child.url) ? "page" : undefined}
                            className={`flex items-center gap-3 rounded-xl px-2 py-2.5 text-base hover:bg-white/5 ${isActive(child.url) ? "text-gold-400" : "text-ink-100"}`}
                            onClick={() => setOpen(false)}
                          >
                            <span className="grid size-8 shrink-0 place-items-center rounded-lg bg-white/10 text-gold-400">
                              <Icon name={child.icon} className="size-4" />
                            </span>
                            {child.label}
                          </a>
                        </li>
                      ))}
                    </ul>
                  </div>
                )}
              </li>
            ))}
          </ul>
          <a
            href={site.cta.url}
            className={`btn-gold mt-8 transition-all duration-500 ${open ? "translate-y-0 opacity-100" : "translate-y-4 opacity-0"}`}
            style={{ transitionDelay: open ? `${100 + site.nav.length * 70}ms` : "0ms" }}
          >
            {site.cta.label}
          </a>
          {site.contact.phone && (
            <a href={site.contact.phoneHref} className="mt-auto flex items-center gap-3 pt-8 text-sm text-ink-300">
              <Icon name="phone" className="size-4 text-gold-400" />
              {site.contact.phone}
            </a>
          )}
        </div>
      </div>
    </header>
  )
}
