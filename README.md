# Dokumentasi Pengaturan Proyek

Berikut adalah panduan langkah demi langkah untuk melakukan instalasi dan konfigurasi proyek *Event Management* ini.

## Persyaratan Sistem

Pastikan environment pengembangan Anda telah memenuhi persyaratan berikut:

* **PHP 8.2 atau lebih tinggi**
* **Composer** (Manajer dependensi untuk PHP)
* **Node.js & npm** (Untuk mengelola dependensi JavaScript)
* **Database** (Proyek ini secara *default* menggunakan SQLite, namun Anda dapat menggantinya dengan MySQL, PostgreSQL, dll.)

## Langkah-langkah Instalasi

### 1. Dapatkan *Source Code*

Langkah pertama adalah mendapatkan *source code* proyek. Anda dapat melakukan ini dengan mengunduh atau melakukan *clone* dari *repository* proyek ke direktori lokal Anda.

### 2. Instalasi Dependensi

Proyek ini menggunakan Composer untuk mengelola dependensi PHP dan npm untuk dependensi JavaScript.

* **Instal Dependensi PHP:**

    Buka terminal atau *command prompt*, masuk ke direktori proyek, lalu jalankan perintah berikut:

    ```bash
    composer install
    ```

* **Instal Dependensi JavaScript:**

    Setelah instalasi Composer selesai, jalankan perintah berikut untuk menginstal dependensi JavaScript yang diperlukan:

    ```bash
    npm install
    ```

### 3. Konfigurasi Environment

Konfigurasi environment sangat penting agar aplikasi dapat berjalan dengan baik.

* **Buat File `.env`:**

    Salin file `.env.example` menjadi file baru dengan nama `.env`. File ini akan digunakan untuk menyimpan semua variabel environment aplikasi Anda.

    ```bash
    cp .env.example .env
    ```

* **Hasilkan Kunci Aplikasi (*Application Key*):**

    Laravel memerlukan kunci aplikasi yang unik untuk keamanan sesi dan enkripsi data. Jalankan perintah Artisan berikut untuk membuatnya:

    ```bash
    php artisan key:generate
    ```

### 4. Pengaturan Database

* **Konfigurasi Koneksi Database:**

    Buka file `.env` yang telah Anda buat dan sesuaikan konfigurasi *database* sesuai dengan environment Anda. Secara *default*, proyek ini menggunakan SQLite, yang tidak memerlukan konfigurasi tambahan.

    Jika Anda menggunakan **MySQL**, ubah baris berikut di file `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=username_anda
    DB_PASSWORD=password_anda
    ```

    Pastikan Anda sudah membuat *database* dengan nama yang sesuai.

* **Migrasi dan *Seeding* Database:**

    Setelah koneksi *database* diatur, jalankan perintah berikut untuk membuat semua tabel yang diperlukan dan mengisi data awal (*dummy data*) ke dalam *database*:

    ```bash
    php artisan migrate --seed
    ```

    Perintah ini akan menjalankan semua file migrasi dan *seeder* yang ada di dalam proyek.

### 5. Penyimpanan File

Proyek ini menggunakan sistem penyimpanan lokal untuk file yang diunggah, seperti gambar *event*. Buat *symbolic link* agar file yang tersimpan di `storage/app/public` dapat diakses dari direktori `public`:

```bash
php artisan storage:link
```

### 6. Menjalankan Aplikasi

Setelah semua langkah di atas selesai, Anda siap untuk menjalankan aplikasi. Proyek ini dilengkapi dengan skrip untuk menjalankan beberapa layanan sekaligus.

* **Menjalankan Development Server:**

    Gunakan perintah berikut untuk menjalankan server pengembangan PHP, queue listener, log tailing, dan Vite (untuk kompilasi aset frontend) secara bersamaan:

    ```bash
    npm run dev
    ```

    Atau, Anda dapat menjalankan server pengembangan PHP saja dengan:

    ```bash
    php artisan serve
    ```

    Setelah server berjalan, aplikasi akan dapat diakses melalui URL:

    ```
    http://127.0.0.1:8000
    ```

    (atau port lain yang ditampilkan di terminal)

## Akun Demo

Anda dapat menggunakan akun demo berikut untuk masuk ke dalam aplikasi dan mencoba fungsionalitasnya:

**Admin:**

- Email: `admin@example.com`
- Password: `password`

**Pembuat Event (Dosen):**

- Email: `budi@ukp.ac.id`
- Password: `password`

**Mahasiswa:**

- Email: `andi@student.ukp.ac.id`
- Password: `password`

Anda dapat menemukan lebih banyak akun demo di dalam file:

```
database/seeders/UserSeeder.php
```

---

Dengan mengikuti langkah-langkah di atas, proyek *Event Management* Anda seharusnya sudah berhasil terinstal dan siap untuk digunakan.
