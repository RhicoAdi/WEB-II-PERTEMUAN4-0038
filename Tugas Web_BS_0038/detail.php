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

// Ambil data pengguna berdasarkan ID
$userId = $_GET['id'];
$sql = "SELECT * FROM mvc WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Detail Pengguna</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Detail Pengguna</h2>
        <?php if ($user): ?>
            <p><strong>ID:</strong> <?php echo $user['id']; ?></p>
            <p><strong>Nama:</strong> <?php echo $user['nama']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <p><strong>Pekerjaan:</strong> <?php echo $user['pekerjaan']; ?></p>
        <?php else: ?>
            <p>Pengguna tidak ditemukan.</p>
        <?php endif; ?>
        <a href="index.php" class="btn btn-primary">Kembali</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
