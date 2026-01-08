<?= $this->extend('layout/sidebar_layout') ?>

<?= $this->section('content') ?>

<h2>Project Submission</h2>
<p class="text-muted">Submit your academic project</p>

<form action="<?= site_url('project/save') ?>" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label class="form-label">Project Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Project Description</label>
        <textarea name="description" class="form-control" rows="4"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Upload Project File</label>
        <input type="file" name="project_file" class="form-control" required>
        <small class="text-muted">Allowed formats: PDF, DOC, DOCX</small>
    </div>

    <button type="submit" class="btn btn-primary">
        Submit Project
    </button>

</form>

<?= $this->endSection() ?>