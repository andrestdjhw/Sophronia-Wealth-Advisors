<?php
/**
 * Datos centrales del sitio (contacto, navegación, avisos legales).
 * Se usan en los templates PHP y se pasan a React como window.sophroniaData.
 * Para cambiar un teléfono, link o aviso, se edita SOLO aquí.
 */

if (!defined('ABSPATH')) exit;

/** URL de una imagen dentro de assets/images */
function sophronia_img($path) {
  return get_theme_file_uri('assets/images/' . ltrim($path, '/'));
}

/** URL de una página del sitio a partir de su slug (con fallback si no existe). */
function sophronia_page_url($slug) {
  $page = get_page_by_path($slug);
  return $page ? get_permalink($page) : home_url('/' . $slug . '/');
}

/** Items del mega menú de Services (sale de inc/services-data.php). */
function sophronia_services_menu() {
  $items = array();
  foreach (sophronia_services() as $slug => $sv) {
    $items[] = array(
      'label' => $sv['title'],
      'url'   => sophronia_service_url($slug),
      'icon'  => $sv['icon'],
      'desc'  => $sv['summary'],
    );
  }
  return $items;
}

function sophronia_site_data() {
  static $data = null;
  if ($data !== null) return $data;

  $data = array(
    'name'    => 'Sophronia Wealth Advisors',
    'legalName' => 'Sophronia Wealth Advisors, Inc.',
    'tagline' => 'Flat fee-only fiduciary wealth management for successful Latino business owners.',

    'homeUrl' => home_url('/'),
    'logo'    => sophronia_img('logo.webp'),

    'nav' => array(
      array('label' => 'Home',       'url' => home_url('/')),
      array('label' => 'About',      'url' => sophronia_page_url('about')),
      array('label' => 'Services',   'url' => sophronia_page_url('services'), 'children' => sophronia_services_menu()),
      array('label' => 'FAQs',       'url' => sophronia_page_url('faqs')),
      array('label' => 'Contact Us', 'url' => sophronia_page_url('contact-us')),
    ),
    'cta' => array(
      'label' => 'Schedule a Clarity Session',
      'url'   => sophronia_page_url('clarity-session'),
    ),

    // Herramienta externa de agenda
    'bookingUrl' => 'https://bookme.name/miguelgomez/lite/discovery-session',

    'contact' => array(
      'phone'        => '949-695-8533',
      'phoneHref'    => 'tel:+19496958533',
      'addressLine1' => '311 Montana Ave. A2-12',
      'addressLine2' => 'El Paso, TX 79902',
      'mapUrl'       => 'https://maps.app.goo.gl/iUrwig68iyEuDrXL6',
      'hours'        => 'Meetings are by appointment only.',
      'contactUrl'   => sophronia_page_url('contact-us'),
    ),

    'social' => array(
      array('name' => 'Instagram', 'icon' => 'instagram', 'url' => 'https://www.instagram.com/dineroenespanol'),
      array('name' => 'Facebook',  'icon' => 'facebook',  'url' => 'https://www.facebook.com/miguelgomezconsejero'),
      array('name' => 'TikTok',    'icon' => 'tiktok',    'url' => 'https://www.tiktok.com/@miguelgomezconsejero'),
    ),

    'affiliations' => array(
      array('name' => 'CFP Board – Certified Financial Planner', 'img' => sophronia_img('affiliations/cfp.webp'),   'url' => 'https://certificates.cfp.net/a2e25b5f-43af-4c2d-b49a-d89caa0e8c56'),
      array('name' => 'Fee-Only Network',                         'img' => sophronia_img('affiliations/fon.webp'),   'url' => ''),
      array('name' => 'XY Planning Network Member',               'img' => sophronia_img('affiliations/xypn.webp'),  'url' => 'https://connect.xyplanningnetwork.com/find-an-advisor/miguel-gomez-garcia-65407'),
      array('name' => 'NAPFA',                                    'img' => sophronia_img('affiliations/napfa.webp'), 'url' => 'https://www.napfa.org/firm/51457/42778'),
      array('name' => 'National Association of Enrolled Agents',  'img' => sophronia_img('affiliations/naea.webp'),  'url' => ''),
    ),

    'legalLinks' => array(
      array('label' => 'Investment Adviser Public Disclosure', 'url' => 'https://reports.adviserinfo.sec.gov/reports/ADV/329967/PDF/329967.pdf'),
      array('label' => 'Form ADV Part 2 – Brochure Supplement', 'url' => 'https://files.adviserinfo.sec.gov/IAPD/Content/Common/crd_iapd_Brochure.aspx?BRCHR_VRSN_ID=1020816'),
      array('label' => 'Privacy Policy', 'url' => get_theme_file_uri('assets/docs/privacy-policy.pdf')),
    ),

    // Texto regulatorio tomado tal cual del sitio actual. No modificar sin revisión de cumplimiento.
    'disclosures' => array(
      'Sophronia Wealth Advisors (“Sophronia”) is a registered investment advisor offering advisory services in the States of Texas, California, and in other jurisdictions where exempt. Registration does not imply a certain level of skill or training.',
      'The information on this site is not intended as tax, accounting or legal advice, as an offer or solicitation of an offer to buy or sell, or as an endorsement of any company, security, fund, or other securities or non-securities offering. This information should not be relied upon as the sole factor in an investment making decision.',
      'Past performance is no indication of future results. Investment in securities involves significant risk and has the potential for partial or complete loss of funds invested. It should not be assumed that any recommendations made will be profitable or equal any performance noted on this site.',
      'The information on this site is provided “AS IS” and without warranties of any kind either express or implied. To the fullest extent permissible pursuant to applicable laws, Sophronia Wealth Advisors, Inc. disclaims all warranties, express or implied, including, but not limited to, implied warranties of merchantability, non-infringement, and suitability for a particular purpose.',
      'Sophronia does not warrant that the information on this site will be free from error. Your use of the information is at your sole risk. Under no circumstances shall Sophronia be liable for any direct, indirect, special or consequential damages that result from the use of, or the inability to use, the information provided on this site, even if Sophronia or a Sophronia authorized representative has been advised of the possibility of such damages. Information contained on this site should not be considered a solicitation to buy, an offer to sell, or a recommendation of any security in any jurisdiction where such offer, solicitation, or recommendation would be unlawful or unauthorized.',
    ),
    'representativeNote' => 'Miguel Angel Gomez Garcia is an Investment Adviser Representative.',

    // Para el formulario de contacto (REST API)
    'api' => array(
      'contact' => esc_url_raw(rest_url('sophronia/v1/contact')),
      'nonce'   => wp_create_nonce('wp_rest'),
    ),
  );

  return $data;
}
