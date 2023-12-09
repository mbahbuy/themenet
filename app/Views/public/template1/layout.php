<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title; ?></title>

    <!-- Meta & Link -->
    <?= $this->include('public/template1/head') ?>
</head>

<body>
    <!-- TopBar -->
    <?= $this->include('public/template1/topbar') ?>

    <!-- Brand -->
    <?= $this->include('public/template1/brand') ?>

    <!-- NavBar -->
    <?= $this->include('public/template1/navbar') ?>


    <?= $this->renderSection('content') ?>


    <!-- Footer -->
    <?= $this->include('public/template1/footer') ?>

    <!-- Script -->
    <?= $this->include('public/template1/script') ?>
</body>

</html>