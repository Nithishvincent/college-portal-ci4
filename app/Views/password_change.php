<?= $this->extend('layout/sidebar_layout') ?>
<?= $this->section('content') ?>

<h2>Change Password</h2>

<form method="post" action="<?= site_url('password/update') ?>">

    <div class="mb-3">
        <label>Current Password</label>
        <input type="password" name="current_password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>New Password</label>
        <input type="password" name="new_password" class="form-control" required>
    </div>

    <button class="btn btn-primary">Update Password</button>
</form>

<?= $this->endSection() ?>