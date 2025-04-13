# 📌 TaskHub

**TaskHub** adalah aplikasi manajemen tugas berbasis Laravel yang membantu pengguna dalam mengelola dan mengorganisir tugas-tugas harian mereka. Aplikasi ini memungkinkan pengguna untuk membuat tugas, mengelompokkannya ke dalam beberapa status, serta menambahkan attachment sebagai pendukung informasi.

---

## ✨ Fitur-Fitur

-   ✅ **CRUD Task**  
    Tambah, lihat, ubah, dan hapus tugas.

-   📎 **Attachment File**  
    Pengguna dapat melampirkan file pada setiap tugas sebagai referensi atau dokumen pendukung.

-   🗂️ **Kategori Tugas (Task Grouping)**  
    Tugas dikelompokkan ke dalam 3 status:
    -   **Open**
    -   **In Progress**
    -   **Done**

---

## ⚙️ Requirements

-   PHP >= 8.1
-   Composer
-   MySQL / PostgreSQL
-   Node.js & npm (jika menggunakan frontend seperti Vue/Vite/React)

---

## 🛠️ Instalasi

Langkah-langkah untuk menjalankan proyek ini secara lokal:

```bash
# 1. Clone repositori
git clone https://github.com/adesopiann/TaskHub.git
cd TaskHub

# 2. Install dependensi PHP
composer install

# 3. Salin dan konfigurasi file environment
cp .env.example .env
php artisan key:generate

# 4. Migrasi dan seed database
php artisan migrate --seed

# 5. Install dependensi frontend (jika ada)
npm install && npm run dev

# 6. Jalankan server Laravel
php artisan serve


🧑‍💻 Developer
Proyek ini dibuat oleh:

Ade Sopian
🧪 Untuk memenuhi tugas Ujian Praktek Akhir
🔗 LinkedIn: https://www.linkedin.com/in/ade-sopian-dev/
📸 Instagram: @adespiann

```
