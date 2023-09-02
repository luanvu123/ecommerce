<!-- resources/views/skus/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Sku {{ $sku->id }}</h1>
    <form action="{{ route('skus.update', $sku->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="code">Sku Code</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ $sku->code }}">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ $sku->price }}">
        </div>
        <div class="form-group">
            <label for="price">Reduced Price</label>
            <input type="number" name="reduced_price" id="reduced_price" class="form-control"
                value="{{ $sku->reduced_price }}">
        </div>
        <div class="form-group">
            <label for="images">Images</label>
            <input type="file" name="images" id="images" class="form-control-file">
            <small class="form-text text-muted">Leave empty if no images available.</small>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ $sku->stock }}">
        </div>
        <div class="form-group">
            <label>Status</label><br>
            <label class="radio-inline">
                <input type="radio" name="status" value="1" {{ $sku->status ? 'checked' : '' }}> Display
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="0" {{ !$sku->status ? 'checked' : '' }}> Do Not Display
            </label>
        </div>
        <div class="form-group">
            <label for="attribute_options">Attribute Options</label><br>
            @php
                $currentAttributeName = null;
            @endphp
            @foreach ($attributeOptions as $option)
                @php
                    $attributeName = $option->attribute->name;
                    $attributeValue = $option->value;
                @endphp

                @if ($attributeName !== $currentAttributeName)
                    {{-- Hiển thị label mới nếu attribute name khác với attribute name trước đó --}}
                    @if ($currentAttributeName !== null)
        </div> {{-- Đóng div trước đó --}}
        @endif
        <div class="form-check">
            <label class="form-check-label">
                {{ $attributeName }}
            </label>
            @php
                $currentAttributeName = $attributeName;
            @endphp
            @endif

            <div class="form-check">
                <input class="form-check-input" type="radio" name="attribute_options[{{ $attributeName }}]"
                    value="{{ $option->id }}"
                    {{ in_array($option->id, $selectedOptions[$attributeName] ?? []) ? 'checked' : '' }}>
                <label class="form-check-label" for="option{{ $option->id }}">
                    {{ $attributeValue }}
                </label>
            </div>
            @endforeach
        </div> {{-- Đóng div cuối cùng --}}
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <a href="{{ route('skus.index') }}" class="btn btn-secondary">Back to Skus</a>
@endsection
