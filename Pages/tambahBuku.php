<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yotsuba Jisho!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/CSS/main.css">
</head>
<body>
</head>
<body class="font-yotsuba">
    <!-- Mulai Navbar -->
    <nav class="navbar navbar-expand-md warna-yotsuba fixed-top">
        <div class="container-fluid">
          <a href="#" class="navbar-brand font-yotsuba2">Yotsuba Jisho!</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                <a href="#" class="navbar-brand offcanvas-title">Yotsuba Jisho!</a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
          <div class="offcanvas-body" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                  <a class="nav-link" href="adminDashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kelola Buku</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Pengembalian Buku</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../Includes/logout.php">Logout</a>
                </li>
              </ul>
        </div>
      </nav>

    <header>
        <div class="container-fluid p-5 text-left bg-hero-yotsuba">
            <h1>Tambah Buku Baru</h1>
        </div>
    </header>

    <div class="container px-5 my-5">
        <form action="../Includes/addBook.php" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input class="form-control" name="judulBuku" type="text" placeholder="Judul Buku" data-sb-validations="required" />
                <label for="judulBuku">Judul Buku</label>
                <div class="invalid-feedback" data-sb-feedback="judulBuku:required">Judul Buku is required.</div>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" name="penulis" type="text" placeholder="Penulis" data-sb-validations="required" />
                <label for="penulis">Penulis</label>
                <div class="invalid-feedback" data-sb-feedback="penulis:required">Penulis is required.</div>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" name="genre" type="text" placeholder="Genre" data-sb-validations="required" />
                <label for="genre">Genre</label>
                <div class="invalid-feedback" data-sb-feedback="genre:required">Genre is required.</div>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="sinopsis" type="text" placeholder="Sinopsis" style="height: 10rem;" data-sb-validations="required"></textarea>
                <label for="sinopsis">Sinopsis</label>
                <div class="invalid-feedback" data-sb-feedback="sinopsis:required">Sinopsis is required.</div>
            </div>    
            <div class="form-floating mb-3">
                <input class="form-control" name="tahunTerbit" type="text" placeholder="Tahun Terbit" data-sb-validations="required" />
                <label for="tahunTerbit">Tahun Terbit</label>
                <div class="invalid-feedback" data-sb-feedback="tahunTerbit:required">Tahun Terbit is required.</div>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" name="isbn" type="text" placeholder="ISBN" data-sb-validations="required" />
                <label for="isbn">ISBN</label>
                <div class="invalid-feedback" data-sb-feedback="isbn:required">ISBN is required.</div>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" name="jumlahBuku" type="number" placeholder="Jumlah Buku" data-sb-validations="required" />
                <label for="jumlahBuku">Jumlah Buku</label>
                <div class="invalid-feedback" data-sb-feedback="isbn:required">ISBN is required.</div>
            </div>
            <div class="mb-3">
                <label for="coverBuku">Cover Buku</label>
                <input type="file" class="form-control" accept="image/*" id="coverBuku" name="coverBuku">
            </div>
            <div class="d-grid">
                <button class="btn warna-yotsuba2 text-white btn-lg" name="tambah" type="submit">Tambah Buku</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>