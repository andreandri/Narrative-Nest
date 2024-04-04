<?php include "database.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NN-Narrative Nest</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@100;300;700&display=swap" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Style -->
    <style>
    <?php include "style.css"?>
    </style>
</head>

<body>

    <!-- Navbar Start -->
    <nav class="navbar">
        <!--membuat elemen navigasi  menggunakan kelas navbar-->
        <a href="#" class="navbar-logo">Narrative<span>Nest</span>.</a>
        <!--membuat logo dengan desain kte-->

        <div class="navbar-nav">
            <!--membuat kelas navbar-nav -->
            <!--membuat daftar navigasi dengan tautan ke bagian berbeda dihalaman-->
            <a href="#home">Home</a>
            <a href="#about">Tentang Kami</a>
            <a href="#produk">Koleksi Kami</a>
            <a href="#kontak">Kontak Kami</a>
        </div>

        <div class="navbar-extra">
        <form action="#" method="post">
            <!--membuat kelas navbar extra digunakan untuk tambahan navbar berupa icon -->
            <a href="#" id="search-button"><i data-feather="search"></i></a>
            <a href="#" id="shopping-button" name="tekan-keranjang"><i data-feather="shopping-cart"></i></a>
            <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
        </form>
        </div>

        <!-- Seacrh Form Start-->
        <div class="search-form">
            <form action="#" method="GET" id="search-form">
                <div class="search-container">
                    <input type="search" id="search-box" name="search" placeholder="Cari judul buku...">
                    <div id="search-result"></div>
                </div>
            </form>
        </div>
        <!-- Seacrh Form End-->
        <!-- Shopping Cart Start -->
        <div class="shopping-cart" id="shopping-cart">
        </div>
        <!-- Shopping Cart End -->

    </nav>
    
    <!-- Navbar End -->

    <!-- Hero Section Start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>Time To Read A <span>Book</span></h1>
            <p>"Unforgettable Stories, Find It Here!"</p>
            <a href="#produk" class="cta">Lihat Produk</a>
        </main>
    </section>

    <!-- Hero Section End -->

    <!-- About Section Start -->
    <section id="about" class="about">
        <h2><span>Tentang</span> Kami</h2>

        <div class="row">
            <div class="about-img">
                <img src="image/LOGO NN.png" alt="" class="Tentang Kami">
            </div>
            <div class="content">
                <h3>Kenapa beli di Toko Kami ?</h3>
                <p>Hai, pecinta buku! Selamat Datang di dunia kami yang penuh cerita tak terlupakan di Halaman.</p>
                <p>Mengapa teman-teman harus berbelanja di toko kami ? Yang pastinya di NN store memiliki koleksi novel
                    terbaik, memiiki koleksi novel yang up-to-date. Mulai dari yang klasik hingga bestseller terbaru.
                    Pelayanan ramah dan berpengetahuan, teman-temman bisa minta rekomendasikan novel-novel terbaik dari
                    admin NN, pengiriman aman dan cepat.</p>
                <p>Jadi,tunggu apa lagi? Mari jeljahi dunia tak terbatas dari halaman buku-buku kami! Dengan koleksi
                    kaya, pelayanan yang ramah, dan penawaran yang menggiurkan, toko buku kami siap mengantarkan kamu
                    pada petualangan membaca yang tak terlupakan.</p>
                <p>Terima kasih sudah memilih Narrative Nest sebagai destinasi buku novel impianmu! Ayo, temukan
                    ceritamu disini.</p>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Menu Section Start -->
    <section id="produk" class="produk">
        <h2><span>Koleksi</span> Kami</h2>
        <p>Jelajahi koleksi kami sekarang dan temukan cerita baru yang akan memikat anda!</p>

        <div class="produk-wrapper">
            <?php
        $sql = "SELECT * FROM tb_novel";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo <<<HTML
                    <div class="produk-card">
                    <a href="detail_novel.php?id={$row['id_novel']}">
                    <img src="{$row['sampul_novel']}" class="produk-card-img"/>
                  <h3 class="produk-card-title">- {$row['judul_novel']} -</h3>
                  <p class="produk-card-price">IDR {$row['harga']},- </p>
                </a>
                </div>
        HTML;
            }
        } else {
            echo "Tidak ada data novel yang tersedia.";
        }
        

        // Close the connection
        $db->close();
        ?>
        </div>
    </section>
    <!-- Menu Section End -->


    <!-- Kontak Section Start -->
    <section id="kontak" class="kontak">
        <h2><span>Kontak</span> Kami</h2>

        <p>Hubungi Kami melalui sosial media Instagram atau langsung ke Whatsapp berikut ini!</p>
        <div class="hubungi">
            <a href="https://www.instagram.com/hmti_upr" target="_blank"><i data-feather="instagram"></i></a>
            <a href="https://wa.me/62895340590148" target="_blank"><i data-feather="phone"></i></a>
        </div>
        <div class="row">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.8344401670142!2d113.89861210000001!3d-2.216046299999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfcb306e0f3dced%3A0x4d50f29c05d3af2d!2sJurusan%20Teknik%20Informatika%2C%20Fakultas%20Teknik%20UPR!5e0!3m2!1sid!2sid!4v1708434390470!5m2!1sid!2sid"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>
        </div>
    </section>
    <!-- Kontak Section End -->

    <!-- Footer Start -->
    <footer>
        <div class="socials">
            <a href="https://www.instagram.com/hmti_upr" target="_blank"><i data-feather="instagram"></i></a>
            <a href="https://wa.me/62895340590148" target="_blank"><i data-feather="phone"></i></a>
        </div>

        <div class="links">
            <a href="#home">Home</a>
            <a href="#about">Tentang Kami</a>
            <a href="#produk">Koleksi Kami</a>
            <a href="#kontak">Kontak Kami</a>
        </div>

        <div class="credit">
            <p>Created by <a href="">kelompok6</a>. | &copy; 2024.</p>
        </div>
    </footer>
    <!-- Footer End -->



    <!-- Feather Icons -->
    <script>
    feather.replace();
    </script>

    <!-- My JavaScript -->
    <script src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/Javascript">
        $(document).ready(function(){
        $("#search-box").keyup(function(){
        var input = $(this).val();
    
        if (input != "") {
            $.ajax({
                url:"search.php",
                method:"POST",
                data:{input:input},
            
                success:function (data) {
                    $("#search-result").html(data);
                    $("#search-result").css("display","block");
                    $("#search-result").css("overflow","auto");
                    $("#search-result").css("height","35rem");
                    
                    
                }
            });
        }else{
            $("#search-result").css("display","none");
        }
        });
    });

    $(document).ready(function(){
    // Membuat penanganan peristiwa untuk tombol keranjang
    $("#shopping-button").click(function(){
        $.ajax({
            url:"keranjang.php",
            method:"POST",
            data:{action: "shopping_button_clicked"},
            success:function (data) {
                $("#shopping-cart").html(data);
                $("#shopping-cart").css("display","block");
            }
        });
    });
});
$(document).ready(function(){
    // Membuat penanganan peristiwa untuk tombol tambah
    $(".tambah").click(function(e){
        e.preventDefault(); // Mencegah perilaku default tombol submit
        
        // Ambil judul novel dari atribut value
        var judul = $(this).val();
        
        // Kirim permintaan AJAX ke server untuk menambahkan novel ke keranjang
        $.ajax({
            url: "tambah_keranjang.php",
            method: "POST",
            data: { judul: judul },
            success: function(data) {
                // Tambahkan kode di sini jika diperlukan setelah menambahkan novel ke keranjang
            },
            error: function(xhr, status, error) {
                // Jika terjadi kesalahan, tampilkan pesan kesalahan
                console.error(xhr.responseText);
                alert("Gagal menambahkan item ke keranjang!");
            }
        });
    });
});

$(document).ready(function(){
    $(".remove-item").click(function(e){
        e.preventDefault(); // Mencegah perilaku default tombol submit
        
        // Ambil judul novel dari atribut value
        var judul = $(this).val();
        
        // Menghapus item dari DOM
        $(this).closest('.item').remove();

        // Mengirimkan permintaan AJAX kehapus_keranjang.php
        $.ajax({
            url: "hapus_keranjang.php",
            method: "POST",
            data: { judul: judul },
            success: function(data) {
                // Lakukan sesuatu setelah item dihapus, jika perlu
                alert("Item berhasil dihapus dari keranjang!");
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Gagal menghapus item dari keranjang!");
            }
        });
    });
});
</script>
</body>