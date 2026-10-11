# PRD Rules - SiBibit Sumbawa

PRD adalah sumber utama seluruh pengembangan sistem.

## Role
- Pemda (Super Admin)
- Koordinator Kampus Mitra
- Pendamping Lapangan
- Validator Lapangan

## Aturan Utama
- Ikuti FR-01 sampai FR-35 sesuai PRD.
- Jangan membuat fitur di luar scope tanpa instruksi.
- Jangan mengubah business logic tanpa instruksi.
- NIK + Program ID harus unik.
- KK dengan NIK berbeda menghasilkan warning.
- Distribusi wajib memiliki penerima, jenis bibit, jumlah, tanggal, foto, GPS, dan tanda tangan.
- Monitoring mencatat tanaman hidup, mati, tinggi, kendala, catatan, dan foto.
- Validator menggunakan status VALID, REVISION_REQUIRED, atau FRAUD.
- Perubahan data penting harus memiliki audit trail.
- NIK dan KK merupakan data sensitif.

Jika requirement tidak jelas, gunakan NEEDS_CLARIFICATION dan jangan membuat asumsi bisnis sendiri.
