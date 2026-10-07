<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="hero">
    <div class="hero-copy">
        <div class="eyebrow"><span class="eyebrow-dot"></span> Your space for the day</div>
        <h1>Make room for what <em>matters today.</em></h1>
        <p>A clear view of what’s next, what’s done, and where to begin. Keep your day moving one task at a time.</p>
        <div class="hero-actions"><a class="button" href="<?= site_url('tasks') ?>">Explore tasks <span aria-hidden="true">↗</span></a><a class="text-link" href="<?= site_url('about') ?>">How it works <span aria-hidden="true">→</span></a></div>
    </div>
    <div class="hero-visual" aria-hidden="true"><div class="orbit orbit-one"></div><div class="orbit orbit-two"></div><div class="hero-core"><span>✦</span><small>One day at a time</small></div><div class="floating-note note-one">Stay in your flow <span>↗</span></div><div class="floating-note note-two"><b><?= $doneCount ?>/<?= $todayCount ?></b><small>completed today</small></div></div>
</section>

<section class="dashboard-section">
    <div class="section-heading"><div><p class="section-kicker">Today at a glance</p><h2><?= esc(date('l, F j')) ?></h2></div><a href="<?= site_url('tasks/new') ?>" class="button button-outline">+ Add a task</a></div>
    <div class="stat-grid"><div class="stat-card"><span>01 / On your list</span><strong><?= $todayCount ?></strong><p>Tasks scheduled for today</p></div><div class="stat-card"><span>02 / In motion</span><strong><?= $openCount ?></strong><p>Still to work through</p></div><div class="stat-card"><span>03 / Finished</span><strong><?= $doneCount ?></strong><p>Progress worth noticing</p></div></div>
    <div class="content-grid">
        <div class="panel"><div class="panel-heading"><div><p class="section-kicker">Your focus</p><h2>Today’s tasks</h2></div><a class="subtle-link" href="<?= site_url('tasks') ?>">View all <span aria-hidden="true">→</span></a></div>
            <?php if ($todayTasks): ?><div class="task-stack"><?php foreach ($todayTasks as $task): ?><?= view('components/task_card', ['task' => $task]) ?><?php endforeach; ?></div><?php else: ?><div class="empty-state"><span aria-hidden="true">✧</span><h3>A clear day ahead</h3><p>No tasks are scheduled for today. Add one when you’re ready.</p><a href="<?= site_url('tasks/new') ?>" class="button button-small">Create a task</a></div><?php endif; ?>
        </div>
        <aside class="side-panel"><div class="side-orb" aria-hidden="true">✦</div><p class="section-kicker">Coming up</p><h2>Keep an eye on what’s next.</h2><?php if ($upcoming): ?><div class="upcoming-list"><?php foreach ($upcoming as $task): ?><div><span><?= esc(date('M j', strtotime($task['task_date']))) ?></span><strong><?= esc($task['title']) ?></strong></div><?php endforeach; ?></div><?php else: ?><p class="side-copy">Nothing on the horizon yet. Your next good idea can start here.</p><?php endif; ?><a href="<?= site_url('tasks') ?>">See the full list <span aria-hidden="true">↗</span></a></aside>
    </div>
</section>
<?= $this->endSection() ?>
