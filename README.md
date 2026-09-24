# Electrical Core SNC — sito vetrina

Sito statico one-page (HTML/CSS/JS puro, nessuna build richiesta) per **Electrical Core SNC**, impresa di impiantistica elettrica con sede a Castelnuovo Don Bosco (AT).

## Struttura

```
index.html       pagina unica (hero, servizi, chi siamo, zona operativa, contatti)
css/style.css     stile del sito
js/script.js      menu mobile, anno dinamico, invio form via mailto
assets/logo.svg   logo vettoriale (adattamento del logo su biglietto da visita)
assets/favicon.svg
```

## Contenuti usati (dal biglietto da visita)

- Ragione sociale: Electrical Core SNC
- Slogan: "Ti connettiamo al futuro"
- Indirizzo: Frazione Bardella 34, 14022 Castelnuovo Don Bosco (AT)
- P.IVA: 01767090051
- Email: electricalcoresnc@gmail.com
- Telefoni: 338 4444117 · 327 5669119
- Servizi: impianti elettrici civili ed industriali, antifurti e videosorveglianza, videocitofonia, automazioni cancelli, antenne e reti dati

## Come vederlo in locale

Basta aprire `index.html` in un browser, oppure servirlo con un server statico qualsiasi, ad es.:

```bash
npx serve .
```

## Pubblicazione

Il sito non richiede build né database: si può pubblicare su qualsiasi hosting statico.

- **GitHub Pages**: crea un repository, carica questi file, attiva Pages sul branch principale.
- **Netlify / Vercel**: trascina la cartella nel pannello di deploy, oppure collega un repository Git.
- Serve solo un dominio (es. electricalcoresnc.it) da puntare all'hosting scelto.

## Modulo contatti

Il form contatti non è collegato a un backend: alla conferma apre un'email precompilata verso `electricalcoresnc@gmail.com` tramite `mailto:`. Per ricevere le richieste direttamente via form (senza aprire il client di posta), si può collegare un servizio come [Formspree](https://formspree.io) o [EmailJS](https://www.emailjs.com/): basta sostituire la gestione del submit in `js/script.js` con una chiamata al servizio scelto.

## Da personalizzare quando disponibili

- Eventuale dominio definitivo (nel codice è impostato un dominio segnaposto `electricalcoresnc.it`).
- Social network, se l'azienda ne attiva.

## Caricamento foto lavori (area riservata `/admin`)

Il cliente può caricare in autonomia le foto dei lavori realizzati, una per servizio, tramite una piccola area riservata — senza toccare testi o struttura del sito.

**Come funziona**
- `/admin/index.php` — form di login (password) + upload foto + gestione/eliminazione delle foto già caricate, con selezione del servizio da un menu a tendina.
- Le foto vengono ridimensionate (lato massimo 1920px) e convertite in `.webp` lato server (libreria GD di PHP), poi salvate in `/uploads/<slug-servizio>/`.
- Ogni cartella `/uploads/<slug-servizio>/gallery.json` elenca le foto di quel servizio; le pagine `servizi/*.html` leggono questo file via JavaScript e mostrano la galleria nella sezione "I nostri lavori".
- Nessun database: solo file system, compatibile con l'hosting Aruba Basic Linux già attivo (che non include MySQL).

**Setup all'attivazione (una tantum)**
1. Copiare `admin/credentials.example.php` in `admin/credentials.php` e generare l'hash della password del cliente:
   ```bash
   php -r "echo password_hash('la-password-del-cliente', PASSWORD_DEFAULT), PHP_EOL;"
   ```
   Incollare l'hash ottenuto in `admin/credentials.php`. **Questo file non va mai versionato** (è già escluso da `.gitignore`).
2. Verificare che l'hosting abbia il modulo GD di PHP attivo (di norma già presente su Aruba Linux).
3. Facoltativo ma consigliato: proteggere ulteriormente la cartella `/admin/` anche con lo strumento nativo "Protezione Directory" del pannello Aruba, come livello di sicurezza aggiuntivo rispetto al login applicativo.
4. Comunicare al cliente l'URL (`https://<dominio>/admin/`) e la password scelta.
