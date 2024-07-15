<footer>
    <!-- Footer Start-->
    <div class="footer-area footer-padding fix">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-5 col-lg-5 col-md-7 col-sm-12">
                    <div class="single-footer-caption">
                        <div class="single-footer-caption">
                            <!-- logo -->
                            <div class="footer-logo">
                                <a href="{{ route('home') }}"><img style="max-width: 300px"
                                        src="{{ asset('assets/img/logo/logo.png') }}" alt=""></a>
                            </div>
                            <div class="footer-tittle">
                                <div class="footer-pera">
                                    <p>Chúng tôi là một nhóm đam mê sáng tạo, luôn cập nhật những thông tin mới nhất
                                        và hữu ích nhất trong các lĩnh vực công nghệ, khoa học, giáo dục, sức khỏe
                                        và kinh doanh. Mục tiêu của chúng tôi là mang đến cho bạn những bài viết
                                        chất lượng cao, thông tin đa dạng và sâu sắc. Hãy theo dõi chúng tôi để
                                        không bỏ lỡ bất kỳ tin tức nào!</p>
                                </div>
                            </div>
                            <!-- social -->
                            <div class="footer-social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4  col-sm-6">
                    <div class="single-footer-caption mt-60">
                        <div class="footer-tittle">
                            <h4>Đăng ký</h4>
                            <p>Đăng ký để nhận được các tin tức mới nhất đến từ chúng tôi!</p>
                            <!-- Form -->
                            <div class="footer-form">
                                <div id="mc_embed_signup">
                                    <form target="_blank"
                                        action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                        method="get" class="subscribe_form relative mail_part">
                                        <input type="email" name="email" id="newsletter-form-email"
                                            placeholder="Email Address" class="placeholder hide-on-focus"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = ' Email Address '">
                                        <div class="form-icon">
                                            <button type="submit" name="submit" id="newsletter-submit"
                                                class="email_icon newsletter-submit button-contactForm"><img
                                                    src="{{ asset('assets/img/logo/form-iocn.png') }}"
                                                    alt=""></button>
                                        </div>
                                        <div class="mt-10 info"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                    <div class="single-footer-caption mb-50 mt-60">
                        <div class="footer-tittle">
                            <h4>Instagram Feed</h4>
                        </div>
                        <div class="instagram-gellay">
                            <ul class="insta-feed">
                                <li><a href="#"><img src="{{ asset('assets/img/post/instra1.jpg') }}"
                                            alt=""></a>
                                </li>
                                <li><a href="#"><img src="{{ asset('assets/img/post/instra2.jpg') }}"
                                            alt=""></a>
                                </li>
                                <li><a href="#"><img src="{{ asset('assets/img/post/instra3.jpg') }}"
                                            alt=""></a>
                                </li>
                                <li><a href="#"><img src="{{ asset('assets/img/post/instra4.jpg') }}"
                                            alt=""></a>
                                </li>
                                <li><a href="#"><img src="{{ asset('assets/img/post/instra5.jpg') }}"
                                            alt=""></a>
                                </li>
                                <li><a href="#"><img src="{{ asset('assets/img/post/instra6.jpg') }}"
                                            alt=""></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer-bottom aera -->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="footer-border">
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-lg-6">
                        <div class="footer-copy-right">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> By Phongdeeptry copy in Internet
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="footer-menu f-right">
                            <ul>
                                <li><a href="#">Terms of use</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>
<!-- JS here -->

<!-- All JS Custom Plugins Link Here here -->
<script src="{{ asset('./assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="{{ asset('./assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('./assets/js/popper.min.js') }}"></script>
<script src="{{ asset('./assets/js/bootstrap.min.js') }}"></script>
<!-- Jquery Mobile Menu -->
<script src="{{ asset('./assets/js/jquery.slicknav.min.js') }}"></script>

{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}

<!-- Quill JS -->
{{-- <script src="{{ asset('/assets/js/quill.min.js') }}"></script> --}}

<!-- ResizeObserver polyfill for browsers that don't support it -->
<script src="https://cdn.jsdelivr.net/npm/resize-observer-polyfill@1.5.1/dist/ResizeObserver.global.js"></script>



<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="{{ asset('./assets/js/owl.carousel.min.js') }}."></script>
<script src="{{ asset('./assets/js/slick.min.js') }}"></script>
<!-- Date Picker -->
<script src="{{ asset('./assets/js/gijgo.min.js') }}"></script>
<!-- One Page, Animated-HeadLin -->
<script src="{{ asset('./assets/js/wow.min.js') }}"></script>
<script src="{{ asset('./assets/js/animated.headline.js') }}"></script>
<script src="{{ asset('./assets/js/jquery.magnific-popup.js') }}"></script>

<!-- Breaking New Pluging -->
<script src="{{ asset('./assets/js/jquery.ticker.js') }}"></script>
<script src="{{ asset('./assets/js/site.js') }}"></script>

<!-- Scrollup, nice-select, sticky -->
<script src="{{ asset('./assets/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('./assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('./assets/js/jquery.sticky.js') }}"></script>

<!-- contact js -->
<script src="{{ asset('./assets/js/contact.js') }}"></script>
<script src="{{ asset('./assets/js/jquery.form.js') }}"></script>
<script src="{{ asset('./assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('./assets/js/mail-script.js') }}"></script>
<script src="{{ asset('./assets/js/jquery.ajaxchimp.min.js') }}"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="{{ asset('./assets/js/plugins.js') }}"></script>
<script src="{{ asset('./assets/js/main.js') }}"></script>
