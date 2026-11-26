<?php
/**
 * Catálogo de servicios.
 * Una sola fuente de datos para: el mega menú (navbar), la página Services
 * y cada subpágina /services/{slug}/ (templates/page-service.php).
 *
 * Para agregar un servicio: añade una entrada aquí y súbele la versión
 * a SOPHRONIA_PAGES_VERSION (inc/setup-pages.php) para que se cree su página.
 */

if (!defined('ABSPATH')) exit;

function sophronia_services() {
  return array(

    'financial-planning' => array(
      'title'    => 'Financial Planning',
      'icon'     => 'compass',
      'image'    => 'about-intro.webp',
      'photo'    => 'financial-planning',          // Medios: sw-financial-planning.*
      'flip'     => true,           // espejo: la persona queda a la derecha, lejos del texto
      'image_position'        => 'center 30%',   // escritorio (foto ancha)
      'image_position_mobile' => '40% center',  // móvil (foto recortada en vertical)
      'summary'  => 'A clear strategy that connects your goals, family and business.',
      'hero'     => 'A clear financial strategy, built around <span class="italic text-gold-400">your life</span> and your business.',
      'subtitle' => 'We help you set priorities, make informed decisions, and coordinate every area of your financial life.',
      'intro'    => array(
        'Financial planning is the foundation of our relationship. We start by understanding your goals, your family, your business and your values, and then build a strategy that connects them.',
        'As important decisions come up — buying property, expanding the business, a change in income — we help you evaluate your options so you can move forward with confidence.',
      ),
      'focus' => array(
        array('title' => 'Financial goals',               'text' => 'Define what matters most and turn it into a plan with clear priorities.'),
        array('title' => 'Cash flow & debt management',   'text' => 'Understand where your money goes and make debt work for you, not against you.'),
        array('title' => 'Wealth building',               'text' => 'Grow your net worth with a strategy that fits your timeline and risk profile.'),
        array('title' => 'College savings',               'text' => 'Plan ahead for your children’s or grandchildren’s education.'),
        array('title' => 'Major financial decisions',     'text' => 'An independent second opinion before you commit to a big move.'),
        array('title' => 'Needs as they arise',           'text' => 'Life changes. Your plan is revisited and adjusted along the way.'),
      ),
      'faqs' => array(
        'Is financial planning a one-time project?' => 'No. Financial planning is not a one-time event. As your business, family, income, investments, tax situation and goals change, we revisit your plan and make adjustments when appropriate.',
        'What do I need to get started?' => 'Just your questions. The best first step is a Clarity Session, where we look at your situation and identify the decisions that matter most.',
      ),
    ),

    'investment-management' => array(
      'title'    => 'Investment Management',
      'icon'     => 'chart',
      'image'    => 'services.webp',
      'photo'    => 'investment-management',          // Medios: sw-investment-management.*
      'flip'     => true,           // espejo: la persona queda a la derecha, lejos del texto
      'image_position'        => 'center 35%',   // escritorio (foto ancha)
      'image_position_mobile' => '30% center',  // móvil (foto recortada en vertical)
      'summary'  => 'Portfolios managed with your plan — no separate investment fee.',
      'hero'     => 'Portfolios designed around <span class="italic text-gold-400">your plan</span>, not around a product.',
      'subtitle' => 'Investment management is part of our ongoing relationship, with no separate investment management fee.',
      'intro'    => array(
        'We manage your investment portfolio as part of our ongoing relationship, without charging a separate investment management fee.',
        'Portfolios are designed and managed in coordination with your broader financial plan, goals, tax situation, and risk profile. We are fee-only: we never earn commissions on the investments we recommend.',
      ),
      'focus' => array(
        array('title' => 'Plan-driven portfolios',    'text' => 'Every investment decision starts from your goals and timeline.'),
        array('title' => 'Risk profile',             'text' => 'An allocation aligned with how much risk you can — and want to — take.'),
        array('title' => 'Tax-aware coordination',   'text' => 'Investment decisions coordinated with your overall tax situation.'),
        array('title' => 'Monitoring & rebalancing', 'text' => 'Ongoing oversight, with adjustments when your circumstances change.'),
        array('title' => 'No commissions',           'text' => 'We don’t sell products, so our advice stays objective.'),
        array('title' => 'No AUM fee',               'text' => 'Your fee doesn’t grow just because your portfolio does.'),
      ),
      'note' => 'Standard fund expenses and transaction costs may still apply. Investing involves risk, including possible loss of principal.',
      'faqs' => array(
        'Is there a separate fee for managing my investments?' => 'No. Investment management is part of the ongoing relationship, with no separate investment management fee. Standard fund expenses and transaction costs may still apply.',
        'Why does a flat fee matter?' => 'Many advisors charge a percentage of the assets they manage. With a flat fee, what you pay is not tied to the size of your portfolio, which removes a common conflict of interest.',
      ),
    ),

    'tax-planning' => array(
      'title'    => 'Tax Planning',
      'icon'     => 'document',
      'image'    => 'why-prudent.webp',
      'photo'    => 'tax-planning',          // Medios: sw-tax-planning.*
      'flip'     => false,
      'image_position'        => 'center 45%',   // escritorio (foto ancha)
      'image_position_mobile' => '60% center',  // móvil (foto recortada en vertical)
      'summary'  => 'Proactive tax strategy, always coordinated with your CPA.',
      'hero'     => 'Proactive tax planning, <span class="italic text-gold-400">coordinated</span> with your CPA.',
      'subtitle' => 'Taxes touch nearly every financial decision. We help you look ahead instead of only looking back.',
      'intro'    => array(
        'Tax planning is one of the areas where thoughtful decisions can make a real difference over time. Our approach is proactive: we consider the tax impact of decisions before they are made.',
        'Our tax planning is always done in collaboration with your CPA, so your advisor and your tax professional are working from the same plan.',
      ),
      'focus' => array(
        array('title' => 'Coordination with your CPA',     'text' => 'One plan, shared between your advisor and your tax professional.'),
        array('title' => 'Planning before decisions',      'text' => 'Understand the tax impact before you sell, buy or restructure.'),
        array('title' => 'Business income considerations', 'text' => 'Coordinate how business and personal decisions affect your taxes.'),
        array('title' => 'Retirement contributions',       'text' => 'Evaluate account types and contribution strategies.'),
        array('title' => 'Tax-aware investing',            'text' => 'Investment decisions made with your tax situation in mind.'),
        array('title' => 'Charitable giving',              'text' => 'Align your generosity with your overall financial plan.'),
      ),
      'note' => 'We do not replace your CPA. Tax planning is coordinated with your tax professional.',
      'faqs' => array(
        'Do I need to change CPAs?' => 'No. Our tax planning is proactive and always done in collaboration with your CPA.',
        'Is tax planning an extra cost?' => 'Tax planning and coordination is part of our ongoing wealth management relationship, offered for one flat fee starting at $4,000 per quarter.',
      ),
    ),

    'retirement-planning' => array(
      'title'    => 'Retirement Planning',
      'icon'     => 'sun',
      'image'    => 'about-flat-fee.webp',
      'photo'    => 'retirement-planning',          // Medios: sw-retirement-planning.*
      'flip'     => false,
      'image_position'        => 'center 25%',   // escritorio (foto ancha)
      'image_position_mobile' => '62% center',  // móvil (foto recortada en vertical)
      'summary'  => 'Know when you can retire and how your income will work.',
      'hero'     => 'Retire with <span class="italic text-gold-400">clarity</span> about timing, income and what comes next.',
      'subtitle' => 'Whether retirement is years away or already here, we help you plan for the life you want after work.',
      'intro'    => array(
        'Retirement raises big questions: When can I retire? How much can I spend? Which accounts should I draw from first? We help you answer them with a plan built around your goals.',
        'We work with business owners preparing for the next stage, and with retirees who want a trusted, independent advisor to help them manage their wealth.',
      ),
      'focus' => array(
        array('title' => 'Retirement goals & timing', 'text' => 'Define what retirement looks like for you, and when.'),
        array('title' => 'Retirement income',         'text' => 'A plan for turning your savings into reliable income.'),
        array('title' => 'Social Security decisions', 'text' => 'Evaluate claiming options as part of your overall plan.'),
        array('title' => 'Withdrawal strategy',       'text' => 'Coordinate which accounts to draw from, and in what order.'),
        array('title' => 'Healthcare considerations', 'text' => 'Plan for healthcare and Medicare costs in retirement.'),
        array('title' => 'Legacy goals',              'text' => 'Make sure your plan reflects what you want to leave behind.'),
      ),
      'faqs' => array(
        'Do you work with people who are already retired?' => 'Yes. Along with business owners, we work with retirees who have at least $1.5 million in investable assets.',
        'When should I start planning for retirement?' => 'The earlier the better, but it’s never too late to get clarity. A Clarity Session is a good place to start.',
      ),
    ),

    'business-owner-planning' => array(
      'title'    => 'Business Owner Planning',
      'icon'     => 'briefcase',
      'image'    => 'client-profile.webp',
      'photo'    => 'business-owner',          // Medios: sw-business-owner.*
      'flip'     => false,
      'image_position'        => 'center 25%',   // escritorio (foto ancha)
      'image_position_mobile' => '64% center',  // móvil (foto recortada en vertical)
      'summary'  => 'Planning for the business you built and the family it supports.',
      'hero'     => 'Planning for the business you built and the <span class="italic text-gold-400">family</span> it supports.',
      'subtitle' => 'For successful Latino and Latina business owners, personal and business finances are deeply connected. Your plan should be too.',
      'intro'    => array(
        'We primarily serve Latino business owners earning at least $300,000 per year in net income. We understand that your business is often your largest asset — and your biggest source of financial decisions.',
        'We help you coordinate business and personal decisions so that the success of your business translates into lasting wealth for your family.',
      ),
      'focus' => array(
        array('title' => 'Business & personal cash flow', 'text' => 'Bring clarity to how money moves between your business and your household.'),
        array('title' => 'Retirement plans for owners',   'text' => 'Evaluate retirement plan options available to business owners.'),
        array('title' => 'Tax coordination',              'text' => 'Work with your CPA on decisions that affect both business and personal taxes.'),
        array('title' => 'Wealth outside the business',   'text' => 'Build assets beyond the business to reduce concentration risk.'),
        array('title' => 'Risk management',               'text' => 'Review protections for you, your family and your business.'),
        array('title' => 'Succession & exit',             'text' => 'Start thinking early about the future of what you built.'),
      ),
      'faqs' => array(
        'Who do you typically work with?' => 'We primarily serve Latino business owners earning at least $300,000 per year in net income, and retirees with at least $1.5 million in investable assets. We also welcome other households looking for a long-term planning relationship.',
        'Do you work with my business advisors?' => 'Yes. We coordinate with the professionals you already work with, such as your CPA and attorney, so everyone is working toward the same goals.',
      ),
    ),

    'estate-risk-planning' => array(
      'title'    => 'Estate & Risk Planning',
      'icon'     => 'shield',
      'image'    => 'why-fiduciary.webp',
      'photo'    => 'estate-risk',          // Medios: sw-estate-risk.*
      'flip'     => false,
      'image_position'        => 'center 30%',   // escritorio (foto ancha)
      'image_position_mobile' => '50% center',  // móvil (foto recortada en vertical)
      'summary'  => 'Protect what you’ve built and the people who depend on you.',
      'hero'     => 'Protect what you’ve built and the <span class="italic text-gold-400">people</span> who depend on you.',
      'subtitle' => 'Insurance analysis and estate planning coordination, so your family and your wealth are prepared for the unexpected.',
      'intro'    => array(
        'A strong financial plan doesn’t only grow wealth — it protects it. We review the risks you face and help you decide how to address them.',
        'We also help you organize your estate planning goals and coordinate with your estate planning attorney, so your wishes are clear and your documents stay aligned with your plan.',
      ),
      'focus' => array(
        array('title' => 'Insurance analysis',      'text' => 'Review life, disability and liability coverage against your real needs.'),
        array('title' => 'Estate planning goals',   'text' => 'Clarify how you want your wealth to be passed on.'),
        array('title' => 'Attorney coordination',   'text' => 'Work alongside your estate planning attorney on implementation.'),
        array('title' => 'Beneficiary review',      'text' => 'Keep account beneficiaries consistent with your wishes.'),
        array('title' => 'Family protection',       'text' => 'Plan for the people who depend on you.'),
        array('title' => 'Legacy',                  'text' => 'Make sure your plan reflects the values you want to pass on.'),
      ),
      'note' => 'Sophronia does not provide legal advice. Estate documents should be prepared by a qualified attorney.',
      'faqs' => array(
        'Do you sell insurance?' => 'No. We are fee-only and do not earn commissions, so our insurance analysis is independent and objective.',
        'Do you draft wills or trusts?' => 'No. We help you define your goals and coordinate with your estate planning attorney, who prepares the legal documents.',
      ),
    ),
  );
}

/** Datos de un servicio por slug (o null). */
function sophronia_service($slug) {
  $all = sophronia_services();
  return $all[$slug] ?? null;
}

/** URL de la subpágina de un servicio. */
function sophronia_service_url($slug) {
  return sophronia_page_url('services/' . $slug);
}
