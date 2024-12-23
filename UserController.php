<?php
require_once 'Koneksi.php';

class UserController extends Koneksi {
    // Metode untuk mengambil semua data user
    public function getAllUsers() {
        $conn = $this->getConnection();
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Metode untuk menambahkan user baru
    public function addUser($username, $email, $password, $browser, $ip) {
        $conn = $this->getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Simpan hasil hash ke variabel
        $sql = "INSERT INTO users (username, email, password, browser, ip_address) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $username, $email, $hashedPassword, $browser, $ip); // Gunakan variabel $hashedPassword
    
        if ($stmt->execute()) {
            return "Akun berhasil diregistrasi!";
        } else {
            return "Gagal menyimpan data: " . $stmt->error;
        }
    }

    // Metode untuk mengecek apakah username atau email sudah ada
    public function checkUserExists($username, $email) {
        $conn = $this->getConnection();
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->num_rows > 0; // Jika ada data, kembalikan true
    }
    
}
?>
