<?= $this->include('tasks/_shell_start', ['title' => 'Tasks for Today', 'active' => 'today']) ?>
<div class="eyebrow">Daily overview</div>
<h1 class="page-heading">Tasks for today</h1>
<p class="page-intro">A focused view of what needs your attention on <?= date('F j, Y') ?>.</p>
<div class="section-tabs" role="tablist" aria-label="Task views"><a class="tab active" href="<?= site_url('/') ?>">Today</a><a class="tab" href="<?= site_url('tasks') ?>">All tasks</a><a class="tab" href="<?= site_url('profile') ?>">My profile</a></div>
<section class="panel">
    <div class="toolbar"><div class="toolbar-left"><span class="filter-label">Showing tasks scheduled for today</span></div><div class="toolbar-right"><span class="filter-label"><?= count($tasks) ?> task<?= count($tasks) === 1 ? '' : 's' ?></span><a class="button button-primary" href="<?= site_url('tasks') ?>">＋ View all tasks</a></div></div>
    <?php if (empty($tasks)): ?>
        <div class="empty-state">No tasks are scheduled for today.</div>
    <?php else: ?>
        <div class="task-table-wrap"><table class="task-table"><thead><tr><th>Task</th><th>Status</th><th>Task date</th><th>Added</th></tr></thead><tbody>
        <?php foreach ($tasks as $task): ?>
            <?php $statusClass = strtolower($task['status']) === 'pending' ? 'status-pending' : (strtolower($task['status']) === 'completed' ? 'status-completed' : 'status-default'); ?>
            <tr><td><?= esc($task['title']) ?></td><td><span class="status <?= $statusClass ?>"><?= esc($task['status']) ?></span></td><td><?= esc(date('M j, Y', strtotime($task['task_date']))) ?></td><td><?= esc(date('M j, Y', strtotime($task['created_at']))) ?></td></tr>
        <?php endforeach; ?>
        </tbody></table></div>
    <?php endif; ?>
</section>
<?= $this->include('tasks/_shell_end') ?>
