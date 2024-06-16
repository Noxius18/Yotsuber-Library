<?php
$db_host = 'localhost';
$db_user = '';
$db_pass = '';
$db_name = 'Perpustakaan';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

//Konek ke SQLite
// try {
//     $db = new SQLite3("../db/perpus.sqlite");
//     if(!$db){
//         die("Database gagal tersambung coy\n");
//     }
//     else{
//         echo "Database terkoneksi mase\n";
//     }
// }   catch(Exception $e) {
//         die("Koneksi masih gagal mase ". $e->getMessage());
// }