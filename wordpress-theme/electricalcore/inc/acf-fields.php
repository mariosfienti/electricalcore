<?php
/**
 * Campi personalizzati (ACF) per rendere il sito editabile dal cliente.
 *
 * NOTA IMPORTANTE: questi campi usano solo tipi disponibili nella versione
 * GRATUITA di Advanced Custom Fields (niente Repeater/Flexible Content, che
 * sono funzioni a pagamento di ACF PRO). Dove servirebbe un elenco libero
 * (es. gli elenchi puntati dei servizi), si usa un campo "Area di testo"
 * con un'istruzione "una voce per riga": il tema poi lo trasforma in
 * elenco puntato in automatico. Vedi README.md del tema per i dettagli.
 */

if (!defined('ABSPATH')) {
    exit;
}

function ec_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    $ec_settings_page_id = function_exists('ec_get_settings_page_id') ? ec_get_settings_page_id() : 0;

    acf_add_local_field_group([
        'key' => 'group_ec_options',
        'title' => 'Impostazioni Sito',
        'fields' => [
            // --- Contatti ---
            ['key' => 'field_ec_tab_contatti', 'label' => 'Contatti', 'type' => 'tab'],
            ['key' => 'field_ec_telefono_principale', 'label' => 'Telefono principale', 'name' => 'telefono_principale', 'type' => 'text', 'default_value' => '338 4444117'],
            ['key' => 'field_ec_telefono_secondario', 'label' => 'Telefono secondario', 'name' => 'telefono_secondario', 'type' => 'text', 'default_value' => '327 5669119'],
            ['key' => 'field_ec_email', 'label' => 'Email', 'name' => 'email', 'type' => 'email', 'default_value' => 'info@electricalcore.it'],
            ['key' => 'field_ec_whatsapp_numero', 'label' => 'Numero WhatsApp', 'name' => 'whatsapp_numero', 'type' => 'text', 'default_value' => '338 4444117', 'instructions' => 'Stesso formato del telefono, es. 338 4444117.'],
            ['key' => 'field_ec_indirizzo', 'label' => 'Indirizzo (via e civico)', 'name' => 'indirizzo', 'type' => 'text', 'default_value' => 'Frazione Bardella 34'],
            ['key' => 'field_ec_cap', 'label' => 'CAP', 'name' => 'cap', 'type' => 'text', 'default_value' => '14022'],
            ['key' => 'field_ec_comune', 'label' => 'Comune', 'name' => 'comune', 'type' => 'text', 'default_value' => 'Castelnuovo Don Bosco'],
            ['key' => 'field_ec_provincia_sigla', 'label' => 'Provincia (sigla)', 'name' => 'provincia_sigla', 'type' => 'text', 'default_value' => 'AT'],
            ['key' => 'field_ec_piva', 'label' => 'Partita IVA', 'name' => 'piva', 'type' => 'text', 'default_value' => '01767090051'],
            ['key' => 'field_ec_ragione_sociale_legale', 'label' => 'Ragione sociale legale (per footer)', 'name' => 'ragione_sociale_legale', 'type' => 'text', 'default_value' => 'Electrical Core S.N.C. di Dumbrava Mihai Lucian e Duma Felician'],
            ['key' => 'field_ec_google_maps_query', 'label' => 'Indirizzo per Google Maps', 'name' => 'google_maps_query', 'type' => 'text', 'instructions' => 'Testo usato per la mappa "Dove siamo", es. "Frazione Bardella 34, 14022 Castelnuovo Don Bosco AT".', 'default_value' => 'Frazione Bardella 34, 14022 Castelnuovo Don Bosco AT'],

            // --- Homepage: Hero ---
            ['key' => 'field_ec_tab_hero', 'label' => 'Homepage - Hero', 'type' => 'tab'],
            ['key' => 'field_ec_hero_eyebrow', 'label' => 'Etichetta sopra il titolo', 'name' => 'hero_eyebrow', 'type' => 'text', 'default_value' => 'Impianti elettrici civili e industriali'],
            ['key' => 'field_ec_hero_titolo', 'label' => 'Titolo principale (H1)', 'name' => 'hero_titolo', 'type' => 'text', 'default_value' => 'Sicurezza, tecnologia e affidabilità per la tua casa e la tua impresa'],
            ['key' => 'field_ec_hero_testo', 'label' => 'Testo introduttivo', 'name' => 'hero_testo', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_ec_hero_badges', 'label' => 'Frasi badge (una per riga)', 'name' => 'hero_badges', 'type' => 'textarea', 'rows' => 3, 'instructions' => 'Es. "Preventivi gratuiti", una per riga.'],
            ['key' => 'field_ec_hero_immagine', 'label' => 'Foto hero (furgone/squadra)', 'name' => 'hero_immagine', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],

            // --- Homepage: Chi siamo ---
            ['key' => 'field_ec_tab_chi_siamo', 'label' => 'Homepage - Chi siamo', 'type' => 'tab'],
            ['key' => 'field_ec_chi_siamo_eyebrow', 'label' => 'Etichetta', 'name' => 'chi_siamo_eyebrow', 'type' => 'text', 'default_value' => 'Chi siamo'],
            ['key' => 'field_ec_chi_siamo_titolo', 'label' => 'Titolo', 'name' => 'chi_siamo_titolo', 'type' => 'text'],
            ['key' => 'field_ec_chi_siamo_testo_1', 'label' => 'Primo paragrafo', 'name' => 'chi_siamo_testo_1', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_ec_chi_siamo_testo_2', 'label' => 'Secondo paragrafo', 'name' => 'chi_siamo_testo_2', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_ec_chi_siamo_immagine', 'label' => 'Foto', 'name' => 'chi_siamo_immagine', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
            ['key' => 'field_ec_punto1_titolo', 'label' => 'Punto di forza 1 - titolo', 'name' => 'punto1_titolo', 'type' => 'text', 'default_value' => 'Preventivi gratuiti'],
            ['key' => 'field_ec_punto1_desc', 'label' => 'Punto di forza 1 - descrizione', 'name' => 'punto1_desc', 'type' => 'text'],
            ['key' => 'field_ec_punto2_titolo', 'label' => 'Punto di forza 2 - titolo', 'name' => 'punto2_titolo', 'type' => 'text', 'default_value' => 'Impianti a norma'],
            ['key' => 'field_ec_punto2_desc', 'label' => 'Punto di forza 2 - descrizione', 'name' => 'punto2_desc', 'type' => 'text'],
            ['key' => 'field_ec_punto3_titolo', 'label' => 'Punto di forza 3 - titolo', 'name' => 'punto3_titolo', 'type' => 'text', 'default_value' => 'Assistenza continua'],
            ['key' => 'field_ec_punto3_desc', 'label' => 'Punto di forza 3 - descrizione', 'name' => 'punto3_desc', 'type' => 'text'],

            // --- Homepage: Dove siamo ---
            ['key' => 'field_ec_tab_dove_siamo', 'label' => 'Homepage - Dove siamo', 'type' => 'tab'],
            ['key' => 'field_ec_dove_siamo_testo', 'label' => 'Testo introduttivo', 'name' => 'dove_siamo_testo', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_ec_provincia1_nome', 'label' => 'Zona 1 - nome', 'name' => 'provincia1_nome', 'type' => 'text', 'default_value' => 'Provincia di Asti'],
            ['key' => 'field_ec_provincia1_comuni', 'label' => 'Zona 1 - comuni serviti', 'name' => 'provincia1_comuni', 'type' => 'text'],
            ['key' => 'field_ec_provincia2_nome', 'label' => 'Zona 2 - nome', 'name' => 'provincia2_nome', 'type' => 'text', 'default_value' => 'Provincia di Torino'],
            ['key' => 'field_ec_provincia2_comuni', 'label' => 'Zona 2 - comuni serviti', 'name' => 'provincia2_comuni', 'type' => 'text'],
            ['key' => 'field_ec_provincia3_nome', 'label' => 'Zona 3 - nome', 'name' => 'provincia3_nome', 'type' => 'text', 'default_value' => 'Provincia di Cuneo'],
            ['key' => 'field_ec_provincia3_comuni', 'label' => 'Zona 3 - comuni serviti', 'name' => 'provincia3_comuni', 'type' => 'text'],

            // --- Footer ---
            ['key' => 'field_ec_tab_footer', 'label' => 'Footer', 'type' => 'tab'],
            ['key' => 'field_ec_footer_tagline', 'label' => 'Frase sotto il logo nel footer', 'name' => 'footer_tagline', 'type' => 'text'],
        ],
        'location' => [
            [
                [
                    'param' => 'page',
                    'operator' => '==',
                    'value' => $ec_settings_page_id,
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_ec_servizio',
        'title' => 'Dettagli Servizio',
        'fields' => [
            ['key' => 'field_ecs_tab_scheda', 'label' => 'Scheda', 'type' => 'tab'],
            ['key' => 'field_ecs_sottotitolo_breve', 'label' => 'Frase breve (menu a tendina / card)', 'name' => 'sottotitolo_breve', 'type' => 'text', 'instructions' => 'Es. "Civili, industriali e quadri a norma". Compare nel menu Servizi e nella card in homepage.'],
            ['key' => 'field_ecs_icona_svg_path', 'label' => 'Icona (avanzato, opzionale)', 'name' => 'icona_svg_path', 'type' => 'text', 'instructions' => 'Percorso SVG dell\'icona. Lascia vuoto per usare l\'icona di default: da modificare solo da chi sa lavorare con SVG.'],

            ['key' => 'field_ecs_tab_hero', 'label' => 'Testata pagina', 'type' => 'tab'],
            ['key' => 'field_ecs_hero_eyebrow', 'label' => 'Etichetta sopra il titolo', 'name' => 'hero_eyebrow', 'type' => 'text'],
            ['key' => 'field_ecs_hero_lead', 'label' => 'Testo introduttivo', 'name' => 'hero_lead', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_ecs_hero_badges', 'label' => 'Frasi badge (una per riga)', 'name' => 'hero_badges', 'type' => 'textarea', 'rows' => 3],

            ['key' => 'field_ecs_tab_ambiti', 'label' => 'Ambiti di intervento', 'type' => 'tab'],
            ['key' => 'field_ecs_ambiti_eyebrow', 'label' => 'Etichetta sezione', 'name' => 'ambiti_eyebrow', 'type' => 'text', 'default_value' => 'Ambiti di intervento'],
            ['key' => 'field_ecs_ambiti_titolo', 'label' => 'Titolo sezione', 'name' => 'ambiti_titolo', 'type' => 'text'],
            ['key' => 'field_ecs_ambiti_testo', 'label' => 'Testo sezione', 'name' => 'ambiti_testo', 'type' => 'textarea', 'rows' => 2],

            ['key' => 'field_ecs_pillar1_titolo', 'label' => 'Scheda 1 - titolo', 'name' => 'pillar1_titolo', 'type' => 'text'],
            ['key' => 'field_ecs_pillar1_desc', 'label' => 'Scheda 1 - descrizione', 'name' => 'pillar1_desc', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ecs_pillar1_elenco', 'label' => 'Scheda 1 - elenco (una voce per riga)', 'name' => 'pillar1_elenco', 'type' => 'textarea', 'rows' => 4],

            ['key' => 'field_ecs_pillar2_titolo', 'label' => 'Scheda 2 - titolo', 'name' => 'pillar2_titolo', 'type' => 'text'],
            ['key' => 'field_ecs_pillar2_desc', 'label' => 'Scheda 2 - descrizione', 'name' => 'pillar2_desc', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ecs_pillar2_elenco', 'label' => 'Scheda 2 - elenco (una voce per riga)', 'name' => 'pillar2_elenco', 'type' => 'textarea', 'rows' => 4],

            ['key' => 'field_ecs_pillar3_titolo', 'label' => 'Scheda 3 - titolo', 'name' => 'pillar3_titolo', 'type' => 'text'],
            ['key' => 'field_ecs_pillar3_desc', 'label' => 'Scheda 3 - descrizione', 'name' => 'pillar3_desc', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ecs_pillar3_elenco', 'label' => 'Scheda 3 - elenco (una voce per riga)', 'name' => 'pillar3_elenco', 'type' => 'textarea', 'rows' => 4],

            ['key' => 'field_ecs_tab_workflow', 'label' => 'Come lavoriamo', 'type' => 'tab'],
            ['key' => 'field_ecs_workflow_eyebrow', 'label' => 'Etichetta sezione', 'name' => 'workflow_eyebrow', 'type' => 'text', 'default_value' => 'Come lavoriamo'],
            ['key' => 'field_ecs_workflow_titolo', 'label' => 'Titolo sezione', 'name' => 'workflow_titolo', 'type' => 'text'],
            ['key' => 'field_ecs_workflow_testo', 'label' => 'Testo sezione', 'name' => 'workflow_testo', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ecs_step1_titolo', 'label' => 'Passo 1 - titolo', 'name' => 'step1_titolo', 'type' => 'text'],
            ['key' => 'field_ecs_step1_desc', 'label' => 'Passo 1 - descrizione', 'name' => 'step1_desc', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ecs_step2_titolo', 'label' => 'Passo 2 - titolo', 'name' => 'step2_titolo', 'type' => 'text'],
            ['key' => 'field_ecs_step2_desc', 'label' => 'Passo 2 - descrizione', 'name' => 'step2_desc', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ecs_step3_titolo', 'label' => 'Passo 3 - titolo', 'name' => 'step3_titolo', 'type' => 'text'],
            ['key' => 'field_ecs_step3_desc', 'label' => 'Passo 3 - descrizione', 'name' => 'step3_desc', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ecs_step4_titolo', 'label' => 'Passo 4 - titolo', 'name' => 'step4_titolo', 'type' => 'text'],
            ['key' => 'field_ecs_step4_desc', 'label' => 'Passo 4 - descrizione', 'name' => 'step4_desc', 'type' => 'textarea', 'rows' => 2],

            ['key' => 'field_ecs_tab_faq', 'label' => 'FAQ', 'type' => 'tab'],
            ['key' => 'field_ecs_faq1_domanda', 'label' => 'Domanda 1', 'name' => 'faq1_domanda', 'type' => 'text'],
            ['key' => 'field_ecs_faq1_risposta', 'label' => 'Risposta 1', 'name' => 'faq1_risposta', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_ecs_faq2_domanda', 'label' => 'Domanda 2', 'name' => 'faq2_domanda', 'type' => 'text'],
            ['key' => 'field_ecs_faq2_risposta', 'label' => 'Risposta 2', 'name' => 'faq2_risposta', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_ecs_faq3_domanda', 'label' => 'Domanda 3', 'name' => 'faq3_domanda', 'type' => 'text'],
            ['key' => 'field_ecs_faq3_risposta', 'label' => 'Risposta 3', 'name' => 'faq3_risposta', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_ecs_faq4_domanda', 'label' => 'Domanda 4', 'name' => 'faq4_domanda', 'type' => 'text'],
            ['key' => 'field_ecs_faq4_risposta', 'label' => 'Risposta 4', 'name' => 'faq4_risposta', 'type' => 'textarea', 'rows' => 3],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'servizio',
                ],
            ],
        ],
    ]);
}
add_action('acf/init', 'ec_register_acf_fields');
