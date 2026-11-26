import React, { useState } from "react"
import site from "../lib/siteData"
import Icon from "./Icon"

const PROFILES = ["Business owner", "Professional", "Retiree", "Other"]
const EMPTY = { name: "", email: "", phone: "", profile: "", message: "", company: "" }

function validate(v) {
  const e = {}
  if (v.name.trim().length < 2) e.name = "Please enter your name."
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.email.trim())) e.email = "Please enter a valid email address."
  if (v.message.trim().length < 10) e.message = "Please write a short message (at least 10 characters)."
  return e
}

/**
 * Estilos por variante:
 *  - light: tarjeta blanca (página de contacto)
 *  - glass: translúcido sobre fondo oscuro (hero de inicio)
 */
const THEMES = {
  light: {
    label: "text-ink-900",
    optional: "text-ink-500",
    error: "text-red-700",
    input: "border-ink-100 bg-white text-ink-900 placeholder:text-ink-300 focus:border-gold-500 focus:ring-gold-100",
    inputError: "border-red-400 bg-white text-ink-900 focus:ring-red-200",
    alert: "bg-red-50 text-red-800",
    note: "text-ink-500",
    option: "",
    success: "border-gold-200 bg-gold-50",
    successText: "text-ink-600",
    successTitle: "",
    againBtn: "btn-outline-dark"
  },
  glass: {
    label: "text-white/90",
    optional: "text-white/50",
    error: "text-red-300",
    input: "border-white/15 bg-white/[0.07] text-white placeholder:text-white/40 focus:border-gold-400 focus:bg-white/[0.12] focus:ring-gold-400/30",
    inputError: "border-red-400/70 bg-white/10 text-white focus:ring-red-400/30",
    alert: "bg-red-500/15 text-red-100",
    note: "text-white/55",
    option: "bg-ink-900 text-white",
    success: "border-white/15 bg-white/10",
    successText: "text-ink-100/80",
    successTitle: "text-white",
    againBtn: "btn-outline-light"
  }
}

function Field({ id, label, error, optional, theme, children }) {
  return (
    <div>
      <label htmlFor={id} className={`mb-2 block text-sm font-medium ${theme.label}`}>
        {label} {optional && <span className={`font-normal ${theme.optional}`}>(optional)</span>}
      </label>
      {children}
      {error && (
        <p id={`${id}-error`} className={`mt-1.5 text-sm ${theme.error}`}>
          {error}
        </p>
      )}
    </div>
  )
}

export default function ContactForm({ variant = "light", compact = false, idPrefix = "cf" }) {
  const theme = THEMES[variant] || THEMES.light
  const isCompact = compact === true || compact === "true" || compact === ""
  const fid = name => `${idPrefix}-${name}`
  const inputClass = hasError =>
    `block w-full rounded-xl border px-4 py-3 transition focus:outline-none focus:ring-2 ${hasError ? theme.inputError : theme.input}`

  const [values, setValues] = useState(EMPTY)
  const [errors, setErrors] = useState({})
  const [status, setStatus] = useState("idle") // idle | sending | success | error
  const [serverMessage, setServerMessage] = useState("")

  const update = e => {
    const { name, value } = e.target
    setValues(v => ({ ...v, [name]: value }))
    if (errors[name]) setErrors(err => ({ ...err, [name]: undefined }))
  }

  const errorProps = field => (errors[field] ? { "aria-invalid": true, "aria-describedby": `${fid(field)}-error` } : {})

  async function onSubmit(e) {
    e.preventDefault()
    const found = validate(values)
    setErrors(found)
    if (Object.keys(found).length) return

    setStatus("sending")
    setServerMessage("")
    try {
      const res = await fetch(site.api.contact, {
        method: "POST",
        headers: { "Content-Type": "application/json", "X-WP-Nonce": site.api.nonce },
        body: JSON.stringify(values)
      })
      const data = await res.json().catch(() => ({}))
      if (res.ok && data.ok) {
        setStatus("success")
        setValues(EMPTY)
      } else {
        if (data.errors) setErrors(data.errors)
        setServerMessage(data.message || "Please review the highlighted fields.")
        setStatus("error")
      }
    } catch {
      setServerMessage("We couldn't send your message. Please check your connection or call us.")
      setStatus("error")
    }
  }

  if (status === "success") {
    return (
      <div className={`chat-in rounded-2xl border p-8 text-center ${theme.success}`} role="status">
        <span className="mx-auto grid size-14 place-items-center rounded-full bg-gold-500 text-ink-950">
          <Icon name="check" className="size-7" />
        </span>
        <h3 className={`mt-5 text-2xl ${theme.successTitle}`}>Thank you!</h3>
        <p className={`mt-2 ${theme.successText}`}>We received your message and will get back to you soon.</p>
        <button type="button" className={`${theme.againBtn} mt-6`} onClick={() => setStatus("idle")}>
          Send another message
        </button>
      </div>
    )
  }

  return (
    <form onSubmit={onSubmit} noValidate className={isCompact ? "space-y-4" : "space-y-5"}>
      <div className={`grid sm:grid-cols-2 ${isCompact ? "gap-4" : "gap-5"}`}>
        <Field id={fid("name")} label="Full name" error={errors.name} theme={theme}>
          <input id={fid("name")} name="name" autoComplete="name" value={values.name} onChange={update} className={inputClass(errors.name)} {...errorProps("name")} />
        </Field>
        <Field id={fid("email")} label="Email" error={errors.email} theme={theme}>
          <input id={fid("email")} name="email" type="email" autoComplete="email" value={values.email} onChange={update} className={inputClass(errors.email)} {...errorProps("email")} />
        </Field>
      </div>

      {isCompact ? (
        <Field id={fid("phone")} label="Phone" optional theme={theme}>
          <input id={fid("phone")} name="phone" type="tel" autoComplete="tel" value={values.phone} onChange={update} className={inputClass(false)} />
        </Field>
      ) : (
        <div className="grid gap-5 sm:grid-cols-2">
          <Field id={fid("phone")} label="Phone" optional theme={theme}>
            <input id={fid("phone")} name="phone" type="tel" autoComplete="tel" value={values.phone} onChange={update} className={inputClass(false)} />
          </Field>
          <Field id={fid("profile")} label="I am a…" optional theme={theme}>
            <select id={fid("profile")} name="profile" value={values.profile} onChange={update} className={inputClass(false)}>
              <option value="" className={theme.option}>
                Select one
              </option>
              {PROFILES.map(p => (
                <option key={p} className={theme.option}>
                  {p}
                </option>
              ))}
            </select>
          </Field>
        </div>
      )}

      <Field id={fid("message")} label="How can we help?" error={errors.message} theme={theme}>
        <textarea id={fid("message")} name="message" rows={isCompact ? 3 : 5} value={values.message} onChange={update} className={inputClass(errors.message)} {...errorProps("message")} />
      </Field>

      {/* Honeypot anti-spam: oculto para personas */}
      <div className="hidden" aria-hidden="true">
        <label htmlFor={fid("company")}>Company</label>
        <input id={fid("company")} name="company" tabIndex={-1} autoComplete="off" value={values.company} onChange={update} />
      </div>

      {status === "error" && serverMessage && (
        <p className={`flex items-center gap-2 rounded-xl px-4 py-3 text-sm ${theme.alert}`} role="alert">
          <Icon name="alert" className="size-5 shrink-0" />
          {serverMessage}
        </p>
      )}

      <div className={`flex flex-col gap-4 ${isCompact ? "" : "sm:flex-row sm:items-center sm:justify-between"}`}>
        {!isCompact && <p className={`text-xs ${theme.note}`}>Please don't include account numbers or trade instructions.</p>}
        <button type="submit" className={`btn-gold shrink-0 disabled:cursor-wait disabled:opacity-60 ${isCompact ? "w-full" : ""}`} disabled={status === "sending"}>
          {status === "sending" ? "Sending…" : "Send message"}
          {status !== "sending" && <Icon name="send" className="size-4" />}
        </button>
        {isCompact && <p className={`text-center text-xs ${theme.note}`}>Please don't include account numbers or trade instructions.</p>}
      </div>
    </form>
  )
}
