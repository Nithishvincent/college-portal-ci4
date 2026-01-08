<?= $this->extend('layout/sidebar_layout') ?>

<?= $this->section('content') ?>

<h2>Evaluate Project</h2>

<form method="post"
      action="<?= isset($isEdit)
          ? site_url('evaluation/update/' . $project['id'])
          : site_url('evaluation/save') ?>">

    <input type="hidden" name="project_id" value="<?= esc($project['id']) ?>">

    <div class="mb-3">
        <label class="form-label">Grade</label>
        <input type="number" name="grade" class="form-control"
       value="<?= $evaluation['grade'] ?? '' ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Remarks</label>
        <textarea name="remarks" class="form-control" required><?= $evaluation['remarks'] ?? '' ?></textarea>

    </div>

    <button class="btn btn-primary">
    <?= isset($isEdit) ? 'Update Evaluation' : 'Submit Evaluation' ?>
</button>

</form>

<?= $this->endSection() ?>
