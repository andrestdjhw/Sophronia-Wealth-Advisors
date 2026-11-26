import React, { useEffect, useRef, useState } from "react"
import site from "../lib/siteData"
import Icon from "./Icon"
import { GREETING, TOPICS, FALLBACK, matchTopic } from "./chatbot/knowledge"

let nextId = 1
const botMessage = entry => ({ id: nextId++, from: "bot", text: entry.text, links: entry.links || [], suggestions: entry.suggestions || [] })

export default function Chatbot() {
  const [open, setOpen] = useState(false)
  const [messages, setMessages] = useState(() => [botMessage(GREETING)])
  const [input, setInput] = useState("")
  const [typing, setTyping] = useState(false)
  const [hasOpened, setHasOpened] = useState(false)
  const listRef = useRef(null)
  const inputRef = useRef(null)
  const timer = useRef(null)

  useEffect(() => {
    if (open) {
      setHasOpened(true)
      inputRef.current?.focus()
    }
    const onKey = e => e.key === "Escape" && setOpen(false)
    window.addEventListener("keydown", onKey)
    return () => window.removeEventListener("keydown", onKey)
  }, [open])

  useEffect(() => {
    listRef.current?.scrollTo({ top: listRef.current.scrollHeight, behavior: "smooth" })
  }, [messages, typing])

  useEffect(() => () => clearTimeout(timer.current), [])

  function respond(entry) {
    setTyping(true)
    clearTimeout(timer.current)
    timer.current = setTimeout(() => {
      setTyping(false)
      setMessages(m => [...m, botMessage(entry)])
    }, 550)
  }

  function ask(text, topicKey) {
    if (!text.trim() || typing) return
    setMessages(m => [...m, { id: nextId++, from: "user", text }])
    const key = topicKey || matchTopic(text)
    respond(key === "__greeting" ? GREETING : TOPICS[key] || FALLBACK)
  }

  function onSubmit(e) {
    e.preventDefault()
    ask(input)
    setInput("")
  }

  const last = messages[messages.length - 1]

  return (
    <div className="fixed right-4 bottom-4 z-40 sm:right-6 sm:bottom-6">
      {/* Panel */}
      <section
        role="dialog"
        aria-label="Chat with Sophronia assistant"
        aria-hidden={!open}
        className={`absolute right-0 bottom-20 flex h-[min(560px,calc(100vh-7rem))] w-[calc(100vw-2rem)] origin-bottom-right flex-col overflow-hidden rounded-3xl border border-ink-100 bg-white shadow-2xl transition-all duration-300 sm:w-96 ${
          open ? "visible scale-100 opacity-100" : "invisible scale-95 opacity-0"
        }`}
      >
        <header className="flex items-center gap-3 bg-brand-gradient px-5 py-4">
          <span className="grid size-10 place-items-center rounded-full bg-gold-500 font-serif text-lg font-semibold text-ink-950">S</span>
          <div className="flex-1">
            <p className="text-sm font-semibold text-white">Sophronia Assistant</p>
            <p className="text-xs text-ocean-100/80">General info · Not financial advice</p>
          </div>
          <button type="button" onClick={() => setOpen(false)} className="grid size-9 place-items-center rounded-full text-white/70 hover:bg-white/10 hover:text-white" aria-label="Close chat">
            <Icon name="close" className="size-5" />
          </button>
        </header>

        <div ref={listRef} className="flex-1 space-y-4 overflow-y-auto bg-ocean-50/60 px-4 py-5" aria-live="polite">
          {messages.map(m =>
            m.from === "user" ? (
              <div key={m.id} className="chat-in flex justify-end">
                <p className="max-w-[80%] rounded-2xl rounded-br-md bg-ocean-700 px-4 py-2.5 text-sm text-white">{m.text}</p>
              </div>
            ) : (
              <div key={m.id} className="chat-in max-w-[88%] space-y-2">
                <p className="rounded-2xl rounded-bl-md border border-ink-100 bg-white px-4 py-3 text-sm leading-relaxed text-ink-800 shadow-sm">{m.text}</p>
                {m.links.length > 0 && (
                  <div className="flex flex-wrap gap-2">
                    {m.links.map(l => (
                      <a
                        key={l.label}
                        href={l.url()}
                        className={`inline-flex items-center gap-1.5 rounded-full px-3.5 py-1.5 text-xs font-semibold transition ${
                          l.primary ? "bg-gold-500 text-ink-950 hover:bg-gold-400" : "border border-ink-900/15 text-ink-900 hover:border-ink-900"
                        }`}
                      >
                        {l.label}
                        <Icon name="arrow-right" className="size-3.5" />
                      </a>
                    ))}
                  </div>
                )}
              </div>
            )
          )}

          {typing && (
            <div className="flex w-16 items-center justify-center gap-1 rounded-2xl rounded-bl-md border border-ink-100 bg-white py-3.5" aria-label="Assistant is typing">
              {[0, 150, 300].map(d => (
                <span key={d} className="size-1.5 animate-bounce rounded-full bg-ink-300" style={{ animationDelay: `${d}ms` }} />
              ))}
            </div>
          )}

          {/* Sugerencias del último mensaje del bot */}
          {!typing && last.from === "bot" && last.suggestions.length > 0 && (
            <div className="chat-in flex flex-wrap gap-2 pt-1" style={{ animationDelay: "150ms" }}>
              {last.suggestions.map(key => (
                <button
                  key={key}
                  type="button"
                  onClick={() => ask(TOPICS[key].label, key)}
                  className="rounded-full border border-gold-300 bg-gold-50 px-3.5 py-1.5 text-left text-xs font-medium text-ink-900 transition hover:border-gold-500 hover:bg-gold-100"
                >
                  {TOPICS[key].label}
                </button>
              ))}
            </div>
          )}
        </div>

        <form onSubmit={onSubmit} className="flex items-center gap-2 border-t border-ink-100 bg-white p-3">
          <label htmlFor="chat-input" className="sr-only">
            Type your question
          </label>
          <input
            id="chat-input"
            ref={inputRef}
            value={input}
            onChange={e => setInput(e.target.value)}
            placeholder="Ask about fees, services…"
            autoComplete="off"
            maxLength={300}
            className="flex-1 rounded-full border border-ink-100 bg-sand-50 px-4 py-2.5 text-sm focus:border-gold-500 focus:ring-2 focus:ring-gold-100 focus:outline-none"
          />
          <button type="submit" className="grid size-10 shrink-0 place-items-center rounded-full bg-ocean-700 text-white transition hover:bg-ocean-600 disabled:opacity-40" disabled={!input.trim() || typing} aria-label="Send">
            <Icon name="send" className="size-4" />
          </button>
        </form>
        <p className="bg-white px-4 pb-3 text-center text-[11px] text-ink-500">
          Please don't share account numbers or personal financial details. <a href={site.contact.contactUrl} className="underline">Contact us</a> for specific questions.
        </p>
      </section>

      {/* Botón flotante */}
      <button
        type="button"
        onClick={() => setOpen(o => !o)}
        aria-expanded={open}
        aria-label={open ? "Close chat" : "Open chat"}
        className={`relative grid size-16 place-items-center rounded-full bg-gold-500 text-ink-950 shadow-xl shadow-ink-950/25 transition hover:scale-110 hover:bg-gold-400 active:scale-95 ${
          hasOpened ? "" : "pulse-ring"
        }`}
      >
        <span className={`transition-transform duration-300 ${open ? "rotate-90" : "rotate-0"}`}>
          <Icon name={open ? "close" : "chat"} className="size-7" />
        </span>
      </button>
    </div>
  )
}
