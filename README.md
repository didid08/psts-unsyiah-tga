## Web TGA Teknik Sipil Unsyiah
##### Sistem pengajuan skripsi/TGA untuk jurusan Teknik Sipil Fakultas Teknik Universitas Syiah Kuala

#### System Requirements
- PHP 7
- Composer
- PostgreSQL

#### Installation Guide (Quick Start)
- Buka Terminal/Console, lalu jalankan:

  > cd *folder_web*
  >
  > composer install
  >
  > composer run generate-env
  >
  > php artisan key:generate
- Kemudian anda wajib mengedit info database dan email di file .env yang baru saja dibuat
- Jika anda menggunakan Gmail sebagai layanan email anda, anda perlu mengizinkan akses aplikasi yang kurang aman di akun gmail anda dengan cara mengakses halaman berikut: [Allow Less Secure Apps](https://myaccount.google.com/lesssecureapps)
- Anda mungkin perlu menyesuaikan beberapa hal lebih lanjut seperti penyesuaian database,dll