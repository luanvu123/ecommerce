<!-- resources/views/admin/skus/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Sku List</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <button class="button" type="button" onclick="window.location='{{ route('skus.create.product', ['product_id' => $product->id]) }}'">
        <span class="button__text">Add Sku</span>
        <span class="button__icon"><svg class="svg" fill="none" height="24" stroke="currentColor"
                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"
                xmlns="http://www.w3.org/2000/svg">
                <line x1="12" x2="12" y1="5" y2="19"></line>
                <line x1="5" x2="19" y1="12" y2="12"></line>
            </svg></span>
    </button>

    <br />
    <table class="table" id="tableevent">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Code</th>
                <th>Price</th>
                <th>Reduced</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Attribute Options</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($skus as $sku)
                <tr>
                    <td>{{ $sku->id }}</td>
                    <td>{{ $sku->product->name }}</td>
                    <td>{{ $sku->code }}</td>
                    <td>{{ $sku->price }}</td>
                    <td>{{ $sku->reduced_price }}</td>
                    <td>{{ $sku->stock }}</td>
                    <td> <select id="{{ $sku->id }}"class="sku_choose">
                        @if ($sku->status == 0)
                            <option value="1">Hoạt động</option>
                            <option selected value="0">Ngừng hoạt động</option>
                        @else
                            <option selected value="1">Hoạt động</option>
                            <option value="0">Ngừng hoạt động</option>
                        @endif
                    </select></td>
                    <td>
                        @foreach ($sku->attributeOptions as $attributeOption)
                            {{ $attributeOption->attribute->name }}: {{ $attributeOption->value }}
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if ($sku->images)
                            <img src="{{ asset('storage/' . $sku->images) }}" alt="Sku Image" style="max-width:50px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('skus.show', $sku->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('skus.edit', $sku->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('skus.destroy', $sku->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this Sku?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
