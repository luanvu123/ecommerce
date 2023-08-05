@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tạo mới sản phẩm xuất kho</h2>
        <form action="{{ route('outgoing_products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="product_id">Sản phẩm</label>
                <select class="form-control" id="product_id" name="product_id" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Số lượng</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
            </div>
            <div class="form-group">
                <label for="note">Ghi chú</label>
                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Tạo mới</button>
        </form>
    </div>
@endsection


