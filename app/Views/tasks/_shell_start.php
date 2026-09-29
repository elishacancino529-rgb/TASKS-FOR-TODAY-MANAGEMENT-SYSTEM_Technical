<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Tasks for Today') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/tasks.css') ?>">
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar" aria-label="Main navigation">
            <a class="brand-mark" href="<?= site_url('/') ?>" aria-label="Tasks for Today home">T</a>
            <div class="rail-divider"></div>
            <nav class="rail-nav">
                <a class="rail-link <?= ($active ?? '') === 'today' ? 'active' : '' ?>" href="<?= site_url('/') ?>"><span class="rail-icon" aria-hidden="true">⌂</span><span>Today</span></a>
                <a class="rail-link <?= ($active ?? '') === 'tasks' ? 'active' : '' ?>" href="<?= site_url('tasks') ?>"><span class="rail-icon" aria-hidden="true">▤</span><span>Tasks</span></a>
                <a class="rail-link <?= ($active ?? '') === 'profile' ? 'active' : '' ?>" href="<?= site_url('profile') ?>"><span class="rail-icon" aria-hidden="true">♙</span><span>Profile</span></a>
                <a class="rail-link <?= ($active ?? '') === 'about' ? 'active' : '' ?>" href="<?= site_url('about') ?>"><span class="rail-icon" aria-hidden="true">?</span><span>About</span></a>
            </nav>
        </aside>
        <div class="main-area">
            <header class="topbar">
                <div class="topbar-left"><span class="org-name">Taskflow</span><span class="trial-pill">▣ &nbsp; Daily planning workspace</span></div>
                <div class="topbar-actions">
                    <div class="top-action" aria-label="Search">⌕</div>
                    <div class="top-action" aria-label="Calendar">▦</div>
                    <div class="top-action" aria-label="Notifications">♧</div>
                    <div class="user-chip"><span>Demo Student</span><span class="avatar">DS</span></div>
                </div>
            </header>
            <main class="content">
