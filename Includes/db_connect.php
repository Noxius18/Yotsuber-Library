<?php
$db_host = 'localhost';
$db_user = '';
$db_pass = '';
$db_name = 'Perpustakaan';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// try {
//     // $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

//     if ($conn->connect_error) {
//         throw new Exception("Koneksi Gagal: " . $conn->connect_error);
//     }

//     echo "Koneksi Berhasil";
// } catch (Exception $e) {
//     echo "Error: " . $e->getMessage();
// }
?>
