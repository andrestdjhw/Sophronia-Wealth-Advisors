import React from "react"
import site from "../lib/siteData"
import Icon from "./Icon"

/**
 * Panel del mega menú de Services (solo desktop).
 * Lo controla Navbar.js: abre al pasar el mouse o con el botón ▾ (teclado).
 * Los servicios vienen de inc/services-data.php vía window.sophroniaData.
 */
export default function MegaMenu({ item, open, onEnter, onLeave, isActive }) {
  return (
    <div
      id="mega-services"
      className={`absolute inset-x-0 top-full hidden transition duration-300 lg:block ${
        open ? "visible translate-y-0 opacity-100" : "invisible -translate-y-2 opacity-0"
      }`}
      onMouseEnter={onEnter}
      onMouseLeave={onLeave}
    >
      <div className="h-0.5 line-brand-gradient" />
      <div className="border-b border-ink-100 bg-white shadow-2xl shadow-ink-950/25">
        <div className="container-site grid grid-cols-12 gap-10 py-10">
          {/* Servicios */}
          <div className="col-span-8">
            <div className="flex items-center justify-between">
              <p className="eyebrow">Our services</p>
              <a href={item.url} className="link-brand inline-flex items-center gap-1.5 text-sm" tabIndex={open ? 0 : -1}>
                View all services <Icon name="arrow-right" className="size-4" />
              </a>
            </div>
            <ul className="mt-6 grid grid-cols-2 gap-2">
              {item.children.map((child, i) => (
                <li
                  key={child.url}
                  className={`transition duration-500 ${open ? "translate-y-0 opacity-100" : "translate-y-2 opacity-0"}`}
                  style={{ transitionDelay: open ? `${60 + i * 45}ms` : "0ms" }}
                >
                  <a
                    href={child.url}
                    tabIndex={open ? 0 : -1}
                    aria-current={isActive(child.url) ? "page" : undefined}
                    className={`group flex items-start gap-4 rounded-2xl p-4 transition hover:bg-ocean-50 ${isActive(child.url) ? "bg-ocean-50" : ""}`}
                  >
                    <span className="grid size-11 shrink-0 place-items-center rounded-xl bg-ocean-600 text-white transition duration-300 group-hover:-rotate-6 group-hover:scale-110 group-hover:bg-gold-500 group-hover:text-ink-950">
                      <Icon name={child.icon} className="size-5" />
                    </span>
                    <span>
                      <span className="flex items-center gap-1.5 font-semibold text-ink-900 group-hover:text-ocean-700">
                        {child.label}
                        <Icon name="arrow-right" className="size-3.5 opacity-0 transition group-hover:opacity-100" />
                      </span>
                      <span className="mt-1 block text-sm leading-snug text-ink-500">{child.desc}</span>
                    </span>
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Tarjeta destacada: Clarity Session */}
          <div className="col-span-4">
            <div className="relative isolate flex h-full flex-col overflow-hidden rounded-2xl bg-brand-gradient p-7 text-white">
              <div className="absolute -top-14 -right-14 -z-10 size-44 rounded-full bg-gold-500/25 blur-2xl" />
              <p className="text-xs font-semibold tracking-widest text-gold-300 uppercase">Not sure where to start?</p>
              <p className="mt-3 font-serif text-2xl leading-snug">The Clarity Session</p>
              <p className="mt-3 text-sm leading-relaxed text-ink-100/80">
                60 minutes, via Zoom or phone. Bring any financial question and get independent, fiduciary advice.
              </p>
              <p className="mt-5 font-serif text-4xl">
                $450 <span className="font-sans text-sm text-ink-100/70">/ session</span>
              </p>
              <div className="mt-auto pt-6">
                <a href={site.cta.url} className="btn-gold w-full" tabIndex={open ? 0 : -1}>
                  Schedule now <Icon name="arrow-right" className="size-4" />
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
