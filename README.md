# Website PAUD Birrul Walidain

**Sistem Informasi dan Website Resmi PAUD Birrul Walidain**

Website PAUD Birrul Walidain merupakan aplikasi berbasis web yang dikembangkan untuk mendukung penyampaian informasi sekolah, pengelolaan kegiatan pembelajaran, administrasi sekolah, serta komunikasi antara pihak sekolah dan orang tua peserta didik.

Aplikasi ini dibangun menggunakan framework Laravel dengan tujuan meningkatkan efektivitas pengelolaan informasi dan pelayanan pendidikan anak usia dini secara digital.

## 🎯 Tujuan Pengembangan

1. Menyediakan media informasi resmi sekolah yang mudah diakses.
2. Mempermudah pengelolaan data dan informasi sekolah.
3. Mendukung kegiatan pembelajaran melalui fitur materi dan tugas.
4. Mempermudah orang tua dalam memperoleh informasi perkembangan dan kegiatan anak.
5. Menyediakan layanan pendaftaran peserta didik baru secara online.
6. Mendukung digitalisasi administrasi dan pengelolaan konten sekolah.

## ✨ Fitur Website

### 1. Halaman Utama
- Profil dan informasi sekolah.
- Informasi kegiatan sekolah.
- Galeri foto kegiatan.
- Video kegiatan sekolah.
- Informasi agenda sekolah.

### 2. Manajemen Pengguna
- Login dan autentikasi pengguna.
- Dashboard administrator.
- Dashboard pendidik.
- Dashboard orang tua.
- Pengelolaan hak akses pengguna.

### 3. Pengelolaan Pembelajaran
- Pengelolaan materi pembelajaran.
- Pengelolaan tugas peserta didik.
- Informasi dan evaluasi pembelajaran.
- Pengelolaan informasi akademik.

### 4. Informasi dan Konten Sekolah
- Pengelolaan berita dan informasi.
- Pengelolaan agenda sekolah.
- Pengelolaan galeri foto.
- Pengelolaan video kegiatan.

### 5. Sistem Penerimaan Murid Baru (SPMB)
- Informasi pendaftaran peserta didik baru.
- Formulir pendaftaran online.
- Pengecekan status pendaftaran.
- Informasi hasil pendaftaran.

## 🛠️ Teknologi yang Digunakan

| Teknologi | Kegunaan |
|---|---|
| PHP | Bahasa pemrograman backend |
| Laravel 12 | Framework aplikasi |
| MySQL / MariaDB | Database |
| HTML5 | Struktur halaman |
| CSS3 | Tampilan website |
| JavaScript | Interaksi halaman |
| Bootstrap 5 | Framework antarmuka |
| Composer | Manajemen dependensi PHP |
| Git & GitHub | Pengelolaan versi kode |

## 📁 Struktur Project

```text
paud-birrul-walidin-laravel/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
│   └── views/
├── routes/
├── storage/
├── tests/
├── .gitignore
├── artisan
├── composer.json
├── package.json
└── README.md
```

## ⚙️ Instalasi Project

### Persyaratan
- PHP sesuai persyaratan Laravel 12.
- Composer.
- MySQL atau MariaDB.
- Node.js dan NPM.
- Web server Apache atau Nginx.

### Langkah Instalasi

1. Clone repository:

```bash
git clone https://github.com/girisugiri55irgi-alt/paud-birrul-walidin-laravel.git
```

2. Masuk ke folder project:

```bash
cd paud-birrul-walidin-laravel
```

3. Install dependensi Laravel:

```bash
composer install
```

4. Salin file konfigurasi:

```bash
copy .env.example .env
```

5. Buat application key:

```bash
php artisan key:generate
```

6. Atur konfigurasi database pada file `.env`.

7. Jalankan migrasi database:

```bash
php artisan migrate
```

8. Buat symbolic link penyimpanan:

```bash
php artisan storage:link
```

9. Install dependensi frontend:

```bash
npm install
npm run build
```

10. Jalankan aplikasi:

```bash
php artisan serve
```

Buka browser dan akses:

```text
http://127.0.0.1:8000
```

## 🔐 Keamanan

- File konfigurasi `.env` tidak boleh dipublikasikan.
- Password pengguna harus dikelola dengan aman.
- Hak akses pengguna disesuaikan dengan peran masing-masing.
- Pengelolaan data harus memperhatikan keamanan dan privasi peserta didik.

## 🚀 Pengembangan Selanjutnya

Beberapa pengembangan yang dapat dilakukan:
- Penyempurnaan sistem laporan perkembangan peserta didik.
- Pengembangan notifikasi informasi kepada orang tua.
- Peningkatan fitur evaluasi pembelajaran.
- Pengembangan laporan administrasi sekolah.
- Optimalisasi keamanan dan performa aplikasi.

## 👨‍💻 Pengembang

**Project:** Website PAUD Birrul Walidain  
**Platform:** Web Application  
**Framework:** Laravel 12  
**Repository:** [GitHub - PAUD Birrul Walidain](https://github.com/girisugiri55irgi-alt/paud-birrul-walidin-laravel)

---

*Website PAUD Birrul Walidain dikembangkan sebagai upaya mendukung digitalisasi layanan informasi dan administrasi pendidikan anak usia dini.*

