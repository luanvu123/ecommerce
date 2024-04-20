@extends('layouts.app')

@section('content')
    <h1>Create Sku for {{ $product->name }}</h1>
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
    <form action="{{ route('skus.store', ['product_id' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
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
        @php
            $selectedOptions = [];
        @endphp

        <div class="form-group">
            <label for="attribute_options">Attribute Options</label><br>
            @php
                $uniqueAttributeNames = [];
            @endphp
            @foreach ($attributeOptions as $option)
                @php
                    $attributeName = $option->attribute->name;
                    $attributeValue = $option->value;
                @endphp

                @if (!in_array($attributeName, $uniqueAttributeNames))
                    @php
                        $uniqueAttributeNames[] = $attributeName;
                    @endphp
                    <p>{{ $attributeName }}</p>
                @endif

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $attributeName }}" value="{{ $option->id }}"
                        {{ in_array($option->id, $selectedOptions) ? 'checked' : '' }}>
                    <label class="form-check-label" for="option{{ $option->id }}">
                        {{ $attributeValue }}
                    </label>
                </div>
            @endforeach
        </div>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const radioGroups = {};

                const radioInputs = document.querySelectorAll('.form-check-input[type="radio"]');

                radioInputs.forEach(function(radio) {
                    const attributeName = radio.getAttribute('name');
                    if (!radioGroups[attributeName]) {
                        radioGroups[attributeName] = [];
                    }
                    radioGroups[attributeName].push(radio);

                    radio.addEventListener("change", function() {
                        if (this.checked) {
                            radioGroups[attributeName].forEach(function(otherRadio) {
                                if (otherRadio !== radio) {
                                    otherRadio.checked = false;
                                }
                            });
                        }
                    });
                });
            });
        </script>



        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
@endsection
