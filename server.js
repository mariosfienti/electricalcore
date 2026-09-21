import express from 'express';
import path from 'path';
import fs from 'fs';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
const PORT = 3000;
const HOST = '0.0.0.0';

const SERVICES_DIR = path.join(__dirname, 'assets', 'services');
if (!fs.existsSync(SERVICES_DIR)) {
  fs.mkdirSync(SERVICES_DIR, { recursive: true });
}

// Map between service identifiers and matching keywords for user-uploaded files
const SERVICE_PATTERNS = {
  'impianti-elettrici': ['11_29_22 (1)', '(1)', 'impianti-elettrici', 'quadro'],
  'videosorveglianza': ['11_29_23 (2)', '(2)', 'videosorveglianza', 'telecamera'],
  'videocitofonia': ['11_29_23 (3)', '(3)', 'videocitofonia', 'citofono'],
  'automazione-cancelli': ['11_29_23 (4)', '(4)', 'automazione-cancelli', 'cancello'],
  'panoramica-lavori': ['11_29_23 (5)', '(5)', 'panoramica-lavori', 'collage'],
  'antenne-reti-dati': ['11_29_24 (6)', '(6)', 'antenne-reti-dati', 'antenne', 'rack'],
  'chi-siamo': ['11_50_30', '11_50', 'chi-siamo', 'tecnico', 'elettricista']
};

function autoDetectService(filename) {
  const lower = filename.toLowerCase();
  for (const [key, patterns] of Object.entries(SERVICE_PATTERNS)) {
    for (const pat of patterns) {
      if (lower.includes(pat.toLowerCase())) {
        return key;
      }
    }
  }
  return null;
}

// Auto-scan directories to link uploaded ChatGPT images to service keys
function scanAndLinkImages() {
  const dirsToScan = [SERVICES_DIR, path.join(__dirname, 'assets'), __dirname];
  for (const dir of dirsToScan) {
    if (!fs.existsSync(dir)) continue;
    try {
      const files = fs.readdirSync(dir);
      for (const file of files) {
        if (!file.match(/\.(png|jpe?g|webp)$/i)) continue;
        const matchedKey = autoDetectService(file);
        if (matchedKey) {
          const ext = path.extname(file).toLowerCase();
          const targetFile = path.join(SERVICES_DIR, `${matchedKey}${ext}`);
          const srcFile = path.join(dir, file);
          if (srcFile !== targetFile && !fs.existsSync(targetFile)) {
            try {
              fs.copyFileSync(srcFile, targetFile);
              console.log(`Auto-linked ${file} -> ${targetFile}`);
            } catch (err) {
              console.error(`Failed linking ${file}:`, err);
            }
          }
        }
      }
    } catch (e) {
      console.warn(`Error scanning dir ${dir}:`, e.message);
    }
  }
}

scanAndLinkImages();

app.use(express.json({ limit: '50mb' }));
app.use(express.static(__dirname));

// Endpoint to get the best matching image for each service
app.get('/api/service-image/:key', (req, res) => {
  const key = req.params.key;
  if (!SERVICE_PATTERNS[key]) {
    return res.status(404).send('Servizio non trovato');
  }

  // Check in priority order:
  // 1. Exact png in assets/services/
  const pngPath = path.join(SERVICES_DIR, `${key}.png`);
  if (fs.existsSync(pngPath)) {
    return res.sendFile(pngPath);
  }

  // 2. Pattern match inside assets/services/ or assets/ or root
  const patterns = SERVICE_PATTERNS[key];
  const searchDirs = [SERVICES_DIR, path.join(__dirname, 'assets'), __dirname];

  for (const dir of searchDirs) {
    if (!fs.existsSync(dir)) continue;
    try {
      const files = fs.readdirSync(dir);
      for (const file of files) {
        if (!file.match(/\.(png|jpe?g|webp)$/i)) continue;
        const lower = file.toLowerCase();
        if (patterns.some(p => lower.includes(p.toLowerCase()))) {
          const matchedPath = path.join(dir, file);
          return res.sendFile(matchedPath);
        }
      }
    } catch (e) {
      // continue
    }
  }

  // 3. Exact jpg in assets/services/
  const jpgPath = path.join(SERVICES_DIR, `${key}.jpg`);
  if (fs.existsSync(jpgPath)) {
    return res.sendFile(jpgPath);
  }

  // 4. Fallback for panoramica-lavori or chi-siamo if not uploaded yet
  if (key === 'panoramica-lavori' || key === 'chi-siamo') {
    const fallbackChiSiamo = path.join(SERVICES_DIR, 'panoramica-lavori.png');
    if (fs.existsSync(fallbackChiSiamo)) {
      return res.sendFile(fallbackChiSiamo);
    }
    const fallback = path.join(SERVICES_DIR, 'impianti-elettrici.jpg');
    if (fs.existsSync(fallback)) {
      return res.sendFile(fallback);
    }
  }

  res.status(404).send('Immagine non trovata');
});

// Endpoint to upload / save images directly
app.post('/api/upload-service-image', (req, res) => {
  try {
    const { key, filename, dataUrl } = req.body;
    let targetKey = key;
    if (!targetKey && filename) {
      targetKey = autoDetectService(filename);
    }
    if (!targetKey) {
      return res.status(400).json({ success: false, error: 'Chiave servizio mancante o non riconosciuta' });
    }

    if (!dataUrl || !dataUrl.includes(',')) {
      return res.status(400).json({ success: false, error: 'Formato dataUrl non valido' });
    }

    const base64Data = dataUrl.split(',')[1];
    const buffer = Buffer.from(base64Data, 'base64');
    
    // Save as png and also with original filename if provided
    const targetPng = path.join(SERVICES_DIR, `${targetKey}.png`);
    fs.writeFileSync(targetPng, buffer);

    if (filename) {
      const originalPath = path.join(SERVICES_DIR, filename);
      fs.writeFileSync(originalPath, buffer);
    }

    console.log(`Saved uploaded image for service: ${targetKey}`);
    res.json({ success: true, service: targetKey, url: `/assets/services/${targetKey}.png?t=${Date.now()}` });
  } catch (err) {
    console.error('Error saving uploaded image:', err);
    res.status(500).json({ success: false, error: err.message });
  }
});

// Endpoint to query current image statuses
app.get('/api/services-status', (req, res) => {
  const result = {};
  for (const key of Object.keys(SERVICE_PATTERNS)) {
    const pngExists = fs.existsSync(path.join(SERVICES_DIR, `${key}.png`));
    const jpgExists = fs.existsSync(path.join(SERVICES_DIR, `${key}.jpg`));
    result[key] = {
      hasPng: pngExists,
      hasJpg: jpgExists,
      activeUrl: pngExists ? `/assets/services/${key}.png` : (jpgExists ? `/assets/services/${key}.jpg` : null)
    };
  }
  res.json(result);
});

// Clean route for service pages (supports /servizi/slug as well as /servizi/slug.html)
app.get('/servizi/:slug', (req, res, next) => {
  const cleanSlug = req.params.slug.replace(/\.html$/, '');
  const htmlPath = path.join(__dirname, 'servizi', `${cleanSlug}.html`);
  if (fs.existsSync(htmlPath)) {
    return res.sendFile(htmlPath);
  }
  next();
});

app.get('*', (req, res) => {
  res.sendFile(path.join(__dirname, 'index.html'));
});

app.listen(PORT, HOST, () => {
  console.log(`Server running on http://${HOST}:${PORT}`);
});
