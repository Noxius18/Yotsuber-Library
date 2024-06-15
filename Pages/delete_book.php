<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perpustakaan";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan ID buku dari URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // SQL untuk menghapus buku
    $sql = "DELETE FROM buku WHERE id = ?";

    // Mempersiapkan pernyataan
    if ($stmt = $conn->prepare($sql)) {
        // Mengikat parameter
        $stmt->bind_param("i", $id);

        // Menjalankan pernyataan
        if ($stmt->execute()) {
            echo "Buku berhasil dihapus.";
        } else {
            echo "Terjadi kesalahan: " . $stmt->error;
        }

        // Menutup pernyataan
        $stmt->close();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
} else {
    echo "ID buku tidak ditemukan.";
}

// Menutup koneksi
$conn->close();
?>
