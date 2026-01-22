<?= $this->extend('layout/sidebar_layout') ?>
<?= $this->section('content') ?>

<h2>Submit Project</h2>

<form method="post" action="<?= site_url('project/save') ?>">

    <div class="mb-3">
        <label>Project Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>

    <button class="btn btn-success">Submit Project</button>
</form>

<?= $this->endSection() ?>