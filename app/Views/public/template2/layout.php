<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <?= $this->include('public/template2/head') ?>
</head>

<body>
    <!-- TopBar -->
    <?= $this->include('public/template2/topbar') ?>

    <!-- NavBar -->
    <?= $this->include('public/template2/navbar') ?>

    <!-- TopNews -->
    <?= $this->include('public/template2/topnews') ?>

    
    <?= $this->renderSection('content') ?>


    <!-- Footer -->
    <?= $this->include('public/template2/footer') ?>

    <!-- Script -->
    <?= $this->include('public/template2/script') ?>
</body>

</html>