<?= $this->extend('templates/default') ?>
<?= $this->section('content') ?>
<?php
    helper('form');
    $attributes = ['method' => 'post'];
    echo form_open('/login');
?>
    <div class="mb-3">
        <label for="userLogin" class="form-label">Nickname</label>
        <input type="text" required class="form-control" name="user" placeholder="PilloElHumilde">
    </div>
    <div class="mb-3">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <input type="password" required class="form-control" name="password">
    </div>
    <button type="submit" class="btn btn-primary mt-5" style="width: 100%;">Login</button>
<?= form_close() ?>
<?= $this->endSection() ?>