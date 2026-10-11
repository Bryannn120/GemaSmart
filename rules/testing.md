# Testing Rules - SiBibit Sumbawa

Gunakan:
- Jest
- React Testing Library
- Supertest
- Playwright
- OWASP ZAP
- k6 atau Artillery

## Critical Testing

Test:
1. Login dan authorization.
2. Pembuatan program.
3. Alokasi anggaran.
4. Pembuatan pendamping.
5. Registrasi penerima.
6. Duplicate NIK.
7. Distribusi bibit.
8. Foto dan GPS.
9. Monitoring tanaman.
10. Validasi lapangan.
11. Status FRAUD.
12. Dashboard.
13. Export laporan.
14. Audit trail.

## Offline
Test:
- kehilangan koneksi
- penyimpanan offline
- pending sync
- auto sync
- conflict
- expired offline data

## Security
Test:
- unauthorized access
- privilege escalation
- broken access control
- invalid token
- expired token
- injection
- file upload
- sensitive data exposure

Target critical business logic minimal 80% coverage.
