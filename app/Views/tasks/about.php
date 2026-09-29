<?= $this->include('tasks/_shell_start', ['title' => 'About', 'active' => 'about']) ?>
<div class="eyebrow">About the project</div>
<h1 class="page-heading">A calmer way to plan today.</h1>
<p class="page-intro">Tasks for Today is a small internal task-management system built for the IT0049 technical summative assessment.</p>
<div class="about-grid" style="margin-top: 34px;">
    <section class="info-card"><h2>What this system does</h2><p>It uses CodeIgniter 4 and a MySQL database to separate today’s focus from the complete task list. The application demonstrates MVC structure, database models, date filtering, and multiple views from one shared data layer.</p><p>The developer of this system is <strong>Your Name</strong>. Replace this text with your name before submitting.</p></section>
    <aside class="info-card accent-card"><div class="mini-mark">T</div><h2>Taskflow</h2><p>Simple records, clear dates, and a focused daily view.</p></aside>
</div>
<?= $this->include('tasks/_shell_end') ?>
