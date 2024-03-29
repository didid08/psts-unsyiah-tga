## Web TGA Teknik Sipil Unsyiah
##### Sistem pengajuan skripsi/TGA untuk jurusan Teknik Sipil Fakultas Teknik Universitas Syiah Kuala

#### System Requirements
- Apache with Mod Rewrite enabled
- PHP 7
- Composer
- PostgreSQL

#### Installation Guide (Quick Start)
- Pastikan webnya sudah berada di direktori yang sesuai di server anda
- Buka Terminal/Console, lalu jalankan:

  > cd *folder_web*
  >
  > composer install
  >
  > php artisan key:generate
- Kemudian anda perlu mengedit beberapa konfigurasi di folder *config* (Termasuk konfigurasi untuk Database dan Email)
- Jika anda menggunakan Gmail sebagai layanan email anda, anda perlu mengizinkan akses aplikasi yang kurang aman di akun gmail anda dengan cara mengakses halaman berikut: [Allow Less Secure Apps](https://myaccount.google.com/lesssecureapps)
- (Opsional) Anda mungkin perlu menyesuaikan beberapa hal lebih lanjut seperti penyesuaian database, dll
- Kemudian jalankan:

  > php artisan config:cache
  >
  > php artisan view:cache
  >
  > composer dump-autoload
- Kemudian jika anda sudah merasa semuanya sudah sesuai, anda perlu migrate & seeding database dengan cara menjalankan:

  > php artisan migrate --seed
- Setelah itu web sudah siap diakses (*Document root: ./public*)