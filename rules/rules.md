# PROJECT RULES - SiBibit Sumbawa

## STATUS

Folder 
ules/ berisi aturan utama yang wajib digunakan sebagai acuan dalam pengembangan sistem SiBibit Sumbawa.

## INSTRUKSI UTAMA

Sebelum membuat, mengubah, menghapus, atau melakukan refactoring terhadap kode, AI Agent wajib membaca dan mengikuti file rules yang relevan di dalam folder 
ules/.

Jangan mengabaikan rules hanya karena task terlihat sederhana.

## RULE FILES

### 1. prd.md
Berisi aturan produk dan business requirement.

Gunakan file ini sebagai sumber utama untuk:

- scope sistem
- user role
- functional requirement
- business rule
- workflow
- data requirement
- status
- fitur sistem

### 2. design.md
Berisi aturan UI/UX.

Gunakan file ini ketika mengerjakan:

- halaman
- dashboard
- form
- table
- modal
- navigation
- responsive layout
- mobile/PWA
- state UI

### 3. md.md
Berisi aturan dokumentasi Markdown.

Gunakan ketika membuat atau mengubah:

- README
- dokumentasi
- technical documentation
- project notes
- Markdown files

### 4. architecture.md
Berisi aturan arsitektur sistem dan teknologi.

Gunakan ketika mengerjakan:

- frontend
- backend
- API
- database
- authentication
- authorization
- storage
- infrastructure
- background jobs

### 5. coding.md
Berisi standar penulisan kode.

Gunakan ketika:

- membuat kode baru
- mengubah kode
- refactoring
- membuat API
- membuat service
- membuat component
- membuat database logic

### 6. testing.md
Berisi aturan testing dan quality assurance.

Gunakan ketika:

- membuat test
- memperbaiki bug
- membuat fitur baru
- melakukan refactoring
- melakukan regression testing

## PRIORITY

Gunakan urutan prioritas berikut:

1. rules.md
2. prd.md
3. architecture.md
4. design.md
5. coding.md
6. testing.md
7. md.md

## SOURCE OF TRUTH

prd.md adalah sumber utama untuk product requirement dan business logic.

AI Agent TIDAK BOLEH:

- membuat fitur baru yang tidak ada di PRD
- menghapus fitur yang diwajibkan PRD
- mengubah business logic
- mengubah role pengguna
- mengubah workflow
- mengubah permission
- mengubah requirement database

kecuali pengguna memberikan instruksi secara eksplisit.

## ROLE

Role sistem yang harus dipertahankan:

- Pemda (Super Admin)
- Koordinator Kampus Mitra
- Pendamping Lapangan
- Validator Lapangan

Jangan membuat role baru tanpa instruksi.

## BEFORE IMPLEMENTATION

Sebelum mengerjakan setiap task:

1. Baca rules.md.
2. Identifikasi rules yang relevan.
3. Baca file rules terkait.
4. Periksa requirement pada prd.md.
5. Identifikasi file/module yang terdampak.
6. Implementasikan sesuai rules.
7. Jalankan testing yang relevan.
8. Pastikan perubahan tidak melanggar PRD.

## SECURITY

Authentication, authorization, validation, audit trail, dan perlindungan data harus selalu mengikuti rules.

Jangan menonaktifkan security hanya untuk membuat fitur bekerja.

NIK dan KK harus diperlakukan sebagai data sensitif.

Jangan menampilkan atau mencatat data sensitif secara tidak diperlukan.

## NO ASSUMPTION

Jika requirement tidak jelas atau terdapat konflik antara requirement:

Jangan membuat asumsi sendiri.

Gunakan:

NEEDS_CLARIFICATION

dan jelaskan requirement yang belum jelas atau konflik tersebut.

## CHANGE CONTROL

Jika perubahan yang diminta berpotensi mengubah:

- database schema
- business logic
- role
- permission
- workflow
- API contract
- security
- existing feature

periksa terlebih dahulu prd.md dan rchitecture.md.

## FINAL CHECK

Sebelum menyatakan task selesai, pastikan:

- sesuai PRD
- sesuai architecture rules
- sesuai design rules jika berkaitan dengan UI
- sesuai coding rules
- testing yang relevan sudah dilakukan
- tidak ada requirement yang dilanggar
- tidak ada fitur baru yang dibuat tanpa instruksi

## IMPORTANT

Folder 
ules/ adalah project rules.

Jangan menganggap file-file di dalamnya sebagai dokumentasi biasa.

Gunakan rules tersebut sebagai acuan pengembangan sistem SiBibit Sumbawa.
