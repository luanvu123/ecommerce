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
                                <th>Image</th>
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
                                    <td>
                                        @if ($product->image_product)
                                            <img src="{{ asset('storage/' . $product->image_product) }}" alt="Product Image"
                                                style="width: 100px;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
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
