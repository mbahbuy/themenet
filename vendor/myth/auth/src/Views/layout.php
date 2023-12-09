<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title><?= $title ?> | Dashboard - Satumedia</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../../template/adminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../../../template/adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../../template/adminLTE/dist/css/adminlte.min.css">

    <?= $this->renderSection('pageStyles') ?>
</head>

<body class="hold-transition dark-mode">

    <main role="main" class="container">
        <?= $this->renderSection('main') ?>
    </main><!-- /.container -->


    <!-- jQuery -->
    <script src="../../../../template/adminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../../../template/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../../template/adminLTE/dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../../../../template/adminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
        <?php if (session()->has('message')) : ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: '<?= session('message') ?>'
            })
        <?php endif ?>

        <?php if (session()->has('error')) : ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: '<?= session('error') ?>'
            })
        <?php endif ?>

        <?php if (session()->has('errors')) : ?>
            <?php foreach (session('errors') as $error) : ?>
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: '<?= $error ?>'
                })
            <?php endforeach ?>
        <?php endif ?>
    </script>
    <?= $this->renderSection('pageScripts') ?>
</body>
</html>
