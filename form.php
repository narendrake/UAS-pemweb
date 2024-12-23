<?php
require_once 'UserController.php'; // require_once digunakan untuk memanggil file UserController.php

// Memulai session
session_start();

// Inisialisasi objek UserController
$userController = new UserController();

// Ambil data user dari database
$users = $userController->getAllUsers();

// Ambil data dari session dan cookie
$usernameSession = $_SESSION['username'] ?? null;
$emailSession = $_SESSION['email'] ?? null;
$usernameCookie = $_COOKIE['username'] ?? null; // (Fungsi pertama untuk cookie yaitu mengambil cookie)
$emailCookie = $_COOKIE['email'] ?? null; // (Fungsi pertama untuk cookie yaitu mengambil cookie)

// Hapus session jika diminta
if (isset($_GET['delete_session'])) {
    session_destroy();
    header("Location: form.php");
    exit;
}

// Hapus cookie jika diminta (Fungsi kedua untuk cookie yaitu menghapus cookie)
if (isset($_GET['delete_cookie'])) {
    setcookie('username', '', time() - 3600, '/'); // cookie akan terhapus sendiri setelah 3600 detik
    setcookie('email', '', time() - 3600, '/');
    header("Location: form.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Form Pendaftaran dan Data Registrasi Akun Mahasiswa</h1>
    <div class="container">

    
        <!-- Form Input -->
        <form id="signupForm" action="process.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
                <div id="usernameError" class="error"></div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <div id="emailError" class="error"></div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <div id="passwordError" class="error"></div>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Re-enter Password:</label>
                <input type="password" name="confirmPassword" id="confirmPassword" required>
                <div id="confirmPasswordError" class="error"></div>
            </div>
            <div class="form-group">
                <div>
                    <input type="checkbox" name="agree" id="agree" required>
                    <label for="agree">I agree with the <a href="#">terms of services</a></label>
                </div>
            </div>
            <div>
                <button type="submit" class="form-button">Register</button>
            </div>
        </form>

        <!-- Tabel Data -->
        <h2>Data Registrasi</h2>
        <table id="studentTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Browser</th>
                    <th>IP Address</th>
                </tr>
            </thead>
            <tbody>
                <!-- Menampilkan data dari database atau server -->
            <?php foreach ($users as $key => $user): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['browser']) ?></td>
                        <td><?= htmlspecialchars($user['ip_address']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="info-group"><!-- Informasi dari Session -->
            <div class="info">
                <h3>Data dari Session</h3>
                <p>Username: <?= htmlspecialchars($usernameSession ?? 'Belum ada') ?></p>
                <p>Email: <?= htmlspecialchars($emailSession ?? 'Belum ada') ?></p>
                <a href="?delete_session=1">Hapus Session</a>
            </div>

            <!-- Informasi dari Cookie -->
            <div class="info">
                <h3>Data dari Cookie</h3>
                <p>Username: <?= htmlspecialchars($usernameCookie ?? 'Belum ada') ?></p>
                <p>Email: <?= htmlspecialchars($emailCookie ?? 'Belum ada') ?></p>
                <a href="?delete_cookie=1">Hapus Cookie</a>
            </div>

            <!-- Informasi dari Browser Storage -->
            <div class="info">
                <h3>Data dari Browser Storage</h3>
                <p>Username: <span id="storageUsername">Belum ada</span></p>
                <p>Email: <span id="storageEmail">Belum ada</span></p>
                <button id="clearStorage">Hapus Browser Storage</button>
            </div>
        </div>
        

    </div>

    <script>
        // Validasi Form dengan JavaScript
        document.getElementById('signupForm').addEventListener('submit', function(event) {
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            let isValid = true;

            // Validasi username (event handler pertama)
            const usernameError = document.getElementById('usernameError');
            if (username.length < 5) {
                usernameError.textContent = 'Username harus minimal 5 karakter.';
                isValid = false;
            } else {
                usernameError.textContent = '';
            }

            // Validasi email (event handler kedua)
            const emailError = document.getElementById('emailError');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                emailError.textContent = 'Format email tidak valid.';
                isValid = false;
            } else {
                emailError.textContent = '';
            }

            // Validasi password (event handler ketiga)
            const passwordError = document.getElementById('passwordError');
            if (password.length < 8) {
                passwordError.textContent = 'Password harus minimal 8 karakter.';
                isValid = false;
            } else {
                passwordError.textContent = '';
            }

            // Validasi konfirmasi password (event handler ketiga)
            const confirmPasswordError = document.getElementById('confirmPasswordError');
            if (password !== confirmPassword) {
                confirmPasswordError.textContent = 'Password tidak cocok.';
                isValid = false;
            } else {
                confirmPasswordError.textContent = '';
            }

            if (!isValid) {
                event.preventDefault();
                alert('Form tidak valid! Pastikan semua data sudah benar.');
            }
        });
 
    </script>

    <script>
        // Simpan data ke localStorage saat form disubmit
        document.getElementById('signupForm').addEventListener('submit', function () {
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;

            localStorage.setItem('username', username);
            localStorage.setItem('email', email);
        });

        // Ambil data dari localStorage
        document.addEventListener('DOMContentLoaded', function () {
            const storageUsername = localStorage.getItem('username') || 'Belum ada';
            const storageEmail = localStorage.getItem('email') || 'Belum ada';

            document.getElementById('storageUsername').textContent = storageUsername;
            document.getElementById('storageEmail').textContent = storageEmail;
        });

        // Hapus data dari localStorage
        document.getElementById('clearStorage').addEventListener('click', function () {
            localStorage.removeItem('username');
            localStorage.removeItem('email');

            document.getElementById('storageUsername').textContent = 'Belum ada';
            document.getElementById('storageEmail').textContent = 'Belum ada';

            alert('Data di Browser Storage telah dihapus.');
        });
    </script>

</body>
</html>
