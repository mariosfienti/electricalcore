# Tema WordPress "Electrical Core"

Tema custom che porta 1:1 il design del sito statico (`index.html`, `css/style.css`,
`js/script.js`, `servizi/*.html`) dentro WordPress, così il cliente può modificare
i contenuti dal pannello di amministrazione senza toccare codice.

## Cosa serve per installarlo

1. **WordPress** installato (su hosting o in locale, es. LocalWP/XAMPP, o su un
   servizio di test gratuito come InstaWP).
2. Il plugin gratuito **Advanced Custom Fields** (ACF) — cercalo e installalo da
   Bacheca → Plugin → Aggiungi nuovo. **Senza questo plugin i campi che rendono
   il sito modificabile non compaiono** (comparirà un avviso in bacheca finché
   non è attivo).
   - Il tema usa solo funzioni della versione **gratuita** di ACF: non serve
     comprare ACF PRO. (Per questo alcuni elenchi — badge, punti elenco dei
     servizi — sono campi "una voce per riga" invece di liste flessibili: è la
     scelta più semplice che non richiede spese aggiuntive. Se in futuro vorrai
     liste illimitate/riordinabili, si può passare ad ACF PRO, a pagamento.)
3. Copia la cartella `electricalcore` (questa cartella) dentro
   `wp-content/themes/` del tuo WordPress, poi attivala da Aspetto → Temi.
4. (Consigliato) Installa il plugin gratuito **WP Mail SMTP** e configuralo con
   l'account email che riceverà le richieste dal form contatti. Molti hosting
   (incluso spesso Aruba/Register su piani base) bloccano o marcano come spam
   le email inviate con la funzione PHP nativa: SMTP risolve il problema.

## Primo avvio: importa i contenuti reali

Appena attivato il tema, tutte le pagine sono vuote. Per popolare subito il sito
con **gli stessi contenuti veri del sito originale** (testi, contatti, i 5
servizi con tutte le schede/FAQ, la pagina Privacy):

1. Vai in bacheca su **Impostazioni Sito → Importa contenuti demo**.
2. Premi il pulsante "Importa contenuti di esempio".
3. Apri il sito: dovrebbe apparire identico (nei contenuti) al sito statico.

Puoi rilanciare l'importazione in qualsiasi momento: aggiorna i contenuti
esistenti invece di duplicarli (utile se pasticci troppo con un campo e vuoi
ripartire dal testo originale).

## Come il cliente modifica i contenuti

Tutto si edita da voci di menu semplici in bacheca, senza mai toccare codice:

| Cosa vuole cambiare | Dove andare |
|---|---|
| Telefono, email, indirizzo, P.IVA | **Impostazioni Sito → Impostazioni Sito**, tab "Contatti" |
| Titolo/testo della prima schermata (hero) | **Impostazioni Sito**, tab "Homepage - Hero" |
| Testo "Chi siamo" e i 3 punti di forza | **Impostazioni Sito**, tab "Homepage - Chi siamo" |
| Testo e zone servite in "Dove siamo" | **Impostazioni Sito**, tab "Homepage - Dove siamo" |
| Frase nel footer | **Impostazioni Sito**, tab "Footer" |
| Testi/immagini di un singolo servizio (es. "Impianti elettrici") | Menu **Servizi** → apri il servizio → modifica i campi nelle varie schede (Scheda, Testata pagina, Ambiti di intervento, Come lavoriamo, FAQ) |
| Foto del servizio (card + testata pagina) | Nel servizio, riquadro "Immagine in evidenza" a destra |
| Ordine con cui i servizi compaiono nel menu e in homepage | Nel servizio, riquadro "Attributi pagina" → campo "Ordine" (0 = primo) |
| Testo della pagina Privacy | Pagine → Informativa Privacy |
| Aggiungere un nuovo servizio | **Servizi → Aggiungi nuovo**, compila i campi come negli altri |

Per i campi "una voce per riga" (badge, elenchi puntati): basta scrivere ogni
voce su una riga diversa nella casella di testo, il sito la trasforma
automaticamente in un elenco puntato.

## Come funziona il form contatti

Il form non usa più Formspree (servizio esterno a pagamento oltre una certa
soglia): invia l'email direttamente tramite WordPress (`wp_mail`), all'indirizzo
impostato in Impostazioni Sito → Contatti → Email. Se le email non arrivano,
installa e configura **WP Mail SMTP** (vedi sopra) — è quasi sempre necessario
su hosting condiviso.

## Struttura dei file del tema

```
style.css                 intestazione tema (richiesta da WordPress)
functions.php              carica i file in inc/
header.php / footer.php     intestazione e piè di pagina, con menu Servizi dinamico
front-page.php               homepage one-page
single-servizio.php           pagina di dettaglio di un Servizio
page.php                     pagina generica (es. Privacy)
inc/
  theme-setup.php            enqueue CSS/JS, dimensioni immagini
  cpt-servizi.php             registra il tipo di contenuto "Servizio"
  acf-fields.php               tutti i campi personalizzati editabili
  contact-form.php              invio email del form contatti
  seed-admin.php                 pagina "Importa contenuti demo"
  helpers.php                    funzioni di supporto
seed/
  seed-content.php                logica di importazione contenuti
  seed-servizi-data.php            testi reali dei 5 servizi
assets/
  css/main.css                stile del sito (identico all'originale)
  js/script.js                  menu, animazioni, form, cookie banner
  images/                        loghi, foto, favicon
template-parts/
  contact-form.php              form contatti riutilizzato in più pagine
```

## Cosa NON è (ancora) stato portato

- Nessun sistema di **anteprima**/staging: testalo su un WordPress di prova
  (locale o hosting gratuito) prima di installarlo sul sito definitivo, come
  già fatto per la versione statica su Netlify.
- Il tema non installa automaticamente plugin SEO (Yoast, Rank Math): se
  servono meta description/sitemap personalizzate per pagina, vanno aggiunte
  con un plugin SEO a parte.
