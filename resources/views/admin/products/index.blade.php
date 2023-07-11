@extends('layouts.app')

@section('content')
    <div class="containe-fluid">

        <div class="row justify-content-center">
            <div class="col-md-12">
                @can('product-create')
                    <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Thêm Sản
                        phẩm</a>
                @endcan
                <div class="table-responsive">
                    <table class="table" id="tableevent">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Detail</th>
                                <th>Price</th>
                                <th>Giảm giá</th>
                                <th>Hot Deals</th>
                                <th>Image</th>
                                <th>Image 2</th>
                                <th>Image 3</th>
                                <th>Image 4</th>
                                <th>Image 5</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->detail }}</td>
                                    <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                                    <td>{{ number_format($product->reduced_price, 0, ',', '.') }} VNĐ</td>
                                    <td>{{ $product->hot_deals ? 'Yes' : 'No' }}</td>
                                    <td>
                                        @if ($product->image_product)
                                            <img src="{{ asset('storage/' . $product->image_product) }}" alt="Product Image"
                                                style="width: 100px;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->image_product2)
                                            <img src="{{ asset('storage/' . $product->image_product2) }}"
                                                alt="Product Image 2" style="width: 100px;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->image_product3)
                                            <img src="{{ asset('storage/' . $product->image_product3) }}"
                                                alt="Product Image 3" style="width: 100px;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->image_product4)
                                            <img src="{{ asset('storage/' . $product->image_product4) }}"
                                                alt="Product Image 4" style="width: 100px;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->image_product5)
                                            <img src="{{ asset('storage/' . $product->image_product5) }}"
                                                alt="Product Image 5" style="width: 100px;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            <a class="btn btn-primary"
                                                href="{{ route('products.edit', $product->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
