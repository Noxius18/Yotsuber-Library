<?php
$db_host = 'localhost';
$db_user = 'Adam';
$db_pass = 'Sayangteto2024#';
$db_name = 'Perpustakaan';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

//Konek ke SQLite
// $db = new SQLite3("../db/perpus.sqlite");

// if(!$db) {
//     die("Database gagal tersambung");
// }
// else{
//     echo("Database berhasil tersambung")
// }