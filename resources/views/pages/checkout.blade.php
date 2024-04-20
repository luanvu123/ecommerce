@extends('layout')
@section('content')
    <!-- Start Cart Area  -->
    <div class="axil-product-cart-area axil-section-gap">
        <div class="container">
            <div class="axil-product-cart-wrap">
                <div class="product-table-heading">
                    @if (session()->has('coupon_error'))
                        <div class="alert alert-danger">
                            {{ session()->get('coupon_error') }}
                        </div>
                    @endif

                    @if (session()->has('coupon_message'))
                        <div class="alert alert-success">
                            {{ session()->get('coupon_message') }}
                        </div>
                    @endif

                    <h4 class="title">Basic detail</h4>
                </div>
                <div class="table-responsive">
                    <table class="table axil-product-table axil-cart-table mb--40">
                        <thead>
                            <tr>
                                <th scope="col" class="product-thumbnail">Product</th>
                                <th scope="col" class="product-title"></th>
                                <th scope="col" class="product-title"></th>
                                <th scope="col" class="product-price">Price</th>
                                <th scope="col" class="product-quantity">Quantity</th>
                                <th scope="col" class="product-subtotal">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="{{ route('product', $cart->product->slug) }}">
                                            <img src="{{ asset('storage/' . $cart->product->image_product) }}"
                                                alt="Digital Product">
                                        </a>
                                    </td>
                                    <td class="product-title">
                                        <a
                                            href="{{ route('product', $cart->product->slug) }}">{{ $cart->product->name }}</a>
                                    </td>

                                    <td class="product-variations-wrapper">
                                        @if ($cart->sku_id)
                                            @php
                                                $sku = \App\Models\Sku::find($cart->sku_id);
                                            @endphp
                                            @if ($sku)
                                                <p>{{ $sku->code }}</p>
                                            @endif
                                        @else
                                            <p></p>
                                        @endif
                                    </td>
                                    <td class="product-price" data-title="Price">
                                        <span class="currency-symbol"></span>
                                        @if ($cart->sku_id && isset($sku))
                                            {{ number_format($sku->reduced_price ?? $sku->price, 0, ',', '.') }} VNĐ
                                        @else
                                            {{ number_format($cart->product->reduced_price ?? $cart->product->price, 0, ',', '.') }}
                                            VNĐ
                                        @endif
                                    </td>
                                    <td class="product-quantity" data-title="Qty">
                                        <span class="currency-symbol"></span>{{ $cart->quantity }}
                                    </td>
                                    <td class="product-subtotal" data-title="Subtotal">
                                        <span
                                            class="currency-symbol"></span>{{ number_format($cart->subtotal, 0, ',', '.') }}
                                        VNĐ
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="cart-update-btn-area">
                    <form action="{{ route('cart.applyCoupon') }}" method="POST">
                        @csrf
                        <div class="input-group product-cupon">
                            <input name="coupon_code" placeholder="Enter coupon code" type="text">
                            <div class="product-cupon-btn">
                                <button type="submit" class="axil-btn btn-outline">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    {{-- <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5"> --}}
                    <div class="col-xl-5 col-lg-7 offset-xl-0 offset-lg-5">
                        <div class="axil-order-summery mt--80">
                            <h5 class="title mb--20">Order Information</h5>
                            <div class="summery-table-wrap">
                                <table class="table summery-table mb--30">
                                    <tbody>
                                        <tr class="name">
                                            <td>Name</td>
                                            <td></td>
                                        </tr>
                                        <tr class="sdt">
                                            <td>SDT</td>
                                            <td></td>
                                        </tr>
                                        <tr class="add">
                                            <td>Address</td>
                                            <td>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('checkout') }}" class="axil-btn btn-bg-primary checkout-btn">Save</a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-7 offset-xl-1 offset-lg-5">
                        <div class="axil-order-summery mt--80">
                            <h5 class="title mb--20">Order Summary</h5>
                            <div class="summery-table-wrap">
                                <table class="table summery-table mb--30">
                                    <tbody>
                                        <tr class="order-subtotal">
                                            <td>Subtotal</td>
                                            <td>{{ number_format($total, 0, ',', '.') }}
                                                VNĐ</td>
                                        </tr>
                                        <tr class="order-tax">
                                            <td>Coupon</td>
                                            <td>{{ number_format($couponDiscount, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        <tr class="order-shipping">
                                            <td>Shipping</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="radio" id="radio1" name="shipping" checked="">
                                                    <label for="radio1">Free Shippping</label>
                                                </div>
                                                <div class="input-group">
                                                    <input type="radio" id="radio2" name="shipping">
                                                    <label for="radio2">Local: $35.00</label>
                                                </div>
                                                <div class="input-group">
                                                    <input type="radio" id="radio3" name="shipping">
                                                    <label for="radio3">Flat rate: $12.00</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <td>Total</td>
                                            <td class="order-total-amount">
                                                {{ number_format($totalAfterCoupon, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <a href="{{ route('checkout') }}" class="axil-btn btn-bg-primary checkout-btn">Thanh
                                        toán khi nhận hàng</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('checkout') }}" class="axil-btn btn-bg-primary checkout-btn">Ví Momo</a>
                                </div>
                                  <div class="col-md-6">
                                    <a href="{{ route('checkout') }}" class="axil-btn btn-bg-primary checkout-btn">Ví Vnpay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- End Cart Area  -->
    @endsection