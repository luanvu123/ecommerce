@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Thông tin kho hàng</h2>
        <p><strong>Sản phẩm:</strong> {{ $inventory->product->name }}</p>
        <p><strong>Số lượng:</strong> {{ $inventory->quantity }}</p>
        <p><strong>Đơn giá:</strong> {{ $inventory->price }}</p>
        <p><strong>Thành tiền:</strong> {{ $inventory->total_amount }}</p>
        <p><strong>Ghi chú:</strong> {{ $inventory->note }}</p>
        <p><strong>Người nhập kho:</strong> {{ $inventory->user->name }}</p>
        <a href="{{ route('inventories.generatePDF', $inventory->id) }}" class="btn btn-primary">Tạo PDF</a>
    </div>
@endsection

