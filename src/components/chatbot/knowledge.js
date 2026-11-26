import site from "../../lib/siteData"

/**
 * Base de conocimiento del chatbot.
 * Cada tema tiene: palabras clave (inglés y español), respuesta, enlaces y sugerencias de seguimiento.
 * Solo información general del sitio: el bot NUNCA da asesoría financiera personalizada.
 */
const page = slug => (site.nav.find(n => n.url.includes(`/${slug}`)) || {}).url || `/${slug}/`

export const GREETING = {
  text: `Hi! 👋 I'm the ${site.name} assistant. I can answer general questions about our services, fees, and how to get started. What would you like to know?`,
  suggestions: ["services", "fees", "clarity", "who"]
}

export const TOPICS = {
  services: {
    label: "What services do you offer?",
    keywords: ["service", "offer", "do you do", "help with", "planning", "wealth management", "servicio", "ofrecen", "planeacion", "planificacion"],
    text: "We provide ongoing, comprehensive wealth management: financial planning (cash flow, debt, retirement, taxes, insurance, estate, college savings) plus investment management — all for one flat fee.",
    links: [{ label: "See all services", url: () => page("services") }],
    suggestions: ["fees", "investments", "clarity"]
  },
  fees: {
    label: "How much does it cost?",
    keywords: ["fee", "cost", "price", "pricing", "charge", "how much", "expensive", "costo", "precio", "cuanto", "cobran", "tarifa"],
    text: "We're flat fee-only. Ongoing wealth management starts at $4,000 per quarter ($16,000 per year). No commissions and no percentage-of-assets (AUM) fees. A one-time Clarity Session is $450.",
    links: [{ label: "About our flat fee", url: () => page("about") }],
    suggestions: ["fiduciary", "investments", "clarity"]
  },
  clarity: {
    label: "What is a Clarity Session?",
    keywords: ["clarity", "session", "consult", "first meeting", "start", "get started", "sesion", "consulta", "empezar", "comenzar"],
    text: "A Clarity Session is a 60-minute meeting (Zoom or phone) for $450. Bring any financial question — investments, taxes, retirement, cash flow — and leave with clear, actionable guidance. No sales pitch.",
    links: [{ label: "Schedule a Clarity Session", url: () => site.cta.url, primary: true }],
    suggestions: ["fees", "who", "contact"]
  },
  who: {
    label: "Who do you work with?",
    keywords: ["who", "client", "minimum", "qualify", "work with", "latino", "business owner", "retire", "quien", "clientes", "minimo", "negocio", "jubilado"],
    text: "We primarily serve Latino business owners earning $300,000+ per year in net income, and retirees with $1.5 million+ in investable assets. We also welcome other households seeking a long-term planning relationship.",
    links: [{ label: "Learn more", url: () => site.homeUrl }],
    suggestions: ["services", "fees", "clarity"]
  },
  fiduciary: {
    label: "What does fiduciary mean?",
    keywords: ["fiduciary", "fiduciario", "best interest", "commission", "conflict", "trust", "comision", "confianza"],
    text: "As a fiduciary, we are committed to always putting your best interests first. We're compensated only by our clients — never by commissions on products. Clients receive a Fiduciary Oath hand-signed by our President, Miguel Gomez.",
    links: [{ label: "Our fiduciary principles", url: () => page("about") }],
    suggestions: ["fees", "team"]
  },
  investments: {
    label: "Do you manage investments?",
    keywords: ["invest", "portfolio", "stocks", "aum", "manage my money", "inversion", "portafolio", "acciones"],
    text: "Yes. Investment management is included in the ongoing relationship with no separate investment management fee. Portfolios are built around your plan, goals, tax situation, and risk profile. Standard fund expenses and transaction costs may still apply.",
    links: [{ label: "Services", url: () => page("services") }],
    suggestions: ["fees", "clarity"]
  },
  tax: {
    label: "Do you help with taxes?",
    keywords: ["tax", "taxes", "irs", "cpa", "impuesto", "impuestos", "contador"],
    text: "Tax planning and coordination are a core part of our planning. Miguel is an Enrolled Agent (EA), and we always work in collaboration with your CPA.",
    links: [{ label: "Services", url: () => page("services") }],
    suggestions: ["services", "team"]
  },
  team: {
    label: "Who is on your team?",
    keywords: ["team", "miguel", "advisor", "cfp", "karina", "antonio", "equipo", "asesor"],
    text: "Miguel Gomez, CFP®, EA is our President and works personally with every client. He has 16+ years of experience. Our team also includes Founder Karina Nava, EA, and Shareholder Antonio Nava, EA, NTPI Fellow.",
    links: [{ label: "Meet the team", url: () => `${page("about")}#team` }],
    suggestions: ["clarity", "contact"]
  },
  contact: {
    label: "How can I contact you?",
    keywords: ["contact", "phone", "call", "email", "address", "office", "where", "location", "hours", "contacto", "telefono", "llamar", "direccion", "oficina", "donde", "horario"],
    text: `Call us at ${site.contact.phone || ""} or send a message through our contact form. Our office is at ${site.contact.addressLine1 || ""}, ${site.contact.addressLine2 || ""}. Meetings are by appointment only.`,
    links: [{ label: "Contact us", url: () => site.contact.contactUrl || page("contact-us"), primary: true }],
    suggestions: ["clarity", "services"]
  }
}

export const FALLBACK = {
  text: "I'm not sure I can answer that one. For anything specific to your situation, the best next step is to talk with us directly — I can only share general information, not personal financial advice.",
  links: [
    { label: "Contact us", url: () => site.contact.contactUrl || page("contact-us") },
    { label: "Schedule a Clarity Session", url: () => site.cta.url, primary: true }
  ],
  suggestions: ["services", "fees", "clarity"]
}

const strip = s =>
  s
    .toLowerCase()
    .normalize("NFD")
    .replace(/[̀-ͯ]/g, "")

/** Devuelve el tema que mejor coincide con el texto del usuario (o null). */
export function matchTopic(input) {
  const text = strip(input)
  if (/^(hi|hello|hey|hola|buenas|buenos)/.test(text)) return "__greeting"
  let best = null
  let bestScore = 0
  for (const [key, topic] of Object.entries(TOPICS)) {
    const score = topic.keywords.reduce((acc, kw) => (text.includes(strip(kw)) ? acc + kw.length : acc), 0)
    if (score > bestScore) {
      best = key
      bestScore = score
    }
  }
  return best
}
