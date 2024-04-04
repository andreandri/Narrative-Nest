// Toggle class active ham menu
const navbarNav = document.querySelector(".navbar-nav");

// Ketika hamburger-menu diklik
document.querySelector("#hamburger-menu").onclick = () => {
  navbarNav.classList.toggle("active");
};

// Toggle class active shopping
const shoppingCart = document.querySelector(".shopping-cart");

// Ketika shopping diklik
document.querySelector("#shopping-button").onclick = (e) => {
  shoppingCart.classList.toggle("active");
  e.preventDefault(); // Mencegah tindakan default dari link
};

// Toggle class active search form
const searchForm = document.querySelector(".search-form");
const searchBox = document.querySelector("#search-box");

// Ketika search diklik
document.querySelector("#search-button").onclick = (e) => {
  searchForm.classList.toggle("active");
  searchBox.focus();
  e.preventDefault(); // Mencegah tindakan default dari link
};

// Klik di luar side bar untuk menghilangkan bar
document.addEventListener("click", function (event) {
  const hb = document.querySelector("#hamburger-menu");
  const sb = document.querySelector("#search-button");
  const sc = document.querySelector("#shopping-button");

  if (!hb.contains(event.target) && !navbarNav.contains(event.target)) {
    navbarNav.classList.remove("active");
  }

  if (!sb.contains(event.target) && !searchForm.contains(event.target)) {
    searchForm.classList.remove("active");
  }

  if (!sc.contains(event.target) && !shoppingCart.contains(event.target)) {
    shoppingCart.classList.remove("active");
  }
});

// Kirim permintaan pencarian ketika dokumen selesai dimuat
document.querySelector("#search-form").addEventListener("submit", function (e) {
  e.preventDefault(); // Mencegah form submit

  const searchQuery = document.querySelector("#search-box").value; // Ambil nilai dari input pencarian

  // Buat objek XMLHttpRequest
  const xhr = new XMLHttpRequest();

  // Konfigurasi request
  xhr.open("GET", `search.php?search=${searchQuery}`, true);

  // Tangani ketika respons diterima
  xhr.onload = function () {
    if (this.status === 200) {
      // Jika respons berhasil (status 200)
      document.querySelector("#search-result").innerHTML = this.responseText; // Tampilkan hasil pencarian di dalam div dengan id "search-result"
    }
  };

  // Kirim request
  xhr.send();
});

// Menghapus hasil pencarian ketika mengklik di luar hasil pencarian
document.addEventListener("click", function (event) {
  const searchResult = document.getElementById("search-result");
  const searchBox = document.getElementById("search-box");

  // Periksa apakah elemen yang diklik bukan bagian dari hasil pencarian atau kotak pencarian itu sendiri
  if (!searchResult.contains(event.target) && !searchBox.contains(event.target)) {
    searchResult.innerHTML = ""; // Kosongkan kotak hasil pencarian
  }
});

// Memproses penambahan buku ke keranjang
document.querySelectorAll(".add-to-cart").forEach(button => {
  button.addEventListener("click", function(e) {
      e.preventDefault();
      const judul = this.dataset.judul;
      const formData = new FormData();
      formData.append("judul", judul);
      formData.append("tambah_ke_keranjang", true);

      fetch("your_php_script.php", {
          method: "POST",
          body: formData
      })
      .then(response => {
          if (response.ok) {
              return response.text();
          }
          throw new Error("Gagal menambahkan buku ke keranjang!");
      })
      .then(data => {
          window.location.reload(); // Muat ulang halaman setelah berhasil menambahkan buku ke keranjang
      })
      .catch(error => {
          console.error(error);
          alert(error.message);
      });
  });
});

