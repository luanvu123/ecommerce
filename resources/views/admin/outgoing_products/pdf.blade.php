<!-- resources/views/admin/outgoing_products/pdf_invoice.blade.php -->
<!DOCTYPE html>
<html>
<head>

    <title>Hóa Đơn Xuất Kho</title>
     <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
        content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice td {
            padding: 8px;
        }
        .invoice-header {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Hóa Đơn Xuất Kho</h2>
    <table class="invoice">
        <tr class="invoice-header">
            <td><strong>Sản phẩm</strong></td>
            <td><strong>Số lượng</strong></td>
            <td><strong>Đơn giá</strong></td>
            <td><strong>Thành tiền</strong></td>
            <td><strong>Nhà phân phối</strong></td>
            <td><strong>Người xuất kho</strong></td>
            <td><strong>Ghi chú</strong></td>
            <td><strong>Ngày xuất kho</strong></td>
        </tr>
        <tr>
            <td>{{ $outgoingProduct->product->name }}</td>
            <td>{{ $outgoingProduct->quantity }}</td>
            <td>{{ number_format($outgoingProduct->price) }}</td>
            <td>{{ number_format($outgoingProduct->total_amount) }}</td>
            <td>{{ $outgoingProduct->supplier->name }}</td>
            <td>{{ $outgoingProduct->user->name }}</td>
            <td>{{ $outgoingProduct->note }}</td>
            <td>{{ $outgoingProduct->created_at }}</td>
        </tr>
    </table>
</body>
</html>
