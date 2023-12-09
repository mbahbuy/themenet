<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="<?= url_to('/') ?>template/news_1/lib/easing/easing.min.js"></script>
<script src="<?= url_to('/') ?>template/news_1/lib/slick/slick.min.js"></script>

<!-- Template Javascript -->
<script src="<?= url_to('/') ?>template/news_1/js/main.js"></script>

<script>
    var selector = '.navbar-nav';
    var selector2 = '.nav-item';

    $(selector).on('click', function() {
        $(selector).removeClass('active');
        $(this).addClass('active');
    });

    $(selector2).on('click', function() {
        $(selector2).removeClass('active');
        $(this).addClass('active');
    });
</script>