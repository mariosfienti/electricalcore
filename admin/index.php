<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/functions.php';
?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title>Gestione foto lavori | Electrical Core</title>
<link rel="icon" type="image/png" href="../assets/favicon.png">
<style>
  body { font-family: system-ui, -apple-system, sans-serif; background: #F7F5F3; color: #2B2B2B; margin: 0; padding: 24px; }
  .wrap { max-width: 960px; margin: 0 auto; }
  h1 { font-size: 1.4rem; }
  .card { background: #fff; border: 1px solid #E7E2DD; border-radius: 12px; padding: 20px; margin-bottom: 20px; }
  label { display: block; font-weight: 600; margin-bottom: 6px; font-size: .9rem; }
  input[type=password], input[type=text], select, input[type=file] {
    width: 100%; padding: 10px; border: 1px solid #E7E2DD; border-radius: 8px;
    margin-bottom: 14px; font-size: 1rem; box-sizing: border-box;
  }
  button { background: #D9382B; color: #fff; border: 0; border-radius: 8px; padding: 10px 18px; font-weight: 600; cursor: pointer; }
  button:hover { background: #B32A20; }
  .error { color: #B32A20; font-weight: 600; }
  .success { color: #1A7A3C; font-weight: 600; }
  .logout { float: right; font-size: .85rem; }
  .gallery-admin-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 12px; }
  .gallery-admin-item { position: relative; border-radius: 8px; overflow: hidden; border: 1px solid #E7E2DD; }
  .gallery-admin-item img { width: 100%; height: 110px; object-fit: cover; display: block; }
  .gallery-admin-item form { position: absolute; top: 6px; right: 6px; margin: 0; }
  .gallery-admin-item button { padding: 4px 8px; font-size: .75rem; background: rgba(0,0,0,.65); }
  .category-block h3 { margin-bottom: 10px; font-size: 1rem; }
  .empty-note { color: #5C6066; font-size: .85rem; }
</style>
</head>
<body>
<div class="wrap">

<?php if (!is_logged_in()): ?>

  <h1>Accesso area gestione foto</h1>
  <div class="card">
    <?php if (!empty($loginError)): ?><p class="error"><?= htmlspecialchars($loginError) ?></p><?php endif; ?>
    <form method="post">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required autofocus>
      <button type="submit">Accedi</button>
    </form>
  </div>

<?php else: ?>

  <h1>Gestione foto lavori <a class="logout" href="logout.php">Esci</a></h1>

  <div class="card">
    <h2 style="font-size:1.05rem;">Carica una nuova foto</h2>
    <form id="uploadForm">
      <label for="categoria">Servizio</label>
      <select id="categoria" name="categoria" required>
        <?php foreach (SERVICE_CATEGORIES as $slug => $label): ?>
          <option value="<?= htmlspecialchars($slug) ?>"><?= htmlspecialchars($label) ?></option>
        <?php endforeach; ?>
      </select>
      <label for="didascalia">Didascalia (facoltativa)</label>
      <input type="text" id="didascalia" name="didascalia" placeholder="Es. Quadro elettrico industriale - Asti">
      <label for="foto">Foto (JPG, PNG o WEBP, max 8MB)</label>
      <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/webp" required>
      <button type="submit">Carica foto</button>
      <p id="uploadMsg"></p>
    </form>
  </div>

  <?php foreach (SERVICE_CATEGORIES as $slug => $label):
        $items = read_gallery($slug); ?>
    <div class="card category-block" data-category="<?= htmlspecialchars($slug) ?>">
      <h3><?= htmlspecialchars($label) ?> (<?= count($items) ?> foto)</h3>
      <div class="gallery-admin-grid">
        <?php foreach ($items as $item):
              $file = htmlspecialchars((string) ($item['file'] ?? ''));
              $caption = htmlspecialchars((string) ($item['caption'] ?? '')); ?>
          <div class="gallery-admin-item">
            <img src="../uploads/<?= htmlspecialchars($slug) ?>/<?= $file ?>" alt="<?= $caption ?>">
            <form class="deleteForm" data-categoria="<?= htmlspecialchars($slug) ?>" data-file="<?= $file ?>">
              <button type="submit" title="Elimina foto">Elimina</button>
            </form>
          </div>
        <?php endforeach; ?>
        <?php if (!$items): ?>
          <p class="empty-note">Nessuna foto caricata per questo servizio.</p>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>

  <script>
    const uploadForm = document.getElementById('uploadForm');
    const uploadMsg = document.getElementById('uploadMsg');

    uploadForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      uploadMsg.textContent = 'Caricamento in corso…';
      uploadMsg.className = '';
      const body = new FormData(uploadForm);
      try {
        const res = await fetch('upload.php', { method: 'POST', body });
        const data = await res.json();
        if (!res.ok || data.error) throw new Error(data.error || 'Errore durante il caricamento.');
        uploadMsg.textContent = 'Foto caricata con successo.';
        uploadMsg.className = 'success';
        setTimeout(() => window.location.reload(), 700);
      } catch (err) {
        uploadMsg.textContent = err.message;
        uploadMsg.className = 'error';
      }
    });

    document.querySelectorAll('.deleteForm').forEach((form) => {
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        if (!confirm('Eliminare questa foto?')) return;
        const body = new FormData();
        body.append('categoria', form.dataset.categoria);
        body.append('file', form.dataset.file);
        try {
          const res = await fetch('delete.php', { method: 'POST', body });
          const data = await res.json();
          if (res.ok && data.ok) {
            form.closest('.gallery-admin-item').remove();
          } else {
            alert(data.error || 'Errore durante l\'eliminazione.');
          }
        } catch (err) {
          alert('Errore di rete durante l\'eliminazione.');
        }
      });
    });
  </script>

<?php endif; ?>

</div>
</body>
</html>
