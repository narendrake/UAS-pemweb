<?php
require_once 'UserController.php'; // Mengambil referensi ke UserController

// Memulai session
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form menggunakan metode POST
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    $agree = isset($_POST['agree']) ? true : false;

    // Validasi sisi server
    if (strlen($username) < 5 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8 || $password !== $confirmPassword || !$agree) {
        echo "Data tidak valid! Pastikan semua data sudah benar.";
        exit;
    }

    // Inisialisasi UserController
    $userController = new UserController();

    // Cek apakah username atau email sudah ada
    if ($userController->checkUserExists($username, $email)) {
        die('Username atau Email sudah digunakan. Silakan gunakan yang lain.');
    }

    // Ambil data tambahan
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];

    // Tambahkan data ke database
    $userController = new UserController();
    $message = $userController->addUser($username, $email, $password, $browser, $ip);

    // Simpan ke session
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    // Simpan ke cookie
    setcookie('username', $username, time() + 3600, '/');
    setcookie('email', $email, time() + 3600, '/');

    // Tampilkan pesan
    echo "<p>$message</p>";
    echo '<a href="form.php">Kembali ke Form</a>';


} else {
    echo "Akses tidak valid."; // Jika tidak menggunakan metode POST
}
?>
