@extends('layouts.app')

@section('content')
    <div class="containe-fluid">
        <h1>Danh sách khách hàng</h1>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <br />
                <div class="table-responsive">
                    <table class="display" id="tableevent">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Ngày sinh</th>
                                <th>Full name</th>
                                <th>Status</th>
                                <th>Đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone_number_customer }}</td>
                                    <td>{{ $customer->address_customer }}</td>
                                    <td>{{ $customer->date_customer }}</td>
                                    <td>{{ $customer->fullname_customer }}</td>
                                    <td>
                                        <select id="{{ $customer->id }}"class="customer_choose">
                                            @if ($customer->status == 0)
                                                <option value="1">Hoạt động</option>
                                                <option selected value="0">Ngừng hoạt động</option>
                                            @else
                                                <option selected value="1">Hoạt động</option>
                                                <option value="0">Ngừng hoạt động</option>
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <a href="{{ route('customers.orders', ['customerId' => $customer->id]) }}">Xem đơn
                                            hàng</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
