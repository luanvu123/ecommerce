@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Danh sách sản phẩm xuất kho</h2>
        <a href="{{ route('outgoing_products.create') }}" class="btn btn-primary">Tạo mới</a>
        <table class="table" id="tableevent">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Ngày xuất kho</th>
                    <th>Ghi chú</th>
                    <th width="150px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($outgoingProducts as $key => $outgoingProduct)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $outgoingProduct->product->name }}</td>
                        <td>{{ $outgoingProduct->quantity }}</td>
                        <td>{{ $outgoingProduct->created_at }}</td>
                        <td>{!! $outgoingProduct->note !!}</td>
                        <td>
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
