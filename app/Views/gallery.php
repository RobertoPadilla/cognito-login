<?= $this->extend('templates/default') ?>
<?= $this->section('content') ?>
<?php foreach ($images as $image) : ?>
    <div class="col-md-3">
        <img src="<?= $image->object_key ?>" class="img-fluid my-4">
    </div>
<?php endforeach; ?>
<?= $this->endSection() ?>