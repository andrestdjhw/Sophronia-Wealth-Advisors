<?php
/**
 * Preguntas frecuentes de la página /faqs/ (templates/page-faq.php).
 *
 * Agrupadas por categoría. Las respuestas admiten HTML simple (enlaces, <strong>).
 * Importante: solo información confirmada por el cliente o publicada en su sitio.
 * Para agregar una pregunta, añádela a la categoría que corresponda.
 */

if (!defined('ABSPATH')) exit;

function sophronia_faqs() {
  $clarity  = esc_url(sophronia_page_url('clarity-session'));
  $services = esc_url(sophronia_page_url('services'));
  $contact  = esc_url(sophronia_page_url('contact-us'));
  $about    = esc_url(sophronia_page_url('about'));

  return array(

    'getting-started' => array(
      'title' => 'Getting started',
      'icon'  => 'compass',
      'items' => array(
        'How do I get started?' =>
          'The best first step is a <a href="' . $clarity . '">Clarity Session</a>: a 60-minute meeting ($450) where you can bring any financial question and get independent, fiduciary advice.',
        'What is a Clarity Session?' =>
          'A 60-minute session via Zoom or phone, designed to help you make informed financial decisions wherever you are in your financial journey. Investments, taxes, retirement, cash flow — bring any question or concern. You’ll walk away with clear, actionable guidance tailored to your situation.',
        'Who do you typically work with?' =>
          'We primarily serve Latino business owners earning at least $300,000 per year in net income, and retirees with at least $1.5 million in investable assets.',
        'Do you only work with Latino clients?' =>
          'No. Serving Latino families is an important part of who we are, but our services are not limited to the Latino community. We also welcome retirees and other households looking for a long-term financial planning relationship.',
        'Can we meet in person?' =>
          'Yes. Our office is in El Paso, Texas, and meetings are by appointment only. Clarity Sessions are held via Zoom or phone, so you can meet with us from anywhere.',
      ),
    ),

    'fees' => array(
      'title' => 'Fees & pricing',
      'icon'  => 'tag',
      'items' => array(
        'How much does it cost?' =>
          'Our wealth management services are offered for a flat fee starting at <strong>$4,000 per quarter</strong> ($16,000 per year). We do not charge commissions or a percentage of your assets.',
        'What does “flat fee-only” mean?' =>
          'We charge a simple, fixed fee for our services. We don’t earn commissions from selling financial products, and we don’t use assets-under-management (AUM) fees, which vary based on the size of your portfolio.',
        'Is there a separate fee for managing my investments?' =>
          'No. Investment management is part of the ongoing relationship, with no separate investment management fee. Standard fund expenses and transaction costs may still apply.',
        'Why a flat fee instead of a percentage of assets?' =>
          'While no fee structure is completely free of conflicts of interest, we believe a flat fee is more transparent and predictable. With a flat fee, what you pay is not tied to the size of your portfolio. It also makes our advice accessible to people with a high income but few investable assets — clients who are often turned down by traditional AUM advisors.',
      ),
    ),

    'fiduciary' => array(
      'title' => 'Fiduciary advice & trust',
      'icon'  => 'shield',
      'items' => array(
        'What does it mean that you are a fiduciary?' =>
          'As a fiduciary, we are committed to acting in your best interest: every recommendation is made for you, not for what earns a commission. We are compensated only by our clients, and our only product is our advice.',
        'Do you earn commissions or sell financial products?' =>
          'No. We are fee-only. We don’t sell products and don’t earn commissions, so our advice stays objective.',
        'Are you a registered investment adviser?' =>
          'Yes. Sophronia Wealth Advisors is a registered investment advisor offering advisory services in the States of Texas, California, and in other jurisdictions where exempt. Registration does not imply a certain level of skill or training. You can review our public disclosures in the footer of this site.',
        'What credentials does your team hold?' =>
          'Our team includes a CERTIFIED FINANCIAL PLANNER™ professional and Enrolled Agents (EA). We are members of NAPFA, the XY Planning Network and the Fee-Only Network. <a href="' . $about . '">Meet the team</a>.',
      ),
    ),

    'services' => array(
      'title' => 'Services',
      'icon'  => 'briefcase',
      'items' => array(
        'What services do you offer?' =>
          'Ongoing financial planning and investment management, including tax planning, retirement planning, business owner planning, and estate and risk planning. <a href="' . $services . '">Explore our services</a>.',
        'Is financial planning a one-time project?' =>
          'No. As your business, family, income, investments, tax situation and goals change, we revisit your plan and make adjustments when appropriate.',
        'Do you work with my CPA?' =>
          'Yes. Our tax planning is proactive and always done in collaboration with your CPA. You don’t need to change tax professionals.',
        'Do you sell insurance?' =>
          'No. We are fee-only and do not earn commissions, so our insurance analysis is independent and objective.',
        'Do you draft wills or trusts?' =>
          'No. We help you define your estate planning goals and coordinate with your estate planning attorney, who prepares the legal documents. Sophronia does not provide legal advice.',
      ),
    ),
  );
}
