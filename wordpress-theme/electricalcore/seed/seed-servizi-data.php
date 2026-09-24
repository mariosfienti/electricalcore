<?php
/**
 * Contenuti reali dei 5 servizi, presi dal sito statico originale.
 * Usato da seed-content.php per popolare il custom post type "servizio".
 */

if (!defined('ABSPATH')) {
    exit;
}

return [

    [
        'slug' => 'impianti-elettrici',
        'title' => 'Impianti elettrici',
        'excerpt' => 'Progettazione, realizzazione, ampliamento e messa a norma di impianti elettrici per abitazioni, uffici e realtà produttive.',
        'image' => 'impianti-elettrici.webp',
        'menu_order' => 1,
        'fields' => [
            'sottotitolo_breve' => 'Civili, industriali e quadri a norma',
            'hero_eyebrow' => 'Elettrotecnica certificata CEI 64-8',
            'hero_lead' => 'Progettiamo, realizziamo e certifichiamo impianti elettrici moderni, sicuri e a basso consumo per abitazioni, negozi, uffici e capannoni industriali nelle province di Asti, Torino e Cuneo.',
            'hero_badges' => "Rilascio Dichiarazione di Conformità (Di.Co.)\nComponenti certificati Bticino, Schneider, ABB\nCollaudo con strumenti calibrati",

            'ambiti_eyebrow' => 'Ambiti di intervento',
            'ambiti_titolo' => 'Soluzioni complete per ogni esigenza',
            'ambiti_testo' => 'Ogni impianto viene dimensionato con precisione per garantire massima sicurezza, continuità di servizio ed efficienza energetica.',

            'pillar1_titolo' => 'Impianti civili e residenziali',
            'pillar1_desc' => 'Realizzazione impianti in nuove costruzioni o ristrutturazioni complete per appartamenti, ville e condomini.',
            'pillar1_elenco' => "Rifacimento quadri elettrici e salvavita\nLinee dedicate carichi pesanti (induzione, forni, pompe di calore)\nIlluminazione LED d'arredo e domotica smart\nProtezione contro sovratensioni (scaricatori SPD)",

            'pillar2_titolo' => 'Attività commerciali e uffici',
            'pillar2_desc' => 'Impianti per negozi, studi professionali, ristorazione e strutture ricettive con illuminazione di sicurezza e continuità.',
            'pillar2_elenco' => "Quadri di distribuzione modulare e sezionamenti\nIlluminazione di emergenza a norma antincendio\nImpianti forza motrice e canalizzazioni a vista o sottopavimento\nAdeguamento normativo per sicurezza luoghi di lavoro",

            'pillar3_titolo' => 'Settore industriale e artigianale',
            'pillar3_desc' => 'Impianti per capannoni, officine meccaniche e magazzini logistici con potenze elevate e carichi trifase gravosi.',
            'pillar3_elenco' => "Quadri generali di bassa tensione (QGBT)\nLinee di alimentazione macchinari e blindo sbarre\nRifasamento automatico industriale\nImpianti di terra e scariche atmosferiche",

            'workflow_eyebrow' => 'Come lavoriamo',
            'workflow_titolo' => "Dall'idea al collaudo finale",
            'workflow_testo' => 'Un percorso lineare, trasparente e senza sorprese per consegnare un impianto conforme e sicuro.',
            'step1_titolo' => 'Sopralluogo gratuito',
            'step1_desc' => "Valutiamo sul posto lo stato dell'immobile, i carichi necessari e le preferenze del cliente.",
            'step2_titolo' => 'Progetto & Preventivo chiaro',
            'step2_desc' => 'Elaboriamo un preventivo trasparente con dettaglio dei materiali, tempistiche e costi certi.',
            'step3_titolo' => "Installazione a regola d'arte",
            'step3_desc' => 'Posa cavi, cablaggio ordinato e fissaggio componenti con standard professionali elevati.',
            'step4_titolo' => 'Collaudo e certificazione Di.Co.',
            'step4_desc' => 'Verifiche strumentali di isolamento e scatto differenziale, con consegna della conformità di legge.',

            'faq1_domanda' => "Cos'è la Dichiarazione di Conformità (Di.Co.) e quando serve?",
            'faq1_risposta' => "È il documento obbligatorio per legge (D.M. 37/08) con cui l'installatore abilitato certifica che l'impianto è stato realizzato a regola d'arte secondo le norme tecniche vigenti. Serve per compravendite, affitti, agibilità e allaccio contatore.",
            'faq2_domanda' => 'Come capisco se il mio impianto elettrico è a norma?',
            'faq2_risposta' => 'Un impianto obsoleto manca solitamente di salvavita adeguato, ha prese non protette o fili rigidi non canalizzati. Durante il sopralluogo verifichiamo la presenza della terra, lo stato del centralino e la sezione dei conduttori.',
            'faq3_domanda' => "Posso predisporre l'impianto per piani a induzione o ricarica auto?",
            'faq3_risposta' => 'Sì, progettiamo linee dedicate di sezione opportuna dal quadro principale, con protezioni differenziali di tipo F o B per evitare scatti intempestivi e sovraccarichi.',
            'faq4_domanda' => 'In quali zone operate?',
            'faq4_risposta' => 'La nostra sede operativa è a Castelnuovo Don Bosco (AT) e interveniamo tempestivamente in tutta la provincia di Asti, nella cintura e centro di Torino e nella provincia di Cuneo.',
        ],
    ],

    [
        'slug' => 'antifurti-videosorveglianza',
        'title' => 'Antifurti e videosorveglianza',
        'excerpt' => 'Sistemi antintrusione e impianti di videosorveglianza su misura, per proteggere casa, negozio e azienda 24 ore su 24.',
        'image' => 'videosorveglianza.webp',
        'menu_order' => 2,
        'fields' => [
            'sottotitolo_breve' => 'Allarmi intelligenti e telecamere HD',
            'hero_eyebrow' => 'Protezione attiva 24 ore su 24',
            'hero_lead' => 'Installiamo sistemi di allarme antintrusione e videosorveglianza IP ad alta definizione con intelligenza artificiale per il riconoscimento di persone e veicoli, notifiche istantanee e controllo totale da smartphone.',
            'hero_badges' => "Telecamere con visione notturna a colori\nAllarmi filari e wireless anti-jammer\nNotifiche video istantanee su smartphone",

            'ambiti_eyebrow' => 'Tecnologie di sicurezza',
            'ambiti_titolo' => 'Sistemi di difesa su misura per ogni ambiente',
            'ambiti_testo' => "Analizziamo i punti deboli del perimetro e progettiamo un sistema integrato che azzera i falsi allarmi e agisce prima che avvenga l'intrusione.",

            'pillar1_titolo' => 'Sistemi antifurto e allarme',
            'pillar1_desc' => 'Centrali di sicurezza ibride (via cavo e wireless a doppia frequenza) resistenti a tentativi di disturbo e taglio fili.',
            'pillar1_elenco' => "Sensori volumetrici a doppia tecnologia (IR + Microonde)\nContatti magnetici e sensori d'urto su porte e finestre\nSirene esterne con lampeggiante e messaggi vocali dissuasivi\nAttivazione e parzializzazione tramite app, telecomando o tastiera",

            'pillar2_titolo' => 'Videosorveglianza IP intelligente',
            'pillar2_desc' => 'Telecamere con algoritmi DeepinView / AcuSense per distinguere con precisione persone, animali e veicoli.',
            'pillar2_elenco' => "Risoluzione da Full HD fino a 4K UHD con ottiche grandangolari\nTecnologia ColorVu / Full-Color per immagini a colori anche di notte\nRegistratori NVR con hard disk specifici per videosorveglianza continua H24\nConformità alle linee guida Privacy e GDPR",

            'pillar3_titolo' => 'Controllo remoto e notifiche push',
            'pillar3_desc' => 'Tutta la tua sicurezza sempre a portata di mano ovunque ti trovi nel mondo, senza abbonamenti obbligatori.',
            'pillar3_elenco' => "Visualizzazione telecamere in tempo reale in streaming fluido\nNotifiche push con anteprima video dell'evento sospetto\nAscolto ambientale e comunicazione audio bidirezionale\nCondivisione accessi sicura con familiari o collaboratori",

            'workflow_eyebrow' => 'Come operiamo',
            'workflow_titolo' => 'La sicurezza costruita attorno ai tuoi spazi',
            'workflow_testo' => "Non esistono kit pre-confezionati: ogni impianto nasce da un'attenta valutazione dei rischi reali.",
            'step1_titolo' => 'Sopralluogo e analisi rischi',
            'step1_desc' => "Individuiamo accessi critici, zone d'ombra e requisiti specifici di privacy o perimetrazione.",
            'step2_titolo' => 'Scelta componenti di qualità',
            'step2_desc' => 'Selezioniamo i migliori marchi professionali (Hikvision, Dahua, Ajax, Elmo) testati nel tempo.',
            'step3_titolo' => 'Installazione pulita e posa cavi',
            'step3_desc' => "Cablaggio a regola d'arte, passaggi cavi invisibili e fissaggio con viti e staffe di sicurezza.",
            'step4_titolo' => 'Configurazione app & collaudo',
            'step4_desc' => "Configuriamo l'app sui tuoi dispositivi, regoliamo le aree di rilevamento e ti mostriamo il funzionamento.",

            'faq1_domanda' => "Se manca la corrente elettrica l'impianto continua a funzionare?",
            'faq1_risposta' => 'Sì, sia la centrale di allarme sia il sistema di videosorveglianza sono dotati di batterie tampone o gruppi di continuità (UPS) che garantiscono autonomia in caso di blackout o taglio cavi.',
            'faq2_domanda' => 'Le telecamere possono distinguere un gatto o il vento da una persona?',
            'faq2_risposta' => 'I nostri sistemi utilizzano telecamere dotate di intelligenza artificiale perimetrale in grado di filtrare pioggia, foglie e animali domestici, inviando notifiche solo quando viene rilevata una sagoma umana o un veicolo.',
            'faq3_domanda' => "È obbligatorio pagare un canone mensile per usare l'app?",
            'faq3_risposta' => "No, i nostri impianti sono di tua proprietà e non richiedono canoni obbligatori. L'app per smartphone si collega direttamente al tuo impianto tramite connessioni P2P crittografate senza costi aggiuntivi.",
            'faq4_domanda' => 'Come funziona per la normativa privacy e i cartelli obbligatori?',
            'faq4_risposta' => 'Forniamo i cartelli a norma di legge e orientiamo le telecamere nel pieno rispetto della normativa GDPR, evitando di inquadrare proprietà altrui o vie pubbliche oltre i limiti consentiti.',
        ],
    ],

    [
        'slug' => 'videocitofonia',
        'title' => 'Videocitofonia',
        'excerpt' => 'Installazione e sostituzione di impianti citofonici e videocitofonici, anche connessi e gestibili comodamente da smartphone.',
        'image' => 'videocitofonia.webp',
        'menu_order' => 3,
        'fields' => [
            'sottotitolo_breve' => 'Sistemi 2 fili, IP e controllo smartphone',
            'hero_eyebrow' => 'Comunicazione e accessi moderni',
            'hero_lead' => 'Installiamo e ammoderniamo impianti videocitofonici mono e plurifamiliari con tecnologia a 2 fili o IP. Ricevi la videochiamata ovunque ti trovi e apri portone o cancello comodamente dallo smartphone.',
            'hero_badges' => "Sostituzione rapida senza opere murarie (tecnologia 2 fili)\nInoltro chiamata audio/video su smartphone\nPosti esterni resistenti IK08 e IP54",

            'ambiti_eyebrow' => 'Soluzioni disponibili',
            'ambiti_titolo' => 'La giusta combinazione tra design e praticità',
            'ambiti_testo' => "Dal singolo appartamento alla villa indipendente fino al condominio multiutenza, progettiamo l'impianto perfetto per i tuoi spazi.",

            'pillar1_titolo' => 'Sistemi 2 fili senza opere murarie',
            'pillar1_desc' => 'La soluzione ideale per trasformare un vecchio citofono a ronzatore in un moderno videocitofono a colori senza rompere i muri.',
            'pillar1_elenco' => "Riutilizzo dei tubi e corrugati esistenti\nMonitor interni ultrasottili touch screen da 5\" e 7\"\nInstallazione rapida, pulita ed economica\nCompatibile con marchi leader Bticino Classe 100/300 e Comelit",

            'pillar2_titolo' => 'Videocitofonia IP connessa Wi-Fi',
            'pillar2_desc' => 'Non perdere mai più una consegna del corriere o una visita importante, anche quando sei fuori casa o al lavoro.',
            'pillar2_elenco' => "Ricezione chiamata direttamente sull'app dello smartphone\nVisione in tempo reale di chi suona alla porta prima di rispondere\nApertura remota di cancelletto pedonale e portone carraio\nIntegrazione con assistenti vocali e domotica domestica",

            'pillar3_titolo' => 'Controllo accessi avanzato',
            'pillar3_desc' => 'Elimina le chiavi tradizionali ed entra in casa o in azienda con badge RFID, impronta o codice segreto.',
            'pillar3_elenco' => "Pulsantiere con tastierino numerico retroilluminato a codice PIN\nLettori di tessere e transponder di prossimità RFID\nStorico accessi e memorizzazione foto dei visitatori\nTelecamere grandangolari 130° con visione notturna a infrarossi",

            'workflow_eyebrow' => 'Procedura di installazione',
            'workflow_titolo' => 'Sostituzione semplice e professionale',
            'workflow_testo' => "In poche ore aggiorniamo il tuo ingresso con tecnologia all'avanguardia.",
            'step1_titolo' => "Verifica dell'impianto attuale",
            'step1_desc' => 'Controlliamo il cablaggio esistente e le distanze tra posto esterno e postazioni interne.',
            'step2_titolo' => 'Scelta estetica e funzionale',
            'step2_desc' => 'Ti mostriamo le finiture e le dimensioni dei monitor touch screen più adatte al tuo arredamento.',
            'step3_titolo' => 'Montaggio e cablaggio preciso',
            'step3_desc' => 'Sostituiamo pulsantiera esterna, alimentatori a quadro e monitor interni in modo impeccabile.',
            'step4_titolo' => 'Abbinamento smartphone & test',
            'step4_desc' => "Colleghiamo i telefoni di famiglia o dell'ufficio all'app e verifichiamo audio, video e serratura.",

            'faq1_domanda' => 'Posso sostituire un vecchio citofono senza rompere le pareti?',
            'faq1_risposta' => 'Sì! I moderni sistemi videocitofonici a 2 fili non polarizzati utilizzano i cavi già presenti nei corrugati, evitando qualsiasi opera muraria o ritinteggiatura.',
            'faq2_domanda' => 'Cosa succede se suonano al campanello e non sono a casa?',
            'faq2_risposta' => 'Con i sistemi connessi, il videocitofono inoltra la chiamata contemporaneamente sul monitor di casa e sugli smartphone associati: puoi parlare con il visitatore e, se necessario, aprire la porta al corriere.',
            'faq3_domanda' => 'Si può installare in un condominio?',
            'faq3_risposta' => 'Certamente. Realizziamo impianti condominiali modulari sia a 2 fili sia IP, dove ogni condomino può scegliere se installare un semplice citofono audio, un videocitofono standard o un modello smart connesso Wi-Fi.',
            'faq4_domanda' => 'Quali marchi utilizzate?',
            'faq4_risposta' => 'Utilizziamo esclusivamente marchi certificati e con assistenza ricambi garantita nel tempo: Bticino, Comelit, Urmet e Dahua.',
        ],
    ],

    [
        'slug' => 'automazioni-cancelli',
        'title' => 'Automazioni cancelli',
        'excerpt' => 'Motorizzazione e automazione di cancelli e barriere, con soluzioni affidabili e durature per uso residenziale e industriale.',
        'image' => 'automazione-cancelli.webp',
        'menu_order' => 4,
        'fields' => [
            'sottotitolo_breve' => 'Cancelli scorrevoli, a battente e barriere',
            'hero_eyebrow' => 'Aperture automatiche conformi UNI EN 12453',
            'hero_lead' => 'Motorizziamo cancelli scorrevoli, ad ante battenti, portoni sezionali e barriere per aziende e condomini. Massima sicurezza antischiacciamento, fotocellule sincronizzate e apertura con smartphone o radiocomando.',
            'hero_badges' => "Certificazione CE e libretto di manutenzione obbligatorio\nMotori 24V ad uso intensivo con rilevamento ostacoli\nSblocco manuale d'emergenza con chiave personalizzata",

            'ambiti_eyebrow' => 'Tipologie di impianto',
            'ambiti_titolo' => 'Soluzioni motorizzate per ogni tipo di apertura',
            'ambiti_testo' => 'Dalle villette private ai varchi industriali transitati quotidianamente da centinaia di veicoli.',

            'pillar1_titolo' => 'Cancelli carrai scorrevoli',
            'pillar1_desc' => "I più robusti e salvaspazio: ideali dove non c'è profondità per l'apertura delle ante all'interno della proprietà.",
            'pillar1_elenco' => "Motori elettromeccanici da 400 kg fino a oltre 2000 kg\nCremagliera in acciaio zincato silenziosa e indeformabile\nRallentamento dolce in apertura e chiusura\nCoste di sicurezza attive antischiacciamento conformi a norma",

            'pillar2_titolo' => 'Cancelli a battente ad 1 o 2 ante',
            'pillar2_desc' => 'Soluzioni eleganti con attuatori a braccio telescopico, a snodo oppure con casse interrate totalmente invisibili.',
            'pillar2_elenco' => "Bracci elettromeccanici resistenti agli agenti atmosferici\nMotori interrati a tenuta stagna IP67 per preservare il design\nElettroserratura di blocco contro raffiche di vento violente\nDoppia coppia di fotocellule di sicurezza interna ed esterna",

            'pillar3_titolo' => 'Barriere stradali e porte garage',
            'pillar3_desc' => 'Sistemi per la gestione dei parcheggi aziendali, condomini e motorizzazioni per basculanti e sezionali.',
            'pillar3_elenco' => "Barriere automatiche con asta fino a 6 metri e luci LED\nApertura ultra-rapida per varchi ad alto traffico\nAutomazioni per porte basculanti e portoni sezionali residenziali\nApertura con loop magnetico a terra o riconoscimento targa",

            'workflow_eyebrow' => 'Conformità e sicurezza',
            'workflow_titolo' => 'La sicurezza prima di tutto: Direttiva Macchine',
            'workflow_testo' => 'Un cancello automatico è considerato per legge una "macchina" e deve rispettare standard severi per proteggere persone e bambini.',
            'step1_titolo' => 'Valutazione meccanica',
            'step1_desc' => 'Verifichiamo che i cardini, i binari e le cerniere del cancello scorrano senza attriti o sbandamenti.',
            'step2_titolo' => 'Scelta motorizzazione corretta',
            'step2_desc' => "Dimensioniamo la potenza del motore in base al peso, alla frequenza d'uso e all'esposizione al vento.",
            'step3_titolo' => 'Dispositivi di protezione',
            'step3_desc' => 'Installiamo fotocellule a raggio infrarosso, lampeggiante visivo e coste in gomma antischiacciamento.',
            'step4_titolo' => 'Misurazione forze & Marcatura CE',
            'step4_desc' => 'Collaudiamo le forze di impatto con dinamometro certificato e rilasciamo il fascicolo tecnico con targa CE.',

            'faq1_domanda' => 'Se manca la corrente posso aprire il cancello manualmente?',
            'faq1_risposta' => "Certamente. Ogni motore è equipaggiato con una leva o chiave personalizzata di sblocco d'emergenza che permette di aprire e chiudere il cancello a spinta. Su richiesta possiamo anche installare batterie tampone di riserva.",
            'faq2_domanda' => 'È possibile motorizzare un cancello già esistente?',
            'faq2_risposta' => 'Nella maggior parte dei casi sì. Se la struttura è in buono stato meccanico e scorre correttamente, possiamo applicare il gruppo motore, la cremagliera o i bracci senza dover rifare il cancello.',
            'faq3_domanda' => 'Quali marchi di motori installate?',
            'faq3_risposta' => 'Lavoriamo solo con i migliori marchi italiani sinonimo di affidabilità e reperibilità decennale dei ricambi: CAME, FAAC, BFT e Nice.',
            'faq4_domanda' => 'Posso aprire il cancello dal telefono cellulare?',
            'faq4_risposta' => 'Sì, installiamo moduli smart Wi-Fi o GSM che consentono di aprire il cancello con una chiamata a costo zero o con un tocco sull\'applicazione del telefono, anche a distanza.',
        ],
    ],

    [
        'slug' => 'antenne-reti-dati',
        'title' => 'Antenne e reti dati',
        'excerpt' => 'Installazione antenne TV/SAT e realizzazione di reti dati e cablaggi strutturati per una connettività stabile ed efficiente.',
        'image' => 'antenne-reti-dati.webp',
        'menu_order' => 5,
        'fields' => [
            'sottotitolo_breve' => 'TV/SAT, fibra ottica e cablaggi rack',
            'hero_eyebrow' => 'Connettività e ricezione senza compromessi',
            'hero_lead' => 'Installiamo e ripariamo impianti antenna per digitale terrestre DVB-T2 e satellitare, e realizziamo cablaggi strutturati in fibra ottica e rame con armadi rack per una rete aziendale o domestica stabile e velocissima.',
            'hero_badges' => "Puntamento con misuratore di campo professionale Rover\nCertificazione cavi LAN Cat.6 / Cat.6A / Cat.7\nArmadi rack ordinati con patch panel e switch gigabit",

            'ambiti_eyebrow' => 'Servizi di segnale & rete',
            'ambiti_titolo' => 'Dalla TV ad altissima definizione al Wi-Fi totale',
            'ambiti_testo' => 'Risolviamo problemi di segnale televisivo e colli di bottiglia nella connessione internet, garantendo massima stabilità a streaming, lavoro e macchinari.',

            'pillar1_titolo' => 'Antenne TV DVB-T2 e Satellitari',
            'pillar1_desc' => 'Impianti singoli e centralizzati condominiali con puntamento di precisione e filtri contro le interferenze 5G/4G.',
            'pillar1_elenco' => "Antenne terrestri UHF ad alto guadagno per il nuovo digitale terrestre DVB-T2\nParabole satellitari per Tivùsat, Sky e canali internazionali\nCentralini a filtri programmabili per bilanciamento perfetto del segnale\nDistribuzione del segnale in tutte le stanze senza perdite di qualità",

            'pillar2_titolo' => 'Cablaggio strutturato e Rack dati',
            'pillar2_desc' => 'La base fondamentale per qualsiasi azienda o smart home: cavi di rete certificati per velocità fino a 10 Gbps.',
            'pillar2_elenco' => "Posa cavi UTP/FTP Cat.6 e Cat.6A a norma CEI UNEL\nAllestimento armadi rack 19\" a parete o a pavimento\nInstallazione patch panel, gruppi di continuità UPS e switch gestiti\nEtichettatura di tutte le prese di rete per una facile manutenzione",

            'pillar3_titolo' => 'Wi-Fi professionale & Fibra Ottica',
            'pillar3_desc' => "Copertura wireless omogenea in tutta la casa, nel giardino o all'interno di capannoni produttivi senza zone d'ombra.",
            'pillar3_elenco' => "Access Point professionali da soffitto (UniFi, Omada, Aruba)\nReti Wi-Fi Mesh con roaming continuo senza interruzioni di chiamata\nRete Wi-Fi ospiti separata per la massima sicurezza aziendale\nDorsali in fibra ottica per collegare fabbricati distanti tra loro",

            'workflow_eyebrow' => 'Strumentazione e metodo',
            'workflow_titolo' => 'Precisione millimetrica e collaudo strumentale',
            'workflow_testo' => 'Non lasciamo nulla al caso: ogni presa e frequenza viene misurata e certificata.',
            'step1_titolo' => 'Misurazione del segnale',
            'step1_desc' => "Analizziamo la potenza (dBuV), il BER e il MER per individuare la posizione ideale dell'antenna o dell'armadio rack.",
            'step2_titolo' => 'Posa cavi e canalizzazioni',
            'step2_desc' => 'Separazione rigorosa delle correnti forti (230V) dai cavi di segnale per azzerare ogni interferenza elettromagnetica.',
            'step3_titolo' => 'Assemblaggio e cablaggio',
            'step3_desc' => "Crimpatura connettori secondo lo standard T568B e allineamento perfetto della parabola o dell'antenna TV.",
            'step4_titolo' => 'Certificazione e test di carico',
            'step4_desc' => 'Verifica delle velocità di trasferimento dati, assenza di pacchetti persi e canali TV perfettamente sintonizzati.',

            'faq1_domanda' => 'Perché alcuni canali TV squadrettano o spariscono quando piove?',
            'faq1_risposta' => 'Spesso è causato da un cavo coassiale invecchiato o screpolato, da un puntamento non ottimale o da interferenze con le nuove celle 5G. Con un misuratore di campo identifichiamo subito la causa e installiamo filtri LTE/5G idonei.',
            'faq2_domanda' => 'Il Wi-Fi di casa non arriva al piano di sopra: cosa si può fare?',
            'faq2_risposta' => 'I ripetitori Wi-Fi economici da presa spesso dimezzano la velocità e creano disconnessioni. La soluzione definitiva è posare un cavo Ethernet (spesso possibile nei tubi esistenti) e installare un Access Point professionale a soffitto con roaming istantaneo.',
            'faq3_domanda' => 'Qual è la differenza tra cavo di rete Cat.6 e Cat.6A?',
            'faq3_risposta' => 'I cavi Cat.6 supportano velocità fino a 1 Gbps (e 10 Gbps su distanze brevi fino a 35m). I cavi Cat.6A e Cat.7 garantiscono 10 Gbps stabili fino a 100 metri con schermatura superiore contro i disturbi elettrici.',
            'faq4_domanda' => 'Potete collegare la rete dati tra due edifici o capannoni vicini?',
            'faq4_risposta' => 'Sì, realizziamo ponti radio punto-punto ad altissima capacità fino a 1 Gbps oppure posiamo una dorsale in fibra ottica interrata protetta, immune da fulmini e disturbi elettrici.',
        ],
    ],

];
