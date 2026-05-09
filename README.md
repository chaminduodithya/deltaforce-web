# Delta Force Loadout Hub

Community platform for Delta Force players to browse, publish, and rate weapon loadouts for Warfare and Operations.

## Implemented MVP Foundation

- Tactical themed UI scaffold (home, browse, loadout detail, create, weapons, public profile).
- Core schema + Eloquent models for weapons, attachments, loadouts, votes, comments, and copies.
- Seeders for demo game data and sample published loadouts.
- Filtered browsing, weapon pages, and profile pages wired through `routes/web.php`.

## Local Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
```
