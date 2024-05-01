<!DOCTYPE html>
<html>
<head>
    <title>Cảm ơn bạn đã thanh toán</title>
</head>
<body>
    <h2>Cảm ơn bạn đã thanh toán thành công!</h2>
    <p>Dưới đây là chi tiết đơn hàng của bạn:</p>
    <p>Mã đơn hàng: {{ $orderId }}</p>
    <p>Số tiền: {{ number_format($amount, 0, ',', '.') }} VNĐ</p>

</body>
</html>
