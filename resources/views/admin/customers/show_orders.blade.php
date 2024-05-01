@extends('layouts.app')

@section('content')
    <div class="containe-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Đơn hàng của khách hàng: {{ $customer->name }}</h1>
                <br />
                <div class="table-responsive">
                    <table class="display" id="tableevent">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên người nhận</th>
                                <th>Số điện thoại người nhận</th>
                                <th>Địa chỉ nhận hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Phương thức thanh toán</th>
                                <th>Thông tin vận chuyển</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->recipient_name }}</td>
                                    <td>{{ $order->recipient_phone }}</td>
                                    <td>{{ $order->recipient_address }}</td>
                                    <td>{{ $order->total_price }}</td>
                                    <td>
                                        @if ($order->status == 1)
                                            Chờ xác nhận
                                        @elseif ($order->status == 2)
                                            Chờ lấy hàng
                                        @elseif ($order->status == 3)
                                            Đang giao hàng
                                        @elseif ($order->status == 4)
                                            Đã giao hàng
                                        @elseif ($order->status == 5)
                                            Hủy đơn
                                        @else
                                            Trạng thái không xác định
                                        @endif
                                    </td>

                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->shipping->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
