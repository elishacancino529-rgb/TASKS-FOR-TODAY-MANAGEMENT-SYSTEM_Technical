<?= $this->include('tasks/_shell_start', ['title' => 'Profile', 'active' => 'profile']) ?>
<div class="eyebrow">Account</div>
<h1 class="page-heading">Your profile</h1>
<p class="page-intro">The demo user connected to this Tasks for Today workspace.</p>
<div class="profile-grid" style="margin-top: 34px;">
    <section class="info-card">
        <?php if ($user): ?>
            <div class="profile-summary"><div class="profile-avatar">DS</div><div><h2><?= esc($user['full_name']) ?></h2><p>@<?= esc($user['username']) ?></p></div></div>
            <div class="info-list"><div class="info-item"><span>Username</span><strong><?= esc($user['username']) ?></strong></div><div class="info-item"><span>Email address</span><strong><?= esc($user['email']) ?></strong></div><div class="info-item"><span>Member since</span><strong><?= esc(date('M j, Y', strtotime($user['created_at']))) ?></strong></div><div class="info-item"><span>Workspace role</span><strong>Task owner</strong></div></div>
        <?php else: ?><div class="empty-state">No profile record was found.</div><?php endif; ?>
    </section>
    <aside class="info-card accent-card"><div class="mini-mark">✦</div><h2>Keep your day clear</h2><p>Use the Today view to focus on the work that belongs to this date, then use All tasks when you need the wider picture.</p></aside>
</div>
<?= $this->include('tasks/_shell_end') ?>
