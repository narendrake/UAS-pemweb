<?php
// Definisi kelas Koneksi untuk menangani koneksi ke database
class Koneksi {
    // Properti untuk menyimpan detail koneksi database
    private $host = 'localhost'; // Nama host database (biasanya localhost)
    private $user = 'root';      // Username untuk mengakses database
    private $pass = '';          // Password untuk mengakses database (kosong jika default)
    private $db = 'uas_pemweb';  // Nama database yang akan diakses

    // Fungsi untuk membuat dan mengembalikan koneksi database
    public function getConnection() {
        // Membuat objek koneksi menggunakan class mysqli
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        // Periksa apakah koneksi berhasil
        if ($conn->connect_error) {
            // Jika terjadi kesalahan koneksi, tampilkan pesan error dan hentikan eksekusi
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Kembalikan objek koneksi jika berhasil
        return $conn;
    }
}
?>
