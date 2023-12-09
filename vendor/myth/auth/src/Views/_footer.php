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
