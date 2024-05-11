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


<body class="sticky-header newsletter-popup-modal">

    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
    <a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>
    <header class="header axil-header header-style-5">
        <div class="axil-header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="header-top-dropdown">
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    English
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">English</a></li>
                                    <li><a class="dropdown-item" href="#">Arabic</a></li>
                                    <li><a class="dropdown-item" href="#">Spanish</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    USD
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">USD</a></li>
                                    <li><a class="dropdown-item" href="#">AUD</a></li>
                                    <li><a class="dropdown-item" href="#">EUR</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="header-top-link">
                            <ul class="quick-link">
                                <li><a href="#">Help</a></li>
                                <li><a href="{{ route('customer.signup') }}">Join Us</a></li>
                                @if (Auth::guard('customer')->check())
                                    <li>Welcome {{ Auth::guard('customer')->user()->name }}</li>
                                    <li>
                                        <form action="{{ route('customer.logout') }}" method="POST">
                                            @csrf
                                            {{-- <button type="submit">Logout</button> --}}
                                            @include('pages.include.logoutbutton')
                                        </form>
                                    </li>
                                @else
                                    <li><a href="{{ route('customer.login') }}">Sign In</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- Start Mainmenu Area  -->
        <div id="axil-sticky-placeholder"></div>
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-brand">
                        <a href="{{ route('/') }}" class="logo logo-dark">
                            <img src="{{ asset('storage/' . $info->logo1) }}" alt="Site Logo">
                        </a>
                        <a href="{{ route('/') }}" class="logo logo-light">
                            <img src="{{ asset('storage/' . $info->logo1) }}" alt="Site Logo">
                        </a>
                    </div>
                    <div class="header-main-nav">
                        <!-- Start Mainmanu Nav -->
                        <nav class="mainmenu-nav">
                            <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                            <div class="mobile-nav-brand">
                                <a href="" class="logo">
                                    <img src="" alt="Site Logo">
                                </a>
                            </div>
                            <ul class="mainmenu">
                                <li><a href="{{ route('/') }}">Home</a></li>
                                @foreach ($categories as $category)
                                    @if ($category->parent_id === null && $category->slug)
                                        <li class="menu-item-has-children">
                                            {{-- <a href="{{ route('category', ['slug' => $category->slug]) }}">{{ $category->name }}</a> --}}
                                            <a href="#">{{ $category->name }}</a>
                                            @if ($category->children->count() > 0)
                                                <ul class="axil-submenu">
                                                    @foreach ($category->children as $child)
                                                        @if ($child->slug && $child->status == 1 && $child->products->count() > 0)
                                                            <li><a
                                                                    href="{{ route('category', ['slug' => $child->slug]) }}">{{ $child->name }}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach



                                <li><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>
                        </nav>
                        <!-- End Mainmanu Nav -->
                    </div>
                    <div class="header-action">
                        <ul class="action-list">
                            <li class="axil-search d-xl-block d-none">
                                <input type="search" class="placeholder product-search-input" name="search2"
                                    id="search2" value="" maxlength="128"
                                    placeholder="What are you looking for?" autocomplete="off">
                                <button type="submit" class="icon wooc-btn-search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </button>
                            </li>
                            <li class="axil-search d-xl-none d-block">
                                <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </a>
                            </li>
                            <li class="wishlist">
                                <a href="{{ route('wishlist') }}">
                                    <i class="flaticon-heart"></i>
                                </a>
                            </li>
                            <li class="shopping-cart">
                                <a href="{{ route('cart') }}" class="cart-dropdown-btn">
                                    @if ($cartTotalQuantity > 0)
                                        <span class="cart-count">{{ $cartTotalQuantity }}</span>
                                    @endif
                                    <i class="flaticon-shopping-cart"></i>
                                </a>
                            </li>

                            <li class="my-account">
                                <a href="javascript:void(0)">
                                    <i class="flaticon-person"></i>
                                </a>
                                <div class="my-account-dropdown">
                                    <span class="title">QUICKLINKS</span>
                                    <ul>
                                        <li>
                                            <a href="{{ route('customer.account') }}">My Account</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('/') }}">Initiate return</a>
                                        </li>
                                        <li>
                                            <a href="#">Your order</a>
                                        </li>
                                        <li>
                                            <a href="#">Language</a>
                                        </li>
                                    </ul>
                                    <a href="{{ route('customer.login') }}" class="axil-btn btn-bg-primary">Login</a>
                                    <div class="reg-footer text-center">No account yet? <a
                                            href="{{ route('customer.signup') }}" class="btn-link">REGISTER HERE.</a>
                                    </div>
                                </div>
                            </li>
                            <li class="axil-mobile-toggle">
                                <button class="menu-btn mobile-nav-toggler">
                                    <i class="flaticon-menu-2"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Mainmenu Area -->
        <div class="header-top-campaign">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-10">
                        <div class="header-campaign-activation axil-slick-arrow arrow-both-side header-campaign-arrow">
                            <div class="slick-slide">
                                <div class="campaign-content">
                                    <p>STUDENT NOW GET 10% OFF : <a href="#">GET OFFER</a></p>
                                </div>
                            </div>
                            <div class="slick-slide">
                                <div class="campaign-content">
                                    <p>STUDENT NOW GET 20% OFF : <a href="#">GET OFFER</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="main-wrapper">
        @yield('content')
    </main>


    <div class="service-area">
        <div class="container">
            <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20">
                @foreach ($policy_home as $policy_homes)
                    <div class="col">
                        <div class="service-box service-style-2">
                            <div class="icon">
                                {{-- @php
                                    $imagePath = str_replace(['the-loai', 'dang-nhap'], '', $policy_homes->image_policies);
                                @endphp --}}
                                <img src="{{ asset('/storage/' . $policy_homes->image_policies) }}"
                                    alt="Service"style="min-height: 45px;max-width: 45px;">
                            </div>
                            <div class="content">
                                <h6 class="title">{{ $policy_homes->title }}</h6>
                                <p>{{ $policy_homes->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Start Footer Area  -->
    <footer class="axil-footer-area footer-style-2">
        <!-- Start Footer Top Area  -->
        <div class="footer-top separator-top">
            <div class="container">
                <div class="row">
                    <!-- Start Single Widget  -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="axil-footer-widget">
                            <h5 class="widget-title">Support</h5>

                            <div class="inner">
                                <p>{{ $info->address_support }}
                                </p>
                                <ul class="support-list-item">
                                    <li><a href="mailto:example@domain.com"><i class="fal fa-envelope-open"></i>
                                            {{ $info->youtube }}</a></li>
                                    <li><a href="tel:(+855)96-601-1977"><i class="fal fa-phone-alt"></i>
                                            {{ $info->phone_support }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                    <!-- Start Single Widget  -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="axil-footer-widget">
                            <h5 class="widget-title">Account</h5>
                            <div class="inner">
                                <ul>
                                    <li><a href="{{ route('customer.account') }}">My Account</a></li>
                                    <li><a href="{{ route('cart') }}">Cart</a></li>
                                    <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                    <!-- Start Single Widget  -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="axil-footer-widget">
                            <h5 class="widget-title">Quick Link</h5>
                            <div class="inner">
                                <ul>
                                    <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ route('terms.of.service') }}">Terms Of Use</a></li>
                                    <li><a href="#">FAQ</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                    <!-- Start Single Widget  -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="axil-footer-widget">
                            <h5 class="widget-title">Download App</h5>
                            <div class="inner">
                                <span>{{ $info->title_download }}</span>
                                <div class="download-btn-group">
                                    <div class="qr-code">
                                        <img src="{{ asset('fontend') }}/images/others/qr.png" alt="riki"
                                            style="max-height: 90px;">
                                    </div>
                                    <div class="app-link">
                                        <a href="#">
                                            <img src="{{ asset('fontend') }}/images/others/app-store.png"
                                                alt="App Store">
                                        </a>
                                        <a href="#">
                                            <img src="{{ asset('fontend') }}/images/others/play-store.png"
                                                alt="Play Store">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                </div>
            </div>
        </div>
        <!-- End Footer Top Area  -->
        <!-- Start Copyright Area  -->
        <div class="copyright-area copyright-default separator-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-4">
                        <div class="social-share">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-discord"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="copyright-left d-flex flex-wrap justify-content-center">
                            <ul class="quick-link">
                                <li>{{ $info->copyright }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div
                            class="copyright-right d-flex flex-wrap justify-content-xl-end justify-content-center align-items-center">
                            <span class="card-text">Accept For</span>
                            <ul class="payment-icons-bottom quick-link">
                                <li><img src="{{ asset('fontend') }}/images/icons/cart/cart-1.png" alt="paypal cart">
                                </li>
                                <li><img src="{{ asset('fontend') }}/images/icons/cart/cart-2.png" alt="paypal cart">
                                </li>
                                <li><img src="{{ asset('fontend') }}/images/icons/cart/cart-5.png" alt="paypal cart">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area  -->
    </footer>
    <!-- End Footer Area  -->

    <!-- Product Quick View Modal Start -->

    {{-- <div class="modal fade quick-view-product" id="quick-view-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="far fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="single-product-thumb">
                        <div class="row">
                            <div class="col-lg-7 mb--40">
                                <div class="row">
                                    <div class="col-lg-10 order-lg-2">
                                        <div
                                            class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">

                                            <div class="thumbnail">
                                                <img src="">
                                                <div class="label-block label-right">
                                                    <div class="product-badget"></div>
                                                </div>
                                                <div class="product-quick-view position-view">
                                                    <a href="" class="popup-zoom">
                                                        <i class="far fa-search-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 order-lg-1">
                                        <div class="product-small-thumb small-thumb-wrapper">
                                            <div class="small-thumb-img">
                                                <img src="" alt="thumb image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 mb--40">
                                <div class="single-product-content">
                                    <div class="inner">
                                        <div class="product-rating">
                                            <div class="star-rating">
                                                <img src="{{ asset('fontend') }}/images/icons/rate.png"
                                                    alt="Rate Images">
                                            </div>
                                            <div class="review-link">
                                                <a href="#">(<span>1</span> customer reviews)</a>
                                            </div>
                                        </div>
                                        <h3 class="product-title"></h3>
                                        <span class="price-amount"></span>
                                        <ul class="product-meta">
                                            <li><i class="fal fa-check"></i></li>
                                        </ul>
                                        <p class="description"></p>
                                        <div class="product-variations-wrapper">
                                        </div>

                                        <!-- Start Product Action Wrapper  -->
                                        <div class="product-action-wrapper d-flex-center">
                                            <!-- Start Quentity Action  -->
                                            <div class="pro-qty"><input type="text" value="1"></div>
                                            <!-- End Quentity Action  -->
                                            <!-- Start Product Action  -->
                                            <ul class="product-action d-flex-center mb--0">
                                                <li class="add-to-cart"><a href="cart.html"
                                                        class="axil-btn btn-bg-primary">Add to Cart</a></li>
                                                <li class="wishlist">
                                                    <a href=""
                                                        class="axil-btn wishlist-btn">
                                                        <i class="far fa-heart"></i>
                                                    </a>
                                                </li>

                                            </ul>
                                            <!-- End Product Action  -->

                                        </div>
                                        <!-- End Product Action Wrapper  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Product Quick View Modal End -->

    <!-- Header Search Modal End -->
    <div class="header-search-modal" id="header-search-modal">
        <button class="card-close sidebar-close"><i class="fas fa-times"></i></button>
        <div class="header-search-wrap">
            <div class="card-header">
                <form action="{{ route('tim-kiem') }}" method="GET">
                    <div class="input-group">
                        <input type="search" class="form-control" name="prod-search" id="prod-search"
                            placeholder="Write Something....">
                        <button type="submit" class="axil-btn btn-bg-primary"><i class="far fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="search-result-header">
                    <h6 class="title" id="result-count">0 Result Found</h6>
                    <a href="{{ route('tim-kiem') }}" class="view-all">View All</a>
                </div>
                <div class="psearch-results" id="result">

                </div>
            </div>
        </div>
    </div>

    <!-- Header Search Modal End -->


    {{-- <div class="cart-dropdown" id="cart-dropdown">
        <div class="cart-content-wrap">
            <div class="cart-header">
                <h2 class="header-title">Cart review</h2>
                <button class="cart-close sidebar-close"><i class="fas fa-times"></i></button>
            </div>
            <div class="cart-body">
                <ul class="cart-item-list">
                    <li class="cart-item">
                        <div class="item-img">
                            <a href=""><img src="{{ asset('fontend') }}/images/products/product-01.png"
                                    alt="Commodo Blown Lamp"></a>
                            <button class="close-btn"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="item-content">

                            <h3 class="item-title"><a href="">Wireless PS Handler</a></h3>
                            <div class="item-price"><span class="currency-symbol">$</span>155.00</div>
                            <div class="pro-qty item-quantity">
                                <input type="number" class="quantity-input" value="15">
                            </div>
                        </div>
                    </li>
                    <li class="cart-item">
                        <div class="item-img">
                            <a href=""><img src="{{ asset('fontend') }}/images/products/product-02.png"
                                    alt="Commodo Blown Lamp"></a>
                            <button class="close-btn"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="item-content">

                            <h3 class="item-title"><a href="">Gradient Light Keyboard</a></h3>
                            <div class="item-price"><span class="currency-symbol">$</span>255.00</div>
                            <div class="pro-qty item-quantity">
                                <input type="number" class="quantity-input" value="5">
                            </div>
                        </div>
                    </li>
                    <li class="cart-item">
                        <div class="item-img">
                            <a href=""><img src="a{{ asset('fontend') }}/images/products/product-03.png"
                                    alt="Commodo Blown Lamp"></a>
                            <button class="close-btn"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="item-content">

                            <h3 class="item-title"><a href="">HD CC Camera</a></h3>
                            <div class="item-price"><span class="currency-symbol">$</span>200.00</div>
                            <div class="pro-qty item-quantity">
                                <input type="number" class="quantity-input" value="100">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="cart-footer">
                <h3 class="cart-subtotal">
                    <span class="subtotal-title">Subtotal:</span>
                    <span class="subtotal-amount">$610.00</span>
                </h3>
                <div class="group-btn">
                    <a href="{{ route('cart') }}" class="axil-btn btn-bg-primary viewcart-btn">View Cart</a>
                    <a href="checkout.html" class="axil-btn btn-bg-secondary checkout-btn">Checkout</a>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Offer Modal Start -->
    <div class="offer-popup-modal" id="offer-popup-modal">
        <div class="offer-popup-wrap">
            <div class="card-body">
                <button class="popup-close"><i class="fas fa-times"></i></button>
                <div class="content">
                    <div class="section-title-wrapper">
                        <span class="title-highlighter highlighter-primary"> <i class="far fa-shopping-basket"></i>
                            Don’t Miss!!</span>
                        <h3 class="title">Best Sales Offer<br> Grab Yours</h3>
                    </div>
                    <div class="poster-countdown countdown"></div>
                    <a href="shop.html" class="axil-btn btn-bg-primary">Shop Now <i
                            class="fal fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="closeMask"></div>
    <!-- Offer Modal End -->
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


    <script type="text/javascript">
        $(document).ready(function() {
            $('#prod-search').keyup(function() {
                $('#result').html('');
                var search = $('#prod-search').val();
                if (search != '') {
                    var expression = new RegExp(search, "i");
                    $.getJSON('/json/products.json', function(data) {
                        var addedProducts = [];
                        $.each(data, function(key, value) {
                            if (value.status === 1 && value.name.search(expression) != -1) {
                                if (addedProducts.indexOf(value.name) === -1) {
                                    $('#result').css('display', 'inherit');
                                    var html = `
                                <div class="axil-product-list">
                                    <div class="thumbnail">
                                        <a href="/product/${value.slug}">
                                            <img src="/storage/${value.image_product}" alt="Yantiti Leather Bags" style="min-height: 120px; max-width: 120px;">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-rating">
                                            <span class="rating-icon">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fal fa-star"></i>
                                            </span>
                                            <span class="rating-number"><span>100+</span> Reviews</span>
                                        </div>
                                        <h6 class="product-title"><a href="/product/${value.slug}">${value.name}</a></h6>
                                        <div class="product-price-variant">
                                            <span class="price current-price">${value.reduced_price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })}</span>
                                            <span class="price old-price">${value.price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })}</span>
                                        </div>
                                        <div class="product-cart">
                                            <a href="/product/${value.slug}" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                            <a href="/wishlist/add/${value.id}" class="cart-btn"><i class="fal fa-heart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            `;
                                    $('#result').append(html);
                                    addedProducts.push(value.name);
                                }
                            }
                        });
                        // Update the result count based on the number of elements with class "axil-product-list"
                        $('#result-count').text($('#result .axil-product-list').length +
                            ' Results Found');
                    })
                } else {
                    $('#result').css('display', 'none');
                }
            });
        });
    </script>
    {{-- <a href="/cart/add/${value.id}" class="cart-btn"><i class="fal fa-shopping-cart"></i></a> --}}

    <script>
        $(document).ready(function() {
            $('.view-all').click(function(event) {
                event.preventDefault();
                $('form').attr('action', '{{ route('tim-kiem') }}').submit();
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('.quickview').on('click', function(event) {
                event.preventDefault();
                var productId = $(this).find('a').data('product-id');
                $.ajax({
                    url: '{{ route('get.product', ['id' => ':id']) }}'.replace(':id', productId),
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#quick-view-modal .product-title').text(response.name);
                        $('#quick-view-modal .price-amount').text('$' + response.price);
                        $('#quick-view-modal .description').text(response.detail);
                        var imagesHtml = '';
                        $.each(response.images, function(index, image) {
                            imagesHtml += '<div class="thumbnail">';
                            imagesHtml +=
                                '<img src="{{ asset('/uploads/products/large/') }}/' +
                                image.name + '" alt="Product Images">';
                            if (response.discountPercentage) {
                                imagesHtml += '<div class="label-block label-right">';
                                imagesHtml += '<div class="product-badget">' + response
                                    .discountPercentage + '% OFF</div>';
                                imagesHtml += '</div>';
                            }
                            imagesHtml +=
                                '<div class="product-quick-view position-view">';
                            imagesHtml +=
                                '<a href="{{ asset('/uploads/products/large/') }}/' +
                                image.name + '" class="popup-zoom">';
                            imagesHtml += '<i class="far fa-search-plus"></i>';
                            imagesHtml += '</a>';
                            imagesHtml += '</div>';
                            imagesHtml += '</div>';
                        });
                        $('#quick-view-modal .product-large-thumbnail').html(imagesHtml);

                        // Populate the small thumbnail images in the modal
                        var smallImagesHtml = '';
                        $.each(response.images, function(index, image) {
                            smallImagesHtml += '<div class="small-thumb-img">';
                            smallImagesHtml +=
                                '<img src="{{ asset('/uploads/products/small/') }}/' +
                                image.name + '" alt="thumb image">';
                            smallImagesHtml += '</div>';
                        });
                        $('#quick-view-modal .product-small-thumb').html(smallImagesHtml);

                        // Hiển thị thông tin product_meta
                        var productMetaHtml = '<ul class="product-meta">';
                        $.each(response.product_meta, function(index, meta) {
                            productMetaHtml += '<li><i class="fal fa-check"></i>' + meta
                                .meta_key + '</li>';
                        });
                        productMetaHtml += '</ul>';
                        $('#quick-view-modal .product-meta').html(productMetaHtml);
                        $('#quick-view-modal').modal('show');
                    },
                    error: function(xhr, status, error) {}
                });
            });
        });
    </script> --}}


</body>

</html>
