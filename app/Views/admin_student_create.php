<?= $this->extend('layout/sidebar_layout') ?>
<?= $this->section('content') ?>

<h2>Create Student</h2>

<form method="post" action="<?= site_url('admin/student/store') ?>">

    <h5>Login Details</h5>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Temporary Password</label>
        <input type="text" name="password" class="form-control" required>
    </div>

    <hr>

    <h5>Student Details</h5>

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

    <button class="btn btn-primary">Create Student</button>
</form>

<?= $this->endSection() ?>
