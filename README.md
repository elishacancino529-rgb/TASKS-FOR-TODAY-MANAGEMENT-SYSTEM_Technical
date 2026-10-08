# Todayline — Tasks for Today Management System

Todayline extends the IT0049 TSA1 CodeIgniter 4 task manager for TSA2. Visitors can view the Welcome, Task List, Profile, and About pages. A signed-in user can create, edit, and archive tasks. Archiving sets `is_archived` to `1`; the record remains in the database and is omitted from public lists. The new migration adds fields to the existing TSA1 tables and preserves existing records.

## Requirements

- PHP 8.2 or later with `intl`, `mbstring`, and `mysqli`
- Composer 2
- MySQL or MariaDB (XAMPP works)
- A web server that can serve the `public/` directory, or CodeIgniter's local server

The project includes `composer.lock`, so `composer install` restores the tested CodeIgniter version. The `vendor/` directory and `.env` file are intentionally excluded from Git.

## Run locally

1. Create an empty MySQL database named `todayline_tsa2`, or choose another name.
2. From this folder, run `composer install`.
3. Copy `.env.example` to `.env`. Set `app.baseURL`, the database name, username, and password for your machine.
4. Run `php spark migrate`.
5. Run `php spark db:seed TasksSeeder`.
6. Run `php spark serve --host 127.0.0.1 --port 8080` and open `http://127.0.0.1:8080/`.

The local project was verified on port `8097` because port `8080` was occupied on the development machine. Change `app.baseURL` and the `serve` port together if needed.

### Demo account

- Email: `demo@example.com`
- Password: `TodaylineDemo2026!`

The seeder stores the password using PHP's `password_hash()`, and login uses `password_verify()`. Set `DEMO_PASSWORD` in `.env` before the first seed to use a different password. The demo credential is displayed on the login page for this classroom project; remove that hint and use a private password before using the app for real data. Re-running the seeder does not replace an existing user's password or duplicate tasks.

## Routes and access

| Route | Access | Purpose |
| --- | --- | --- |
| `GET /` | Public | Welcome dashboard with today's active tasks |
| `GET /tasks` | Public | Active task list and status filter |
| `GET /profile` | Public | Demo profile |
| `GET /about` | Public | About the system |
| `GET /login`, `POST /login` | Public | Login form and authentication |
| `POST /logout` | Signed in | Logout |
| `GET /tasks/new`, `POST /tasks` | Signed in | New task form and creation |
| `GET /tasks/{id}/edit`, `POST /tasks/{id}` | Signed in, task owner | Edit and update |
| `POST /tasks/{id}/archive` | Signed in, task owner | Soft delete |

Only explicit routes are enabled, so alternate controller URLs cannot bypass the `auth` route filter. POST forms use CodeIgniter's CSRF filter. Required task fields are `title` and `task_date`; the date must be valid. Values for priority and status are restricted to the available options. Task output is escaped in views.

## Project structure

- `app/Controllers/` — public pages, authentication, task actions
- `app/Models/` — users and tasks
- `app/Filters/AuthFilter.php` — login gate for management routes
- `app/Views/` — layouts, public pages, forms, reusable task card
- `app/Database/Migrations/` — original TSA1 schema and additive TSA2 upgrade for `password`, `is_archived`, and task details
- `app/Database/Seeds/TasksSeeder.php` — hashed demo user, sample tasks, and ownership of existing TSA1 tasks
- `public/assets/` — responsive styles and archive confirmation script
- `TESTING.md` — repeatable access-control and CRUD checks

## Deployment

For conventional PHP hosting, use CodeIgniter 4 with MySQL/MariaDB. Upload the repository source, run `composer install --no-dev`, create a database, configure `.env` with the site's HTTPS `app.baseURL` and database credentials, then run `php spark migrate` and `php spark db:seed TasksSeeder`. For an existing TSA1 database, use its current connection settings and run the same two commands; the upgrade migration retains its users and tasks. Set the web server's document root to `public/`, make `writable/` writable by PHP, and set `CI_ENVIRONMENT = production` in `.env` after confirming the site works.

### Vercel with Neon Postgres

The repository includes a Vercel PHP function in `api/index.php`, routing and static asset configuration in `vercel.json`, and a database-backed session migration. Vercel's serverless filesystem is temporary, so a persistent Postgres database is required for users, tasks, and sessions.

1. Create a Vercel project for this repository and connect a Neon Postgres resource to its Production and Preview environments. Choose a region close to the app's users. Neon supplies `DATABASE_URL` automatically when installed through Vercel Marketplace.
2. Add `CI_ENVIRONMENT=production` to the Production and Preview environment variables. Vercel supplies `VERCEL`, `VERCEL_URL`, and `VERCEL_PROJECT_PRODUCTION_URL` automatically. The app uses them to select Postgres, database sessions, a temporary writable directory, and the public URL.
3. Pull the database URL to a private local environment file, or obtain it from the Neon dashboard. With PHP's `pgsql` extension enabled, set `VERCEL=1` and `DATABASE_URL` in the shell, then run `php spark migrate` and `php spark db:seed TasksSeeder`. Do not commit the database URL or a pulled environment file.
4. Deploy with `vercel deploy --prod`, then check the home page, login, task creation, editing, and archiving on the public URL.

The free classroom demo credentials are shown on the login page. For real use, set a private `DEMO_PASSWORD` before seeding and remove the credential hint from `app/Views/auth/login.php`.

Coursework submission links:

- GitHub repository: https://github.com/elishacancino529-rgb/TASKS-FOR-TODAY-MANAGEMENT-SYSTEM_Technical
- Hosted application: https://todayline-tasks.vercel.app/
