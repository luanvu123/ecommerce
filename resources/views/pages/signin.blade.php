<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Riki || Shop</title>
    <meta name="robots" content="noindex, follow">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('fontend') }}/images/logo/riki.ico">

    <!-- CSS
    ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/vendor/flaticon/flaticon.css">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/vendor/slick.css">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/vendor/jquery-ui.min.css">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/vendor/sal.css">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/vendor/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/vendor/base.css">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/style.min.css">

</head>


<body>
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <a href="{{ route('/') }}" class="site-logo"><img
                            src="{{ asset('fontend') }}/images/logo/logo.png" alt="logo"></a>
                </div>
                <div class="col-sm-8">
                    <div class="singin-header-btn">
                        <p>Not a member?</p>
                        <a href="{{ route('customer.signup') }}" class="axil-btn btn-bg-secondary sign-up-btn">Sign Up
                            Now</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--9">
                    <h3 class="title">We Offer the Best Products</h3>
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <h3 class="title">Sign in to eTrade.</h3>
                        <p class="b2 mb--55">Enter your detail below</p>
                        <form action="{{ route('customer.login.submit') }}" method="POST" class="singin-form">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="annie@example.com">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" value="0987654321">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Remember Me</label>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn">Sign In</button>
                                <a href="{{ route('customer.request') }}" class="forgot-btn">Forget
                                    password?</a>
                            </div>
                        </form>
                        <!-- Đăng nhập bằng Google -->
                        <a href="{{ route('customer.login.google') }}">
                            <img src="{{ asset('fontend/images/logo/682665_favicon_google_logo_new_icon.png') }}"
                                alt="Google" width="20" height="20">
                            Đăng nhập bằng Google
                        </a>

                        <!-- Đăng nhập bằng Facebook -->
                        <a href="{{ route('customer.login.facebook') }}">
                            <img src="{{ asset('fontend/images/logo/4102573_applications_facebook_media_social_icon.png') }}"
                                alt="Facebook" width="20" height="20">
                            Đăng nhập bằng Facebook
                        </a>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JS
============================================ -->
    <!-- Modernizer JS -->
    <script src="{{ asset('fontend') }}/js/vendor/modernizr.min.js"></script>
    <!-- jQuery JS -->
    <script src="{{ asset('fontend') }}/js/vendor/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('fontend') }}/js/vendor/popper.min.js"></script>
    <script src="{{ asset('fontend') }}/js/vendor/bootstrap.min.js"></script>
    <script src="{{ asset('fontend') }}/js/vendor/slick.min.js"></script>
    <script src="{{ asset('fontend') }}/js/vendor/js.cookie.js"></script>
    <!-- <script src="{{ asset('fontend') }}/js/vendor/jquery.style.switcher.js"></script> -->
    <script src="{{ asset('fontend') }}/js/vendor/jquery-ui.min.js"></script>
    <script src="{{ asset('fontend') }}/js/vendor/jquery.countdown.min.js"></script>
    <script src="{{ asset('fontend') }}/js/vendor/sal.js"></script>
    <script src="{{ asset('fontend') }}/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('fontend') }}/js/vendor/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('fontend') }}/js/vendor/isotope.pkgd.min.js"></script>
    <script src="{{ asset('fontend') }}/js/vendor/counterup.js"></script>
    <script src="{{ asset('fontend') }}/js/vendor/waypoints.min.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('fontend') }}/js/main.js"></script>

</body>

</html>
