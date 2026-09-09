<div align="center">

  <!-- Tempatkan file logo kamu di folder public (contoh: public/logo.png) atau ganti src ini dengan link/path logo kamu -->
  <img src="public/logo.jpeg" alt="ParfumStore.id Logo" width="130" style="border-radius: 20px;">

  # 💐 ParfumStore.id
  **Platform E-Commerce & Dashboard Analisis Toko Parfum Premium**

  [![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
  [![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
  [![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
  [![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)

</div>

---

## 📌 Tentang Proyek

**ParfumStore.id** adalah aplikasi e-commerce dan sistem manajemen wewangian premium berbasis web. Dibangun dengan pendekatan UI/UX modern (*Floating Capsule Navbar* & *Soft Gradient Background*), platform ini menghadirkan pengalaman berbelanja yang interaktif dan responsif, sekaligus menyediakan dashboard analitik bisnis internal secara *real-time* bagi admin toko.

---

## 🚀 Fitur-Fitur Utama

* **🛒 Katalog & Keranjang Belanja:** Eksplorasi koleksi varian parfum dengan manajemen *shopping cart* dan proses *checkout* ringkas.
* **🧾 Struk Pembayaran Digital (.PNG):** Ekspor otomatis bukti transaksi menjadi file gambar (.PNG) berbasis `html2canvas` yang siap diunduh atau dibagikan.
* **📊 Dashboard Admin & Chart.js:** Visualisasi grafik 5 parfum terlaris secara *real-time*, ringkasan pendapatan, dan verifikasi pesanan masuk.
* **👁️ Internal Visitor Tracking:** Middleware statistik lalu lintas pengunjung (pencatat IP address, pengunjung unik, dan kunjungan harian) tanpa ketergantungan API pihak ketiga.
* **🖼️ Manajemen Media Hybrid:** Fleksibilitas input gambar produk (mendukung *upload* file lokal storage maupun tautan URL gambar dari internet).
* **📱 Floating Navigation & Responsive UI:** Antarmuka visual kapsul melayang yang secara otomatis menyesuaikan tata letak untuk layar desktop maupun ponsel (*mobile menu*).

---

## 🛠️ Teknologi & Tools

* **Backend:** PHP 8.2, Laravel 12 (MVC Framework)
* **Frontend:** Blade Templating, Bootstrap 5, Bootstrap Icons, JavaScript (ES6)
* **Database:** MySQL
* **Libraries:** Chart.js, html2canvas
* **Environment Tools:** XAMPP, Git

---

## ⚙️ Panduan Instalasi Lokal

Ingin mencoba proyek ini di komputer lokal? Ikuti langkah-langkah berikut:

```bash
# 1. Clone repository ini
git clone [https://github.com/syafiqrasul123-spec/Website-Parfum-Store-Id.git](https://github.com/syafiqrasul123-spec/Website-Parfum-Store-Id.git)

# 2. Masuk ke direktori proyek
cd Website-Parfum-Store-Id

# 3. Install dependency PHP via Composer
composer install

# 4. Salin file environment
cp .env.example .env

# 5. Generate Application Key
php artisan key:generate

# 6. Sesuaikan konfigurasi database MySQL pada file .env
# DB_DATABASE=website-parfum

# 7. Jalankan Migrasi Database
php artisan migrate

# 8. Buat Symlink Storage Gambar
php artisan storage:link

# 9. Jalankan Server Lokal
php artisan serve