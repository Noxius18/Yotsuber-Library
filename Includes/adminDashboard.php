<?php
session_start();
require 'db_connect.php';

$search = isset($_POST['cari']) ? filter_input(INPUT_POST, 'cari', FILTER_SANITIZE_STRING) : ''; 

if($search){
    $sql = 
    'SELECT CONCAT(Member.Nama_Depan, " ", Member.Nama_Belakang) AS Nama, 
    Katalog_Buku.Judul AS Judul, 
    Riwayat_Peminjaman.Tgl_Peminjaman AS Tgl_Peminjaman, 
    Riwayat_Peminjaman.Bts_Peminjaman AS Bts_Peminjaman, 
    Riwayat_Peminjaman.Tgl_Pengembalian AS Tgl_Pengembalian FROM Riwayat_Peminjaman 
    INNER JOIN Member ON Riwayat_Peminjaman.ID_Member=Member.ID_Member 
    INNER JOIN Katalog_Buku ON Riwayat_Peminjaman.ID_Katalog=Katalog_Buku.ID_Katalog
    WHERE CONCAT(Member.Nama_Depan, " ", Member.Nama_Belakang) LIKE ? OR Email LIKE ? OR Judul LIKE ?;';
    $stmt = $conn->prepare($sql);
    $search = '%'. $search .'%';
    $stmt->bind_param('sss', $search, $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();
}
else{
    $sql = 
    'SELECT CONCAT(Member.Nama_Depan, " ", Member.Nama_Belakang) AS Nama, 
    Katalog_Buku.Judul AS Judul, 
    Riwayat_Peminjaman.Tgl_Peminjaman AS Tgl_Peminjaman, 
    Riwayat_Peminjaman.Bts_Peminjaman AS Bts_Peminjaman, 
    Riwayat_Peminjaman.Tgl_Pengembalian AS Tgl_Pengembalian FROM Riwayat_Peminjaman 
    INNER JOIN Member ON Riwayat_Peminjaman.ID_Member=Member.ID_Member 
    INNER JOIN Katalog_Buku ON Riwayat_Peminjaman.ID_Katalog=Katalog_Buku.ID_Katalog;';

    $result = $conn->query($sql);
}

if( $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>'. htmlspecialchars($row['Nama']) .'</td>';
        echo '<td>'. htmlspecialchars($row['Judul']) .'</td>';
        echo '<td>'. htmlspecialchars($row['Tgl_Peminjaman']) .'</td>';
        echo '<td>'. htmlspecialchars($row['Bts_Peminjaman']) .'</td>';
        echo '<td>'. htmlspecialchars($row['Tgl_Pengembalian']) .'</td>';
        echo '</tr>';
    }
}
