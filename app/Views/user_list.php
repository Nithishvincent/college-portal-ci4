<?= $this->extend('layout/sidebar_layout') ?>
<?= $this->section('content') ?>

<h2>User Management</h2>

<!-- CREATE USER -->
<div class="card mb-4">
    <div class="card-header">Create User</div>
    <div class="card-body">
        <form method="post" action="<?= site_url('users/store') ?>">
            <div class="row">
                <div class="col-md-4">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Role</label>
                    <select name="role" class="form-select" required>
                        <option value="student">Student</option>
                        <option value="faculty">Faculty</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-primary w-100">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- USER LIST -->
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $u): ?>
        <tr>
            <form method="post" action="<?= site_url('users/update') ?>">
                <td>
                    <input type="email" name="email"
                           value="<?= esc($u['email']) ?>"
                           class="form-control">
                </td>

                <td>
                    <select name="role" class="form-select">
                        <option value="admin"   <?= $u['role']=='admin'?'selected':'' ?>>Admin</option>
                        <option value="faculty" <?= $u['role']=='faculty'?'selected':'' ?>>Faculty</option>
                        <option value="student" <?= $u['role']=='student'?'selected':'' ?>>Student</option>
                    </select>
                </td>

                <td>
                    <select name="status" class="form-select">
                        <option value="active"   <?= $u['status']=='active'?'selected':'' ?>>Active</option>
                        <option value="inactive" <?= $u['status']=='inactive'?'selected':'' ?>>Inactive</option>
                    </select>
                </td>

                <td>
                    <input type="hidden" name="id" value="<?= $u['id'] ?>">
                    <button class="btn btn-sm btn-success">Save</button>
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
