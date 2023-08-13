<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Hóa đơn nhập hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .invoice .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .invoice .details .left {
            width: 50%;
        }

        .invoice .details .right {
            width: 50%;
            text-align: right;
        }

        .items {
            width: 100%;
            border-collapse: collapse;
        }

        .items th,
        .items td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .total {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>HÓA ĐƠN NHẬP HÀNG</h2>
        </div>
        <div class="invoice">
            <div class="details">
                <div class="left">
                    <p><strong>Sản phẩm:</strong> {{ $inventory->product->name }}</p>
                    <p><strong>Số lượng:</strong> {{ $inventory->quantity }}</p>
                    <p><strong>Đơn giá:</strong> {{ number_format($inventory->price, 0, '.', ',') }} VND</p>
                    <p><strong>Thành tiền:</strong> {{ number_format($inventory->total_amount, 0, '.', ',') }} VND</p>
                </div>
                <div class="right">
                    <p><strong>Ngày nhập:</strong> {{ $inventory->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Người nhập kho:</strong> {{ $inventory->user->name }}</p>
                </div>
            </div>
        </div>
        <div class="total">
            <p><strong>Tổng cộng:</strong> {{ number_format($inventory->total_amount, 0, '.', ',') }} VND</p>
        </div>
    </div>
</body>

</html>
