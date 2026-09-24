<?php
require_once __DIR__ . '/config.php';

function gallery_dir(string $slug): string
{
    return UPLOAD_BASE_DIR . '/' . $slug;
}

function gallery_json_path(string $slug): string
{
    return gallery_dir($slug) . '/gallery.json';
}

function valid_category(string $slug): bool
{
    return array_key_exists($slug, SERVICE_CATEGORIES);
}

function read_gallery(string $slug): array
{
    $path = gallery_json_path($slug);
    if (!is_file($path)) {
        return [];
    }
    $data = json_decode((string) file_get_contents($path), true);
    return is_array($data) ? $data : [];
}

function write_gallery(string $slug, array $items): void
{
    $dir = gallery_dir($slug);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $fp = fopen(gallery_json_path($slug), 'c+');
    if ($fp === false) {
        throw new RuntimeException('Impossibile aggiornare la galleria del servizio.');
    }
    flock($fp, LOCK_EX);
    ftruncate($fp, 0);
    fwrite($fp, json_encode(array_values($items), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
}

/**
 * Valida, ridimensiona e salva la foto caricata nella cartella del servizio.
 * Ritorna il nome del file salvato.
 */
function save_uploaded_image(array $file, string $slug): string
{
    if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Caricamento non riuscito.');
    }
    if ($file['size'] > MAX_UPLOAD_BYTES) {
        $maxMb = (int) (MAX_UPLOAD_BYTES / 1024 / 1024);
        throw new RuntimeException("Il file supera la dimensione massima consentita ({$maxMb}MB).");
    }

    $info = @getimagesize($file['tmp_name']);
    if ($info === false) {
        throw new RuntimeException("Il file non e' un'immagine valida.");
    }

    [$width, $height, $type] = $info;

    switch ($type) {
        case IMAGETYPE_JPEG:
            $source = @imagecreatefromjpeg($file['tmp_name']);
            break;
        case IMAGETYPE_PNG:
            $source = @imagecreatefrompng($file['tmp_name']);
            break;
        case IMAGETYPE_WEBP:
            $source = @imagecreatefromwebp($file['tmp_name']);
            break;
        default:
            throw new RuntimeException('Formato non supportato: usa JPG, PNG o WEBP.');
    }

    if ($source === false) {
        throw new RuntimeException("Impossibile leggere l'immagine.");
    }

    $longSide = max($width, $height);
    if ($longSide > MAX_DIMENSION_PX) {
        $targetWidth = $width >= $height ? MAX_DIMENSION_PX : -1;
        $targetHeight = $width >= $height ? -1 : MAX_DIMENSION_PX;
        $scaled = imagescale($source, $targetWidth, $targetHeight);
        if ($scaled !== false) {
            imagedestroy($source);
            $source = $scaled;
        }
    }

    $dir = gallery_dir($slug);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    $useWebp = function_exists('imagewebp');
    $filename = 'img_' . date('Ymd_His') . '_' . bin2hex(random_bytes(3)) . ($useWebp ? '.webp' : '.jpg');
    $destination = $dir . '/' . $filename;

    $saved = $useWebp
        ? imagewebp($source, $destination, WEBP_QUALITY)
        : imagejpeg($source, $destination, 85);

    imagedestroy($source);

    if (!$saved) {
        throw new RuntimeException("Impossibile salvare l'immagine sul server.");
    }

    return $filename;
}
