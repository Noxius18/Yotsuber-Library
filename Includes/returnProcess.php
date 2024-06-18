<?php
session_start();
require 'db_connect.php';

$userID = $_SESSION['userID'];

$sql = 
'SELECT Katalog_Buku.Judul AS Judul, 
Pinjam.ID_Peminjaman AS pinjamID,
Katalog_Buku.Penulis AS Penulis, 
Katalog_Buku.Cover_Buku AS Cover,
Pinjam.Tgl_Peminjaman AS Tanggal FROM Pinjam
INNER JOIN Katalog_Buku ON Pinjam.ID_Katalog=Katalog_Buku.ID_Katalog
INNER JOIN Status_Pinjam ON Pinjam.ID_Peminjaman=Status_Pinjam.ID_Peminjaman
WHERE Pinjam.ID_Member = ? AND Status_Pinjam.sts = "Sedang Dipinjam"';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userID);
$stmt->execute();
$result = $stmt->get_result();

//Proses Update status Pengajuan
if(isset($_POST['submit'])){
    $idPeminjaman = $_POST['idPeminjaman'];
    $updateQuery = 'UPDATE Status_Pinjam SET sts = "Sedang Diajukan" WHERE ID_Peminjaman = ?';
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param('i', $idPeminjaman);
    $updateStmt->execute();
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-6">';
        echo '<div class="card mb-4">';
        echo '<div class="row g-0">';
        echo '<div class="col-md-4">';
        echo '<img src="../Assets/Images/Cover_Buku/'. htmlspecialchars($row['Cover']) .'" class="img-fluid rounded-start" alt="Cover Buku">';
        echo '</div>';
        echo '<div class="col-md-8">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'. htmlspecialchars($row['Judul']) .'</h5>';
        echo '<p class="card-text">';
        echo '<strong>Penulis: </strong>'. htmlspecialchars($row['Penulis']) .'<br>';
        echo '<strong>Tanggal Peminjaman: </strong>'. htmlspecialchars($row['Tanggal']);
        echo '</p>';
        echo '<form method="POST" action="">';
        echo '<input type="hidden" name="idPeminjaman" value="'.$row['pinjamID'].'">';
        echo '<button type="submit" name="submit" class="btn btn-primary">Ajukan Pengembalian</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<tr><td colspan="3">Tidak ada buku yang sedang dipinjam.</td></tr>';
}

