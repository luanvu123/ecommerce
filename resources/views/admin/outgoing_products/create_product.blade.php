@extends('layouts.app')

@section('content')
    <div class="container">
         @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2>Xuất kho: <b>{{ $product->name }}</b></h2>
        <form action="{{ route('outgoing_products.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" class="form-control">
            </div>
             <div class="form-group">
                <label for="supplier_id">Chọn nhà phân phối:</label>
                <select name="supplier_id" class="form-control">
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
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
                <label for="note">Note (optional):</label>
                <textarea name="note" class="form-control" id="note"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">XUất</button>
        </form>
    </div>
@endsection
