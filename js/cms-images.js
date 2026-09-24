(function () {
  var currentScript = document.currentScript;
  var depth = (currentScript && currentScript.getAttribute('data-depth')) || '';

  fetch(depth + 'content/images.json', { cache: 'no-store' })
    .then(function (res) {
      return res.ok ? res.json() : null;
    })
    .then(function (data) {
      if (!data) return;
      Object.keys(data).forEach(function (key) {
        var url = data[key];
        if (!url) return;
        document.querySelectorAll('[data-img-key="' + key + '"]').forEach(function (img) {
          img.src = depth + url;
        });
      });
    })
    .catch(function () {
      // Nessuna immagine personalizzata trovata: restano quelle di default nell'HTML.
    });
})();
