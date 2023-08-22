<!-- resources/views/admin/skus/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Sku List</h1>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Create Sku</a>
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
                    <td>{{ $sku->status ? 'Display' : 'Do Not Display' }}</td>
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
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Sku?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

