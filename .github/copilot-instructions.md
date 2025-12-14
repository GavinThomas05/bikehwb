## Quick orientation for AI contributors

This repository is a small Laravel (Framework ^12, PHP ^8.2) application with Vite-based frontend tooling. The goal of these notes is to give an AI coding agent the essential, repo-specific context so it can be productive immediately.

Project purpose: this app is a simple blog where admin users can create posts and regular users can comment on those posts. The main flows are: post creation (admin) → post listing/view (public) → comment submission (authenticated users). Look at `app/Models/User.php`, `app/Models/Post.php`, and `app/Models/Comment.php` for the data model.

- Project roots worth opening:
  - `app/Models/` — Eloquent models (e.g. `Post.php` shows $fillable and relationships).
  - `app/Http/Controllers/` — controllers (base `Controller.php`, plus `PostController.php`, `CommentController.php`).
  - `routes/web.php` — application routing; currently uses several closure routes and simple examples.
  - `resources/views/` — view templates (this project uses plain PHP templates: `home.php`, `addpost.php`, not Blade `.blade.php`).
  - `database/migrations/` and `database/seeders/` — schema and seed data (see `PostTableSeeder.php`, `CommentTableSeeder.php`).
  - `composer.json`, `package.json`, `vite.config.js` — build and dev scripts.

## Important workflows & commands

- Install & initial setup (developer machine): prefer the `composer` setup script which encapsulates steps in `composer.json`:
  - `composer run setup` (runs install, creates `.env`, generates key, runs migrations and builds assets)
  - Alternatively do the steps manually: `composer install` → `cp .env.example .env` → `php artisan key:generate` → `php artisan migrate --force` → `npm install` → `npm run build`.
- Local development (hot reload): `composer run dev` (this runs a `concurrently` command: `php artisan serve`, `php artisan queue:listen`, `php artisan pail`, and `npm run dev`). Use this when developing features that touch backend + frontend.
- Tests: `composer run test` or `./vendor/bin/phpunit` (config in `phpunit.xml`; Laravel uses `php artisan test`).

## Project conventions and patterns (be concrete)

- Models use standard Eloquent patterns: `$fillable`, relationship methods (see `app/Models/Post.php`). Follow the same pattern when adding fields or relations.
- Routing is defined in `routes/web.php`; existing routes use closures for simple pages. For non-trivial logic place code in a Controller under `app/Http/Controllers/` and reference it from routes (prefer `Route::get('/x', [PostController::class,'index'])`).
- Views are plain PHP files in `resources/views/` (not Blade). Render them with `return view('home')` where `home` corresponds to `resources/views/home.php`.
- Background jobs/queues: the repo runs `php artisan queue:listen` in dev. If adding queued jobs, register them using Laravel's job classes and ensure local dev runs the queue listener.

## Integration points & what to check when editing

- Database: migrations live under `database/migrations`. When changing models, add a migration and update seeders in `database/seeders`.
- Frontend: assets are built with Vite. `package.json` scripts: `npm run dev` → Vite dev server, `npm run build` → production build. `vite.config.js` is present for configuration.
- Vendor dependencies and autoloading: PSR-4 maps `App\` to `app/`. After adding new classes run `composer dump-autoload` if needed.

## Examples (copyable patterns)

- Route to controller example:

  Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index']);

- Typical Eloquent relationship (from `app/Models/Post.php`):

  public function comments() {
      return $this->hasMany(Comment::class);
  }

## Notes for the AI agent

- Do not assume Blade templates; check `resources/views/` first.
- Prefer non-destructive composer scripts in CI. The `setup` script runs `migrate --force` — only run in CI or known safe dev environment.
- When adding or changing DB schema, update corresponding seeders and factories in `database/factories`.
- Tests: run `composer run test` locally after changes that impact behavior.

If any part of this is unclear or you'd like more examples (routes → controller → view, or a sample migration + seeder flow), tell me which area to expand and I will iterate.
