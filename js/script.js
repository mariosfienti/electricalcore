// Electrical Core SNC — script di navigazione e interazione

// Animazione d'ingresso dell'hero al caricamento (testo, poi foto)
document.querySelectorAll('.reveal-onload').forEach((el, i) => {
  requestAnimationFrame(() => {
    setTimeout(() => el.classList.add('in'), 120 + i * 150);
  });
});

// Reveal all'entrata nel viewport (l'hero è gestito a parte, sopra, con l'animazione al caricamento)
const revealEls = document.querySelectorAll('.reveal:not(.in):not(.reveal-onload), .reveal-stagger:not(.in):not(.reveal-onload)');
if (revealEls.length && 'IntersectionObserver' in window) {
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });
  revealEls.forEach((el) => revealObserver.observe(el));
} else {
  revealEls.forEach((el) => el.classList.add('in'));
}

const yearEl = document.getElementById('year');
if (yearEl) {
  yearEl.textContent = new Date().getFullYear();
}

// Menu mobile
const navToggle = document.getElementById('navToggle');
const primaryNav = document.getElementById('primaryNav');

if (navToggle && primaryNav) {
  navToggle.addEventListener('click', () => {
    const isOpen = primaryNav.classList.toggle('open');
    navToggle.setAttribute('aria-expanded', String(isOpen));
  });

  // Il toggle "Servizi" è escluso: su mobile il suo click apre/chiude solo il
  // sottomenu (gestito più sotto) e non deve richiudere tutto il pannello.
  primaryNav.querySelectorAll('a:not(.nav-dropdown-toggle)').forEach((link) => {
    link.addEventListener('click', () => {
      primaryNav.classList.remove('open');
      navToggle.setAttribute('aria-expanded', 'false');
    });
  });
}

// Dropdown Servizi (desktop click & mobile expand)
const servicesDropdown = document.getElementById('servicesDropdown');
const servicesToggle = document.getElementById('servicesToggle');

if (servicesDropdown && servicesToggle) {
  servicesToggle.addEventListener('click', (e) => {
    // Su mobile il menu è a comparsa (non c'è hover): tutta la riga "Servizi"
    // apre/chiude il sottomenu, altrimenti la freccina da toccare è troppo
    // piccola per un tap preciso e il sottomenu non si riesce mai ad aprire.
    // Su desktop invece il testo naviga alla sezione in home e solo la
    // freccina apre/chiude l'anteprima del sottomenu senza navigare.
    const isMobile = window.matchMedia('(max-width: 720px)').matches;
    if (isMobile || e.target.closest('.dropdown-chevron')) {
      e.preventDefault();
      e.stopPropagation();
      const isActive = servicesDropdown.classList.toggle('is-active');
      servicesToggle.setAttribute('aria-expanded', String(isActive));
    } else {
      servicesDropdown.classList.remove('is-active');
      servicesToggle.setAttribute('aria-expanded', 'false');
    }
  });

  // Chiudi cliccando fuori
  document.addEventListener('click', (e) => {
    if (!servicesDropdown.contains(e.target)) {
      servicesDropdown.classList.remove('is-active');
      servicesToggle.setAttribute('aria-expanded', 'false');
    }
  });

  // Chiudi premendo Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      servicesDropdown.classList.remove('is-active');
      servicesToggle.setAttribute('aria-expanded', 'false');
    }
  });
}

// Form di contatto: invio diretto via FormSubmit (nessun client di posta
// richiesto sul dispositivo del visitatore — prima il "mailto:" non
// funzionava per chi non aveva un programma di posta configurato/collegato).
const contactForm = document.getElementById('contactForm');
const formNote = document.getElementById('formNote');

if (contactForm) {
  contactForm.addEventListener('submit', (event) => {
    event.preventDefault();

    if (!contactForm.checkValidity()) {
      contactForm.reportValidity();
      return;
    }

    const nome = document.getElementById('nome')?.value.trim() || '';
    const telefono = document.getElementById('telefono')?.value.trim() || '';
    const email = document.getElementById('email')?.value.trim() || '';
    const servizio = document.getElementById('servizio')?.value.trim() || 'Generale';
    const messaggio = document.getElementById('messaggio')?.value.trim() || '';

    const submitBtn = contactForm.querySelector('button[type="submit"]');
    const originalBtnLabel = submitBtn ? submitBtn.textContent : '';
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = 'Invio in corso…';
    }
    if (formNote) {
      formNote.textContent = '';
      formNote.classList.remove('success', 'error');
    }

    const payload = new FormData();
    payload.append('Nome', nome);
    payload.append('Telefono', telefono);
    payload.append('Email', email || 'non indicata');
    payload.append('Servizio di interesse', servizio);
    payload.append('Messaggio', messaggio);
    payload.append('_subject', `Richiesta preventivo [${servizio}] - ${nome}`);
    payload.append('_template', 'table');
    payload.append('_captcha', 'false');

    fetch('https://formsubmit.co/ajax/info@electricalcore.it', {
      method: 'POST',
      headers: { Accept: 'application/json' },
      body: payload,
    })
      .then((res) => {
        if (!res.ok) throw new Error('Invio non riuscito');
        return res.json();
      })
      .then(() => {
        contactForm.reset();
        if (formNote) {
          formNote.textContent = 'Richiesta inviata! Ti risponderemo il prima possibile.';
          formNote.classList.add('success');
        }
      })
      .catch(() => {
        if (formNote) {
          formNote.textContent = 'Invio non riuscito. Chiamaci al 338 4444117, scrivici su WhatsApp o a info@electricalcore.it.';
          formNote.classList.add('error');
        }
      })
      .finally(() => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.textContent = originalBtnLabel;
        }
      });
  });
}

// Cookie banner e caricamento condizionato di Google Maps
const COOKIE_CONSENT_KEY = 'ecsnc_cookie_consent'; // 'accepted' | 'rejected'

function getCookieConsent() {
  try {
    return localStorage.getItem(COOKIE_CONSENT_KEY);
  } catch (e) {
    return null;
  }
}

function setCookieConsent(value) {
  try {
    localStorage.setItem(COOKIE_CONSENT_KEY, value);
  } catch (e) {
    // localStorage non disponibile: la scelta non viene salvata, il banner ricomparirà
  }
}

function loadMap() {
  const mapContainer = document.getElementById('mapContainer');
  if (!mapContainer || mapContainer.querySelector('iframe')) return;
  const src = mapContainer.getAttribute('data-map-src');
  if (!src) return;
  mapContainer.innerHTML = `<iframe
    title="Mappa: Electrical Core SNC - Frazione Bardella 34, Castelnuovo Don Bosco"
    src="${src}"
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"
    allowfullscreen></iframe>`;
}

function hideCookieBanner() {
  const banner = document.getElementById('cookieBanner');
  if (banner) banner.classList.remove('visible');
  syncBackToTopOffset();
}

function buildCookieBanner() {
  const banner = document.createElement('div');
  banner.className = 'cookie-banner';
  banner.id = 'cookieBanner';
  banner.setAttribute('role', 'dialog');
  banner.setAttribute('aria-label', 'Informativa sui cookie');
  banner.innerHTML = `
    <div class="container cookie-banner-inner">
      <p>Utilizziamo solo cookie tecnici necessari al funzionamento del sito. La mappa di Google Maps nella sezione "Dove siamo" utilizza cookie di terze parti e viene caricata solo con il tuo consenso. <a href="/privacy.html">Maggiori informazioni</a>.</p>
      <div class="cookie-banner-actions">
        <button type="button" class="btn btn-reject" id="cookieReject">Rifiuta</button>
        <button type="button" class="btn btn-accept" id="cookieAccept">Accetta</button>
      </div>
    </div>
  `;
  document.body.appendChild(banner);

  document.getElementById('cookieAccept').addEventListener('click', () => {
    setCookieConsent('accepted');
    hideCookieBanner();
    loadMap();
  });
  document.getElementById('cookieReject').addEventListener('click', () => {
    setCookieConsent('rejected');
    hideCookieBanner();
  });
}

// Pulsante "torna su": iniettato in ogni pagina, compare dopo un po' di scroll.
// Creato prima del banner cookie qui sotto, così può spostarsi sopra di esso
// quando il banner è visibile (altrimenti il banner, a tutta larghezza, lo
// coprirebbe completamente).
const backToTop = document.createElement('button');
backToTop.type = 'button';
backToTop.className = 'back-to-top';
backToTop.setAttribute('aria-label', 'Torna all\'inizio della pagina');
backToTop.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 19V5M5 12l7-7 7 7"/></svg>';
document.body.appendChild(backToTop);

function toggleBackToTop() {
  backToTop.classList.toggle('visible', window.scrollY > 480);
}
window.addEventListener('scroll', toggleBackToTop, { passive: true });
toggleBackToTop();

backToTop.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

function syncBackToTopOffset() {
  const banner = document.getElementById('cookieBanner');
  if (banner && banner.classList.contains('visible')) {
    backToTop.style.bottom = (banner.getBoundingClientRect().height + 16) + 'px';
  } else {
    backToTop.style.bottom = '';
  }
}
window.addEventListener('resize', syncBackToTopOffset);

function showCookieBanner() {
  let banner = document.getElementById('cookieBanner');
  if (!banner) {
    buildCookieBanner();
    banner = document.getElementById('cookieBanner');
  }
  requestAnimationFrame(() => {
    banner.classList.add('visible');
    syncBackToTopOffset();
  });
}

const cookieConsent = getCookieConsent();
if (cookieConsent === 'accepted') {
  loadMap();
} else if (cookieConsent !== 'rejected') {
  showCookieBanner();
}

const loadMapBtn = document.getElementById('loadMapBtn');
if (loadMapBtn) {
  loadMapBtn.addEventListener('click', loadMap);
}

// Link "Preferenze cookie" nel footer: riapre il banner per cambiare scelta
document.querySelectorAll('.cookie-prefs-link').forEach((link) => {
  link.addEventListener('click', (e) => {
    e.preventDefault();
    showCookieBanner();
  });
});

