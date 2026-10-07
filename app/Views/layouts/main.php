<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#080f20">
    <meta name="description" content="Todayline keeps your daily tasks clear and within reach.">
    <title><?= esc($pageTitle ?? 'Todayline') ?> · Todayline</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>
<div class="site-shell">
    <header class="topbar">
        <a class="brand" href="<?= site_url('/') ?>" aria-label="Todayline home"><span class="brand-mark" aria-hidden="true">✦</span> Todayline<span class="brand-dot">.</span></a>
        <nav class="main-nav" aria-label="Main navigation">
            <?php $section = service('uri')->getSegment(1); ?>
            <a href="<?= site_url('/') ?>" class="<?= $section === '' ? 'active' : '' ?>">Home</a>
            <a href="<?= site_url('tasks') ?>" class="<?= $section === 'tasks' ? 'active' : '' ?>">Task list</a>
            <a href="<?= site_url('profile') ?>" class="<?= $section === 'profile' ? 'active' : '' ?>">Profile</a>
            <a href="<?= site_url('about') ?>" class="<?= $section === 'about' ? 'active' : '' ?>">About</a>
        </nav>
        <div class="nav-actions">
            <?php if (session('user_id')): ?>
                <span class="signed-in">Hi, <?= esc(explode(' ', (string) session('user_name'))[0]) ?></span>
                <form action="<?= site_url('logout') ?>" method="post" class="inline-form"><?= csrf_field() ?><button type="submit" class="nav-sign">Log out</button></form>
            <?php else: ?>
                <a class="nav-sign" href="<?= site_url('login') ?>">Sign in</a>
            <?php endif; ?>
            <a class="button button-small" href="<?= site_url('tasks/new') ?>">+ New task</a>
        </div>
    </header>

    <?php if (session('success')): ?><div class="flash flash-success" role="status"><?= esc(session('success')) ?></div><?php endif; ?>
    <?php if (session('notice')): ?><div class="flash" role="status"><?= esc(session('notice')) ?></div><?php endif; ?>
    <?php if (session('error')): ?><div class="flash flash-error" role="alert"><?= esc(session('error')) ?></div><?php endif; ?>

    <main id="main-content"><?= $this->renderSection('content') ?></main>
    <footer class="footer"><span>Todayline © <?= date('Y') ?></span><span>A calmer way to keep moving.</span></footer>
</div>
<script src="<?= base_url('assets/js/app.js') ?>" defer></script>
</body>
</html>
