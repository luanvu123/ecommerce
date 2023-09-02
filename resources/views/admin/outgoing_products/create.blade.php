@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
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
                <label for="price_type">Loại giá</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price_type" value="product_price" checked>
                    <label class="form-check-label" for="price_type">
                        Giá sản phẩm
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price_type" value="custom_price">
                    <label class="form-check-label" for="price_type">
                        Giá khác
                    </label>
                </div>
            </div>

            <div class="form-group" id="custom_price_group" style="display: none;">
                <label for="custom_price">Giá tùy chỉnh</label>
                <input type="number" class="form-control" id="custom_price" name="custom_price" min="0">
            </div>

            <script>
                // Lắng nghe sự kiện thay đổi lựa chọn giá
                const priceTypeRadios = document.querySelectorAll('input[name="price_type"]');
                const customPriceGroup = document.getElementById('custom_price_group');

                priceTypeRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.value === 'custom_price') {
                            customPriceGroup.style.display = 'block';
                        } else {
                            customPriceGroup.style.display = 'none';
                        }
                    });
                });
            </script>

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
