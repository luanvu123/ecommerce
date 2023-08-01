<!-- create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Nhập kho sản phẩm</h2>
        <form action="{{ route('inventories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="product_id">Chọn sản phẩm:</label>
                <select name="product_id" class="form-control">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @if ($product->id == $product->id) selected @endif>
                            {{ $product->name }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label for="quantity">Số lượng nhập kho:</label>
                <input type="number" name="quantity" class="form-control">
            </div>
            <div class="form-group">
                <label for="note">Ghi chú (tùy chọn):</label>
                <textarea name="note" class="form-control" id="note"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Nhập kho</button>
        </form>
    </div>
@endsection
