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
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
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
            <div class="form-group">
                <label for="custom_price">Đơn giá:</label>
                <input type="number" name="custom_price" id="custom_price" class="form-control">
            </div>
            <div class="form-group">
                <label for="total_amount">Thành tiền:</label>
                <input type="number" name="total_amount" id="total_amount" class="form-control" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Nhập kho</button>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            $('#custom_price').on('input', function () {
                var quantity = $('input[name="quantity"]').val();
                var customPrice = $(this).val();
                var totalAmount = quantity * customPrice;
                $('#total_amount').val(totalAmount);
            });
        });
    </script>
@endsection
