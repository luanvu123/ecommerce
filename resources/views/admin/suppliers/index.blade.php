@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Meta List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('suppliers.create') }}"> Thêm nhà phân phối</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table" id="tableevent">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên nhà cung cấp</th>
                <th>Tên người liên hệ</th>
                <th>Địa chỉ</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Người tạo</th>
                <th>Trạng thái</th>
                <th width="180px">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->contact_person }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>{{ $supplier->email_suppliers }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->user->name }}</td>
                    <td>
                        <select id="{{ $supplier->id }}"class="supplier_choose">
                            @if ($supplier->status == 0)
                                <option value="1">Hoạt động</option>
                                <option selected value="0">Ngừng hoạt động</option>
                            @else
                                <option selected value="1">Hoạt động</option>
                                <option value="0">Ngừng hoạt động</option>
                            @endif
                        </select>
                    </td>
                    <td>
                        <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                            style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
