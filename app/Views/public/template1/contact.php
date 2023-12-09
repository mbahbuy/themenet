<?= $this->extend('public/template1/layout') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb -->
<?= $this->include('public/template1/breadcrumb') ?>

<!-- Contact Start -->
<div class="contact">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="contact-form">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="Your Name" />
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" placeholder="Your Email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Subject" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" placeholder="Message"></textarea>
                        </div>
                        <div><button class="btn" type="submit">Send Message</button></div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-info">
                    <h3>Get in Touch</h3>
                    <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="#">Download Now</a>.</p>
                    <h4><i class="fa fa-map-marker"></i>Plaza BRI Surabaya</h4>
                    <h4><i class="fa fa-envelope"></i>support@satu-media.net</h4>
                    <h4><i class="fa fa-phone"></i>+62 8778 7798 888</h4>
                    <div class="social">
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-linkedin-in"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<?= $this->endSection() ?>