# 🍱 KantinSMKN10 - Sistem Kantin Digital

Aplikasi E-Commerce Kantin Sekolah berbasis web untuk mendigitalisasi proses pemesanan dan manajemen kantin di SMKN 10. Dibangun menggunakan **Laravel 11**, **Livewire**, dan **Spatie Permission**.

## 🚀 Fitur Utama

* **Customer (Siswa):** Browsing menu, pemesanan online, dan cek riwayat pesanan.
* **Kasir (Siswa Petugas):** Manajemen pesanan masuk, konfirmasi pembayaran, dan update stok harian.
* **Administrator (Guru):** Monitoring laporan penjualan, manajemen user, dan manajemen kategori menu.

## 🛠️ Tech Stack

* **Framework:** [Laravel 11](https://laravel.com)
* **Frontend Interface:** [Laravel UI (Bootstrap 5)](https://laravel.com/docs/11.x/starter-kits#laravel-ui)
* **Reactivity:** [Livewire v3](https://livewire.laravel.com)
* **Authorization:** [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)
* **Database:** MySQL

## 📋 Prasyarat

Sebelum menjalankan proyek ini, pastikan kamu sudah menginstal:
* PHP >= 8.2
* Composer
* Node.js & NPM
* MySQL / MariaDB

## ⚙️ Cara Instalasi

1. **Clone Repository**
   ```bash
   git clone [https://github.com/almer2304/SMKN-10-Kantin-App.git](https://github.com/almer2304/SMKN-10-Kantin-App.git)
   cd SMKN-10-Kantin-App

2. **Install dependencies**
    ```bash
    composer install
    npm install

3. **Konfigurasi ENV**
    ```bash
    cp .env.example .env

4. **Generate key**
    ```bash
    php artisan key:generate

5. **Migrasi dan seeding**
    ```bash
    php artisan migrate:fresh --seed

6. **Jalankan aplikasi dengan 2 terminal**
    ```bash
    php artisan serve
    npm run dev
