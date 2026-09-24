<?php
// Copiare questo file in "credentials.php" (stessa cartella) e sostituire
// l'hash sottostante con quello della password scelta per il cliente.
//
// Per generare l'hash da riga di comando:
//   php -r "echo password_hash('la-password-del-cliente', PASSWORD_DEFAULT), PHP_EOL;"
//
// credentials.php NON va mai versionato: contiene la password di accesso
// all'area riservata ed è escluso da .gitignore.

define('ADMIN_PASSWORD_HASH', '$2y$10$REPLACE.WITH.YOUR.OWN.GENERATED.HASH.xxxxxxxxxxxxxxxxxxxxx');
