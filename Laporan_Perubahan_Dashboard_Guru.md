# Laporan Perubahan: Fitur Dashboard Guru

Berdasarkan *Use Case Diagram* untuk aktor **Guru** dan penyesuaian UI/UX dengan **Dashboard Siswa**, berikut adalah rincian perubahan yang telah diimplementasikan:

## 1. Pembaruan Logika Controller (`GuruController.php`)
- **[MODIFY]** `src/app/Http/Controllers/GuruController.php`
  - **Penambahan `UserSession`:** Mengimpor `App\Services\UserSession` untuk mengambil data sesi pengguna aktif dengan menggunakan *Singleton Pattern*, sama seperti pada *Dashboard Siswa*.
  - **Pengiriman Data ke View:** Mengambil data nama guru (`$userName`) dan foto profil (`$photoProfile`) dari *session* dan mengirimkannya ke berkas tampilan (`guru.dashboard`) melalui fungsi `compact`.

## 2. Pembuatan Tampilan Antarmuka (`dashboard.blade.php`)
- **[MODIFY/OVERWRITE]** `src/resources/views/guru/dashboard.blade.php`
  - Mengganti kode *placeholder* lama dengan desain antarmuka *modern* bergaya **Glassmorphism** dan warna *earth-tone* yang konsisten dengan desain web `Pintar.id`.

### Penyesuaian Fitur berdasarkan *Use Case* Guru:
| Use Case Guru | Implementasi pada Dashboard |
| :--- | :--- |
| **Melihat Jadwal Mengajar** | Dibuat daftar **Jadwal Mengajar Hari Ini** dalam bentuk kartu (*card*) interaktif dengan rincian kelas, materi, dan jam mengajar. Tersedia juga tautan cepat "Mulai Kelas" dan "Persiapkan Materi". |
| **Memilih / Membuka Kelas & Siswa** | Ditambahkan menu navigasi *sidebar* **Kelas & Siswa** untuk mengelola data peserta didik. |
| **Memberikan Tugas dan Materi** | Ditambahkan menu navigasi *sidebar* **Materi & Tugas** agar guru dapat mengunggah atau menyesuaikan bahan ajar. |
| **Mengevaluasi Hasil / Menginput Nilai** | Ditambahkan *stat card* **Tugas Perlu Dikoreksi** dan menu navigasi **Evaluasi Nilai** sebagai akses utama evaluasi siswa. |
| **Menerima Notifikasi** | Diwujudkan dalam blok **Aktivitas & Notifikasi** terbaru yang menampilkan kegiatan terkini (misal: "Budi mengumpulkan tugas" atau "Pesan baru dari siswa"). |

### Elemen UI Tambahan:
- **Sidebar Khusus Guru:** Berisi menu (*Dashboard*, *Jadwal Mengajar*, *Kelas & Siswa*, *Materi & Tugas*, *Evaluasi Nilai*, *Chat*, *Notifikasi*).
- **Banner Selamat Datang:** Pesan sambutan khusus pendidik: *"Siap Menginspirasi Hari Ini? Pantau jadwal kelas, kelola materi pembelajaran, dan evaluasi perkembangan siswa dengan mudah."*
- **Statistik Cepat (Status Card):** Menampilkan rangkuman berupa **Total Siswa** (120), **Kelas Aktif** (4), dan **Tugas Perlu Dikoreksi** (15).
- **Profil Topbar Dinamis:** Mengambil inisial atau foto profil dan nama guru dari variabel *session* (`$userName`, `$photoProfile`).

## 3. Catatan Teknis Lanjutan
- Tampilan bersifat responsif (*Mobile Friendly*). Saat berada pada perangkat *mobile* atau tablet, *sidebar* disembunyikan dan antarmuka akan menyesuaikan lebar layar.
- Desain *blob background* dipertahankan agar menjaga identitas visual (UI/UX) antar dasbor pengguna.

---
**Selanjutnya:** Anda dapat memeriksa tampilan dasbor secara langsung atau menyalin laporan ini ke dalam dokumen tugas Anda.
