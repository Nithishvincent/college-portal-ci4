<?= $this->extend('layout/sidebar_layout') ?>
<?= $this->section('content') ?>

<h2>Student Details</h2>

<div class="card mb-4">
    <div class="card-body">
        <p><strong>Name:</strong> <?= esc($student['name']) ?></p>
        <p><strong>Register No:</strong> <?= esc($student['reg_no']) ?></p>
        <p><strong>Department:</strong> <?= esc($student['department']) ?></p>
        <p><strong>College:</strong> <?= esc($student['college']) ?></p>
    </div>
</div>

<h3>Submitted Projects</h3>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>File</th>
            <th>Grade</th>
            <th>Remarks</th>
            <?php if (session()->get('role') === 'faculty'): ?>
                <th>Action</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($projects)): ?>
            <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?= esc($project['title']) ?></td>
                    <td><?= esc($project['description']) ?></td>
                    <td>
                        <a href="<?= base_url($project['file_path']) ?>" target="_blank">
                            View
                        </a>
                    </td>
                    <td><?= $project['grade'] ?? 'Pending' ?></td>
                    <td><?= $project['remarks'] ?? '-' ?></td>

                    <?php if (session()->get('role') === 'faculty'): ?>
                        <td>
                            <?php if (empty($project['grade'])): ?>
                                <a href="<?= site_url('evaluation/' . $project['id']) ?>"
                                class="btn btn-sm btn-primary">
                                    Evaluate
                                </a>
                            <?php else: ?>
                                <a href="<?= site_url('evaluation/edit/' . $project['id']) ?>"
                                class="btn btn-sm btn-secondary">
                                    Edit Evaluation
                                </a>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>

                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">No projects submitted</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
