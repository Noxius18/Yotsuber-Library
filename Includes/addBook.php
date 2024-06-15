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
    
    //Insert Gambar ke Database
    $ekstensiFile = array('jpg', 'png', 'jpeg', 'webp');
    if(in_array($fileType, $ekstensiFile)) {
        if(move_uploaded_file($_FILES['coverBuku']['tmp_name'], $targetPath)){
            $sql = "INSERT INTO Katalog_Buku (ISBN, Judul, Genre, Penulis, Tahun_Terbit, Sinopsis, Jumlah, Cover_Buku)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssis", $ISBN, $Judul, $Genre, $Penulis, $tahunTerbit, $Sinopsis, $jumlahBuku, $coverGambar);

            if($stmt->execute()){
                echo "Buku berhasil ditambah!";
                header("Location: ../Pages/add_book.html");
            }
            else {
                echo "Buku gagal ditambah!";
            }

        }
        else{
            echo "Ada error saat upload";
        }
        
    }
    else {
        echo "Format tidak support";
    }

}