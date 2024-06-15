<?php
session_start();
require 'db_connect.php';

$cari = isset($_POST['keyword']) ? filter_input(INPUT_POST, 'keyword', FILTER_SANITIZE_STRING) : ''; 

if($cari) {
    $sql = 'SELECT * FROM Katalog_Buku WHERE Judul LIKE ? OR Penulis LIKE ? OR Genre LIKE ?';
    $stmt = $conn->prepare($sql);
    $cari ='%'. $cari. '%';
    $stmt->bind_param('sss', $cari, $cari, $cari);
    $stmt->execute();
    $res = $stmt->get_result();
}
else {
    $sql = 'SELECT * FROM Katalog_Buku';
    $res = $conn->query($sql);
}

if($res->num_rows > 0){
    while($row = $res->fetch_assoc()){
        echo '<div class="col-md-3 col-sm-6 mb-4">';
        echo '<div class="card" style="width: 18rem;">';
        echo '<img src="../Assets/Images/Cover_Buku/' . htmlspecialchars($row["Cover_Buku"]) . '" class="card-img-top" alt="Cover Buku">';
        echo '<div class="card-body text-center">';
        echo '<h5 class="card-title font-yotsuba">' . htmlspecialchars($row["Judul"]) . '</h5>';
        echo '<p class="card-text">' . htmlspecialchars($row["Penulis"]) . '</p>';
        echo '<a href="#" class="btn btn-primary">Detail Buku</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
else {
    echo "Tidak ada buku";
}

$conn->close();