# Coding Rules - SiBibit Sumbawa

Gunakan TypeScript strict mode.

## Prinsip
- modular
- readable
- maintainable
- reusable
- single responsibility

Hindari:
- duplicate logic
- hardcoded business rules
- massive component
- massive service
- penggunaan any tanpa alasan

## Security
- RBAC
- server-side validation
- secure authentication
- rate limiting
- input validation
- secure file upload
- protection terhadap XSS dan injection
- jangan expose sensitive data

NIK dan KK tidak boleh ditulis penuh ke log.

Jangan menyimpan password, token, API key, atau secret di source code.

Gunakan environment variables.

## Audit
Perubahan penting harus mencatat:
- user
- timestamp
- action
- entity
- old value
- new value
- IP

Audit log bersifat append-only.

## Git
Gunakan commit yang jelas:
feat:
fix:
refactor:
test:
docs:
