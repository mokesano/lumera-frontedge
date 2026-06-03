# Lumera Frontedge

Lumera Frontedge adalah platform open-source untuk manajemen editorial dan penerbitan ilmiah. Fokus repositori ini adalah modernisasi kode legacy menjadi struktur PHP modern berbasis Composer, PSR-4, dan PSR-12.

## Informasi Utama

- **Nama paket:** `lumera/lumera-frontiers`
- **Tipe proyek:** aplikasi PHP
- **Lisensi:** GPL-3.0-only
- **PHP:** `^8.4`
- **Autoload:** Composer PSR-4
- **Vendor dir:** `core/Library`

## Struktur Singkat

| Path | Fungsi |
| --- | --- |
| `app/` | Domain, halaman, controller, service, dan helper aplikasi. |
| `core/` | Kernel, modul inti, include global, dan library Composer. |
| `plugins/` | Plugin gateway, generic, import/export, metadata, dan pembayaran. |
| `resources/` | Template, locale, dan asset pendukung aplikasi. |
| `public/` | Entry point dan asset publik. |
| `docs-dev/` | Catatan teknis dan utilitas migrasi internal. |

## Instalasi Development

```bash
composer install
npm install
```

## Pemeriksaan Kode

```bash
composer dump-autoload --optimize --no-interaction
composer cs-check
```

`composer cs-check` menggunakan PHP_CodeSniffer jika tersedia. Jika dependency belum terpasang, command tetap selesai tanpa gagal dan menampilkan instruksi singkat untuk menjalankan `composer install`.

## Dokumentasi

Dokumentasi teknis tambahan berada di folder `docs/` dan `docs-dev/`.
