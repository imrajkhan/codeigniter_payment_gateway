<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<h1 class="text-center">Login Successful</h1>
<p class="text-center">Welcome, <?= session()->get('username') ?>!</p>
<div class="text-center">
    <a href="/login/logout" class="btn btn-secondary">Logout</a>
</div>
<?= $this->endSection() ?>
