<?= $this->extend('layout/sidebar_layout') ?>

<?= $this->section('content') ?>

<h2>Student Registration</h2>
 
<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<form method="post" action="<?= base_url('student/save') ?>" class="mt-4">

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Register Number</label>
        <input type="text" name="reg_no" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>College Name</label>
        <input type="text" name="college" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Department</label>
        <select name="department" class="form-control" required>
            <option value="">Select</option>
            <option>CSE</option>
            <option>ECE</option>
            <option>AI&DS</option>
            <option>MECH</option>
            <option>CIVIL</option>
        </select>
    </div>

    <button class="btn btn-primary">
        Save Student
    </button>

</form>

<?= $this->endSection() ?>
