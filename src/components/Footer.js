import React from "react"
import site from "../lib/siteData"
import Icon from "./Icon"

export default function Footer() {
  const { contact } = site
  const year = new Date().getFullYear()

  return (
    <footer className="relative text-ink-300">
      <div className="h-1 line-brand-gradient" />
      {/* Bloque principal */}
      <div className="container-site grid gap-12 py-16 md:grid-cols-2 lg:grid-cols-12">
        <div className="lg:col-span-4">
          <img src={site.logo} alt={site.name} className="h-[100px] w-auto" width="302" height="100" loading="lazy" />
          <p className="mt-6 max-w-sm text-sm leading-relaxed">{site.tagline}</p>
          <p className="mt-4 text-xs font-semibold tracking-widest text-gold-400 uppercase">Registered Investment Adviser</p>
          {site.social.length > 0 && (
            <ul className="mt-6 flex gap-3">
              {site.social.map(s => (
                <li key={s.url}>
                  <a
                    href={s.url}
                    target="_blank"
                    rel="noopener"
                    aria-label={s.name}
                    className="grid size-10 place-items-center rounded-full border border-white/15 text-white/80 transition hover:border-gold-500 hover:text-gold-400"
                  >
                    <Icon name={s.icon} className="size-[18px]" />
                  </a>
                </li>
              ))}
            </ul>
          )}
        </div>

        <nav className="lg:col-span-2" aria-label="Footer">
          <h2 className="font-sans text-sm font-semibold text-white">Explore</h2>
          <ul className="mt-5 space-y-3 text-sm">
            {[...site.nav, site.cta].map(item => (
              <li key={item.url}>
                <a href={item.url} className="transition hover:text-gold-400">
                  {item.label}
                </a>
              </li>
            ))}
          </ul>
        </nav>

        <div className="lg:col-span-3">
          <h2 className="font-sans text-sm font-semibold text-white">Visit us</h2>
          <ul className="mt-5 space-y-4 text-sm">
            <li className="flex gap-3">
              <Icon name="map-pin" className="mt-0.5 size-4 shrink-0 text-gold-400" />
              <a href={contact.mapUrl} target="_blank" rel="noopener" className="hover:text-gold-400">
                {site.legalName}
                <br />
                {contact.addressLine1}
                <br />
                {contact.addressLine2}
              </a>
            </li>
            <li className="flex gap-3">
              <Icon name="phone" className="mt-0.5 size-4 shrink-0 text-gold-400" />
              <a href={contact.phoneHref} className="hover:text-gold-400">
                {contact.phone}
              </a>
            </li>
            <li className="flex gap-3">
              <Icon name="clock" className="mt-0.5 size-4 shrink-0 text-gold-400" />
              {contact.hours}
            </li>
          </ul>
        </div>

        <div className="lg:col-span-3">
          <h2 className="font-sans text-sm font-semibold text-white">Disclosures</h2>
          <ul className="mt-5 space-y-3 text-sm">
            {site.legalLinks.map(l => (
              <li key={l.url}>
                <a href={l.url} target="_blank" rel="noopener" className="transition hover:text-gold-400">
                  {l.label}
                </a>
              </li>
            ))}
          </ul>
        </div>
      </div>

      {/* Afiliaciones */}
      {site.affiliations.length > 0 && (
        <div className="border-t border-white/10">
          <div className="container-site flex flex-wrap items-center gap-x-6 gap-y-4 py-8">
            <p className="text-xs font-semibold tracking-widest text-white/50 uppercase">Affiliations</p>
            <ul className="flex flex-wrap items-center gap-3">
              {site.affiliations.map(a => {
                const logo = <img src={a.img} alt={a.name} className="h-8 w-auto object-contain" loading="lazy" />
                return (
                  <li key={a.name} className="rounded-lg bg-white px-3 py-2">
                    {a.url ? (
                      <a href={a.url} target="_blank" rel="noopener">
                        {logo}
                      </a>
                    ) : (
                      logo
                    )}
                  </li>
                )
              })}
            </ul>
          </div>
        </div>
      )}

      {/* Avisos regulatorios */}
      <div className="bg-ocean-900">
        <div className="container-site space-y-3 py-10 text-xs leading-relaxed text-ink-300/80">
          {site.disclosures.map((text, i) => (
            <p key={i}>{text}</p>
          ))}
          <p className="font-semibold text-ink-300">{site.representativeNote}</p>
          <div className="border-t border-white/10 pt-6">
            <p>
              © {year} {site.legalName} All rights reserved.
            </p>
          </div>
        </div>
      </div>
    </footer>
  )
}
