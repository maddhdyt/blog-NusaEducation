# 🚀 Roadmap Kustomisasi Frontend ArkaSEO (Per Brand)

Roadmap ini dibuat untuk memandu alur kerja kustomisasi tampilan aplikasi blog ArkaSEO agar sesuai dengan kebutuhan masing-masing brand di perusahaan.

---

## 💻 Tahap 1: Persiapan Awal (Setup di PC Baru)
Karena kamu akan bekerja di PC yang berbeda besok, hal pertama yang harus dilakukan adalah menyiapkan *environment* agar aplikasi bisa berjalan seperti hari ini.

- [ ] **Clone / Copy Project**: Pastikan folder project `ArkaSEO` sudah ada di dalam `C:\laragon\www\` di PC barumu.
- [ ] **Setup Database**: Buka aplikasi Laragon, pastikan database SQLite sudah siap.
- [ ] **Install Dependency**: Buka terminal Git Bash di dalam folder project, lalu jalankan:
  ```bash
  composer install
  npm install
  ```
- [ ] **Migrasi & Dummy Data**: 
  ```bash
  php artisan migrate
  php artisan db:seed
  ```
- [ ] **Jalankan Server Lokal**: Buka 2 terminal terpisah:
  - Terminal 1: `php artisan serve`
  - Terminal 2: `npm run dev`

---

## 🎨 Tahap 2: Pengenalan Struktur File (Area Kerjamu)
Sebagai Frontend Developer yang akan merombak tampilan, kamu tidak perlu memikirkan *database* atau *controller*. Fokus kerjamu hanya ada di folder-folder berikut:

- `resources/views/frontend/` ➡️ Berisi semua struktur HTML (Blade) untuk pengunjung (Home, Artikel, Kategori).
- `resources/views/layouts/frontend.blade.php` ➡️ Kerangka utama (Master Layout) seperti Navbar dan Footer.
- `resources/css/app.css` ➡️ File CSS utama.
- `tailwind.config.js` ➡️ Tempat kamu mendaftarkan warna kustom atau *font* khusus untuk brand tersebut.

---

## 🛠️ Tahap 3: Alur Kustomisasi per Brand
Langkah-langkah sistematis saat mulai mendesain tampilan untuk sebuah brand:

### Langkah 3.1: Pengaturan Dasar via Admin
Sebelum mengubah kode, lakukan pengaturan dasar dari Dashboard Admin (`/login` dengan `admin@arkaseo.com` / `password`).
- [ ] Ganti **Logo Website**.
- [ ] Ubah teks **Footer**.
- [ ] Atur **Warna Tema Utama (Theme Colors)** jika brand tersebut hanya butuh ganti warna.

### Langkah 3.2: Perombakan Layout & Navbar (Jika Perlu)
- [ ] Buka `resources/views/layouts/frontend.blade.php`
- [ ] Sesuaikan bentuk Navbar, letak logo, dan susunan menu sesuai *guideline* desain brand.
- [ ] Modifikasi Footer.

### Langkah 3.3: Mendesain Halaman Utama (Home)
- [ ] Buka `resources/views/frontend/home.blade.php`
- [ ] Rombak struktur *Hero Section* (Artikel Utama).
- [ ] Sesuaikan bentuk *Grid* atau daftar artikel (Terbaru, Populer, Sorotan).
- [ ] Pastikan tampilan *Responsive* (bagus di HP dan Desktop) menggunakan *class* Tailwind seperti `md:flex`, `lg:grid`.

### Langkah 3.4: Mendesain Halaman Detail & Kategori
- [ ] Buka `resources/views/frontend/posts/show.blade.php` ➡️ Rapikan tampilan saat orang membaca artikel (ukuran font, jarak paragraf).
- [ ] Buka `resources/views/frontend/category.blade.php` ➡️ Rapikan tampilan daftar artikel berdasarkan kategori tertentu.

---

## 🚀 Tahap 4: Finalisasi & Build (Jika Sudah Selesai)
Jika desain untuk satu brand sudah *fix* dan siap di-online-kan (atau diserahkan ke tim backend/server):

- [ ] Pastikan tidak ada *error* tampilan di layar HP.
- [ ] Jalankan perintah ini untuk mengompilasi CSS/JS menjadi versi final (Production):
  ```bash
  npm run build
  ```
- [ ] Project siap di-*deploy*!

---

**Catatan untuk Sesi AI Besok:**
Jika besok kamu memulai *chat* / sesi baru dengan AI, kamu bisa memintanya untuk **membaca file `ROADMAP.md` ini** agar AI tersebut langsung mengerti konteks pekerjaanmu tanpa harus kamu jelaskan dari awal lagi! Selamat bekerja! ☕
