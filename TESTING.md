# Verification checklist

Run migrations and `TasksSeeder`, then start the app. Use a fresh private browser window for logged-out checks.

1. Open `/`, `/tasks`, `/profile`, and `/about`. Each should load without signing in. Sample tasks appear on Home and Task List.
2. While signed out, open `/tasks/new` and `/tasks/1/edit`. Both should redirect to `/login`. A direct POST to create, update, archive, or logout also requires authentication. (POST routes additionally require a valid CSRF token.)
3. Try a wrong password. Login should fail with a generic message. Sign in using the demo account; the task list should open.
4. Open `/tasks/new` and submit with empty title and date. Both required-field errors should appear. An invalid date should also be rejected.
5. Create a task with a title and date. Confirm it appears on `/tasks`; if dated today, it also appears on `/`.
6. Edit its title, date, priority, or status. Confirm the changed values appear on the list.
7. Archive it. Confirm it disappears from both public lists, then inspect the database: `SELECT title, is_archived FROM tasks WHERE id = <id>;` should show `is_archived = 1`.
8. Log out and retry `/tasks/new`; it should redirect to `/login` again.

The local browser verification completed these flows successfully on 2026-10-07 against an upgraded TSA1 database, including a mobile viewport check with no horizontal overflow. The archived test row remained in MySQL with `is_archived = 1`. A separate clean database also migrated and seeded successfully (one user and four sample tasks). The automated verification created and archived one task in the local development database; it does not affect the source files or the fresh seed on another machine.
