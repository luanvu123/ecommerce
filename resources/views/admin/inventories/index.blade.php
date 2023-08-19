@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Danh sách kho hàng</h2>
        <a href="{{ route('inventories.create') }}" class="btn btn-primary">Tạo mới</a>
        <table class="display" id="tableevent">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                    <th>Người nhập</th>
                    <th>Ngày nhập</th>
                    <th>Ghi chú</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventories as $key => $inventory)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $inventory->product->name }}</td>
                        <td>{{ $inventory->quantity }}</td>
                        <td>{{ $inventory->price }}</td>
                        <td>{{ $inventory->total_amount }}</td>
                        <td>
                            @if ($inventory->user)
                                {{ $inventory->user->name }}
                            @else
                                Không có người dùng
                            @endif
                        </td>

                        <td>{{ $inventory->created_at }}</td>
                        <td>{{ $inventory->note }}</td>
                        <td>
                            <a href="{{ route('inventories.show', $inventory->id) }}" class="btn btn-info btn-sm"><img src="{{ asset('backend/images/3671905_show_view_icon.svg') }}"
                                                    alt="Google" width="20" height="27" title="Xem"></a>
                            <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete?')"><img src="{{ asset('backend/images/185090_delete_garbage_icon.svg') }}"
                                                    alt="Google" width="19" height="20"></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
