<?php
session_start();

require_once __DIR__ . '/config.php';

$credentialsFile = __DIR__ . '/credentials.php';
if (!file_exists($credentialsFile)) {
    http_response_code(500);
    exit('Configurazione mancante: creare admin/credentials.php a partire da admin/credentials.example.php.');
}
require_once $credentialsFile;

function is_logged_in(): bool
{
    return !empty($_SESSION['admin_authenticated']);
}

function require_login(): void
{
    if (!is_logged_in()) {
        header('Location: index.php');
        exit;
    }
}

$loginError = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password']) && !is_logged_in()) {
    if (password_verify($_POST['password'], ADMIN_PASSWORD_HASH)) {
        session_regenerate_id(true);
        $_SESSION['admin_authenticated'] = true;
    } else {
        $loginError = 'Password non corretta.';
    }
}
