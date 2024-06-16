<?php
session_start();
require 'db_connect.php';

if(!isset($_SESSION['userID'])){
    header('Location: ../login.php');
    exit();
}

$user = $_SESSION['userID'];

$sql = 
'SELECT Katalog_Buku.Judul AS Judul,
Katalog_Buku.Penulis AS Penulis, 
Pinjam.Tgl_Peminjaman AS Tgl_Peminjaman, 
Pinjam.Bts_Peminjaman AS Bts_Peminjaman, 
Katalog_Buku.Cover_Buku AS Cover FROM Status_Pinjam
INNER JOIN Pinjam ON Status_Pinjam.ID_Peminjaman=Pinjam.ID_Peminjaman
INNER JOIN Member ON Pinjam.ID_Member=Member.ID_Member 
INNER JOIN Katalog_Buku ON Pinjam.ID_Katalog=Katalog_Buku.ID_Katalog
WHERE Member.ID_Member = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="col-md-3 col-sm-6 mb-4">';
        echo '<div class="card" style="width: 18rem">';
        echo '<img src="../Assets/Images/Cover_Buku/' . htmlspecialchars($row['Cover']) . '" class="card-img-top" alt="Cover">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'. htmlspecialchars($row['Judul']) .'</h5>';
        echo '<h6 class="card-subtitle mb-2 text-muted">'. htmlspecialchars($row['Penulis']) .'</h6>';
        echo '<p class="card-text">Tanggal Pinjam: '. htmlspecialchars($row['Tgl_Peminjaman']) .'</p>';
        echo '<p class="card-text">Batas Pengembalian: '. htmlspecialchars($row['Bts_Peminjaman']) .'</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
else {
    echo 'Kamu belum meminjam buku';
}