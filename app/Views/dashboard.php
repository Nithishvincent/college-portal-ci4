<?= $this->extend('layout/sidebar_layout') ?>

<?= $this->section('content') ?>

<h2>Dashboard</h2>

<div class="row mt-4">

    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Students</h5>
                <h3><?= esc($totalStudents) ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                <h5 class="card-title">Flagged Students</h5>
                <h3><?= esc($flaggedStudents) ?></h3>
            </div>
        </div>
    </div>

</div>

<style>
    .alert {margin-top: 20px;width: 200px;size: medium;
    }
</style>

<style>
    .alert {margin-top: 20px;width: 200px;size: medium;
    }
</style>
<h4 class="mt-4">Registered Students</h4> 
<table class="table table-bordered table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Reg No</th>
            <th>Email</th>
            <th>College</th>
            <th>Department</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($students)): ?>
            <?php foreach ($students as $s): ?>
                <tr>
                    <td><?= esc($s['id']) ?></td>
                    <td><?= esc($s['name']) ?></td>
                    <td><?= esc($s['reg_no']) ?></td>
                    <td><?= esc($s['email']) ?></td>
                    <td><?= esc($s['college']) ?></td>
                    <td><?= esc($s['department']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">
                    No students found
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
<?= $this->extend('layout/sidebar_layout') ?>

<?= $this->section('content') ?>

<?= $this->endSection() ?>
