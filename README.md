# Setup Projek Laravel PPDB

Ini adalah proyek Laravel yang menggunakan Vite untuk pengelolaan aset, TailwindCSS untuk styling, dan Flowbite untuk komponen UI. Berikut adalah langkah-langkah untuk mengatur proyek ini di mesin lokal Anda.

## requirement

Pastikan Anda telah menginstal:

-   **PHP** (>=7.4)
-   **Composer**
-   **Node.js** (>=14.x)
-   **npm**

## Instalasi

Ikuti langkah-langkah di bawah ini untuk menginstal dan menjalankan proyek.

### 1. Clone Repository

```bash
git clone https://github.com/AdiLamunedo21/ppdb_smk_nurul_huda.git
```

### 2. Install Dependensi PHP

Gunakan Composer untuk menginstal dependensi PHP.

```bash
composer install
```

### 3. Install Dependensi Node.js

Install paket Node.js yang diperlukan menggunakan npm.

Menggunakan npm:

```bash
npm install
```

### 4. Konfigurasi Env

Salin file `.env.example` menjadi `.env` dan sesuaikan variabel env sesuai kebutuhan:

```bash
cp .env.example .env
```

```bash
Generate aplikasi key:
```

```bash
php artisan key:generate
```

### 5. Jalankan Migrasi

Jalankan perintah berikut untuk menyiapkan database:

```bash
php artisan migrate
```

```bash
php artisan db:seed
```

### 6. Kompilasi Aset

Untuk mengompilasi aset menggunakan Vite, jalankan:

Untuk pengembangan:

```bash
npm run dev
```


### 7. Jalankan Aplikasi

Terakhir, mulai server pengembangan Laravel:

```bash
php artisan serve
```

Aplikasi sekarang dapat diakses di `http://localhost:8000`.

## Informasi Tambahan

-   **TailwindCSS**: Digunakan untuk styling, bersama dengan komponen kustom.
-   **Vite**: Digunakan untuk alat frontend modern.
-   **Flowbite**: Komponen UI berbasis TailwindCSS.
