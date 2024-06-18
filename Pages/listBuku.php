<?php
session_start();
if (!isset($_SESSION["userID"]) || ($_SESSION["Role"] !== "Admin" && $_SESSION["Role"] !== "Member")) {
  header("Location: ../login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perpustakaan</title>
    <link rel="stylesheet" href="../Assets/CSS/list_buku.css">
    <link rel="stylesheet" href="../Assets/CSS/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="font-yotsuba">
  <nav class="navbar navbar-expand-md warna-yotsuba fixed-top">
    <div class="container-fluid">
      <a href="#" class="navbar-brand">Yotsuba Jisho!</a>
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
          <?php
          if(isset($_SESSION["userID"]) && $_SESSION["Role"] === "Member"){
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="userDashboard.php">'.$_SESSION["namaDepan"]. ' '. $_SESSION["namaBelakang"] .'</a>';
            echo '</li>';
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="listBuku.php">Pinjam Buku</a>';
            echo '</li>';
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="kembalikanUser.php">Kembalikan Buku</a>';
            echo '</li>';
          }

          if(isset($_SESSION["userID"]) && $_SESSION["Role"] === "Admin"){
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="adminDashboard.php">Dashboard</a>';
            echo '</li>';
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="tambahBuku.php">Kelola Buku</a>';
            echo '</li>';
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="listBuku.php">List Buku</a>';
            echo '</li>';
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="kembalikanAdmin.php">Pengembalian Buku</a>';
            echo '</li>';
          }
          ?>
          <li class="nav-item">
            <a  class="nav-link" href="../Includes/logout.php">Logout</a>
          </li>
      </ul>
    </div>
  </nav>

  <header>
    <div class="container-fluid p-5 text-left bg-hero-yotsuba">
        <h1>Daftar Buku</h1>
    </div>
  </header>
  
  <section>
    <div class="card-container">
      <div class="container">
          <div class="row">
            <?php include '../Includes/listBook.php'; ?>
          </div>
      </div>
    </div>
  </section>
  <!-- Footer -->
  <div class="text-center p-3 warna-yotsuba">
    © 2024 Copyright: Yotsuba Jisho!
  </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
