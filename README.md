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

- Foto reali di cantieri/lavori (attualmente il sito usa solo il logo vettoriale).
- Eventuale dominio definitivo (nel codice è impostato un dominio segnaposto `electricalcoresnc.it`).
- Social network, se l'azienda ne attiva.
