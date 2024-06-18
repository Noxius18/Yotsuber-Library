<?php
session_start();
require 'db_connect.php';

if (isset($_POST['return'])) {
    $idBuku = $_POST['book_id'];
    $idMember = $_POST['member_id'];
    $tanggalPengembalian = date('Y-m-d');

    $sql = 
    "UPDATE Status_Pinjam SET status = 'Dikembalikan', Tgl_Pengembalian = ? 
    WHERE ID_Katalog = ? AND ID_Member = ? AND status = 'Sedang Dipinjam'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sii', $return_date, $book_id, $member_id);

    if ($stmt->execute()) {
        echo "Buku berhasil dikembalikan!";
    } else {
        echo "Gagal mengembalikan buku.";
    }
}

$sql = 
"SELECT Pinjam.ID_Peminjaman AS ID, 
Katalog_Buku.Judul AS Judul, 
CONCAT(Member.Nama_Depan, ' ', Member.Nama_Belakang) AS Nama, 
Pinjam.Tgl_Peminjaman AS Tanggal, 
Katalog_Buku.Cover_Buku AS Cover FROM Pinjam 
INNER JOIN Member ON Pinjam.ID_Member=Member.ID_Member 
INNER JOIN Katalog_Buku ON Pinjam.ID_Katalog=Katalog_Buku.ID_Katalog
INNER JOIN Status_Pinjam ON Status_Pinjam.ID_Status=Pinjam.ID_Peminjaman 
WHERE Status_Pinjam.sts = 'Sedang Dipinjam'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // echo '<div class="col-md-4">';
        // echo '<div class="card mb-4">';
        // echo '<div class="card-body">';
        // echo '<h5 class="card-title">'. htmlspecialchars($row['Judul']) .'</h5>';
        // echo '<p class="card-text">';
        // echo '<strong>Peminjam:</strong>'. htmlspecialchars($row['Nama']) .'<br>';
        // echo '<strong>Tanggal Peminjaman:</strong>'. htmlspecialchars($row['Tanggal']);
        // echo '</p>';
        // echo '<form method="POST" action="confirmProcess.php">';
        // echo '<input type="hidden" name="peminjaman_id" value="1">';
        // echo '<button type="submit" class="btn btn-primary">Konfirmasi Pengembalian</button>';
        // echo '</form>';
        // echo '</div>';
        // echo '</div>';
        // echo '</div>';
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
        echo '<strong>Peminjam: </strong>'. htmlspecialchars($row['Nama']) .'<br>';
        echo '<strong>Tanggal Peminjaman: </strong>'. htmlspecialchars($row['Tanggal']);
        echo '</p>';
        echo '<form method="POST" action="confirm_return.php">';
        echo '<input type="hidden" name="peminjaman_id" value="1">';
        echo '<button type="submit" class="btn btn-primary">Konfirmasi Pengembalian</button>';
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
