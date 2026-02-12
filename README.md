# TokoBuku - Sistem Manajemen Inventaris Toko Buku

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-A52A2A?style=for-the-badge)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

Selamat datang di proyek TokoBuku! Aplikasi ini adalah sistem manajemen inventaris dan penjualan untuk toko buku, dibangun dengan Laravel dan Filament.

## Fitur Utama

-   **Manajemen Data Master**: Kelola data penulis, kategori, dan penerbit buku.
-   **Manajemen Buku**: Pencatatan detail buku beserta relasinya dengan penulis dan kategori.
-   **Manajemen Stok**: Lacak jumlah stok buku di setiap lokasi.
-   **Manajemen Penjualan**: Catat transaksi penjualan dan detail item yang terjual.
-   **Manajemen Pengembalian**: Catat transaksi pengembalian (retur) dari pelanggan.
-   **Panel Admin Modern**: Antarmuka yang cepat dan responsif dibangun dengan [Filament](https://filamentphp.com/).
-   **Manajemen Akses**: Kontrol hak akses pengguna menggunakan [Filament Shield](https://filamentphp.com/plugins/bezhansalleh-shield).

## Teknologi yang Digunakan

-   **Backend**: Laravel 12
-   **Admin Panel**: Filament 4
-   **Frontend**: Blade, Tailwind CSS (via Filament)
-   **Database**: (Dapat dikonfigurasi di `.env`, contoh: MySQL, PostgreSQL)
-   **Server**: (Dapat dijalankan dengan `php artisan serve` atau server lain seperti Nginx/Apache)

## Panduan Instalasi

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan pengembangan lokal Anda.

**Prasyarat:**
-   PHP 8.2+
-   Composer
-   Node.js & NPM
-   Database (misal: MySQL, MariaDB, PostgreSQL)

**Langkah-langkah:**

1.  **Clone Repositori**
    ```bash
    git clone https://[URL-repositori-Anda].git
    cd tokobuku
    ```

2.  **Instal Dependensi**
    Gunakan skrip `setup` yang sudah disediakan di `composer.json` untuk instalasi cepat.
    ```bash
    composer setup
    ```
    Skrip ini akan menjalankan perintah berikut:
    -   `composer install`
    -   Membuat file `.env` dari `.env.example`
    -   `php artisan key:generate`
    -   `php artisan migrate --force`
    -   `npm install`
    -   `npm run build`

3.  **Konfigurasi Environment**
    Buka file `.env` dan sesuaikan konfigurasi database Anda.
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=tokobuku
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Jalankan Migrasi & Seeder (jika diperlukan)**
    Jika Anda tidak menggunakan skrip `setup`, jalankan migrasi secara manual. Jalankan seeder untuk mengisi data awal.
    ```bash
    php artisan migrate
    php artisan db:seed
    ```

5.  **Jalankan Server Pengembangan**
    Gunakan skrip `dev` yang sudah disediakan untuk menjalankan server, antrian, dan Vite secara bersamaan.
    ```bash
    composer dev
    ```
    Atau jalankan secara manual:
    ```bash
    php artisan serve
    ```

6.  **Akses Aplikasi**
    -   **URL Aplikasi**: [http://localhost:8000](http://localhost:8000)
    -   **URL Panel Admin**: [http://localhost:8000/admin](http://localhost:8000/admin)

    Untuk login ke panel admin, Anda dapat membuat user baru melalui seeder atau register jika fitur tersebut diaktifkan.

## Struktur Direktori & Konvensi Penamaan

Proyek ini menggunakan konvensi penamaan yang terstruktur untuk model, resource, dan file terkait lainnya untuk menjaga keteraturan.

-   **Format**: `G<Grup>M<Modul>_<Nama>`
-   **Contoh**: `G001M001Author`

**Penjelasan Grup & Modul:**

-   **G001: Data Master**
    -   `M001`: Authors (Penulis)
    -   `M002`: Categories (Kategori)
    -   `M003`: Publishers (Penerbit)
    -   `M004`: Books (Buku)
    -   `M005`: AuthorBooks (Relasi Penulis-Buku)
    -   `M006`: CategoryBooks (Relasi Kategori-Buku)
-   **G002: Manajemen Stok**
    -   `M007`: Locations (Lokasi)
    -   `M008`: StockBalances (Saldo Stok)
    -   `M009`: Returns (Pengembalian)
    -   `M010`: ReturnItems (Item Pengembalian)
-   **G003: Transaksi**
    -   `M011`: Sales (Penjualan)
    -   `M012`: SaleItems (Item Penjualan)

Struktur ini diterapkan pada direktori `app/Models`, `app/Filament/Resources`, `app/Policies`, dan file migrasi untuk memudahkan navigasi dan pemeliharaan.

## Berkontribusi

Terima kasih telah mempertimbangkan untuk berkontribusi! Silakan buat *issue* atau *pull request* jika Anda menemukan bug atau memiliki saran untuk perbaikan.

## Lisensi

Proyek ini menggunakan lisensi [MIT license](https://opensource.org/licenses/MIT).