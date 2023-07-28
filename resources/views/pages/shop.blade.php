@extends('layout')
@section('content')
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="{{ route('/') }}">Home</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">My Account</li>
                        </ul>
                        <h1 class="title">Explore All Products</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img src="{{ asset('fontend') }}/images/products/product-45.png" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->
    <!-- Start Categorie Area  -->
    <div class="axil-categorie-area bg-color-white axil-section-gapcommon">
        <div class="container">
            <div class="section-title-wrapper">
                <span class="title-highlighter highlighter-secondary"> <i class="far fa-tags"></i> Categories</span>
                <h2 class="title">Browse by Category</h2>
            </div>
            <div class="categrie-product-activation slick-layout-wrapper--15 axil-slick-arrow  arrow-top-slide">
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

    <!-- Start Shop Area  -->
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
                                                <li class="wishlist"><a href="{{ route('add.to.wishlist', ['product_id' => $product->id]) }}"><i
                                                            class="far fa-heart"></i></a>
                                                </li>
                                                <li class="select-option"><a href="{{ route('add.to.cart', ['product_id' => $product->id]) }}">Add to Cart</a></li>
                                                <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#quick-view-modal" data-product-id="{{ $product->id }}"><i class="far fa-eye"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="inner">
                                            <h5 class="title"><a href="single-product.html">{{ $product->name }}</a></h5>
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

    <!-- End Shop Area  -->
    <!-- Start Axil Newsletter Area  -->
    @include('pages.include.newsletter')
    <!-- End Axil Newsletter Area  -->
@endsection
