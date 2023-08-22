@extends('layouts.app')

@section('content')
    <h1>Create Sku for {{ $product->name }}</h1>
    <form action="{{ route('skus.store', ['product_id' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="code">Sku Code</label>
            <input type="text" name="code" id="code" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control">
        </div>
        <div class="form-group">
            <label for="reduced_price">Reduced Price</label>
            <input type="number" name="reduced_price" id="reduced_price" class="form-control">
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control">
        </div>
        <div class="form-group">
            <label for="images">Images</label>
            <input type="file" name="images" id="images" class="form-control-file">
            <small class="form-text text-muted">Leave empty if no images available.</small>
        </div>
        <div class="form-group">
            <label>Status</label><br>
            <label class="radio-inline">
                <input type="radio" name="status" value="1"> Display
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="0"> Do Not Display
            </label>
        </div>
        <div class="form-group">
            <label for="attribute_options">Attribute Options</label><br>
            <select name="attribute_options[]" id="attribute_options" class="form-control" multiple>
                @foreach ($attributeOptions as $option)
                    <option value="{{ $option->id }}">  {{ $option->attribute->name }}: {{ $option->value }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
@endsection


