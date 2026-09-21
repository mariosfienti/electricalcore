// Electrical Core SNC — script di navigazione e interazione

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

  primaryNav.querySelectorAll('a').forEach((link) => {
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
    // Click sulla freccina: apre/chiude il sottomenu senza navigare.
    // Click sulla voce "Servizi": naviga normalmente alla sezione in home.
    if (e.target.closest('.dropdown-chevron')) {
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

// Form di contatto: prepara un'email pre-compilata
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

    const subject = encodeURIComponent(`Richiesta preventivo [${servizio}] - ${nome}`);
    const body = encodeURIComponent(
      `Nome: ${nome}\nTelefono: ${telefono}\nEmail: ${email}\nServizio di interesse: ${servizio}\n\nMessaggio:\n${messaggio}`
    );

    window.location.href = `mailto:electricalcoresnc@gmail.com?subject=${subject}&body=${body}`;

    if (formNote) {
      formNote.textContent = 'Si aprirà il tuo programma di posta con la richiesta già compilata: invia l\'email per completare.';
      formNote.classList.add('success');
    }
  });
}

