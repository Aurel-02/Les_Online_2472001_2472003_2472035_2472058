# Pintar.id - Platform Les Online

Pintar.id adalah platform bimbingan belajar (les online) interaktif untuk jenjang SD, SMP, dan SMA. Platform ini dilengkapi dengan fitur dashboard siswa/guru/admin/orang tua, sistem paket belajar, riwayat transaksi, video pembelajaran, try out/ujian online, target PTN Impian, rekomendasi jurusan, dan chat interaktif.

---

## ✨ Fitur-Fitur Utama Program

### 1. 🎓 Role Siswa
* **Dashboard Utama**: Menampilkan grafik target PTN Impian, skor try out terakhir, dan ringkasan aktivitas belajar (jumlah latihan diselesaikan, video ditonton, catatan ditulis).
* **Materi & Video Pembelajaran**: Menonton video materi belajar interaktif dan mengunduh berkas modul pembelajaran. Dilengkapi dengan fallback video otomatis jika ID video tidak dispesifikasikan di URL.
* **Catatan Belajar**: Fitur menulis catatan pribadi per mata pelajaran dengan pilihan kustomisasi warna kartu catatan (blue, amber, sage, mauve).
* **Ujian & Try Out Online**: Mengerjakan try out/ujian (UTS, UAS, Try Out) secara online dengan penghitungan skor otomatis.
* **Review & Pembahasan Ujian**: Melihat detail riwayat ujian, skor raw, jumlah soal benar/salah, serta pembahasan lengkap per soal.
* **Target PTN Impian**: Simulasi peluang kelulusan berdasarkan grafik nilai try out terakhir siswa dibandingkan dengan nilai target jurusan PTN yang diminati.
* **Rekomendasi Jurusan**: Rekomendasi jurusan kuliah otomatis berdasarkan minat bakat dan nilai evaluasi ujian.
* **Chat Interaktif**: Chat dua arah secara real-time dengan guru pembimbing.
* **Pembelian Paket Belajar**: Membeli paket belajar (masa aktif belajar) secara mandiri dengan input kode promo diskon. Siswa dibatasi agar tidak dapat membeli paket yang sama jika paket tersebut masih aktif.
* **Manajemen Profil**: Mengubah nama profil, mengganti kata sandi, dan mengunggah foto profil.

### 2. 👨‍🏫 Role Guru
* **Dashboard Guru**: Menampilkan total siswa yang dibimbing serta jadwal mengajar hari ini.
* **Manajemen Materi (CRUD)**: Mengelola materi pelajaran (menambahkan modul, deskripsi, tautan video YouTube, jenjang, kelas, dan jurusan).
* **Manajemen Jadwal Mengajar (CRUD)**: Mengatur hari dan jam sesi mengajar per kelas dan mata pelajaran.
* **Daftar Siswa**: Melihat detail data siswa yang berada di bawah bimbingan guru yang bersangkutan.
* **Chat Interaktif**: Berdiskusi langsung dengan siswa yang mengajukan pertanyaan.

### 3. 👨‍👩‍👦 Role Orang Tua
* **Dashboard Pemantauan**: Memantau progress belajar anak secara transparan, termasuk hasil try out, materi yang telah dipelajari, dan riwayat aktivitas belajar lainnya.
* **Pembelian Paket Belajar**: Membelikan paket belajar untuk anak agar akses belajar anak tetap aktif.

### 4. ⚡ Role Admin
* **Dashboard Statistik**: Rangkuman total siswa, guru, pendapatan platform, serta grafik income bulanan.
* **Manajemen Pengguna (CRUD & Soft Delete)**:
  * Mengelola seluruh data akun pengguna (Admin, Guru, Siswa, Orang Tua).
  * Fitur deaktifasi akun (Soft Delete) dan pemulihan akun (Restore).
  * Sistem persetujuan aktivasi ulang akun (Reactivation Requests) dari notifikasi deaktifasi pengguna.
* **Manajemen Paket Belajar (CRUD)**: Mengatur paket belajar berbayar (Nama paket, harga, deskripsi, masa aktif).
* **Manajemen Promo / Voucher (CRUD)**: Membuat dan menghapus voucher diskon belanja paket (Kode promo, persentase potongan, minimal pembelian).
* **Riwayat Transaksi & Laporan Keuangan**: Menampilkan tabel rincian transaksi lengkap di bawah grafik pendapatan (ID Transaksi, Nama Siswa, Paket, Harga, Voucher, Tanggal, dan Status pembayaran).

---

## 📂 Penyimpanan Database SQL
File database SQL cadangan (SQL dump) proyek ini disimpan di:
* **[`src/database/sql/les_online.sql`](file:///c:/Project%20Sem%204/Les_Online_2472001_2472003_2472035_2472058/src/database/sql/les_online.sql)**

---

## 🚀 Cara Menjalankan Program

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di lingkungan lokal Anda:

### 1. Prasyarat (Prerequisites)
Pastikan Anda sudah menginstal aplikasi berikut di komputer Anda:
* **PHP** (versi 8.2 atau lebih tinggi)
* **Composer**
* **MySQL Server** (seperti XAMPP, Laragon, atau MySQL secara mandiri)
* **Node.js & NPM**

### 2. Persiapan Database
1. Buka database manager pilihan Anda (misalnya phpMyAdmin, DBeaver, dll).
2. Buat database baru bernama **`les_online`**.
3. Import berkas SQL **`les_online.sql`** yang berada di dalam folder `src/database/sql/` ke dalam database `les_online` yang baru saja Anda buat.

### 3. Konfigurasi Environment File
1. Buka folder **`src/`** proyek.
2. Salin atau ubah nama file **`.env.example`** menjadi **`.env`**.
3. Buka file **`.env`** tersebut, dan pastikan pengaturan koneksi database Anda sudah sesuai (umumnya seperti berikut):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=les_online
   DB_USERNAME=root
   DB_PASSWORD=
   ```

### 4. Instalasi Dependensi & Kunci Aplikasi
Jalankan perintah berikut di terminal Anda (arahkan terminal ke folder **`src/`**):

```bash
# Menginstal semua dependensi PHP dari Composer
composer install

# Menginstal dependensi NPM untuk kompilasi asset
npm install

# Membuat APP_KEY unik baru untuk aplikasi
php artisan key:generate
```

### 5. Menjalankan Migrasi & Sinkronisasi Database
Untuk memastikan seluruh struktur tabel database sudah versi paling mutakhir (termasuk kolom penyesuaian terbaru):
```bash
php artisan migrate
```

### 6. Menjalankan Server Aplikasi
Jalankan server backend Laravel dan server asset Vite secara bersamaan.

Di terminal pertama (arahkan ke folder **`src/`**):
```bash
php artisan serve
```

Di terminal kedua (arahkan ke folder **`src/`**):
```bash
npm run dev
```

Setelah server berjalan, Anda dapat mengakses aplikasi les online melalui peramban web pada alamat:
👉 **[http://localhost:8000](http://localhost:8000)**

---

## 🔑 Akun Uji Coba & Autentikasi (Test Accounts)
Anda dapat menggunakan beberapa akun demo berikut yang sudah tersedia di dalam database SQL dump untuk pengujian:

| Role | Email |
| --- | --- |
| **Admin** | `alice.admin@lesonline.com` |
| **Guru** | `bambang.guru@lesonline.com` |
| **Siswa** | `gani.siswa@email.com` |
| **Orang Tua** | `lestari.ortu@email.com` |

> [!NOTE]
> * **Password Akun Bawaan**: Jika Anda tidak mengetahui password akun bawaan dari database dump, Anda dapat melakukan **Registrasi Akun Baru** langsung dari halaman depan, atau memperbarui kolom password di tabel `user` menggunakan hash bcrypt baru.