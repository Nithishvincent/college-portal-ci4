<?= $this->extend('layout/sidebar_layout') ?>
<?= $this->section('content') ?>

<h2>Admin Dashboard</h2>

<div class="row">
    <div class="col-md-4">
        <div class="card p-3 text-center">
            <h5>Total Users</h5>
            <h3><?= $totalUsers ?></h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 text-center">
            <h5>Total Students</h5>
            <h3><?= $totalStudents ?></h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 text-center">
            <h5>Total Projects</h5>
            <h3><?= $totalProjects ?></h3>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <div class="card p-3 text-center bg-warning">
            <h5>Submitted (Pending Evaluation)</h5>
            <h3><?= $submittedCount ?></h3>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <div class="card p-3 text-center bg-success text-white">
            <h5>Graded Projects</h5>
            <h3><?= $gradedCount ?></h3>
        </div>
    </div>
</div>

<?= $this->endSection() ?>