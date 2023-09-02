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

                    <h4 class="title">Your Cart</h4>
                    <a href="{{ route('cart.clear') }}" class="cart-clear">Clear Shoping Cart</a>
                </div>
                <form action="{{ route('update.cart.quantity') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="table-responsive">
                        <table class="table axil-product-table axil-cart-table mb--40">
                            <thead>
                                <tr>
                                    <th scope="col" class="product-remove"></th>
                                    <th scope="col" class="product-thumbnail">Product</th>
                                    <th scope="col" class="product-title"></th>
                                    <th scope="col" class="product-title"></th>
                                    <th scope="col" class="product-price">Price</th>
                                    <th scope="col" class="product-stock-status">Stock Status</th>
                                    <th scope="col" class="product-quantity">Quantity</th>
                                    <th scope="col" class="product-subtotal">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td class="product-remove">
                                            <form method="POST" action="{{ route('remove.from.cart') }}">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $cart->product_id }}">
                                                <button type="submit" class="remove-wishlist"><i
                                                        class="fal fa-times"></i></button>
                                            </form>
                                        </td>
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

                                        <td>
                                            @if ($cart->selected_options)
                                                @php
                                                    $selectedOptions = json_decode($cart->selected_options, true);
                                                @endphp
                                                @foreach ($selectedOptions as $attribute => $option)
                                                    {{ $attribute }}: {{ $option }}<br>
                                                @endforeach
                                            @endif
                                        </td>


                                        <td class="product-price" data-title="Price">
                                            <span class="currency-symbol"></span>
                                            {{ number_format($cart->product->reduced_price, 0, ',', '.') }}
                                            VNĐ
                                        </td>
                                        <td class="product-stock-status" data-title="Status">
                                            @php
                                                $remainQuantity = $remainQuantities[$cart->product->id] ?? 0;
                                            @endphp
                                            @if ($remainQuantity > 0)
                                                <p>Còn hàng</p>
                                            @else
                                                <p>Hết hàng</p>
                                            @endif
                                        </td>
                                        <td class="product-quantity" data-title="Qty">
                                            <div class="pro-qty">
                                                <input type="number" class="quantity-input"
                                                    name="cart[{{ $cart->product_id }}]" value="{{ $cart->quantity }}">
                                            </div>
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
                        <div class="update-btn">
                            <button type="submit" class="axil-btn btn-outline"style="max-width: 180px;">Update
                                Cart</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
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
                                        <tr class="order-tax">
                                            <td>State Tax</td>
                                            <td>$8.00</td>
                                        </tr>
                                        <tr class="order-total">
                                            <td>Total</td>
                                            <td class="order-total-amount">
                                                {{ number_format($totalAfterCoupon, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="checkout.html" class="axil-btn btn-bg-primary checkout-btn">Process to
                                Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End Cart Area  -->
@endsection
