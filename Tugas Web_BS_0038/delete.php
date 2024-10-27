<?php
$servername = "localhost";
$username = "root";     // Ganti dengan username Anda
$password = "";         // Ganti dengan password Anda
$database = "bootstrap0038";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Hapus pengguna berdasarkan ID
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Cek apakah pengguna dengan ID tersebut ada
    $checkSql = "SELECT * FROM mvc WHERE id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $userId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $deleteSql = "DELETE FROM mvc WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $userId);

        if ($deleteStmt->execute()) {
            header("Location: index.php"); // Redirect ke halaman daftar setelah hapus
            exit();
        } else {
            echo "Error saat menghapus pengguna: " . $deleteStmt->error;
        }
    } else {
        echo "Pengguna dengan ID $userId tidak ditemukan.";
    }
} else {
    echo "ID pengguna tidak ditemukan.";
}

$conn->close();
?>
