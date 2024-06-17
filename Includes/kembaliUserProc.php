<?php
session_start();
require 'db_connect.php';

$userID = $_SESSION['userID'];

$sql = 
'SELECT Katalog_Buku.Judul, Pinjam.ID_Peminjaman, Katalog_Buku.Cover_Buku FROM Pinjam
INNER JOIN Katalog_Buku ON Pinjam.ID_Katalog=Katalog_Buku.ID_Katalog
INNER JOIN Status_Pinjam ON Pinjam.ID_Peminjaman=Status_Pinjam.ID_Peminjaman
WHERE Pinjam.ID_Member = ? AND Status_Pinjam.status = "Sedang Dipinjam"';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['Judul']) . '</td>';
        echo '<td><img src="../Assets/Images/Cover_Buku/' . htmlspecialchars($row['Cover_Buku']) . '" alt="Cover" style="width: 50px; height: auto;"></td>';
        echo '<td>';
        echo '<form method="post" action="request_return_process.php">';
        echo '<input type="hidden" name="peminjaman_id" value="' . htmlspecialchars($row['ID_Peminjaman']) . '">';
        echo '<button type="submit" name="request_return" class="btn btn-primary">Ajukan Pengembalian</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="3">Tidak ada buku yang sedang dipinjam.</td></tr>';
}

