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
  initAccordion();
}

// Initialize FAQ accordion (idempotent)
function initAccordion() {
  var buttons = document.querySelectorAll(".faq-question");
  buttons.forEach(function (btn) {
    if (btn.dataset.faqInit) return; // already initialized
    btn.dataset.faqInit = "1";
    btn.addEventListener("click", function () {
      var item = btn.closest(".faq-item");
      if (!item) return;
      // toggle open class; CSS handles animation via max-height
      item.classList.toggle("open");
    });
  });
}

// Ensure accordion initialized even if includes/load timing varies
window.addEventListener("load", function () {
  // remove any 'open' classes on load to ensure all answers are closed
  var items = document.querySelectorAll(".faq-item.open");
  items.forEach(function (it) {
    it.classList.remove("open");
  });
  initAccordion();
});

// Simple debounce (top-level so it is available when includes run)
function debounce(fn, wait) {
  var t;
  return function () {
    var args = arguments;
    clearTimeout(t);
    t = setTimeout(function () {
      fn.apply(null, args);
    }, wait || 250);
  };
}
