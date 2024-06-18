<?php
session_start();
if(!isset($_SESSION['userID']) || $_SESSION['Role'] !== "Member"){
  header('Location: ../login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/CSS/main.css">
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
            <?php 
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="userDashboard.php">'.$_SESSION["namaDepan"]. ' '. $_SESSION["namaBelakang"] .'</a>';
            echo '</li>';
            ?>
            <li class="nav-item">
              <a class="nav-link" href="listBuku.php">Pinjam Buku</a>
            </li>
            <li class="nav-item">
              <a  class="nav-link" href="kembalikanUser.php">Kembalikan Buku</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../Includes/logout.php">Logout</a>
            </li>
        </ul>
      </div>
    </div>
  </nav>

  <header>
    <div class="container-fluid mb-5 p-5 text-left bg-hero-yotsuba">
        <h1>Dashboard Pengembalian</h1>
    </div>
  </header>


  <div class="container mt-5">
    <h2>Konfirmasi Pengembalian Buku</h2>
      <div class="row">
          <?php require '../Includes/returnProcess.php' ?>
      </div>
  </div>

  <div class="text-center p-3 footer warna-yotsuba text-black fixed-bottom">
        &copy 2024 Yotsuba Jisho!
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>