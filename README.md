### Nama: Muhammad Narendra Budi Utomo ###
### NIM : 122140050 ###

# Penjelasan Website Registrasi Akun Mahasiswa

## **Bagian 1: Client-side Programming (Bobot: 30%)**

### **1.1 Manipulasi DOM dengan JavaScript (15%)**

- **Form**:
  Ada empat elemen utama yaitu username, email, password, dan checkbox terms of service dummy
- **Tabel**:
  Tabel ditampilkan dari server dengan nama tabel yaitu users

### **1.2 Event Handling (15%)**

- **Implementasi**:
  - Handle form pertama dilakukan ketika klik button register untuk mengecek bahwa username harus lebih dari lima karakter dan email harus valid,
  - Kemudian kedua dilakukan juga pengecekan saat submit untuk harus mengisi semua form
  - Terakhir yang ketiga ada input untuk handle focus dan blur

---

## **Bagian 2: Server-side Programming (Bobot: 30%)**

### **2.1 Pengelolaan Data dengan PHP (20%)**

- **Implementasi**:
  - Berhasil Menangani request `POST` yang saya gunakan.
  - Validasi data sebelum menyimpan ke database dilakukan pada process.php dan ada metode dari UserController.php juga.
  - Sistem juga mengambil data browser dan ip address user dan dimasukkan kedalam database.

### **2.2 Objek PHP Berbasis OOP (10%)**

- **Implementasi**:
  - UserController.php dan config.php mengugnakan OOP dan terdapat kelas masing-masing.
  - UserController memiliki method getAllUsers, addUser dan checkUserExists.
  - Koneksi (kelas dari config.php) memiliki method getConnection.

---

## **Bagian 3: Database Management (Bobot: 20%)**

### **3.1 Pembuatan Tabel Database (5%)**

- **Implementasi**:
  - Perintah SQL untuk membuat database dan tabel ada di database.sql
  - Tipe data juga sudah ditentukan sesuai dengan kebutuhan.

### **3.2 Konfigurasi Koneksi Database (5%)**

- **Implementasi**:
  - Koneksi ke database di buat di dalam config.php seperti host, user, password, dan database.
  - Di kode saya menggunakan localhost dengan nama database "uas_pemweb".

### **3.3 Manipulasi Data pada Database (10%)**

- **Implementasi**:
  - Kode di index.php sudah bisa menampilkan data yang baru di register.
  - Artinya sudah bisa memanipulasi data pada database yaitu create dan read.

---

## **Bagian 4: State Management (Bobot: 20%)**

### **4.1 State Management dengan Session (10%)**

- **Implementasi**:
  - Menyimpan data pengguna yaitu username dan email yang terakhir di registrasi dalam session.
  - Menggunakan `session_start()` untuk memulai sesi.
  - Session akan terhapus sendiri setelah beberapa waktu atau dapat dihapus manual juga dengan menekan menu hapus.

### **4.2 Pengelolaan State dengan Cookie dan Browser Storage (10%)**

- **Implementasi**:
  - Mengelola cookie juga ketika menambah data baru sama seperti session.
  - Cookie memiliki fitur create, read, dan delete.
  - Mengelola browser storage juga menggunakan localStorage pada javascript.
