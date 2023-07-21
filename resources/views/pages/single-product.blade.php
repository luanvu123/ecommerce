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
                                        @foreach ($single_of_product->images as $image)
                                            <div class="thumbnail">
                                                <a href="{{ asset('uploads/products/large/' . $image->name) }}"
                                                    class="popup-zoom">
                                                    <img src="{{ asset('uploads/products/large/' . $image->name) }}"
                                                        alt="Product Images">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($single_of_product->discountPercentage > 0)
                                        <div class="label-block">
                                            <div class="product-badget">{{ $single_of_product->discountPercentage }}% OFF
                                            </div>
                                        </div>
                                    @endif
                                    {{-- <div class="product-quick-view position-view">
                                        <a href="{{ asset('uploads/products/large/' . $image->name) }}"
                                            class="popup-zoom">
                                            <i class="far fa-search-plus"></i>
                                        </a>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-lg-2 order-lg-1">
                                <div class="product-small-thumb-3 small-thumb-wrapper">
                                    @foreach ($single_of_product->images as $image)
                                        <div class="small-thumb-img">
                                            <img src="{{ asset('uploads/products/large/' . $image->name) }}"
                                                alt="thumb image">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mb--40">
                        <div class="single-product-content">
                            <div class="inner">
                                <h2 class="product-title"> {{ $single_of_product->name }}</h2>
                                <span
                                    class="price-amount">{{ number_format($single_of_product->reduced_price, 0, ',', '.') }}
                                    VNĐ</span>
                                <div class="product-rating">

                                </div>
                                <ul class="product-meta">
                                    @foreach ($single_of_product->product_meta as $meta)
                                        <li><i class="fal fa-check"></i>{{ $meta->meta_key }}</li>
                                    @endforeach
                                </ul>
                                <p class="description">{{ $single_of_product->detail }}</p>

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
                @foreach ($viewedItems as $item)
                    <div class="slick-single-layout">
                        <div class="axil-product">
                            <div class="thumbnail">
                                <a href="{{ route('product', $item->slug) }}">
                                    <img src="{{ asset('storage/' . $item->image_product) }}"
                                        alt="Product Images"style="min-height: 276px;max-width: 276px;">
                                </a>
                                <div class="label-block label-right">
                                    @if ($item->discountPercentageItems > 0)
                                        <div class="product-badget">{{ $item->discountPercentageItems }}% OFF</div>
                                    @endif
                                </div>
                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        <li class="wishlist"><a href="{{ route('wishlist') }}"><i
                                                    class="far fa-heart"></i></a></li>
                                        <li class="select-option"><a href="{{ route('cart') }}">Add to Cart</a></li>
                                        <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a
                                            href="{{ route('product', $item->slug) }}">{{ $item->name }}</a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">{{ number_format($item->price, 0, ',', '.') }}
                                            VNĐ</span>
                                        <span
                                            class="price current-price">{{ number_format($item->reduced_price, 0, ',', '.') }}
                                            VNĐ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Recently Viewed Product Area  -->
    <!-- Start Axil Newsletter Area  -->
    @include('pages.include.newsletter')
    <!-- End Axil Newsletter Area  -->
@endsection
