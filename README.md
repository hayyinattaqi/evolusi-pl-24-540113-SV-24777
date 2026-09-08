# To Do List Web App — Evolusi & Konstruksi Perangkat Lunak 2026

Aplikasi web to-do list sederhana berbasis **Laravel**, dibuat untuk memenuhi tugas Pertemuan 2 — *Manajemen GitHub & Prinsip CI* mata kuliah Evolusi & Konstruksi Perangkat Lunak 2026.

## Identitas

| | |
|---|---|
| Nama | `Hayyina Attaqiyya` |
| Repository | `https://github.com/KEPL2026/evolusi-pl-24-540113-SV-24777` |

## Deskripsi Aplikasi

Aplikasi ini memungkinkan pengguna untuk:

- Menambahkan tugas baru ke dalam daftar
- Menandai suatu tugas sebagai **selesai** atau membatalkannya kembali
- Menghapus tugas dari daftar
- Melihat seluruh daftar tugas beserta statusnya

Dibangun mengikuti pola **MVC** bawaan Laravel, dengan data disimpan melalui Eloquent ORM.

## Tech Stack

- PHP 8.2
- Laravel 11
- SQLite (untuk development & CI)
- Blade Template

## Instalasi & Menjalankan Secara Lokal

```bash
git clone https://github.com/KEPL2026/evolusi-pl-24-540113-SV-24777.git
cd evolusi-pl-<NIM>

composer install
cp .env.example .env
php artisan key:generate

touch database/database.sqlite
php artisan migrate

php artisan serve
```

Buka `http://127.0.0.1:8000` di browser.

## Menjalankan Test

```bash
php artisan test
```

## Struktur Branch

Repository ini menggunakan alur kerja Git terstruktur dengan tiga jenis branch:

| Branch | Fungsi |
|---|---|
| `main` | Branch produksi. Hanya menerima perubahan melalui Pull Request dari `dev`. **Tidak pernah** menerima push langsung. |
| `dev` | Branch pengembangan. Tempat seluruh fitur digabungkan dan diuji sebelum dirilis ke `main`. |
| `feature/<nama>` | Branch kerja sementara, dibuat dari `dev` untuk mengerjakan satu perubahan spesifik secara terisolasi. |

**Alur kerja:** `feature/<nama>` → Pull Request → `dev` → Pull Request → `main`

## Commit

Seluruh commit mengikuti konvensi [Conventional Commits](https://www.conventionalcommits.org/):

## Pull Request

| PR | Source → Target | Keterangan |
|---|---|---|
| #1 | `feature/todo-crud` → `dev` | Menggabungkan implementasi fitur CRUD to-do list |
| #2 | `feature/ci-workflow` → `dev` | Menambahkan workflow CI (job `lint` dan `test`) |
| #3 | `dev` → `main` | Merilis fitur dan CI yang sudah stabil ke `main` |

## CI/CD

Continuous Integration dijalankan otomatis lewat GitHub Actions (`.github/workflows/ci.yml`) setiap kali ada `push` atau `pull_request` ke branch `dev` dan `main`. Terdapat dua job:

- **`lint`** — memeriksa gaya penulisan kode menggunakan Laravel Pint
- **`test`** — menyiapkan environment, menjalankan migrasi database, lalu menjalankan seluruh automated test (`php artisan test`)

Status build dapat dilihat di tab [Actions](https://github.com/KEPL2026/evolusi-pl-<NIM>/actions).

## Branch Protection

Branch `main` dan `dev` dilindungi dengan aturan berikut (Settings → Branches):

- Require a pull request before merging
- Require status checks to pass before merging (job `lint` dan `test`)
- Restrict deletions
- Block force pushes

## Kolaborator

Dosen/pengampu mata kuliah ditambahkan sebagai collaborator dengan peran **Read**.