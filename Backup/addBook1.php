<?php
session_start();
require "db_connect.php";

if (isset($_POST["tambah"])) {
    $Judul = filter_input(INPUT_POST, 'judulBuku', FILTER_SANITIZE_STRING);
    $Penulis = filter_input(INPUT_POST, 'penulis', FILTER_SANITIZE_STRING);
    $Genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);
    $Sinopsis = filter_input(INPUT_POST, 'sinopsis', FILTER_SANITIZE_STRING);
    $tahunTerbit = filter_input(INPUT_POST, 'tahunTerbit', FILTER_SANITIZE_STRING);
    $ISBN = filter_input(INPUT_POST, 'isbn', FILTER_SANITIZE_STRING);
    $jumlahBuku = filter_input(INPUT_POST, 'jumlahBuku', FILTER_SANITIZE_NUMBER_INT);

    $targetDir = "../Assets/Images/Cover_Buku";
    $coverGambar = basename($_FILES["coverBuku"]["name"]);
    $targetPath = $targetDir . "/" . $coverGambar;
    $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);

    // Proses Insert Nama Penulis
    $sql = "SELECT ID_Penulis FROM Penulis WHERE Nama_Penulis = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $Penulis);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idPenulis);
        $stmt->fetch();
    } 
    else {
        $sql = "INSERT INTO Penulis (Nama_Penulis) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $Penulis);
        $stmt->execute();
        $idPenulis = $conn->insert_id;
    }

    // Proses Insert Detail Buku
    $sql = "INSERT INTO Katalog_Buku (ISBN, Judul, Genre, Tahun_Terbit, Sinopsis, Jumlah) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $ISBN, $Judul, $Genre, $tahunTerbit, $Sinopsis, $jumlahBuku);
    $stmt->execute();
    $idKatalog = $conn->insert_id;

    // Pengecekan dan Insert Gambar
    $ekstensiFile = array('jpg', 'png', 'jpeg', 'webp');
    if (in_array($fileType, $ekstensiFile)) {
        if (move_uploaded_file($_FILES['coverBuku']['tmp_name'], $targetPath)) {
            $sql = "UPDATE Katalog_Buku SET Cover_Buku = ? WHERE ID_Katalog = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $coverGambar, $idKatalog);
            if ($stmt->execute()) {
                echo "Buku berhasil ditambah!";
                header("Location: ../Pages/add_book.html");
                exit();
            } 
            else {
                echo "Buku gagal ditambah!";
            }
        } 
        else {
            echo "Ada error saat upload";
        }
    } 
    else {
        echo "Format tidak support";
    }

    // Insert ke Relasi
    $sql = "INSERT INTO Penulis_Buku (ID_Katalog, ID_Penulis) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $idKatalog, $idPenulis);
    $stmt->execute();
}
?>
