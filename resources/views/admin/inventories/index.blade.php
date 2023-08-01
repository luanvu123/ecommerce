@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Danh sách kho hàng</h2>
        <table class="table" id="tableevent">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Ngày nhập</th>
                    <th>Ghi chú</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventories as $key => $inventory)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $inventory->product->name }}</td>
                        <td>{{ $inventory->quantity }}</td>
                        <td>{{ $inventory->created_at }}</td>
                        <td>{!! $inventory->note !!}</td>
                        <td>
                            <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
