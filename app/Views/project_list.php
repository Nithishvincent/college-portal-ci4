<?= $this->extend('layout/sidebar_layout') ?>
<?= $this->section('content') ?>

<h2>Project Submissions</h2>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>File</th>
            <th>Submitted On</th>
            <th>Grade</th>
            <th>Remarks</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($projects)): ?>
            <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?= esc($project['id']) ?></td>
                    <td><?= esc($project['title']) ?></td>
                    <td><?= esc($project['description']) ?></td>
                    <td>
                        <a href="<?= base_url($project['file_path']) ?>" target="_blank">
                            View File
                        </a>
                    </td>
                    <td><?= esc($project['created_at']) ?></td>
                    <td><?= $project['grade'] ? esc($project['grade']) : 'Pending' ?></td>
                    <td><?= $project['remarks'] ? esc($project['remarks']) : '-' ?></td>
                    <td>
                        <?php if ($project['status'] === 'graded'): ?>
                            <span class="badge bg-success">Graded</span>
                        <?php elseif ($project['status'] === 'submitted'): ?>
                            <span class="badge bg-warning text-dark">Submitted</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Draft</span>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">No projects found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection() ?>