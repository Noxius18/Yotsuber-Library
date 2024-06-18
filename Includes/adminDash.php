<?php
session_start();
require 'db_connect.php';

$search = isset($_POST['cari']) ? filter_input(INPUT_POST, 'cari', FILTER_SANITIZE_STRING) : ''; 

if($search){
    $sql = 
    'SELECT CONCAT(Member.Nama_Depan, " ", Member.Nama_Belakang) AS Nama, 
    Katalog_Buku.Judul AS Judul, 
    Pinjam.Tgl_Peminjaman AS Tgl_Peminjaman, 
    Pinjam.Bts_Peminjaman AS Bts_Peminjaman, 
    Pinjam.Tgl_Pengembalian AS Tgl_Pengembalian,
    Status_Pinjam.sts AS status_pinjam FROM Status_Pinjam 
    INNER JOIN Pinjam ON Status_Pinjam.ID_Peminjaman=Pinjam.ID_Peminjaman 
    INNER JOIN Member ON Pinjam.ID_Member=Member.ID_Member 
    INNER JOIN Katalog_Buku ON Pinjam.ID_Katalog=Katalog_Buku.ID_Katalog
    WHERE CONCAT(Member.Nama_Depan, " ", Member.Nama_Belakang) LIKE ? OR Email LIKE ? OR Judul LIKE ?';
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
    Pinjam.Tgl_Peminjaman AS Tgl_Peminjaman, 
    Pinjam.Bts_Peminjaman AS Bts_Peminjaman, 
    Pinjam.Tgl_Pengembalian AS Tgl_Pengembalian,
    Status_Pinjam.sts AS status_pinjam FROM Status_Pinjam 
    INNER JOIN Pinjam ON Status_Pinjam.ID_Peminjaman=Pinjam.ID_Peminjaman
    INNER JOIN Member ON Pinjam.ID_Member=Member.ID_Member 
    INNER JOIN Katalog_Buku ON Pinjam.ID_Katalog=Katalog_Buku.ID_Katalog';

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
        echo '<td>'. htmlspecialchars($row['status_pinjam']) .'</td>';
        echo '</tr>';
    }
}