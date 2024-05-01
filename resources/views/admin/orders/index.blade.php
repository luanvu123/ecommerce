@extends('layouts.app')

@section('content')
    <div class="containe-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <br />
                <div class="table-responsive">
                    <table class="display" id="tableevent">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Recipient Name</th>
                                <th>Recipient Phone</th>
                                <th>Recipient Address</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Payment Method</th>
                                <th>Shipping ID</th>
                                <th>Coupon ID</th>
                                <th>Message</th>
                                <th>Payment ID</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $order->recipient_name }}</td>
                                    <td>{{ $order->recipient_phone }}</td>
                                    <td>{{ $order->recipient_address }}</td>
                                    <td>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                                    <td>
                                        <select id="{{ $order->id }}" class="order_choose">
                                            @if ($order->status == 1)
                                                <option selected value="1">Chờ xác nhận</option>
                                                <option value="2">Chờ lấy hàng</option>
                                                <option value="3">Đang giao hàng</option>
                                                <option value="4">Đã giao hàng</option>
                                                <option value="5">Hủy đơn</option>
                                            @elseif ($order->status == 2)
                                                <option value="1">Chờ xác nhận</option>
                                                <option selected value="2">Chờ lấy hàng</option>
                                                <option value="3">Đang giao hàng</option>
                                                <option value="4">Đã giao hàng</option>
                                                <option value="5">Hủy đơn</option>
                                            @elseif ($order->status == 3)
                                                <option value="1">Chờ xác nhận</option>
                                                <option value="2">Chờ lấy hàng</option>
                                                <option selected value="3">Đang giao hàng</option>
                                                <option value="4">Đã giao hàng</option>
                                                <option value="5">Hủy đơn</option>
                                            @elseif ($order->status == 4)
                                                <option value="1">Chờ xác nhận</option>
                                                <option value="2">Chờ lấy hàng</option>
                                                <option value="3">Đang giao hàng</option>
                                                <option selected value="4">Đã giao hàng</option>
                                                <option value="5">Hủy đơn</option>
                                            @elseif ($order->status == 5)
                                                <option value="1">Chờ xác nhận</option>
                                                <option value="2">Chờ lấy hàng</option>
                                                <option value="3">Đang giao hàng</option>
                                                <option value="4">Đã giao hàng</option>
                                                <option selected value="5">Hủy đơn</option>
                                            @endif
                                        </select>
                                    </td>


                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->shipping->name ?? 'N/A' }}</td>
                                    <td>{{ $order->coupon->code ?? 'N/A' }}</td>
                                    <td>{{ $order->message ?? 'N/A' }}</td>
                                    <td>{{ $order->paymentId ?? 'N/A' }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-warning">Xem chi
                                            tiết</a>
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
