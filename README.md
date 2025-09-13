# sanak-cbt-lama

Legacy CodeIgniter-based Computer Based Test (CBT) application.

## Fitur Utama
- Manajemen tes & bank soal
- Import / export Excel (PhpSpreadsheet)
- Theming hijau kustom
- Panel dashboard collapsible
- Konfigurasi database via file `.env`

## Persyaratan
- PHP 8.1+ (disarankan 8.2/8.3)
- Ekstensi: mysqli, gd, mbstring, zip, xml
- MySQL / MariaDB
- Composer

## Instalasi
1. Clone repo
2. Masuk folder project
3. Salin `.env.example` menjadi `.env` lalu sesuaikan nilai DB
4. Jalankan `composer install` (jika belum ada vendor)
5. Pastikan `application/config/database.php` sudah mengambil variabel lingkungan
6. Akses aplikasi melalui `http://localhost/<folder>`

## Konfigurasi .env
```
DB_HOST=localhost
DB_PORT=3306
DB_NAME=cbt1
DB_USER=root
DB_PASS=
DB_DRIVER=mysqli
```

## Struktur Direktori Singkat
- `application/` kode utama CodeIgniter
- `public/` aset frontend
- `uploads/` file soal & media (di-ignore git)
- `.env` konfigurasi lokal (jangan commit)

## Perintah Pengembangan
Regenerasi autoload composer setelah menambah library:
```
composer dump-autoload
```

## Keamanan
- Jangan commit `.env`
- Ganti `encryption_key` di `config.php` untuk produksi

## Lisensi
Hak cipta sesuai pemilik asli aplikasi CBT.
