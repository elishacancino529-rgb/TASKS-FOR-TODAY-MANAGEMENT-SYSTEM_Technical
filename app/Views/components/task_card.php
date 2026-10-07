<?php
$isDone = $task['status'] === 'Done';
$priorityClass = strtolower($task['priority']);
?>
<article class="task-card <?= $isDone ? 'task-done' : '' ?>">
    <div class="task-symbol" aria-hidden="true"><?= $isDone ? '✓' : '◌' ?></div>
    <div class="task-main">
        <div class="task-topline"><span class="task-date"><?= esc(date('M j, Y', strtotime($task['task_date']))) ?></span><span class="priority priority-<?= esc($priorityClass) ?>"><?= esc($task['priority']) ?> priority</span></div>
        <h3><?= esc($task['title']) ?></h3>
        <?php if ($task['description']): ?><p><?= esc($task['description']) ?></p><?php endif; ?>
        <span class="status-tag"><?= esc($task['status']) ?></span>
    </div>
    <?php if (session('user_id') && (int) session('user_id') === (int) $task['user_id']): ?>
        <div class="task-actions">
            <a href="<?= site_url('tasks/' . $task['id'] . '/edit') ?>" aria-label="Edit <?= esc($task['title'], 'attr') ?>">Edit</a>
            <form action="<?= site_url('tasks/' . $task['id'] . '/archive') ?>" method="post" class="inline-form archive-form">
                <?= csrf_field() ?>
                <button type="submit" aria-label="Archive <?= esc($task['title'], 'attr') ?>">Archive</button>
            </form>
        </div>
    <?php endif; ?>
</article>
