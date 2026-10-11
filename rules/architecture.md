# Architecture Rules - SiBibit Sumbawa

## Frontend
- Next.js 14
- React
- Tailwind CSS
- shadcn/ui
- Leaflet.js
- OpenStreetMap

## Backend
- NestJS
- Node.js
- TypeScript
- Prisma

## Database
- PostgreSQL 16
- PostGIS

## Infrastructure
- Redis
- BullMQ
- Cloudflare R2
- Cloudflare

## Monitoring
- Sentry
- Grafana
- Prometheus
- Loki

Pisahkan UI, business logic, API, database access, authentication, authorization, validation, background jobs, dan file storage.

Semua endpoint harus melakukan authentication, authorization, dan validation di server.

Gunakan migration untuk perubahan database.
