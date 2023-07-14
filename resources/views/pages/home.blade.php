@extends('layout')
@section('content')
    <div class="axil-main-slider-area main-slider-style-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-sm-6">
                    <div class="main-slider-content">
                        <div class="slider-content-activation-one">
                            @foreach ($hot_products as $hot_product)
                                @if ($hot_product->reduced_price < $hot_product->price)
                                    <div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="400"
                                        data-sal-duration="800">
                                        <span class="subtitle"><i class="fas fa-fire"></i> {{ $info->title_hotdeals }}</span>
                                        <h1 class="title">{{ $hot_product->name }}</h1>
                                        <div class="slide-action">
                                            <div class="shop-btn">
                                                <a href="{{ route('shop') }}" class="axil-btn btn-bg-white"><i
                                                        class="fal fa-shopping-cart"></i>Shop Now</a>
                                            </div>
                                            <div class="item-rating">
                                                <div class="content">
                                                    <span class="rating-icon">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fal fa-star"></i>
                                                    </span>
                                                    <span class="review-text">
                                                        <span>100+</span> Reviews
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-6">
                    <div class="main-slider-large-thumb">
                        <div class="slider-thumb-activation-one axil-slick-dots">
                            @foreach ($hot_products as $hot_product)
                                @if ($hot_product->reduced_price < $hot_product->price)
                                    <div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="600"
                                        data-sal-duration="1500">
                                        <img src="{{ 'storage/' . $hot_product->image_product }}" alt="Product">
                                        <div class="product-price">
                                            <span class="text">From</span>
                                            <span
                                                class="price-amount">{{ number_format($hot_product->reduced_price, 0, ',', '.') }}
                                                VNĐ</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="shape-group">
            <li class="shape-1"><img src="{{ asset('fontend') }}/images/others/shape-1.png" alt="Shape"></li>
            <li class="shape-2"><img src="{{ asset('fontend') }}/images/others/shape-2.png" alt="Shape"></li>
        </ul>
    </div>

    <!-- Start Categorie Area  -->
    <div class="axil-categorie-area bg-color-white axil-section-gapcommon">
        <div class="container">
            <div class="section-title-wrapper">
                <span class="title-highlighter highlighter-secondary"> <i class="far fa-tags"></i>
                    {{$info->title_categories}}</span>
                <h2 class="title">{{$info->title2_categories}}</h2>
            </div>
            <div class="categrie-product-activation slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
                @foreach ($categories as $category)
                    @if ($category->parent_id !== null)
                        <div class="slick-single-layout">
                            <div class="categrie-product" data-sal="zoom-out" data-sal-delay="200" data-sal-duration="500">
                                <a href="{{ route('category', $category->slug) }}">
                                    <img class="img-fluid" src="{{ asset('storage/' . $category->icon) }}"
                                        alt="product categorie">
                                    <h6 class="cat-title">{{ $category->name }}</h6>
                                </a>
                            </div>
                            <!-- End .categrie-product -->
                        </div>
                    @endif
                @endforeach
            </div>


        </div>
    </div>
    <!-- End Categorie Area  -->

    <!-- Poster Countdown Area  -->
    <div class="axil-poster-countdown">
        <div class="container">
            <div class="poster-countdown-wrap bg-lighter">
                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="poster-countdown-content">
                            <div class="section-title-wrapper">
                                <span class="title-highlighter highlighter-secondary"> <i class="fal fa-headphones-alt"></i>
                                    {{ $info->title_dontmiss}}</span>
                                <h2 class="title">{{ $info->title2_dontmiss}}</h2>
                            </div>
                            <div class="poster-countdown countdown mb--40"></div>
                            <a href="#" class="axil-btn btn-bg-primary">Check it Out!</a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6">
                        <div class="poster-countdown-thumbnail">
                            <img src="{{ asset('fontend') }}/images/poster/poster-03.png" alt="Poster Product">
                            <div class="music-singnal">
                                <div class="item-circle circle-1"></div>
                                <div class="item-circle circle-2"></div>
                                <div class="item-circle circle-3"></div>
                                <div class="item-circle circle-4"></div>
                                <div class="item-circle circle-5"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Poster Countdown Area  -->

    <!-- Start Expolre Product Area  -->
    <div class="axil-shop-area axil-section-gap bg-color-white">
        @foreach ($category_home as $category)
            @if ($category->products->count() > 0)
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="axil-shop-top">
                                <h4>{{ $category->name }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row row--15">
                        @foreach ($category->products as $product)
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="axil-product product-style-one has-color-pick mt--40">
                                    <div class="thumbnail">
                                        <a href="single-product.html">
                                            <img src="{{ asset('storage/' . $product->image_product) }}"
                                                alt="Product Images">
                                        </a>
                                        <div class="label-block label-right">
                                            @if ($product->discountPercentage > 0)
                                                <div class="product-badget">{{ $product->discountPercentage }}% OFF</div>
                                            @endif
                                        </div>
                                        <div class="product-hover-action">
                                            <ul class="cart-action">
                                                <li class="wishlist"><a href="wishlist.html"><i
                                                            class="far fa-heart"></i></a>
                                                </li>
                                                <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                                <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="inner">
                                            <h5 class="title"><a href="single-product.html">{{ $product->name }}</a>
                                            </h5>
                                            <div class="product-price-variant">
                                                <span
                                                    class="price current-price">{{ number_format($product->reduced_price, 0, ',', '.') }}
                                                    VNĐ</span>
                                                <span
                                                    class="price old-price">{{ number_format($product->price, 0, ',', '.') }}
                                                    VNĐ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center pt--30">
                        <a href="{{ route('category', ['slug' => $category->slug]) }}"
                            class="axil-btn btn-bg-lighter btn-load-more">Load more</a>
                    </div>

                </div>
            @endif
        @endforeach
    </div>
    <!-- End Expolre Product Area  -->

    <!-- Start New Arrivals Product Area  -->
    <div class="axil-new-arrivals-product-area bg-color-white axil-section-gap pb--0">
        <div class="container">
            <div class="product-area pb--50">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i>{{ $info->title_thisweek}}</span>
                    <h2 class="title">{{ $info->title2_thisweek}}</h2>
                </div>
                <div class="new-arrivals-product-activation slick-layout-wrapper--30 axil-slick-arrow  arrow-top-slide">
                    <div class="slick-single-layout">
                        <div class="axil-product product-style-two">
                            <div class="thumbnail">
                                <a href="">
                                    <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="500"
                                        src="{{ asset('fontend') }}/images/products/product-05.png" alt="Product Images">
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget">10% OFF</div>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">

                                    <h5 class="title"><a href="">Demon's Souls</a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">$40</span>
                                        <span class="price current-price">$30</span>
                                    </div>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                            <li class="select-option"><a href="single-product.html">Add to
                                                    Cart</a></li>
                                            <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout">
                        <div class="axil-product product-style-two">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img data-sal="zoom-out" data-sal-delay="300" data-sal-duration="500"
                                        src="{{ asset('fontend') }}/images/products/product-06.png" alt="Product Images">
                                </a>
                            </div>
                            <div class="product-content">
                                <div class="inner">

                                    <h5 class="title"><a href="single-product.html">Google Home</a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">$50</span>
                                        <span class="price current-price">$40</span>
                                    </div>
                                </div>
                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                        <li class="select-option"><a href="single-product.html">Select
                                                Option</a></li>
                                        <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout">
                        <div class="axil-product product-style-two">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img data-sal="zoom-out" data-sal-delay="400" data-sal-duration="500"
                                        src="{{ asset('fontend') }}/images/products/product-07.png" alt="Product Images">
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget">15% OFF</div>
                                </div>

                            </div>
                            <div class="product-content">
                                <div class="inner">

                                    <h5 class="title"><a href="single-product.html">Netfilx Remot</a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">$60</span>
                                        <span class="price current-price">$45</span>
                                    </div>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                            <li class="select-option"><a href="single-product.html">Add to
                                                    Cart</a></li>
                                            <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout">
                        <div class="axil-product product-style-two">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img data-sal="zoom-out" data-sal-delay="500" data-sal-duration="500"
                                        src="{{ asset('fontend') }}/images/products/product-08.png" alt="Product Images">
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget">30% OFF</div>
                                </div>

                            </div>
                            <div class="product-content">
                                <div class="inner">

                                    <h5 class="title"><a href="single-product.html">Digital Accessories</a>
                                    </h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">$30</span>
                                        <span class="price current-price">$20</span>
                                    </div>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                            <li class="select-option"><a href="single-product.html">Add to
                                                    Cart</a></li>
                                            <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout">
                        <div class="axil-product product-style-two">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img data-sal="zoom-out" data-sal-delay="100" data-sal-duration="500"
                                        src="{{ asset('fontend') }}/images/products/product-04.png" alt="Product Images">
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget">50% OFF</div>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">

                                    <h5 class="title"><a href="single-product.html">PS5 Smart Remote</a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">$50</span>
                                        <span class="price current-price">$25</span>
                                    </div>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                            <li class="select-option"><a href="single-product.html">Add to
                                                    Cart</a></li>
                                            <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                </div>
            </div>
        </div>
    </div>
    <!-- End New Arrivals Product Area  -->

    <!-- Start Most Sold Product Area  -->
    <div class="axil-most-sold-product axil-section-gap">
        <div class="container">
            <div class="product-area pb--50">
                <div class="section-title-wrapper section-title-center">
                    <span class="title-highlighter highlighter-primary"><i class="fas fa-star"></i> {{ $info->title_mostsold}}</span>
                    <h2 class="title">{{ $info->title2_mostsold}}</h2>
                </div>
                <div class="row row-cols-xl-2 row-cols-1 row--15">
                    <div class="col">
                        <div class="axil-product-list">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img data-sal="zoom-in" data-sal-delay="100" data-sal-duration="1500"
                                        src="{{ asset('fontend') }}/images/products/product-09.png"
                                        alt="Yantiti Leather Bags">
                                </a>
                            </div>
                            <div class="product-content">

                                <h6 class="product-title"><a href="single-product.html">Media Remote</a></h6>
                                <div class="product-price-variant">
                                    <span class="price current-price">$29.99</span>
                                    <span class="price old-price">$49.99</span>
                                </div>
                                <div class="product-cart">
                                    <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                    <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="axil-product-list">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img data-sal="zoom-in" data-sal-delay="200" data-sal-duration="1500"
                                        src="{{ asset('fontend') }}/images/products/product-10.png"
                                        alt="Yantiti Leather Bags">
                                </a>
                            </div>
                            <div class="product-content">

                                <h6 class="product-title"><a href="single-product.html">HD Camera</a></h6>
                                <div class="product-price-variant">
                                    <span class="price current-price">$49.99</span>
                                </div>
                                <div class="product-cart">
                                    <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                    <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="axil-product-list">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img data-sal="zoom-in" data-sal-delay="300" data-sal-duration="1500"
                                        src="{{ asset('fontend') }}/images/products/product-11.png"
                                        alt="Yantiti Leather Bags">
                                </a>
                            </div>
                            <div class="product-content">

                                <h6 class="product-title"><a href="single-product.html">Gaming Controller</a>
                                </h6>
                                <div class="product-price-variant">
                                    <span class="price current-price">$50.00</span>
                                </div>
                                <div class="product-cart">
                                    <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                    <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="axil-product-list">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img data-sal="zoom-in" data-sal-delay="400" data-sal-duration="1500"
                                        src="{{ asset('fontend') }}/images/products/product-12.png"
                                        alt="Yantiti Leather Bags">
                                </a>
                            </div>
                            <div class="product-content">

                                <h6 class="product-title"><a href="single-product.html">Wall Mount </a></h6>
                                <div class="product-price-variant">
                                    <span class="price current-price">$19.00</span>
                                </div>
                                <div class="product-cart">
                                    <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                    <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="axil-product-list">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img data-sal="zoom-in" data-sal-delay="500" data-sal-duration="1500"
                                        src="{{ asset('fontend') }}/images/products/product-13.png"
                                        alt="Yantiti Leather Bags">
                                </a>
                            </div>
                            <div class="product-content">

                                <h6 class="product-title"><a href="single-product.html">Lenevo Laptop</a></h6>
                                <div class="product-price-variant">
                                    <span class="price current-price">$999.99</span>
                                </div>
                                <div class="product-cart">
                                    <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                    <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="axil-product-list">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img data-sal="zoom-in" data-sal-delay="600" data-sal-duration="1500"
                                        src="{{ asset('fontend') }}/images/products/product-14.png"
                                        alt="Yantiti Leather Bags">
                                </a>
                            </div>
                            <div class="product-content">

                                <h6 class="product-title"><a href="single-product.html">Juice Grinder
                                        Machine</a></h6>
                                <div class="product-price-variant">
                                    <span class="price current-price">$99.00</span>
                                </div>
                                <div class="product-cart">
                                    <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                    <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="axil-product-list">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img data-sal="zoom-in" data-sal-delay="400" data-sal-duration="1500"
                                        src="{{ asset('fontend') }}/images/products/product-15.png"
                                        alt="Yantiti Leather Bags">
                                </a>
                            </div>
                            <div class="product-content">

                                <h6 class="product-title"><a href="single-product.html">Wireless Headphone</a>
                                </h6>
                                <div class="product-price-variant">
                                    <span class="price current-price">$59.99</span>
                                </div>
                                <div class="product-cart">
                                    <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                    <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="axil-product-list">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img data-sal="zoom-in" data-sal-delay="500" data-sal-duration="1500"
                                        src="{{ asset('fontend') }}/images/products/product-16.png"
                                        alt="Yantiti Leather Bags">
                                </a>
                            </div>
                            <div class="product-content">

                                <h6 class="product-title"><a href="single-product.html">Asus Zenbook Laptop</a>
                                </h6>
                                <div class="product-price-variant">
                                    <span class="price current-price">$899.00</span>
                                </div>
                                <div class="product-cart">
                                    <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                    <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Most Sold Product Area  -->

    <!-- Start Why Choose Area  -->
    <div class="axil-why-choose-area pb--50 pb_sm--30">
        <div class="container">
            <div class="section-title-wrapper section-title-center">
                <span class="title-highlighter highlighter-secondary"><i class="fal fa-thumbs-up"></i>{{ $info->title_whyus}}</span>
                <h2 class="title">{{ $info->title2_whyus}}</h2>
            </div>
            <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 row--20">
                <div class="col">
                    <div class="service-box">
                        <div class="icon">
                            <img src="{{ asset('fontend') }}/images/icons/service6.png" alt="Service">
                        </div>
                        <h6 class="title">Fast &amp; Secure Delivery</h6>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box">
                        <div class="icon">
                            <img src="{{ asset('fontend') }}/images/icons/service7.png" alt="Service">
                        </div>
                        <h6 class="title">100% Guarantee On Product</h6>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box">
                        <div class="icon">
                            <img src="{{ asset('fontend') }}/images/icons/service8.png" alt="Service">
                        </div>
                        <h6 class="title">24 Hour Return Policy</h6>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box">
                        <div class="icon">
                            <img src="{{ asset('fontend') }}/images/icons/service9.png" alt="Service">
                        </div>
                        <h6 class="title">24 Hour Return Policy</h6>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box">
                        <div class="icon">
                            <img src="{{ asset('fontend') }}/images/icons/service10.png" alt="Service">
                        </div>
                        <h6 class="title">Next Level Pro Quality</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Why Choose Area  -->


    <!-- Start Axil Product Poster Area  -->
    <div class="axil-poster">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb--30">
                    <div class="single-poster">
                        <a href="shop.html">
                            <img src="{{ asset('fontend') }}/images/poster/poster-01.png" alt="eTrade promotion poster">
                            <div class="poster-content">
                                <div class="inner">
                                    <h3 class="title">Rich sound, <br> for less.</h3>
                                    <span class="sub-title">Collections <i class="fal fa-long-arrow-right"></i></span>
                                </div>
                            </div>
                            <!-- End .poster-content -->
                        </a>
                    </div>
                    <!-- End .single-poster -->
                </div>
                <div class="col-lg-6 mb--30">
                    <div class="single-poster">
                        <a href="shop-sidebar.html">
                            <img src="{{ asset('fontend') }}/images/poster/poster-02.png" alt="eTrade promotion poster">
                            <div class="poster-content content-left">
                                <div class="inner">
                                    <span class="sub-title">50% Offer In Winter</span>
                                    <h3 class="title">Get VR <br> Reality Glass</h3>
                                </div>
                            </div>
                            <!-- End .poster-content -->
                        </a>
                    </div>
                    <!-- End .single-poster -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Axil Product Poster Area  -->

    <!-- Start Axil Newsletter Area  -->
    <div class="axil-newsletter-area axil-section-gap pt--0">
        <div class="container">
            <div class="etrade-newsletter-wrapper bg_image bg_image--5">
                <div class="newsletter-content">
                    <span class="title-highlighter highlighter-primary2"><i
                            class="fas fa-envelope-open"></i>Newsletter</span>
                    <h2 class="title mb--40 mb_sm--30">{{$info->newsletter}}</h2>
                    <div class="input-group newsletter-form">
                        <div class="position-relative newsletter-inner mb--15">
                            <input placeholder="example@gmail.com" type="text">
                        </div>
                        <button type="submit" class="axil-btn mb--15">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End .container -->
    </div>
    <!-- End Axil Newsletter Area  -->
@endsection
