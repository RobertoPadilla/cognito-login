<?= $this->extend('templates/default') ?>
<?= $this->section('content') ?>
<?php foreach ($urls as $url) : ?>
    <div class="col-md-3">
        <img src="<?= $url ?>" class="img-fluid my-4">
    </div>
<?php endforeach; ?>
<?= $this->endSection() ?>