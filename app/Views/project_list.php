<?= $this->extend('layout/sidebar_layout') ?>
<?= $this->section('content') ?>

<h2>Project List</h2>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Student</th>
            <th>Title</th>
            <th>Status</th>
            <th>Grade</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $p): ?>
        <tr>
            <td><?= esc($p['name']) ?></td>
            <td><?= esc($p['title']) ?></td>
            <td>
                <span class="badge bg-<?= $p['status']=='graded'?'success':'warning' ?>">
                    <?= ucfirst($p['status']) ?>
                </span>
            </td>
            <td><?= $p['grade'] ?? '-' ?></td>
            <td>
                <?php if (session()->get('role') === 'faculty' && $p['status'] !== 'graded'): ?>
                    <a href="<?= site_url('evaluation/'.$p['id']) ?>"
                       class="btn btn-sm btn-primary">Evaluate</a>
                <?php elseif ($p['status'] === 'graded'): ?>
                    <span class="text-muted">Evaluated</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>