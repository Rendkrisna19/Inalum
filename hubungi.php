<?php
// Konfigurasi database
$servername = "localhost";
$username = "root"; // Ganti sesuai username database
$password = ""; // Ganti sesuai password database
$dbname = "inalum"; // Ganti dengan nama database

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses data form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Simpan data ke database
    $sql = "INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        // Jika berhasil, arahkan kembali ke halaman utama
        header("Location: index.html");
        exit();
    } else {
        echo "Gagal menyimpan data: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
