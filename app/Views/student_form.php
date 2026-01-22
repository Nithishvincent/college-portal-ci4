<?= $this->extend('layout/sidebar_layout') ?>
<?= $this->section('content') ?>

<h2>Student Registration</h2>

<form method="post" action="<?= site_url('student/store') ?>">

    <div class="mb-3">
        <label>Email (must match user email)</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Register Number</label>
        <input type="text" name="reg_no" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Department</label>
        <input type="text" name="department" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>College</label>
        <input type="text" name="college" class="form-control" required>
    </div>

    <button class="btn btn-primary">Register Student</button>
</form>

<?= $this->endSection() ?>