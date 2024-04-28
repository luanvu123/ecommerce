<!-- resources/views/checkout-success.blade.php -->

@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Checkout Success</div>

                    <div class="card-body">
                        <h4>Your order has been successfully placed!</h4>
                        <p>Thank you for your purchase.</p>
                        <h5>Order Details:</h5>
                        <p>Order ID: {{ $order->id }}</p>
                        <p>Recipient Name: {{ $order->recipient_name }}</p>
                        <p>Recipient Email: {{ $order->recipient_email }}</p>
                        <p>Total Price: {{ number_format($order->total_price, 0, ',', '.') }} VNĐ</p>
                        <a href="{{ route('/') }}" class="btn btn-primary">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
