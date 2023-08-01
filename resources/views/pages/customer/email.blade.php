<!-- resources/views/customer/forgot-password.blade.php -->
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
                        <p>Bạn đã nhớ mật khẩu?</p>
                        <a href="{{ route('customer.login') }}" class="axil-btn btn-bg-secondary sign-up-btn">Đăng nhập
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
                        <h3 class="title">Forgot Password.</h3>
                        <p class="b2 mb--55">Enter your detail below</p>
                        <form method="POST" action="{{ route('customer.email') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input type="email" name="email_account" >

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
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
