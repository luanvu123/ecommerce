<!-- resources/views/admin/outgoing_products/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Chi tiết sản phẩm đã xuất kho</h2>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Sản phẩm:</strong> {{ $outgoingProduct->product->name }}</p>
                <p><strong>Số lượng:</strong> {{ $outgoingProduct->quantity }}</p>
                <p><strong>Đơn giá:</strong>  {{ number_format($outgoingProduct->price, 0, ',', '.') }} VNĐ</p>
                <p><strong>Thành tiền:</strong> {{ number_format($outgoingProduct->total_amount , 0, ',', '.') }} VNĐ</p>
                <p><strong>Nhà phân phối:</strong> {{ $outgoingProduct->supplier->name }}</p>
                <p><strong>Người xuất kho:</strong> {{ $outgoingProduct->user->name }}</p>
                <p><strong>Ghi chú:</strong> {!! $outgoingProduct->note !!}</p>
                <p><strong>Ngày xuất kho:</strong> {{ $outgoingProduct->created_at }}</p>
                 <a href="{{ route('outgoing.products.generate.pdf', $outgoingProduct->id) }}" class="btn btn-primary">Tạo PDF</a>
            </div>
        </div>
    </div>
@endsection
