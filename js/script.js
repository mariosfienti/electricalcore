// Electrical Core SNC — sito vetrina

document.getElementById('year').textContent = new Date().getFullYear();

// Menu mobile
const navToggle = document.getElementById('navToggle');
const primaryNav = document.getElementById('primaryNav');

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

// Form di contatto: prepara un'email pre-compilata (nessun backend collegato)
const contactForm = document.getElementById('contactForm');
const formNote = document.getElementById('formNote');

contactForm.addEventListener('submit', (event) => {
  event.preventDefault();

  if (!contactForm.checkValidity()) {
    contactForm.reportValidity();
    return;
  }

  const nome = document.getElementById('nome').value.trim();
  const telefono = document.getElementById('telefono').value.trim();
  const email = document.getElementById('email').value.trim();
  const messaggio = document.getElementById('messaggio').value.trim();

  const subject = encodeURIComponent(`Richiesta preventivo da ${nome}`);
  const body = encodeURIComponent(
    `Nome: ${nome}\nTelefono: ${telefono}\nEmail: ${email}\n\nMessaggio:\n${messaggio}`
  );

  window.location.href = `mailto:electricalcoresnc@gmail.com?subject=${subject}&body=${body}`;

  formNote.textContent = 'Si aprirà il tuo programma di posta con la richiesta già compilata: invia l\'email per completare.';
  formNote.classList.add('success');
});
