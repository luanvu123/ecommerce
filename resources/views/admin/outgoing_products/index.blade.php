@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2>Danh sách sản phẩm xuất kho</h2>
        <a href="{{ route('outgoing_products.create') }}" class="btn btn-primary">Tạo mới</a>
        <table class="display" id="tableevent">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                    <th>Nhà phân phối</th>
                    <th>Người xuất kho</th>
                    <th>Ghi chú</th>
                    <th>Ngày xuất kho</th>
                    <th width="150px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($outgoingProducts as $key => $outgoingProduct)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $outgoingProduct->product->name }}</td>
                        <td>{{ $outgoingProduct->quantity }}</td>
                        <td>
                        {{ number_format($outgoingProduct->price, 0, ',', '.') }} VNĐ
                        </td>
                        <td> {{ number_format($outgoingProduct->total_amount , 0, ',', '.') }} VNĐ</td>
                        <td>
                            @if ($outgoingProduct->supplier)
                                {{ $outgoingProduct->supplier->name }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $outgoingProduct->user->name }}</td>
                        <td>{!! $outgoingProduct->note !!}</td>
                        <td>{{ $outgoingProduct->created_at }}</td>
                        <td>
                             <a href="{{ route('outgoing_products.show', $outgoingProduct->id) }}" class="btn btn-info btn-sm">Xem</a>
                            <form action="{{ route('outgoing_products.destroy', $outgoingProduct->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
