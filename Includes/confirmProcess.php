<?php
session_start();
require 'db_connect.php';

$sql = 
"SELECT Pinjam.ID_Peminjaman AS idPinjam, 
Katalog_Buku.Judul AS Judul, 
CONCAT(Member.Nama_Depan, ' ', Member.Nama_Belakang) AS Nama, 
Pinjam.Tgl_Peminjaman AS Tanggal, 
Katalog_Buku.Cover_Buku AS Cover FROM Pinjam 
INNER JOIN Member ON Pinjam.ID_Member=Member.ID_Member 
INNER JOIN Katalog_Buku ON Pinjam.ID_Katalog=Katalog_Buku.ID_Katalog
INNER JOIN Status_Pinjam ON Status_Pinjam.ID_Status=Pinjam.ID_Peminjaman 
WHERE Status_Pinjam.sts = 'Sedang Diajukan'";
$result = $conn->query($sql);

if(isset( $_POST["submit"] )) {
    $idPeminjaman = $_POST['idPeminjaman'];
    // $tanggalPengembalian = date('Y-m-d');
    
    // Update status pengembalian di tabel Status_Pinjam
    $updateQueryStatus = 'UPDATE Status_Pinjam SET sts = "Dikembalikan" WHERE ID_Peminjaman = ?';
    $updateStmtStatus = $conn->prepare($updateQueryStatus);
    $updateStmtStatus->bind_param('i', $idPeminjaman);
    $updateStmtStatus->execute();

    // Update tanggal pengembalian di tabel Pinjam
    $updateQueryTanggal = 'UPDATE Pinjam SET Tgl_Pengembalian = CURDATE() WHERE ID_Peminjaman = ?';
    $updateStmtTanggal = $conn->prepare($updateQueryTanggal);
    $updateStmtTanggal->bind_param('i', $idPeminjaman);
    $updateStmtTanggal->execute();

    if($updateStmtStatus->affected_rows > 0 && $updateStmtTanggal->affected_rows > 0) {
        header("Location: ../Pages/kembalikanAdmin.php?success=true");
        exit();
    }
}
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         echo '<div class="col-md-6">';
//         echo '<div class="card mb-4">';
//         echo '<div class="row g-0">';
//         echo '<div class="col-md-4">';
//         echo '<img src="../Assets/Images/Cover_Buku/'. htmlspecialchars($row['Cover']) .'" class="img-fluid rounded-start" alt="Cover Buku">';
//         echo '</div>';
//         echo '<div class="col-md-8">';
//         echo '<div class="card-body">';
//         echo '<h5 class="card-title">'. htmlspecialchars($row['Judul']) .'</h5>';
//         echo '<p class="card-text">';
//         echo '<strong>Peminjam: </strong>'. htmlspecialchars($row['Nama']) .'<br>';
//         echo '<strong>Tanggal Peminjaman: </strong>'. htmlspecialchars($row['Tanggal']);
//         echo '</p>';
//         echo '<form method="POST" action="">';
//         echo '<input type="hidden" name="idPeminjaman" value="'.$row['idPinjam'].'">';
//         echo '<button type="submit" name="submit" class="btn btn-primary">Konfirmasi Pengembalian</button>';
//         echo '</form>';
//         echo '</div>';
//         echo '</div>';
//         echo '</div>';
//         echo '</div>';
//         echo '</div>';

//     }
// } else {
//     echo '<div class="col-md-12">';
//     echo '<div class="card">';
//     echo '<div class="card-body">';
//     echo '<p class="card-text">Tidak ada buku yang sedang dipinjam.</p>';
//     echo '</div>';
//     echo '</div>';
//     echo '</div>';
// }
