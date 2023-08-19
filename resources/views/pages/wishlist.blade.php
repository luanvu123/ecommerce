@extends('layout')

@section('content')
    <!-- Start Wishlist Area  -->
    <div class="axil-wishlist-area axil-section-gap">
        <div class="container">
            <div class="product-table-heading">
                <h4 class="title">My Wish List on eTrade</h4>
            </div>
            <div class="table-responsive">
                <table class="table axil-product-table axil-wishlist-table">
                    <thead>
                        <tr>
                            <th scope="col" class="product-remove"></th>
                            <th scope="col" class="product-thumbnail">Product</th>
                            <th scope="col" class="product-title"></th>
                            <th scope="col" class="product-price">Unit Price</th>
                            <th scope="col" class="product-stock-status">Stock Status</th>
                            <th scope="col" class="product-add-cart"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wishlistItems as $item)
                            <tr>
                                <td class="product-remove">
                                    <form method="POST" action="{{ route('remove.from.wishlist') }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                        <button type="submit" class="remove-wishlist"><i class="fal fa-times"></i></button>
                                    </form>
                                </td>

                                <td class="product-thumbnail">
                                    <a href="{{ route('product', $item->product->slug) }}"><img
                                            src="{{ '/storage/' . $item->product->image_product }}"
                                            alt="Digital Product"></a>
                                </td>
                                <td class="product-title"><a
                                        href="{{ route('product', $item->product->slug) }}">{{ $item->product->name }}</a>
                                </td>
                                <td class="product-price" data-title="Price"><span class="currency-symbol"></span>
                                    @if ($item->product->reduced_price !== null)
                                        {{ number_format($item->product->reduced_price, 0, ',', '.') }}
                                        VND
                                    @else
                                        {{ number_format($item->product->price, 0, ',', '.') }}
                                        VNĐ
                                    @endif

                                </td>
                                <td class="product-stock-status" data-title="Status">
                                    @php
                                        $remainQuantity = $remainQuantities[$item->product->id] ?? 0;
                                    @endphp
                                    @if ($remainQuantity > 0)
                                        <p>Còn hàng</p>
                                    @else
                                        <p>Hết hàng</p>
                                    @endif
                                </td>
                                <td class="product-add-cart"><a
                                        href="{{ route('add.to.cart', ['product_id' => $item->product_id]) }}"
                                        class="axil-btn btn-outline">Add to Cart</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Wishlist Area  -->
@endsection
