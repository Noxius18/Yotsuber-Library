<?php
session_start();
require 'db_connect.php';


if (isset($_POST['login'])) {
    $email = $_POST["Email"];
    $pass = $_POST["Password"];

    $sql = $conn->prepare("SELECT * FROM Member WHERE Email = ?");
    $sql->bind_param('s', $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($pass, $row["Pass"])) {
            $_SESSION["userID"] = $row["ID_Member"];
            $_SESSION["namaDepan"] = $row["Nama_Depan"];
            $_SESSION["namaBelakang"] = $row["Nama_Belakang"];
            $_SESSION["Role"] = "Member";
            header("Location: ../Pages/userDashboard.php");
            exit;
        } 
    } 

    $sql = $conn->prepare("SELECT * FROM Admin WHERE Username = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if(password_verify($pass, $row["Pass"])) {
            $_SESSION["userID"] = $row["Username"];
            $_SESSION["Role"] = "Admin";
            header("Location: ../Pages/adminDashboard.php");
            exit;
        }
    }

    if (isset($error) && $error) {
        echo "<p>Email atau Password salah</p>";
    }
}



// if(isset($_POST['login'])){
//     $email = $_POST["Email"];
//     $pass = $_POST["Password"];

//     $query = mysqli_query($conn, "SELECT * FROM Member WHERE Email = '$email'");

//     if(mysqli_num_rows($query) === 1){
        
//         $row = mysqli_fetch_assoc($query);

//         if(password_verify($pass, $row["Pass"])){
//             $_SESSION["userID"] = $row["ID_Member"];
//             $_SESSION["namaDepan"] = $row["Nama_Depan"];
//             $_SESSION["namaBelakang"] = $row["Nama_Belakang"];
//             header("Location: ../Pages/userdash.html");
//             exit;
//         }
//     }

//     $error = true;
//     if($error){
//         echo "<p>Email atau Password salah</p>";
//     }
// }