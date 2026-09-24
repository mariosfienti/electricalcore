<?php
// Configurazione dell'area di caricamento foto lavori.

define('UPLOAD_BASE_DIR', dirname(__DIR__) . '/uploads');

// Slug => etichetta leggibile. Gli slug devono coincidere con le sottocartelle
// in /uploads e con i nomi dei file in /servizi.
const SERVICE_CATEGORIES = [
    'impianti-elettrici'          => 'Impianti elettrici civili e industriali',
    'antifurti-videosorveglianza' => 'Antifurti e videosorveglianza',
    'videocitofonia'              => 'Videocitofonia',
    'automazioni-cancelli'        => 'Automazioni cancelli',
    'antenne-reti-dati'           => 'Antenne e reti dati',
];

define('MAX_UPLOAD_BYTES', 8 * 1024 * 1024); // limite prima della compressione
define('MAX_DIMENSION_PX', 1920);            // lato massimo dopo il ridimensionamento
define('WEBP_QUALITY', 82);
