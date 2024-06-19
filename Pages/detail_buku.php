<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <link rel="stylesheet" href="../Assets/CSS/detail_buku.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- Navbar -->
    <header class="navbar navbar-yotsuba">
        <div class="logo">
            <h1 class="font-yotsuba">Perpustakaan Online</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Daftar Buku</a></li>
                <li><a href="#">Tentang</a></li>
                <li><a href="#">Kontak</a></li>
                <li><a href="#">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Book Detail Section -->
    <section class="book-detail">
        <div class="container">
            <div class="book-info">
                <img src="../Assets/Images/Cover_Buku/Mikulia.webp" alt="Book Cover">
                <div class="book-meta">
                    <h2 class="font-yotsuba">Judul Buku</h2>
                    <p><strong>Penulis:</strong> Nama Penulis</p>
                    <p><strong>Penerbit:</strong> Nama Penerbit</p>
                    <p><strong>Tahun Terbit:</strong> 2024</p>
                    <p><strong>ISBN:</strong> 123-456-789</p>
                    <p><strong>Kategori:</strong> Fiksi</p>
                    <p><strong>Bahasa:</strong> Indonesia</p>
                    <button class="borrow-btn warna-yotsuba">Pinjam Buku</button>
                </div>
            </div>
            <div class="book-description">
                <h3 class="font-yotsuba">Sinopsis</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel ligula eu eros cursus venenatis. Nulla facilisi. Duis at scelerisque magna, ac bibendum mauris. Integer interdum quam in urna cursus, vel condimentum libero volutpat.</p>
                <p>Vivamus tempor sapien sed ipsum dictum, nec fermentum est vehicula. Sed vitae orci vel metus volutpat dignissim. Curabitur vestibulum sapien non quam commodo, et luctus metus cursus. Vivamus maximus erat ut odio ullamcorper, vel sodales dui blandit.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>Informasi Hak Cipta &copy; 2024 Perpustakaan Online</p>
        <div class="footer-links">
            <a href="#">Tautan Sosial Media</a>
            <a href="#">Tentang Kami</a>
            <a href="#">Hubungi Kami</a>
        </div>
    </footer>
</body>
</html>
