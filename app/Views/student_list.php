<?= $this->extend('layout/sidebar_layout') ?>

<?= $this->section('content') ?>
<style>
    button{
        margin-top: 15px;
        align-items: right;
        color: #ffffffff;
    }
</style>
<h2>Student Table</h2>

<button class="btn btn-primary mb-3"
        onclick="window.location='<?= base_url('student') ?>'">Add Student
    </button>
<table class="table table-bordered table-striped mt-4">
    <thead class="table-dark">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Reg No</th>
        <th>Email</th>
        <th>College</th>
        <th>Department</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($students as $s): ?>
    <tr>
        <td><?= esc($s['id']) ?></td>
        <td><?= esc($s['name']) ?></td>
        <td><?= esc($s['reg_no']) ?></td>
        <td><?= esc($s['email']) ?></td>
        <td><?= esc($s['college']) ?></td>
        <td><?= esc($s['department']) ?></td>
<td>
    <a href="<?= base_url('student/edit/' . $s['id']) ?>"
       class="btn btn-sm btn-warning">
       Edit
    </a>

    <?php if (in_array(session()->get('role'), ['faculty', 'admin'])): ?>
        <a href="<?= site_url('faculty/student/' . $s['id']) ?>"
           class="btn btn-sm btn-info ms-1">
           View
        </a>
    <?php endif; ?>

    <?php if ($s['is_flagged'] == 0 && session()->get('role') === 'admin'): ?>
        <a href="<?= base_url('student/flag/' . $s['id']) ?>"
           class="btn btn-sm btn-danger ms-1"
           onclick="return confirm('Delete this student?')">
           Delete
        </a>
    <?php endif; ?>
</td>
    </tr>  
    <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>





