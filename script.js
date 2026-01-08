// Fungsi untuk memasukkan konten dari file eksternal
function includeHTML() {
  var elements = document.querySelectorAll("[data-include]");
  elements.forEach(function (el) {
    var file = el.getAttribute("data-include");
    if (!file) return;
    // gunakan fetch untuk kesederhanaan dan menangani banyak elemen
    fetch(file)
      .then(function (response) {
        if (!response.ok) throw new Error("not found");
        return response.text();
      })
      .then(function (html) {
        el.innerHTML = html;
        // after include inserted, initialize any dynamic behaviors for included fragment
        try {
          initIncludes();
        } catch (e) {
          // ignore
        }
      })
      .catch(function () {
        el.innerHTML = "Page not found.";
      });
  });
}

// Panggil fungsi saat halaman dimuat
document.addEventListener("DOMContentLoaded", includeHTML);

// Initialize behaviors for included fragments (idempotent)
function initIncludes() {
  // Placeholder for future initialization functions
}
