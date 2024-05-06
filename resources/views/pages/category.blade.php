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
                            <li class="axil-breadcrumb-item active" aria-current="page">Category</li>
                        </ul>
                        <h1 class="title">{{ $cate_slug->name }}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img src="{{ asset('storage/' . $cate_slug->icon) }}"
                                alt="Image"style="min-height: 120px;max-width: 120px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->
    <!-- Start Categorie Area  -->
    <div class="axil-shop-area axil-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="axil-shop-top">
                        <h4>{{ $cate_slug->name }}</h4>
                    </div>
                </div>
            </div>
            <div class="row row--15">
                @foreach ($products as $product)
                    @if ($product->status == 1)
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="axil-product product-style-one has-color-pick mt--40">
                                <div class="thumbnail">
                                    <a href="{{ route('product', $product->slug) }}">
                                        <img src="{{ asset('storage/' . $product->image_product) }}"
                                            alt="Product Images"style="min-height: 300px;max-width: 300px;max-height: 300px;">
                                    </a>
                                    <div class="label-block label-right">
                                        @if ($product->discountPercentage > 0)
                                            <div class="product-badget">{{ $product->discountPercentage }}% OFF</div>
                                        @endif
                                    </div>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="wishlist"><a
                                                    href="{{ route('add.to.wishlist', ['product_id' => $product->id]) }}"><i
                                                        class="far fa-heart"></i></a></li>
                                            @if ($product->skus->count() > 0)
                                                {{-- Nếu sản phẩm có skus --}}
                                                <li class="select-option"><a
                                                        href="{{ route('product', $product->slug) }}">Add to
                                                        Cart</a></li>
                                            @else
                                                {{-- Nếu sản phẩm không có skus --}}
                                                <li class="select-option"><a
                                                        href="{{ route('add.to.cart', ['product_id' => $product->id]) }}">Add
                                                        to Cart</a></li>
                                            @endif

                                            {{-- <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                    data-product-id="{{ $product->id }}"
                                                    data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li> --}}
                                            <li class="quickview"><a href="{{ route('product', $product->slug) }}"><i
                                                        class="far fa-eye"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <h5 class="title"><a
                                                href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                        </h5>
                                        <div class="product-price-variant">
                                            <span
                                                class="price current-price">{{ number_format($product->reduced_price, 0, ',', '.') }}
                                                VNĐ</span>
                                            <span class="price old-price">{{ number_format($product->price, 0, ',', '.') }}
                                                VNĐ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="text-center pt--30">
                <a href="#" class="axil-btn btn-bg-lighter btn-load-more">Load more</a>
            </div>
        </div>
    </div>

    <!-- End Shop Area  -->
    <!-- Start Axil Newsletter Area  -->
    @include('pages.include.newsletter')
    <!-- End Axil Newsletter Area  -->
@endsection
