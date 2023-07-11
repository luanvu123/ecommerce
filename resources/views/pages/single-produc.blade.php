@extends('layout')
@section('content')
    <!-- Start Shop Area  -->
    <div class="axil-single-product-area axil-section-gap pb--0 bg-color-white">
        <div class="single-product-thumb mb--40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mb--40">
                        <div class="row">
                            <div class="col-lg-10 order-lg-2">
                                <div class="single-product-thumbnail-wrap zoom-gallery">
                                    <div class="single-product-thumbnail product-large-thumbnail-3 axil-product">
                                        <div class="thumbnail">
                                            <a href="{{ asset('fontend') }}/images/products/product-big-01.png"
                                                class="popup-zoom">
                                                <img src="{{ asset('fontend') }}/images/products/product-big-01.png"
                                                    alt="Product Images">
                                            </a>
                                        </div>
                                        <div class="thumbnail">
                                            <a href="{{ asset('fontend') }}/images/products/product-big-02.png"
                                                class="popup-zoom">
                                                <img src="{{ asset('fontend') }}/images/products/product-big-02.png"
                                                    alt="Product Images">
                                            </a>
                                        </div>
                                        <div class="thumbnail">
                                            <a href="{{ asset('fontend') }}/images/products/product-big-03.png"
                                                class="popup-zoom">
                                                <img src="{{ asset('fontend') }}/images/products/product-big-03.png"
                                                    alt="Product Images">
                                            </a>
                                        </div>
                                        <div class="thumbnail">
                                            <a href="{{ asset('fontend') }}/images/products/product-big-02.png"
                                                class="popup-zoom">
                                                <img src="{{ asset('fontend') }}/images/products/product-big-02.png"
                                                    alt="Product Images">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="label-block">
                                        <div class="product-badget">20% OFF</div>
                                    </div>
                                    <div class="product-quick-view position-view">
                                        <a href="{{ asset('fontend') }}/images/products/product-big-01.png"
                                            class="popup-zoom">
                                            <i class="far fa-search-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 order-lg-1">
                                <div class="product-small-thumb-3 small-thumb-wrapper">
                                    <div class="small-thumb-img">
                                        <img src="{{ asset('fontend') }}/images/products/thumb-08.png" alt="thumb image">
                                    </div>
                                    <div class="small-thumb-img">
                                        <img src="{{ asset('fontend') }}/images/products/thumb-07.png" alt="thumb image">
                                    </div>
                                    <div class="small-thumb-img">
                                        <img src="{{ asset('fontend') }}/images/products/thumb-09.png" alt="thumb image">
                                    </div>
                                    <div class="small-thumb-img">
                                        <img src="{{ asset('fontend') }}/images/products/thumb-07.png" alt="thumb image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mb--40">
                        <div class="single-product-content">
                            <div class="inner">
                                <h2 class="product-title">3D™ wireless headset</h2>
                                <span class="price-amount">$155.00 - $255.00</span>
                                <div class="product-rating">

                                </div>
                                <ul class="product-meta">
                                    <li><i class="fal fa-check"></i>In stock</li>
                                    <li><i class="fal fa-check"></i>Free delivery available</li>
                                    <li><i class="fal fa-check"></i>Sales 30% Off Use Code: MOTIVE30</li>
                                </ul>
                                <p class="description">In ornare lorem ut est dapibus, ut tincidunt nisi pretium. Integer
                                    ante est, elementum eget magna. Pellentesque sagittis dictum libero, eu dignissim
                                    tellus.</p>

                                <div class="product-variations-wrapper">

                                </div>

                                <!-- Start Product Action Wrapper  -->
                                <div class="product-action-wrapper d-flex-center">
                                    <!-- Start Quentity Action  -->
                                    <div class="pro-qty"><input type="text" value="1"></div>
                                    <!-- End Quentity Action  -->

                                    <!-- Start Product Action  -->
                                    <ul class="product-action d-flex-center mb--0">
                                        <li class="add-to-cart"><a href="cart.html" class="axil-btn btn-bg-primary">Add to
                                                Cart</a></li>
                                        <li class="wishlist"><a href="wishlist.html" class="axil-btn wishlist-btn"><i
                                                    class="far fa-heart"></i></a></li>
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
        <!-- End .single-product-thumb -->



    </div>
    <!-- End Shop Area  -->

    <!-- Start Recently Viewed Product Area  -->
    <div class="axil-product-area bg-color-white axil-section-gap pb--50 pb_sm--30">
        <div class="container">
            <div class="section-title-wrapper">
                <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i> Your
                    Recently</span>
                <h2 class="title">Viewed Items</h2>
            </div>
            <div class="recent-product-activation slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
                <div class="slick-single-layout">
                    <div class="axil-product">
                        <div class="thumbnail">
                            <a href="single-product.html">
                                <img src="{{ asset('fontend') }}/images/products/product-01.png" alt="Product Images">
                            </a>
                            <div class="label-block label-right">
                                <div class="product-badget">20% OFF</div>
                            </div>
                            <div class="product-hover-action">
                                <ul class="cart-action">
                                    <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a></li>
                                    <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                    <li class="quickview"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="inner">
                                <h5 class="title"><a href="single-product.html">3D™ wireless headset</a></h5>
                                <div class="product-price-variant">
                                    <span class="price old-price">$30</span>
                                    <span class="price current-price">$30</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End .slick-single-layout -->
                <div class="slick-single-layout">
                    <div class="axil-product">
                        <div class="thumbnail">
                            <a href="single-product.html">
                                <img src="{{ asset('fontend') }}/images/products/product-02.png" alt="Product Images">
                            </a>
                            <div class="label-block label-right">
                                <div class="product-badget">40% OFF</div>
                            </div>
                            <div class="product-hover-action">
                                <ul class="cart-action">
                                    <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a></li>
                                    <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                    <li class="quickview"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="inner">
                                <h5 class="title"><a href="single-product.html">Media remote</a></h5>
                                <div class="product-price-variant">
                                    <span class="price old-price">$80</span>
                                    <span class="price current-price">$50</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End .slick-single-layout -->
                <div class="slick-single-layout">
                    <div class="axil-product">
                        <div class="thumbnail">
                            <a href="single-product.html">
                                <img src="{{ asset('fontend') }}/images/products/product-03.png" alt="Product Images">
                            </a>
                            <div class="label-block label-right">
                                <div class="product-badget">30% OFF</div>
                            </div>
                            <div class="product-hover-action">
                                <ul class="cart-action">
                                    <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a></li>
                                    <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                    <li class="quickview"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="inner">
                                <h5 class="title"><a href="single-product.html">HD camera</a></h5>
                                <div class="product-price-variant">
                                    <span class="price old-price">$60</span>
                                    <span class="price current-price">$45</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End .slick-single-layout -->
                <div class="slick-single-layout">
                    <div class="axil-product">
                        <div class="thumbnail">
                            <a href="single-product.html">
                                <img src="{{ asset('fontend') }}/images/products/product-04.png" alt="Product Images">
                            </a>
                            <div class="label-block label-right">
                                <div class="product-badget">50% OFF</div>
                            </div>
                            <div class="product-hover-action">
                                <ul class="cart-action">
                                    <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a></li>
                                    <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                    <li class="quickview"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="inner">
                                <h5 class="title"><a href="single-product.html">PS Remote Control</a></h5>
                                <div class="product-price-variant">
                                    <span class="price old-price">$70</span>
                                    <span class="price current-price">$35</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End .slick-single-layout -->
                <div class="slick-single-layout">
                    <div class="axil-product">
                        <div class="thumbnail">
                            <a href="single-product.html">
                                <img src="{{ asset('fontend') }}/images/products/product-05.png" alt="Product Images">
                            </a>
                            <div class="label-block label-right">
                                <div class="product-badget">25% OFF</div>
                            </div>
                            <div class="product-hover-action">
                                <ul class="cart-action">
                                    <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a></li>
                                    <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                    <li class="quickview"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="inner">
                                <h5 class="title"><a href="single-product.html">PS Remote Control</a></h5>
                                <div class="product-price-variant">
                                    <span class="price old-price">$50</span>
                                    <span class="price current-price">$38</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End .slick-single-layout -->
                <!-- End .slick-single-layout -->
                <div class="slick-single-layout">
                    <div class="axil-product">
                        <div class="thumbnail">
                            <a href="single-product.html">
                                <img src="{{ asset('fontend') }}/images/products/product-03.png" alt="Product Images">
                            </a>
                            <div class="label-block label-right">
                                <div class="product-badget">30% OFF</div>
                            </div>
                            <div class="product-hover-action">
                                <ul class="cart-action">
                                    <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a></li>
                                    <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                    <li class="quickview"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="inner">
                                <h5 class="title"><a href="single-product.html">HD camera</a></h5>
                                <div class="product-price-variant">
                                    <span class="price old-price">$60</span>
                                    <span class="price current-price">$45</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End .slick-single-layout -->
                <div class="slick-single-layout">
                    <div class="axil-product">
                        <div class="thumbnail">
                            <a href="single-product.html">
                                <img src="{{ asset('fontend') }}/images/products/product-04.png" alt="Product Images">
                            </a>
                            <div class="label-block label-right">
                                <div class="product-badget">50% OFF</div>
                            </div>
                            <div class="product-hover-action">
                                <ul class="cart-action">
                                    <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a></li>
                                    <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                    <li class="quickview"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="inner">
                                <h5 class="title"><a href="single-product.html">PS Remote Control</a></h5>
                                <div class="product-price-variant">
                                    <span class="price old-price">$70</span>
                                    <span class="price current-price">$35</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End .slick-single-layout -->
                <div class="slick-single-layout">
                    <div class="axil-product">
                        <div class="thumbnail">
                            <a href="single-product.html">
                                <img src="{{ asset('fontend') }}/images/products/product-05.png" alt="Product Images">
                            </a>
                            <div class="label-block label-right">
                                <div class="product-badget">25% OFF</div>
                            </div>
                            <div class="product-hover-action">
                                <ul class="cart-action">
                                    <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a></li>
                                    <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                    <li class="quickview"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="inner">
                                <h5 class="title"><a href="single-product.html">PS5 Remote Control</a></h5>
                                <div class="product-price-variant">
                                    <span class="price old-price">$50</span>
                                    <span class="price current-price">$38</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End .slick-single-layout -->

            </div>
        </div>
    </div>
    <!-- End Recently Viewed Product Area  -->
    <!-- Start Axil Newsletter Area  -->
    <div class="axil-newsletter-area axil-section-gap pt--0">
        <div class="container">
            <div class="etrade-newsletter-wrapper bg_image bg_image--5">
                <div class="newsletter-content">
                    <span class="title-highlighter highlighter-primary2"><i
                            class="fas fa-envelope-open"></i>Newsletter</span>
                    <h2 class="title mb--40 mb_sm--30">Get weekly update</h2>
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
