<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Artikulo' ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/neumorphic.css') ?>">
</head>
<body>
<nav class="nm-navbar">
    <a href="<?= base_url('index.php') ?>" class="nm-navbar-logo">✦ Artikulo</a>
    <div class="nm-navbar-tabs">
        <a href="<?= base_url('/') ?>" class="nm-nav-tab <?= ($active_page ?? '') == 'home' ? 'active' : '' ?>">Beranda</a>
        <a href="<?= base_url('blog/tambah') ?>" class="nm-nav-tab <?= ($active_page ?? '') == 'add' ? 'active' : '' ?>">Tulis</a>
        <a href="<?= base_url('blog/about') ?>" class="nm-nav-tab <?= ($active_page ?? '') == 'about' ? 'active' : '' ?>">Tentang</a>
    </div>
</nav>