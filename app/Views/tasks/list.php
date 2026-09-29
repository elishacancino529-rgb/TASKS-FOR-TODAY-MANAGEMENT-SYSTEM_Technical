<?= $this->include('tasks/_shell_start', ['title' => 'All Tasks', 'active' => 'tasks']) ?>
<div class="eyebrow">Workspace</div>
<h1 class="page-heading">All tasks</h1>
<p class="page-intro">Review every task in your planning queue, ordered by date.</p>
<div class="section-tabs" role="tablist" aria-label="Task views"><a class="tab" href="<?= site_url('/') ?>">Today</a><a class="tab active" href="<?= site_url('tasks') ?>">All tasks</a><a class="tab" href="<?= site_url('profile') ?>">My profile</a></div>
<section class="panel">
    <div class="toolbar"><div class="toolbar-left"><a class="button button-primary" href="<?= site_url('/') ?>">← Back to today</a></div><div class="toolbar-right"><label class="search-box" aria-label="Search tasks">⌕<input type="search" placeholder="Search tasks" oninput="filterTasks(this.value)"></label><span class="filter-label"><?= count($tasks) ?> total</span></div></div>
    <div class="task-table-wrap"><table class="task-table" id="all-tasks-table"><thead><tr><th>Task</th><th>Status</th><th>Task date</th><th>Added</th></tr></thead><tbody>
    <?php foreach ($tasks as $task): ?>
        <?php $statusClass = strtolower($task['status']) === 'pending' ? 'status-pending' : (strtolower($task['status']) === 'completed' ? 'status-completed' : 'status-default'); ?>
        <tr><td><?= esc($task['title']) ?></td><td><span class="status <?= $statusClass ?>"><?= esc($task['status']) ?></span></td><td><?= esc(date('M j, Y', strtotime($task['task_date']))) ?></td><td><?= esc(date('M j, Y', strtotime($task['created_at']))) ?></td></tr>
    <?php endforeach; ?>
    </tbody></table></div>
</section>
<script>function filterTasks(query) { const value = query.toLowerCase(); document.querySelectorAll('#all-tasks-table tbody tr').forEach(row => { row.hidden = !row.textContent.toLowerCase().includes(value); }); }</script>
<?= $this->include('tasks/_shell_end') ?>
