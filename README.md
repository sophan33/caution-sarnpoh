# Caution - ប្រុងប្រយ័ត្ន

Digital safety awareness for Cambodia. 100% human-made.

## Setup
1. `mysql -u root -p < schema.sql`
2. `cp src/db.php.example src/db.php` — fill in real credentials
3. `php -S localhost:8000 -t public`

## Deploy
Server pulls this repo every 2 minutes (systemd timer).
`src/db.php` is gitignored and hand-created on the server only.
