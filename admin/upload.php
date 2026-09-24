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
if (!valid_category($slug)) {
    http_response_code(400);
    echo json_encode(['error' => 'Servizio non valido.']);
    exit;
}

if (!isset($_FILES['foto'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Nessun file ricevuto.']);
    exit;
}

try {
    $filename = save_uploaded_image($_FILES['foto'], $slug);
} catch (Throwable $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}

$caption = trim((string) ($_POST['didascalia'] ?? ''));

$gallery = read_gallery($slug);
$gallery[] = [
    'file' => $filename,
    'caption' => $caption,
    'uploaded_at' => date('c'),
];
write_gallery($slug, $gallery);

echo json_encode(['ok' => true, 'file' => $filename]);
