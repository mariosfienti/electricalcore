<?php
/**
 * Importazione automatica dei contenuti reali del sito Electrical Core SNC.
 *
 * Serve a popolare da subito le Impostazioni Sito, i 5 Servizi e la pagina
 * Privacy con lo stesso testo del sito statico originale, così il tema
 * funziona da subito con contenuti veri invece che con campi vuoti.
 *
 * Si esegue una sola volta, in due modi possibili:
 *  1) Dalla bacheca di WordPress: menu "Impostazioni Sito" -> pulsante
 *     "Importa contenuti di esempio" (vedi inc/seed-admin.php).
 *  2) Da riga di comando, se hai accesso WP-CLI:
 *     wp eval-file wp-content/themes/electricalcore/seed/seed-content.php
 *
 * È sicuro rilanciarlo più volte: aggiorna i contenuti esistenti invece di
 * duplicarli (i servizi vengono riconosciuti dallo slug).
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Carica un'immagine del tema nella libreria media (una sola volta: se è
 * già stata importata in un run precedente, riusa quella esistente) e
 * restituisce l'ID allegato.
 */
function ec_seed_local_image($relative_path, $description) {
    $marker_key = '_ec_seed_source';
    $existing = get_posts([
        'post_type' => 'attachment',
        'meta_key' => $marker_key,
        'meta_value' => $relative_path,
        'posts_per_page' => 1,
        'post_status' => 'inherit',
    ]);
    if ($existing) {
        return $existing[0]->ID;
    }

    $file_path = get_template_directory() . '/assets/images/' . $relative_path;
    if (!file_exists($file_path)) {
        return 0;
    }

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $filetype = wp_check_filetype(basename($file_path));
    $upload = wp_upload_bits(basename($file_path), null, file_get_contents($file_path));
    if ($upload['error']) {
        return 0;
    }

    $attachment_id = wp_insert_attachment([
        'post_mime_type' => $filetype['type'],
        'post_title' => $description,
        'post_status' => 'inherit',
    ], $upload['file']);

    $metadata = wp_generate_attachment_metadata($attachment_id, $upload['file']);
    wp_update_attachment_metadata($attachment_id, $metadata);
    update_post_meta($attachment_id, $marker_key, $relative_path);

    return $attachment_id;
}

function ec_seed_servizio($data) {
    $existing = get_page_by_path($data['slug'], OBJECT, 'servizio');

    $post_args = [
        'post_type' => 'servizio',
        'post_title' => $data['title'],
        'post_name' => $data['slug'],
        'post_excerpt' => $data['excerpt'],
        'post_status' => 'publish',
        'menu_order' => $data['menu_order'],
    ];

    if ($existing) {
        $post_args['ID'] = $existing->ID;
        $post_id = wp_update_post($post_args);
    } else {
        $post_id = wp_insert_post($post_args);
    }

    if (!$post_id || is_wp_error($post_id)) {
        return false;
    }

    foreach ($data['fields'] as $field_name => $value) {
        update_field($field_name, $value, $post_id);
    }

    if (!empty($data['image'])) {
        $attachment_id = ec_seed_local_image('services/' . $data['image'], $data['title']);
        if ($attachment_id) {
            set_post_thumbnail($post_id, $attachment_id);
        }
    }

    return $post_id;
}

function ec_run_seed_content() {
    if (!function_exists('update_field')) {
        return ['ok' => false, 'message' => 'Il plugin Advanced Custom Fields non è attivo: attivalo e riprova.'];
    }

    // --- Impostazioni Sito ---
    $options = [
        'telefono_principale' => '338 4444117',
        'telefono_secondario' => '327 5669119',
        'email' => 'info@electricalcore.it',
        'whatsapp_numero' => '338 4444117',
        'indirizzo' => 'Frazione Bardella 34',
        'cap' => '14022',
        'comune' => 'Castelnuovo Don Bosco',
        'provincia_sigla' => 'AT',
        'piva' => '01767090051',
        'ragione_sociale_legale' => 'Electrical Core S.N.C. di Dumbrava Mihai Lucian e Duma Felician',
        'google_maps_query' => 'Frazione Bardella 34, 14022 Castelnuovo Don Bosco AT',
        'hero_eyebrow' => 'Impianti elettrici civili e industriali',
        'hero_titolo' => 'Sicurezza, tecnologia e affidabilità per la tua casa e la tua impresa',
        'hero_testo' => "Electrical Core SNC progetta e installa impianti elettrici, sistemi antifurto, videosorveglianza, videocitofonia, automazioni per cancelli e reti dati con sede a Castelnuovo Don Bosco e operatività nelle province di Asti, Torino e Cuneo.",
        'hero_badges' => "Preventivi gratuiti\nInterventi civili e industriali\nAsti, Torino e Cuneo",
        'chi_siamo_eyebrow' => 'Chi siamo',
        'chi_siamo_titolo' => 'Esperienza elettrotecnica al servizio di casa e impresa',
        'chi_siamo_testo_1' => "Electrical Core SNC è un'impresa elettrotecnica con sede a Castelnuovo Don Bosco, in provincia di Asti. Seguiamo i nostri clienti dal sopralluogo al collaudo, con impianti a norma e soluzioni pensate per durare nel tempo.",
        'chi_siamo_testo_2' => "Lavoriamo con privati, professionisti e aziende su tutto il territorio delle province di Asti, Torino, Cuneo e del Piemonte, offrendo un servizio diretto e senza intermediari: preventivo chiaro, tempi certi e assistenza anche dopo la fine dei lavori.",
        'punto1_titolo' => 'Preventivi gratuiti',
        'punto1_desc' => 'Sopralluogo e preventivo senza impegno prima di ogni intervento.',
        'punto2_titolo' => 'Impianti a norma',
        'punto2_desc' => 'Lavori eseguiti secondo le normative vigenti, con rilascio di dichiarazione di conformità.',
        'punto3_titolo' => 'Assistenza continua',
        'punto3_desc' => "Supporto rapido e manutenzione anche dopo l'installazione degli impianti.",
        'dove_siamo_testo' => "La nostra sede operativa si trova in Frazione Bardella 34, a Castelnuovo Don Bosco (AT). Dalla nostra posizione centrale e strategica, interveniamo con rapidità ed efficienza su tutto il territorio circostante per qualsiasi esigenza civile e industriale.",
        'provincia1_nome' => 'Provincia di Asti',
        'provincia1_comuni' => "Castelnuovo Don Bosco, Monferrato, Villanova d'Asti, Asti e comuni limitrofi.",
        'provincia2_nome' => 'Provincia di Torino',
        'provincia2_comuni' => 'Chieri, Carmagnola, Riva presso Chieri, cintura sud-est e area torinese.',
        'provincia3_nome' => 'Provincia di Cuneo',
        'provincia3_comuni' => 'Area Roero, Alba, Bra e comuni della provincia cuneese.',
        'footer_tagline' => 'Impianti elettrici, sicurezza e connettività per casa e impresa, nelle province di Asti, Torino e Cuneo.',
    ];
    foreach ($options as $field_name => $value) {
        update_field($field_name, $value, 'option');
    }

    $hero_img_id = ec_seed_local_image('hero-van.webp', 'Furgone aziendale Electrical Core SNC');
    if ($hero_img_id) {
        update_field('hero_immagine', $hero_img_id, 'option');
    }
    $chi_siamo_img_id = ec_seed_local_image('services/chi-siamo.webp', 'Tecnico Electrical Core al lavoro');
    if ($chi_siamo_img_id) {
        update_field('chi_siamo_immagine', $chi_siamo_img_id, 'option');
    }

    // --- Servizi ---
    $servizi = require __DIR__ . '/seed-servizi-data.php';
    $created = 0;
    foreach ($servizi as $data) {
        if (ec_seed_servizio($data)) {
            $created++;
        }
    }

    // --- Pagina Privacy ---
    ec_seed_privacy_page();

    return [
        'ok' => true,
        'message' => "Importazione completata: {$created} servizi aggiornati, Impostazioni Sito e pagina Privacy popolate.",
    ];
}

function ec_seed_privacy_page() {
    $existing = get_page_by_path('privacy');

    $content = <<<HTML
<p>La presente informativa descrive le modalità di trattamento dei dati personali degli utenti che visitano il sito <strong>www.electricalcoresnc.it</strong> e che utilizzano il modulo di contatto, ai sensi dell'art. 13 del Regolamento UE 2016/679 ("GDPR") e del D.Lgs. 196/2003 come modificato dal D.Lgs. 101/2018.</p>

<h2>1. Titolare del trattamento</h2>
<p>Electrical Core S.N.C. di Dumbrava Mihai Lucian e Duma Felician<br>
Frazione Bardella 34, 14022 Castelnuovo Don Bosco (AT)<br>
P.IVA 01767090051<br>
Email: <a href="mailto:info@electricalcore.it">info@electricalcore.it</a><br>
PEC: <a href="mailto:electricalcoresnc@pec.it">electricalcoresnc@pec.it</a></p>

<h2>2. Dati raccolti e finalità del trattamento</h2>
<p>Il sito raccoglie dati personali esclusivamente tramite il modulo di contatto presente nella sezione "Contatti". I dati richiesti sono: nome e cognome, numero di telefono, indirizzo email e il contenuto del messaggio inserito dall'utente.</p>
<p>Alla conferma, i dati inseriti nel modulo vengono elaborati dal server del sito e inviati via email alla casella del Titolare tramite la funzione nativa di WordPress.</p>
<p>La finalità del trattamento è rispondere alle richieste di informazioni, preventivo o assistenza inviate dall'utente.</p>

<h2>3. Base giuridica</h2>
<p>Il trattamento si fonda sul consenso dell'interessato, espresso tramite la compilazione volontaria del modulo di contatto e l'invio dell'email (art. 6, par. 1, lett. a GDPR), oppure sull'esecuzione di misure precontrattuali richieste dall'interessato stesso (art. 6, par. 1, lett. b GDPR), qualora la richiesta riguardi un preventivo o un sopralluogo.</p>

<h2>4. Modalità di trattamento e conservazione</h2>
<p>I dati sono trattati con strumenti informatici e conservati per il tempo strettamente necessario a evadere la richiesta e, in caso di successivo rapporto contrattuale, per il periodo previsto dalla normativa fiscale e civilistica applicabile. Sono adottate misure tecniche e organizzative adeguate a garantire un livello di sicurezza adeguato al rischio.</p>

<h2>5. Comunicazione a terzi</h2>
<p>Il sito integra i seguenti servizi di terze parti, che possono comportare un trattamento autonomo di dati da parte dei rispettivi fornitori:</p>
<ul>
<li><strong>Google Maps</strong> (Google Ireland Limited): utilizzato per mostrare la posizione della sede aziendale nella sezione "Dove siamo". Il caricamento della mappa può comportare la trasmissione di dati tecnici (es. indirizzo IP) a Google. Per maggiori informazioni: <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">informativa privacy di Google</a>.</li>
<li><strong>Google Fonts</strong> (Google Ireland Limited): utilizzato per il caricamento dei caratteri tipografici del sito. Anche in questo caso può avvenire una trasmissione di dati tecnici a Google.</li>
</ul>
<p>Il Titolare non vende né cede a terzi i dati personali raccolti tramite il modulo di contatto per finalità di marketing.</p>

<h2>6. Cookie</h2>
<p>Questo sito utilizza esclusivamente <strong>cookie tecnici</strong>, necessari al normale funzionamento delle pagine, che non richiedono consenso ai sensi dell'art. 122 del Codice Privacy.</p>
<p>La sezione "Dove siamo" incorpora una mappa di <strong>Google Maps</strong>, che utilizza cookie di terze parti non tecnici. Per rispettare il principio del consenso preventivo, la mappa <strong>non viene caricata automaticamente</strong>: al primo accesso al sito compare un banner che permette di accettare o rifiutare il caricamento dei cookie di terze parti; in alternativa, è possibile caricare la mappa in qualsiasi momento cliccando sul pulsante "Mostra la mappa" al suo interno, azione che costituisce di per sé un consenso specifico e puntuale a quel servizio.</p>
<p>La scelta effettuata tramite il banner viene salvata nel browser (tramite <em>local storage</em>) e può essere modificata in qualsiasi momento cliccando su "Preferenze cookie" in fondo a ogni pagina del sito.</p>
<p>Il sito non utilizza cookie di profilazione né strumenti di analisi statistica (es. Google Analytics).</p>

<h2>7. Diritti dell'interessato</h2>
<p>In qualità di interessato, hai diritto di richiedere al Titolare, in qualsiasi momento:</p>
<ul>
<li>l'accesso ai tuoi dati personali (art. 15 GDPR)</li>
<li>la rettifica dei dati inesatti (art. 16 GDPR)</li>
<li>la cancellazione dei dati, nei casi previsti (art. 17 GDPR)</li>
<li>la limitazione del trattamento (art. 18 GDPR)</li>
<li>la portabilità dei dati (art. 20 GDPR)</li>
<li>l'opposizione al trattamento (art. 21 GDPR)</li>
</ul>
<p>Per esercitare questi diritti puoi scrivere a <a href="mailto:info@electricalcore.it">info@electricalcore.it</a> o tramite PEC a <a href="mailto:electricalcoresnc@pec.it">electricalcoresnc@pec.it</a>.</p>
<p>Hai inoltre diritto di proporre reclamo all'Autorità Garante per la protezione dei dati personali (<a href="https://www.garanteprivacy.it" target="_blank" rel="noopener">www.garanteprivacy.it</a>) qualora ritenga che il trattamento violi la normativa vigente.</p>

<h2>8. Modifiche alla presente informativa</h2>
<p>Il Titolare si riserva il diritto di modificare o aggiornare, in tutto o in parte, la presente informativa. Le modifiche saranno pubblicate su questa pagina con indicazione della data di ultimo aggiornamento.</p>
HTML;

    $args = [
        'post_type' => 'page',
        'post_title' => 'Informativa Privacy',
        'post_name' => 'privacy',
        'post_content' => $content,
        'post_status' => 'publish',
    ];

    if ($existing) {
        $args['ID'] = $existing->ID;
        wp_update_post($args);
    } else {
        wp_insert_post($args);
    }
}

// Esecuzione diretta da WP-CLI: `wp eval-file seed/seed-content.php`
if (defined('WP_CLI') && WP_CLI) {
    $result = ec_run_seed_content();
    WP_CLI::log($result['message']);
}
