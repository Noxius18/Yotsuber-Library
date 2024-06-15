<?php
session_start();
require 'db_connect.php';

if(isset($_POST['login'])){
    $email = $_POST["Email"];
    $pass = $_POST["Password"];

    $query = mysqli_query($conn, "SELECT * FROM Member WHERE Email = '$email'");

    if(mysqli_num_rows($query) === 1){
        
        $row = mysqli_fetch_assoc($query);

        if(password_verify($pass, $row["Pass"])){
            header("Location: ../Pages/userdash.html");
            exit;
        }
    }

    $error = true;
    if($error){
        echo "<p>Email atau Password salah</p>";
    }
}