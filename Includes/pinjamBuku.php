<?php
session_start();
require 'db_connect.php';

// if(isset($_POST['pinjam'])){
//     $idMember = $_SESSION['userID'];
//     $idBuku = $_POST['idBuku'];
//     $tanggalPinjam = date('Y-m-d');
//     // $batasPinjam = date('Y-m-d', strtotime($tanggalPinjam . '+ 7 days'));

//     $queryCekTersedia = 'SELECT Jumlah FROM Katalog_Buku WHERE ID_Katalog = ?';
//     $stmtCekTersedia = $conn->prepare($queryCekTersedia);
//     $stmtCekTersedia->bind_param('i', $idBuku);
//     $stmtCekTersedia->execute();
//     $stmtCekTersedia->store_result();

//     if( $stmtCekTersedia->num_rows > 0){
//         $stmtCekTersedia->bind_result($jumlahTersedia);
//         $stmtCekTersedia->fetch();

//         if($jumlahTersedia > 0){
//             $insertPinjam = 'INSERT INTO Pinjam (ID_Katalog, ID_Member, Tgl_Peminjaman, Bts_Peminjaman) VALUES (?, ?, ?, ?)';
//             $stmt = $conn->prepare($insertPinjam);
//             $stmt->bind_param('iiss', $idBuku, $idMember, $tanggalPinjam, $batasPinjam);

//             $batasPinjam = date('Y-m-d', strtotime($tanggalPinjam . '+ 7 days'));

//             if($stmt->execute()){   
//                 $idPinjam = $stmt->insert_id;

//                 $insertStatus = 'INSERT INTO Status_Pinjam (ID_Peminjaman) VALUES (?)';
//                 $stmtStatus = $conn->prepare($insertStatus);
//                 $stmtStatus->bind_param('i', $idPinjam);
//                 $stmtStatus->execute();

//                 $updatePinjam = 'UPDATE Katalog_Buku SET Jumlah = Jumlah - 1 WHERE ID_Katalog = ?';
//                 $stmtUpdate = $conn->prepare($updatePinjam);
//                 $stmtUpdate->bind_param('i', $idBuku);
//                 $stmtUpdate->execute();
//             }
//         }
//     }
// }

if(isset($_POST['submit'])){
    $idMember = $_SESSION['userID'];
    $idBuku = $_POST['idBuku'];
    $tanggalPinjam = date('Y-m-d');
    $batasPinjam = date('Y-m-d', strtotime($tanggalPinjam . '+ 7 days')); // Move this line up

    // Query untuk mengecek ketersediaan buku
    $queryCekTersedia = 'SELECT Jumlah FROM Katalog_Buku WHERE ID_Katalog = ?';
    $stmtCekTersedia = $conn->prepare($queryCekTersedia);
    $stmtCekTersedia->bind_param('i', $idBuku);
    $stmtCekTersedia->execute();
    $stmtCekTersedia->store_result();

    if($stmtCekTersedia->num_rows > 0){
        $stmtCekTersedia->bind_result($jumlahTersedia);
        $stmtCekTersedia->fetch();

        if($jumlahTersedia > 0){
            // Insert ke tabel Pinjam
            $insertPinjam = 'INSERT INTO Pinjam (ID_Katalog, ID_Member, Tgl_Peminjaman, Bts_Peminjaman) VALUES (?, ?, ?, ?)';
            $stmt = $conn->prepare($insertPinjam);
            $stmt->bind_param('iiss', $idBuku, $idMember, $tanggalPinjam, $batasPinjam);

            if($stmt->execute()){   
                $idPinjam = $stmt->insert_id;

                // Insert ke tabel Status_Pinjam
                $insertStatus = 'INSERT INTO Status_Pinjam (ID_Peminjaman) VALUES (?)';
                $stmtStatus = $conn->prepare($insertStatus);
                $stmtStatus->bind_param('i', $idPinjam);
                $stmtStatus->execute();

                // Update jumlah buku di Katalog_Buku
                $updatePinjam = 'UPDATE Katalog_Buku SET Jumlah = Jumlah - 1 WHERE ID_Katalog = ?';
                $stmtUpdate = $conn->prepare($updatePinjam);
                $stmtUpdate->bind_param('i', $idBuku);
                $stmtUpdate->execute();

                // Redirect dengan pesan sukses
                header('Location: ../Pages/userDashboard.php?status=success');
                exit();
            } else {
                $error = 'Terjadi kesalahan saat meminjam buku.';
            }
        } else {
            $error = 'Buku tidak tersedia.';
        }
    } else {
        $error = 'Buku tidak ditemukan.';
    }
}