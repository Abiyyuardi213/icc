# Informatics Coding Competition (ICC) Platform

Platform web untuk pendaftaran dan manajemen lomba Informatika (ICC). Aplikasi ini memungkinkan peserta untuk mendaftar akun, membentuk tim, memilih kategori lomba, dan mengelola data tim mereka.

## 🚀 Fitur Utama

-   **Authentication**: Registrasi dan Login peserta.
-   **Dynamic Events**: Kategori lomba (misal: Basis Data, Pemrograman) dikelola via database, bukan hardcoded.
-   **Team Management**: Satu User (Ketua) mengelola Satu Tim.
-   **Team Members**: Mendukung input anggota tim yang fleksibel.
-   **Dashboard**: Panel status untuk melihat data tim dan status verifikasi.

## 🗂️ Struktur Database & Relasi

Aplikasi ini menggunakan desain database relasional yang ternormalisasi:

1.  **Users**: Data akun login (Email, Password).
    -   _Relasi_: One-to-One dengan `Teams`.
2.  **Roles**: Hak akses user (Admin vs User).
3.  **Events**: Data perlombaan (Nama, Deskripsi, Jadwal, Batas Anggota).
    -   _Relasi_: One-to-Many dengan `Teams`.
4.  **Teams**: Data tim peserta.
    -   _Relasi_: BelongsTo `User` (Ketua/Pemilik Akun).
    -   _Relasi_: BelongsTo `Event` (Kategori Lomba yang diikuti).
5.  **Team Members**: Data detail anggota tim (Nama, NPM, No HP).
    -   _Relasi_: BelongsTo `Team`.
6.  **Submissions**: File yang dikumpulkan peserta.
    -   _Relasi_: BelongsTo `Team` dan `Event`.

## 🔄 Alur Penggunaan (User Flow)

1.  **Registrasi Akun**: Pengunjung mendaftar akun baru (`/register`).
2.  **Login**: Masuk ke sistem menggunakan email & password.
3.  **Registrasi Tim**:
    -   Akses menu pendaftaran.
    -   Pilih **Jenis Kompetisi** (Data diambil dari tabel `events`).
    -   Isi Nama Tim dan Data Anggota.
    -   _Note_: NPM anggota akan divalidasi agar tidak ada duplikasi antar tim.
4.  **Dashboard**:
    -   Setelah mendaftar, user akan dialihkan ke Dashboard.
    -   User dapat melihat detail tim, status kelulusan, dan jadwal.

## 🛠️ Instalasi & Setup

Ikuti langkah berikut untuk menjalankan project di local environment:

### Prerequisite

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL

### Langkah Instalasi

1.  **Clone Repository**

    ```bash
    git clone https://github.com/username/icc-project.git
    cd ipc-project
    ```

2.  **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**

    -   Copy file `.env.example` menjadi `.env`:

    ```bash
    cp .env.example .env
    ```

    -   Atur konfigurasi database di `.env`:

    ```ini
    DB_DATABASE=icc_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generate Key**

    ```bash
    php artisan key:generate
    ```

5.  **Migrasi & Seeding (PENTING)**
    Langkah ini akan membuat tabel dan mengisi data Lomba (Events) default.

    ```bash
    php artisan migrate:fresh --seed
    ```

6.  **Jalankan Aplikasi**
    Buka dua terminal:

    ```bash
    # Terminal 1 (Backend)
    php artisan serve
    ```

    ```bash
    # Terminal 2 (Frontend Assets)
    npm run dev
    ```

7.  **Akses Web**
    Buka browser di [http://localhost:8000](http://localhost:8000).

## 👨‍💻 Kontribusi

Silakan buat Pull Request untuk fitur baru atau perbaikan bug. Pastikan mengikuti naming convention tabel (plural) dan controller yang disepakati.
