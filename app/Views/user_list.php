<?= $this->extend('layout/sidebar_layout') ?>
<?= $this->section('content') ?>

<h2>User Management</h2>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <form method="post" action="<?= site_url('users/update') ?>">
                    <td><?= esc($u['email']) ?></td>

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
                        <button class="btn btn-sm btn-primary">Update</button>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
