<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/functions.php';

header('Content-Type: application/json; charset=utf-8');

if (!is_logged_in()) {
    http_response_code(401);
    echo json_encode(['error' => 'Sessione scaduta, effettua di nuovo l\'accesso.']);
    exit;
}

$slug = $_POST['categoria'] ?? '';
$file = basename((string) ($_POST['file'] ?? ''));

if (!valid_category($slug) || $file === '') {
    http_response_code(400);
    echo json_encode(['error' => 'Richiesta non valida.']);
    exit;
}

$gallery = read_gallery($slug);
$found = false;
$remaining = [];
foreach ($gallery as $item) {
    if (($item['file'] ?? '') === $file) {
        $found = true;
        continue;
    }
    $remaining[] = $item;
}

if (!$found) {
    http_response_code(404);
    echo json_encode(['error' => 'Foto non trovata.']);
    exit;
}

write_gallery($slug, $remaining);

$path = gallery_dir($slug) . '/' . $file;
if (is_file($path)) {
    unlink($path);
}

echo json_encode(['ok' => true]);
