<div align="center">
  
# 🛒 Item Backend API (UTP)
Sebuah *Restful API (Backend)* sederhana bergaya e-commerce yang mengadopsi operasi **CRUD (Create, Read, Update, Delete)** menyeluruh menggunakan data persisten lokal berformat JSON (Non-Database). Proyek ini dibangun sebagai pemenuhan spesifikasi **Ujian Tengah Praktikum (UTP)**.

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Swagger](https://img.shields.io/badge/-Swagger-%23Clojure?style=for-the-badge&logo=swagger&logoColor=white)](https://swagger.io/)

</div>

---

## ✨ Fitur Utama
Sistem ini memenuhi seluruh *terms & conditions* UTP dengan kelengkapan fitur berikut:

- 🚀 **Full CRUD Operation**: Implementasi menyeluruh terhadap 5 operasi metode HTTP primer (POST, GET, PUT, PATCH, DELETE).
- 💾 **JSON File Based Storage**: Penyimpanan data (mock-data) di-*handle* sepenuhnya lewat baca-tulis file `storage/app/items.json`.
- 🛡️ **Validation & Error Handling**: Mengetatkan gerbang *Request*! Memastikan parameter mutlak diisi (`required`) dan memiliki proteksi keamanan bertipe numerik (`integer`), serta memunculkan status `404 Not Found` ketika *Error ID* gagal dimuat.
- 📋 **Live Interactive Documentation (Point +)**: Terintegrasi 100% menggunakan library **L5-Swagger** *(OpenAPI)* yang secara otomatis *meng-generate* UI dokumentasi interaktif yang bisa diuji coba layaknya Postman dari dalam web!

---

## 🛠️ Persiapan & Instalasi Sistem

Ikuti panduan ringan di bawah ini untuk menjalankan *Source Code* di komputermu sendiri:

1. **Clone Repository ini**
   ```bash
   git clone https://github.com/Mangga123/245150300111013-AnggaPrimaR-UTPTIS.git
   cd 245150300111013-AnggaPrimaR-UTPTIS
   ```

2. **Install Seluruh Dependensi Eksternal (Composer)**
   Termasuk *library* `darkaonline/l5-swagger` sebagai fondasi dokumentasi.
   ```bash
   composer install
   ```

3. **Duplikat Environment File**
   Bila perlu, gandakan `.env.example` ke `.env` (Namun karena no-DB, step konfigurasi internal bisa diabaikan).
   ```bash
   cp .env.example .env
   ```

4. **Nyalakan Server Lokal Laravel**
   ```bash
   php artisan serve
   ```
   *Server backend akan menyala di `http://127.0.0.1:8000`.*

---

## 🧪 Cara Testing dan Menggunakan Swagger API Docs

Melakukan eksekusi Endpoint kini super praktis karena tidak membutuhkan ekstensi semacam *Thunder Client* / *Postman*, semuanya terangkum di **Swagger UI**.

1. Buka Browser (Google Chrome/Edge/Firefox).
2. Kunjungi alamat Endpoint Dokumentasinya: 👉 **`http://127.0.0.1:8000/api/documentation`**
3. Anda akan dihadapkan pada tabel visual API berwarna-warni. Berikut detail daftar rutenya:
   - 🟩 **POST `/items`** : Menginputkan & Mendata item produk baru *(butuh Data `nama` & `harga`)*
   - 🟦 **GET `/items`** : Mengambil (Read) seluruh antrean data yang tersimpan di dalam JSON.
   - 🟦 **GET `/items/{id}`** : Mendapatkan sebuah item secara pesifik berdasarkan penunjukan nomor ID.
   - 🟧 **PUT `/items/{id}`** : Menimpa secara penuh (wajib *full package*) baris informasi barang.
   - 🟫 **PATCH `/items/{id}`** : Penyesuaian informasi barang secara *fleksibel/parsial* tanpa harus melengkapi semua field.
   - 🟥 **DELETE `/items/{id}`** : Menghapus data inventaris secara spesifik via ID.

### Langkah Simulasi Request / Try-it Out:
- Silakan klik sembarang blok jalur URL (cth: 🟩 **POST `/items`**).
- Tekan tombol **"Try it out"**.
- Sunting spesifikasi kolom **RequestBody** sesuka hatimu.
- Klik tombol **"Execute"**. 
- Status dan data respon hasil *Request* (Entah Sukses Status `201`/`200` atau Gagal Error `404`/`422`) akan merespons dengan instan langsung tepat setelah diklik pada panel layar bagian bawah!

---
<div align="center">
  <i>Dibuat dengan ❤️ Untuk Pemenuhan UTP - Angga Prima R (245150300111013)</i>
</div>
