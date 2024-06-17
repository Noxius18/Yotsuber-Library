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
"SELECT Pinjam.ID_Peminjaman, Member.ID_Member, CONCAT(Member.Nama_Depan, ' ', Member.Nama_Belakang) AS Nama, 
Katalog_Buku.ID_Katalog, Katalog_Buku.Judul 
FROM Pinjam 
INNER JOIN Member ON Pinjam.ID_Member = Member.ID_Member 
INNER JOIN Katalog_Buku ON Pinjam.ID_Katalog = Katalog_Buku.ID_Katalog
INNER JOIN Status_Pinjam ON Status_Pinjam.ID_Status=Pinjam.ID_Peminjaman 
WHERE Status_Pinjam.status = 'Sedang Dipinjam'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['Nama']). '</td>';
        echo '<td>' . htmlspecialchars($row['Judul']) . '</td>';
        echo '<td>';
        echo '<form method="post" action="return_book.php">';
        echo '<input type="hidden" name="book_id" value="' . htmlspecialchars($row['ID_Katalog']) . '">';
        echo '<input type="hidden" name="member_id" value="' . htmlspecialchars($row['ID_Member']) . '">';
        echo '<button type="submit" name="return" class="btn btn-primary">Kembalikan</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="3">Tidak ada buku yang sedang dipinjam.</td></tr>';
}
