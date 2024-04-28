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
                                                <p>
                                                    @foreach ($sku->attributeOptions as $attributeOption)
                                                        {{ $attributeOption->attribute->name }}:
                                                        {{ $attributeOption->value }}
                                                        @if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                </p>
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
                    <!-- Thông tin đơn hàng -->
                    <div class="col-xl-5 col-lg-7 offset-xl-0 offset-lg-5">
                        <div class="axil-order-summery mt--80">
                            <h5 class="title mb--20">Order Information</h5>
                            <div class="summery-table-wrap">
                                <form action="{{ route('checkout_submit') }}" method="POST">
                                    @csrf
                                    <table class="table summery-table mb--30">
                                        <tbody>
                                            <tr class="name">
                                                <td>Fullname</td>
                                                <td><input type="text" name="fullname_customer"
                                                        value="{{ $customer->fullname_customer }}"></td>
                                            </tr>
                                            <tr class="sdt">
                                                <td>Phone</td>
                                                <td><input type="text" name="phone_number_customer"
                                                        value="{{ $customer->phone_number_customer }}"></td>
                                            </tr>
                                            <tr class="add">
                                                <td>Address</td>
                                                <td><input type="text" name="address_customer"
                                                        value="{{ $customer->address_customer }}"></td>
                                            </tr>
                                            <tr class="email">
                                                <td>Email</td>
                                                <td><input type="email" name="email" value="{{ $customer->email }}">
                                                </td>
                                            </tr>
                                            <tr class="name">
                                                <td>Lời nhắn</td>
                                                <td><input type="text" name="message_customer"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <input type="hidden" name="totalAfterCoupon"
                                                        value="{{ $totalAfterCoupon }}">
                                                </td>
                                            </tr>
                                            <input type="hidden" name="shipping_id" id="shipping_id" value="">
                                            <input type="hidden" name="shipping_price" id="shipping_price" value="">
                                            <tr>
                                                <td colspan="2">
                                                    <button type="submit"
                                                        class="axil-btn btn-bg-primary checkout-btn">Thanh toán khi nhận
                                                        hàng</button>
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>

                                </form>
                                <!-- Nút thanh toán VNpay -->
                                <tr>
                                    <td colspan="2">
                                        <form method="post" action="{{ route('charge-vnpay') }}" id="vnpay-form">
                                            @csrf
                                            <input type="hidden" name="total_vnpay" id="total_vnpay_input"
                                                value="{{ $totalAfterCoupon }}">
                                            <button type="submit" id="pay-now-button" name="redirect"
                                                onclick="updateVnpayTotal()">
                                                Vnpay
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Nút thanh toán Momo -->
                                <script>
                                    function updateVnpayTotal() {
                                        var shippingPrice = parseFloat(document.querySelector('input[name="shipping"]:checked').value);
                                        var totalAfterCoupon = parseFloat("{{ $totalAfterCoupon }}");
                                        var totalVnpay = totalAfterCoupon + shippingPrice;
                                        document.getElementById('total_vnpay_input').value = totalVnpay.toFixed(2); // Cập nhật giá trị vào input hidden
                                    }
                                </script>
                                <!-- Nút thanh toán Momo -->
                                <tr>
                                    <td colspan="2">
                                        <form method="post" action="{{ route('charge-momo') }}" id="momo-form">
                                            @csrf
                                            <input type="hidden" name="total_momo" id="total_momo_input"
                                                value="{{ $totalAfterCoupon }}">

                                            <button type="submit" id="pay-now-button-momo" name="payUrl"
                                                onclick="updateMomoTotal()">
                                                Momo
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <script>
                                    function updateMomoTotal() {
                                        var shippingPrice = parseFloat(document.querySelector('input[name="shipping"]:checked').value);
                                        var totalAfterCoupon = parseFloat("{{ $totalAfterCoupon }}");
                                        var totalMomo = totalAfterCoupon + shippingPrice;
                                        document.getElementById('total_momo_input').value = totalMomo.toFixed(2); // Cập nhật giá trị vào input hidden
                                    }
                                </script>




                            </div>
                        </div>
                    </div>

                    <!-- Tóm tắt đơn hàng -->
                    <div class="col-xl-5 col-lg-7 offset-xl-1 offset-lg-5">
                        <div class="axil-order-summery mt--80">
                            <h5 class="title mb--20">Order Summary</h5>
                            <div class="summery-table-wrap">
                                <table class="table summery-table mb--30">
                                    <tbody>
                                        <tr class="order-subtotal">
                                            <td>Subtotal</td>
                                            <td>{{ number_format($total, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        <tr class="order-tax">
                                            <td>Coupon</td>
                                            <td>{{ number_format($couponDiscount, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        <input type="hidden" name="coupon_id" value="{{ session('coupon_id') }}">

                                        <tr class="order-shipping">
                                            <td>Shipping</td>
                                            <td>
                                                @foreach ($shippings as $shipping)
                                                    <div class="input-group">
                                                        <input type="radio" id="{{ $shipping->id }}" name="shipping"
                                                            value="{{ $shipping->price }}" onchange="updateTotal(this)">
                                                        <label for="{{ $shipping->id }}">{{ $shipping->name }}:
                                                            {{ number_format($shipping->price, 0, ',', '.') }} VNĐ </label>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>



                                        <script>
                                            function updateTotal(selectedRadio) {
                                                var shippingId = selectedRadio.id;
                                                document.getElementById('shipping_id').value = shippingId;

                                                var shippingPrice = selectedRadio.value;
                                                document.getElementById('shipping_price').value = shippingPrice;
                                                var totalBeforeCoupon = parseInt("{{ $totalAfterCoupon }}");
                                                var shippingPrice = parseFloat(selectedRadio.value);
                                                var totalAfterShipping = totalBeforeCoupon + shippingPrice;
                                                document.querySelector(".order-total-amount").textContent = totalAfterShipping.toLocaleString() + " VNĐ";
                                            }
                                        </script>

                                        <tr class="order-total">
                                            <td>Total</td>
                                            <td class="order-total-amount">
                                                {{ number_format($totalAfterCoupon, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    @endsection
