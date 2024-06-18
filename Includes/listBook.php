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
// $conn->close();