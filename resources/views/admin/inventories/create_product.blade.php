<!-- create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add Quantity for: <b>{{ $product->name }}</b></h2>
        <form action="{{ route('inventories.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" class="form-control">
            </div>
            <div class="form-group">
                <label for="note">Note (optional):</label>
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
        $(document).ready(function() {
            $('#custom_price').on('input', function() {
                var quantity = $('input[name="quantity"]').val();
                var customPrice = $(this).val();
                var totalAmount = quantity * customPrice;
                $('#total_amount').val(totalAmount);
            });
        });
    </script>
@endsection
