<!-- resources/views/skus/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Sku {{ $sku->id }}</h1>
    <form action="{{ route('skus.update', $sku->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                $groupedOptions = [];
            @endphp

            @foreach ($attributeOptions as $option)
                @php
                    $attributeName = $option->attribute->name;
                    $attributeValue = $option->value;
                @endphp

                <!-- Kiểm tra xem nhóm này đã được tạo chưa -->
                @if (!isset($groupedOptions[$attributeName]))
                    <!-- Tạo một nhóm mới nếu chưa tồn tại -->
                    @php
                        $groupedOptions[$attributeName] = [];
                    @endphp
                @endif

                <!-- Thêm tùy chọn vào nhóm tương ứng -->
                @php
                    $groupedOptions[$attributeName][] = $option;
                @endphp
            @endforeach

            <!-- Hiển thị từng nhóm thuộc tính -->
            @foreach ($groupedOptions as $attributeName => $options)
                <!-- Hiển thị tên thuộc tính -->
                <p>{{ $attributeName }}</p>

                <!-- Hiển thị các tùy chọn trong cùng một nhóm -->
                @foreach ($options as $option)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="attribute_options[{{ $attributeName }}]"
                            value="{{ $option->id }}"
                            {{ in_array($option->id, $selectedOptions[$attributeName] ?? []) ? 'checked' : '' }}>
                        <label class="form-check-label" for="option{{ $option->id }}">
                            {{ $option->value }}
                        </label>
                    </div>
                @endforeach
            @endforeach
        </div>

        </div>


        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <a href="{{ route('show.skus.product', ['product_id' =>$sku->product->id]) }}" class="btn btn-secondary">Back to Skus</a>
@endsection
