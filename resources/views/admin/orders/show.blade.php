@extends('layouts.app')

@section('content')
    <div class="containe-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Order Details</h1>
                <br />
                <div class="table-responsive">
                    <table class="display" id="tableevent">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thumbnail</th>
                                <th>Product Name</th>
                                <th>Sku</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetails as $key => $orderDetail)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $orderDetail->product->image_product) }}"
                                            alt="Product Image" style="width: 100px;">
                                    </td>
                                    <td>{{ $orderDetail->product->name }}</td>
                                    <td>
                                        @if ($orderDetail->sku_id)
                                            {{-- Hiển thị thông tin về SKU --}}
                                            @php
                                                $sku = \App\Models\Sku::find($orderDetail->sku_id);
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
                                            {{-- Nếu không có sku_id --}}
                                            <p>N/A</p>
                                        @endif
                                    </td>
                                    <td>{{ $orderDetail->quantity }}</td>
                                    <td>{{ number_format($orderDetail->price_detail, 0, ',', '.') }} VNĐ</td>
                                    <td>{{ number_format($orderDetail->subtotal_detail, 0, ',', '.') }} VNĐ</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
