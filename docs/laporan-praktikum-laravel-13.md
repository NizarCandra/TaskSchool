# Laporan Praktikum Laravel 13 - TaskSchool

## Nama Project
TaskSchool - Sistem Manajemen Tugas Sekolah.

## Fungsi Aplikasi
Aplikasi ini digunakan untuk mengelola tugas sekolah. Pengguna dapat menambah tugas, melihat daftar tugas, mengubah tugas, menghapus tugas, menentukan status, dan mengisi deadline.

## Fitur Project
- CRUD tugas sekolah.
- Status tugas: belum, proses, selesai.
- Deadline tugas.
- JSON API dengan response standar.
- Queue job untuk simulasi reminder tugas.
- CSRF protection pada form web menggunakan `@csrf`.
- PHP Attribute pada model menggunakan `#[Scope]` untuk contoh attribute-based development.

## Endpoint API
- `GET /api/tasks`
- `POST /api/tasks`
- `GET /api/tasks/{task}`
- `PUT /api/tasks/{task}`
- `DELETE /api/tasks/{task}`

Contoh JSON response:

```json
{
  "success": true,
  "message": "Data tugas berhasil diambil.",
  "data": []
}
```

## Laravel Boost dan AI Assisted Development
Laravel Boost adalah tool resmi Laravel untuk membantu AI assistant memahami project Laravel. Pada praktikum, Boost dapat digunakan untuk mencari dokumentasi, membaca struktur project, dan membantu upgrade framework.

Command yang diminta tugas:

```bash
composer require laravel/boost
php artisan boost:install
php artisan boost:list-skills
```

Catatan hasil implementasi: PHP 8.3.31 sudah dipasang di `C:\php-8.3`, project berhasil dinaikkan ke Laravel 13.11.2, dan Laravel Boost berhasil dipasang. Pada versi Boost yang digunakan, command daftar skill adalah `php artisan boost:list-skills`.

Prompt AI yang digunakan:

```text
Buatkan implementasi Laravel 13 untuk sistem manajemen tugas sekolah dengan CRUD, JSON API, queue reminder, dan dokumentasi praktikum.
```

Keuntungan AI:
- Membantu menyusun struktur fitur lebih cepat.
- Membantu debugging dan dokumentasi.
- Membantu membandingkan Laravel 12 dan Laravel 13.

Kekurangan AI:
- Hasil harus tetap dicek programmer.
- Bisa memberi kode yang tidak sesuai versi package lokal.
- Tidak boleh langsung copy paste tanpa memahami.

## JSON Response Standard
API project ini memakai struktur JSON rapi berisi `success`, `message`, dan `data`. Struktur ini memudahkan frontend dan mobile app membaca hasil response secara konsisten.

## Attribute Based Development
Project ini memakai PHP Attribute `#[Scope]` pada model `Task` untuk membuat query scope modern. Pada Laravel 12, style seperti ini lebih sering ditulis manual sebagai method biasa. Pada Laravel 13, penggunaan attribute membuat metadata kode lebih eksplisit dan modern.

Contoh perbandingan:

```php
// Style modern berbasis attribute
#[Scope]
protected function pending(Builder $query): void
{
    $query->where('status', 'belum');
}
```

## Security Improvement
CSRF melindungi form dari request palsu yang dikirim dari website lain. Pada project ini, form tambah, edit, dan hapus tugas memakai `@csrf` agar request hanya valid jika berasal dari aplikasi.

Laravel 13 memperkenalkan pendekatan `PreventRequestForgery` sebagai penerus konsep lama `VerifyCsrfToken`. Pada environment saat ini, class tersebut belum bisa diuji karena dependency vendor masih perlu diselaraskan dengan PHP 8.3+. Konsep yang sudah diterapkan di project adalah perlindungan request form memakai `@csrf`.

## Queue / Job Modernization
Project ini memiliki job `SendTaskReminder`. Job akan masuk ke queue saat tugas baru dibuat. Simulasi ini mewakili proses reminder, email, generate laporan, atau proses berat lain yang sebaiknya tidak langsung dijalankan di request utama.

Command menjalankan queue:

```bash
php artisan queue:work
```

Manfaat queue:
- Aplikasi terasa lebih cepat.
- Proses berat dipindahkan ke background.
- Cocok untuk aplikasi besar yang butuh skalabilitas.

## Laravel 12 vs Laravel 13
Laravel 12 masih berfokus pada backend web tradisional dan fitur modern Laravel umum. Laravel 13 membawa arah lebih modern, terutama melalui dukungan AI assisted workflow, dokumentasi upgrade berbasis AI, peningkatan keamanan request, attribute modernization, queue improvement, dan JSON API yang lebih nyaman untuk aplikasi frontend atau mobile.

## Kesimpulan Pribadi
Melalui project ini, saya mempelajari cara membuat aplikasi Laravel 13 sederhana dengan CRUD, API JSON, queue, dan dokumentasi. Fitur paling menarik adalah queue karena dapat memindahkan proses reminder ke background. Penggunaan AI juga membantu mempercepat penyusunan kode dan dokumentasi, tetapi hasil AI tetap harus dipahami dan diuji.
