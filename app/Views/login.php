<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<h1 class="text-center">Login</h1>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<form method="post" action="/login/authenticate">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" id="username" value="<?= old('username') ?>" required>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" required>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Login</button>
</form>
<?= $this->endSection() ?>
