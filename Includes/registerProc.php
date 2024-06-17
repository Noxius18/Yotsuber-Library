<?php
session_start();
require "db_connect.php";

if (isset($_POST['register'])) {
    $namaDepan = filter_input(INPUT_POST, 'namaDepan', FILTER_SANITIZE_STRING);
    $namaBelakang = filter_input(INPUT_POST, 'namaBelakang', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $phone = filter_input(INPUT_POST, 'nomorTel', FILTER_SANITIZE_NUMBER_INT);

    if ($email === false) {
        echo "Minimal input email keja bener dek";
        exit();
    }

    // Prepare the SQL statement using prepared statements
    $sql = "INSERT INTO Member (Email, Pass, Nama_Depan, Nama_Belakang, No_Tel) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssss", $email, $password, $namaDepan, $namaBelakang, $phone);
        if ($stmt->execute()) {
            header("Location: ../login.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
$conn->close();
