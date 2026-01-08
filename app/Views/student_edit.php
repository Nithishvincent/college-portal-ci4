<?= $this->extend('layout/sidebar_layout') ?>

<?= $this->section('content') ?>

<h2>Edit Student</h2>

<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<form method="post" action="<?= base_url('student/update/' . $student['id']) ?>" class="mt-4">

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control"
               value="<?= esc($student['name']) ?>" required>
    </div>

    <div class="mb-3">
        <label>Register Number</label>
        <input type="text" name="reg_no" class="form-control"
               value="<?= esc($student['reg_no']) ?>" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control"
               value="<?= esc($student['email']) ?>" required>
    </div>

    <div class="mb-3">
        <label>College</label>
        <input type="text" name="college" class="form-control"
               value="<?= esc($student['college']) ?>" required>
    </div>

    <div class="mb-3">
        <label>Department</label>
        <select name="department" class="form-control" required>
            <option <?= $student['department']=='CSE'?'selected':'' ?>>CSE</option>
            <option <?= $student['department']=='ECE'?'selected':'' ?>>ECE</option>
            <option <?= $student['department']=='AI&DS'?'selected':'' ?>>AI&DS</option>
            <option <?= $student['department']=='MECH'?'selected':'' ?>>MECH</option>
            <option <?= $student['department']=='CIVIL'?'selected':'' ?>>CIVIL</option>
        </select>
    </div>
    
    <button class="btn btn-success">Update</button>
    <a href="<?= base_url('student/list') ?>" class="btn btn-secondary">Cancel</a>

</form>

<?= $this->endSection() ?>
