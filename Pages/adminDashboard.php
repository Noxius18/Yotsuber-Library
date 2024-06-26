<?php
session_start();
if(!isset($_SESSION["userID"]) || $_SESSION["Role"] !== "Admin"){
  header("Location: ../login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../Assets/CSS/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="font-yotsuba">
    <nav class="navbar navbar-expand-md warna-yotsuba fixed-top">
        <div class="container-fluid">
          <a href="home.php" class="navbar-brand font-yotsuba2">Yotsuba Jisho!</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
              <div class="offcanvas-header">
              <a href="home.php" class="navbar-brand offcanvas-title">Yotsuba Jisho!</a>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                  <a class="nav-link" href="adminDashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tambahBuku.php">Kelola Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listBuku.php">List Buku</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="kembalikanAdmin.php">Pengembalian Buku</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../Includes/logout.php">Logout</a>
                </li>
              </ul>
          </div>
        </div>
      </nav>

    <header>
        <div class="container-fluid mb-4 p-5 text-left bg-hero-yotsuba">
            <h1>Dashboard Admin</h1>
        </div>
    </header>

    <div class="container-fluid mt-5">
        <h2 class="mb-3">Buku Yang Dipinjam</h2>
        <table class="table table-striped table-hover">
            <form action="" method="POST">
              <div class="form-outline p-2" data-mdb-input-init>
                  <input type="search" id="form1" class="form-control" placeholder="Cari..." name="cari" aria-label="Search" />
              </div>
            </form>
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Batas Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>               
                <?php include '../Includes/adminDash.php'; ?>               
            </tbody>
        </table>
    </div>

    <div class="text-center p-3 warna-yotsuba fixed-bottom text-black">
      &copy 2024 Yotsuba Jisho!
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
