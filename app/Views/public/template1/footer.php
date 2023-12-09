    <!-- Footer Start -->
    <div class="footer">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <!-- <div class="col-md-3">

                </div> -->
                <div class="col-md-5 ml-5">
                    <style>
                        .menu-footer {
                            display: inline-grid;
                            grid-template-rows: repeat(4, auto);
                            grid-auto-flow: column;
                        }
                    </style>
                    <div class="footer-widget">
                        <h3 class="title">Menu</h3>
                        <ul class="menu-footer">
                            <li><a class="px-2" href="/news">Home</a></li>
                            <?php foreach ($dropdown_category as $category_lists) : ?>
                                <li><a class="px-2" href="/categories/<?= $category_lists['nama_kategori'] ?>"><?= ucfirst($category_lists['nama_kategori']); ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-widget">
                        <h3 class="title">Hubungi Kami</h3>
                        <div class="contact-info">
                            <p><i class="fa fa-map-marker"></i>Plaza BRI Surabaya</p>
                            <p><i class="fa fa-envelope"></i>support@satu-media.net</p>
                            <p><i class="fa fa-phone"></i>+62 8778 7798 888</p>
                            <div class="social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h3 class="title">Quick Links</h3>
                        <ul>
                            <li><a href="#">Lorem ipsum</a></li>
                            <li><a href="#">Pellentesque</a></li>
                            <li><a href="#">Aenean vulputate</a></li>
                            <li><a href="#">Vestibulum sit amet</a></li>
                            <li><a href="#">Nam dignissim</a></li>
                        </ul>
                    </div>
                </div> -->

                <!-- <div class="col-lg-3 col-md-6 ml-5">
                    <div class="footer-widget">
                        <h3 class="title">Newsletter</h3>
                        <div class="newsletter">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed porta dui. Class aptent taciti sociosqu
                            </p>
                            <form>
                                <input class="form-control" type="email" placeholder="Your email here">
                                <button class="btn">Submit</button>
                            </form>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Footer Menu Start -->
    <div class="footer-menu">
        <div class="container">
            <div class="f-menu">
                <a href="#">Terms of use</a>
                <a href="#">Privacy policy</a>
                <a href="#">Cookies</a>
                <a href="#">Accessibility help</a>
                <a href="#">Advertise with us</a>
                <a href="#">Contact us</a>
            </div>
        </div>
    </div>
    <!-- Footer Menu End -->

    <!-- Footer Bottom Start -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 copyright">
                    <p>Copyright &copy; <a href="#">Satu-Media</a>. All Rights Reserved</p>
                </div>

                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                <div class="col-md-6 template-by">
                    <p>Developed By <a href="#">Satu-Media Team</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom End -->

    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>