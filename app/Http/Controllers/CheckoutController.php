<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThankYouEmail;

class CheckoutController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $carts = Cart::where('customer_id', $customer->id)->get();
        $shippings = Shipping::where('status', 1)->get();

        $carts->each(function ($cart) {
            $product = $cart->product;
            if ($product->skus->isNotEmpty() && $cart->sku_id) {
                // Nếu sản phẩm có sku và sku đã được chọn, tính toán giá từ sku
                $sku = Sku::findOrFail($cart->sku_id);
                if ($sku->reduced_price !== null) {
                    $price = $sku->reduced_price;
                } else {
                    $price = $sku->price;
                }
            } else {
                if ($product->reduced_price !== null) {
                    $price = $product->reduced_price;
                } else {
                    $price = $product->price;
                }
            }
            $cart->subtotal = $cart->quantity * $price;
        });

        $total = $carts->sum('subtotal');
        $cartTotalQuantity = $carts->sum('quantity');
        $couponDiscount = 0;
        $totalAfterCoupon = $total;

        return view('pages.checkout', compact('customer', 'carts', 'total', 'couponDiscount', 'cartTotalQuantity', 'totalAfterCoupon', 'shippings'));
    }

    public function applyCoupon(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $carts = Cart::where('customer_id', $customer->id)->get();
        $shippings = Shipping::where('status', 1)->get();
        $carts->each(function ($cart) {
            $product = $cart->product;
            if ($product->skus->isNotEmpty() && $cart->sku_id) {
                // Nếu sản phẩm có sku và sku đã được chọn, tính toán giá từ sku
                $sku = Sku::findOrFail($cart->sku_id);
                if ($sku->reduced_price !== null) {
                    $price = $sku->reduced_price;
                } else {
                    $price = $sku->price;
                }
            } else {
                // Nếu sản phẩm không có sku, sử dụng giá của sản phẩm
                if ($product->reduced_price !== null) {
                    $price = $product->reduced_price;
                } else {
                    $price = $product->price;
                }
            }
            $cart->subtotal = $cart->quantity * $price;
        });

        $total = $carts->sum('subtotal');
        $cartTotalQuantity = $carts->sum('quantity');

        $couponCode = $request->input('coupon_code');
        $couponDiscount = 0;
        $message = '';

        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->where('status', 1)->where('expires_at', '>=', now())->first();

            if ($coupon) {
                $couponDiscount = ($coupon->type === 'percent') ? $total * ($coupon->value / 100) : $coupon->value;
                $message = 'Coupon applied successfully!';
            } else {
                $message = 'Invalid coupon code. Please try again.';
                return redirect()->back()->with('coupon_error', $message);
            }
        }


        // Sau khi xác định được giảm giá từ mã coupon, lưu coupon_id vào session
        $coupon = Coupon::where('code', $couponCode)->where('status', 1)->where('expires_at', '>=', now())->first();
        if ($coupon) {
            session(['coupon_id' => $coupon->id]);
        }
        $totalAfterCoupon = $total - $couponDiscount;
        if ($request->has('shipping')) {

            $shippingPrice = $request->input('shipping');
            $totalAfterCoupon += $shippingPrice;
        }
        session()->flash('coupon_message', $message);
        return view('pages.checkout', compact('customer', 'carts', 'total', 'cartTotalQuantity', 'couponDiscount', 'totalAfterCoupon', 'shippings'));
    }


    public function checkoutSubmit(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $carts = Cart::where('customer_id', $customer->id)->get();
        $couponId = session('coupon_id');
        $shippingPrice = $request->input('shipping_price');


        // Tạo một đối tượng Order
        $order = new Order();
        $order->customer_id = $customer->id;
        $order->recipient_name = $request->input('fullname_customer');
        $order->recipient_phone = $request->input('phone_number_customer');
        $order->recipient_address = $request->input('address_customer');
        $order->recipient_email = $request->input('email');
        $order->message = $request->input('message_customer');
        $order->total_price = $request->input('totalAfterCoupon') + $shippingPrice;
        $order->status = '1';
        $order->payment_method = 'Thanh toán khi nhận hàng';
        $order->shipping_id = $request->input('shipping_id');
        // dd($order->total_price);
        $order->coupon_id = $couponId;
        $order->save();
        $orderId=$order->id;
        $email = $customer->email;
        $amount =  $order->total_price;
        $this->sendThankYouEmail($email, $orderId, $amount);
        // Lưu chi tiết đơn hàng
        foreach ($carts as $cart) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cart->product_id;
            $orderDetail->quantity = $cart->quantity;
            $orderDetail->sku_id = $cart->sku_id;

            if ($cart->sku_id) {
                $sku = Sku::findOrFail($cart->sku_id);
                $orderDetail->price_detail = $sku->reduced_price ?? $sku->price;
            } else {
                $orderDetail->price_detail = $cart->product->reduced_price ?? $cart->product->price;
            }
            $orderDetail->subtotal_detail = $cart->quantity * $orderDetail->price_detail;

            $orderDetail->save();
        }

        // Xóa các sản phẩm trong giỏ hàng sau khi đã đặt hàng thành công
        $carts->each->delete();
        // Redirect hoặc hiển thị thông báo thành công
        return redirect()->route('checkout-success')->with('success_message', 'Đơn hàng đã được đặt thành công!');
    }
    public function sendThankYouEmail($email, $orderId, $amount)
    {
        Mail::to($email)->send(new ThankYouEmail($orderId, $amount));
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function chargeVnpay(Request $request)
    {
        $data = $request->all();
        $code_cart = rand(00, 9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/thanh-toan-vnpay-thanh-cong";
        $vnp_TmnCode = "5DK93HQO"; //Mã website tại VNPAY
        $vnp_HashSecret = "SDFVNVGBWBGQOUQGAYAROOQHJUNRZPZA"; //Chuỗi bí mật

        $vnp_TxnRef = $code_cart; //Mã đơn hàng
        $vnp_OrderInfo = 'Thanh toán qua vnpay';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $data['total_vnpay'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
            // "vnp_ExpireDate" => $vnp_ExpireDate,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function chargeMomo(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $_POST['total_momo'];
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/checkout-success";
        $ipnUrl = "http://127.0.0.1:8000/checkout";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature

        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true); // decode json



        return redirect()->to($jsonResult['payUrl']);
    }

    public function result_vnpay(Request $request)
    {
        $validatedData = $request->validate([
            'fullname_customer' => 'required',
            'phone_number_customer' => 'required',
            'recipient_address' => 'required',
            'recipient_email' => 'required|email',
            'message_customer' => 'required',

        ]);

        // Retrieve validated data from the request
        $fullname_customer = $validatedData['fullname_customer'];
        $phone_number_customer = $validatedData['phone_number_customer'];
        $recipientAddress = $validatedData['recipient_address'];
        $recipientEmail = $validatedData['recipient_email'];
        $message = $validatedData['message_customer'];
        $shippingId = $request->input('shipping_id');

        $customer = Auth::guard('customer')->user();
        $carts = Cart::where('customer_id', $customer->id)->get();
        $couponId = session('coupon_id');
        $shippingPrice = $request->input('shipping_price');
        $vnp_HashSecret = "SDFVNVGBWBGQOUQGAYAROOQHJUNRZPZA";

        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $inputData = array();
        $returnData = array();

        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnp_OrderInfo = $inputData['vnp_OrderInfo'];
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi
        $orderId = $inputData['vnp_TxnRef'];
        $Status = 0;


        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                if ($request->query()) {

                    // Lưu thông tin vào cơ sở dữ liệu

                    if (Order::where('paymentId', $orderId)->exists()) {
                        return redirect()->route('cart');
                    } else {
                        $order = new Order();
                        $order->customer_id = $customer->id;
                        $order->paymentId = $orderId;
                        $order->recipient_name = $fullname_customer;
                        $order->recipient_phone = $phone_number_customer;
                        $order->recipient_address = $recipientAddress;
                        $order->recipient_email = $recipientEmail;
                        $order->message = $message;
                        $order->total_price = $vnp_Amount;
                        $order->status = '1';
                        $order->payment_method = 'thanh toán vnpay ';
                        $order->shipping_id =  $shippingId;
                        $order->coupon_id = $couponId;
                        $order->save();

                        // Lưu chi tiết đơn hàng
                        foreach ($carts as $cart) {
                            $orderDetail = new OrderDetail();
                            $orderDetail->order_id = $order->id;
                            $orderDetail->product_id = $cart->product_id;
                            $orderDetail->quantity = $cart->quantity;
                            $orderDetail->sku_id = $cart->sku_id;

                            if ($cart->sku_id) {
                                $sku = Sku::findOrFail($cart->sku_id);
                                $orderDetail->price_detail = $sku->reduced_price ?? $sku->price;
                            } else {
                                $orderDetail->price_detail = $cart->product->reduced_price ?? $cart->product->price;
                            }
                            $orderDetail->subtotal_detail = $cart->quantity * $orderDetail->price_detail;

                            $orderDetail->save();
                        }
                        $carts->each->delete();
                    }
                }
                echo json_encode($returnData);
            } else {
                return redirect()->route('cart');
            }
        } else {
            return redirect()->route('cart');
        }
        return view('pages.checkout-success', compact('orderId', 'vnp_Amount', 'vnp_BankCode', 'vnpTranId', 'order'));
    }


    public function checkoutSuccess()
    {
        // Retrieve the latest order placed by the authenticated customer
        $customer = auth()->guard('customer')->user();
        $order = Order::where('customer_id', $customer->id)
            ->latest()
            ->first();

        // Pass the order details to the checkout success view
        return view('pages.checkout-success', compact('order'));
    }

    //momo
    public function result(Request $request)
    {
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $validatedData = $request->validate([
            'fullname_customer' => 'required',
            'phone_number_customer' => 'required',
            'recipient_address' => 'required',
            'recipient_email' => 'required|email',
            'message_customer' => 'required',
        ]);

        // Retrieve validated data from the request
        $fullname_customer = $validatedData['fullname_customer'];
        $phone_number_customer = $validatedData['phone_number_customer'];
        $recipientAddress = $validatedData['recipient_address'];
        $recipientEmail = $validatedData['recipient_email'];
        $message = $validatedData['message_customer'];
        $shippingId = $request->input('shipping_id');

        $customer = Auth::guard('customer')->user();
        $carts = Cart::where('customer_id', $customer->id)->get();
        $couponId = session('coupon_id');
        $shippingPrice = $request->input('shipping_price');
        if ($request->query()) {
            $partnerCode = $request->query('partnerCode');
            $orderId = $request->query('orderId');
            $orderInfo = utf8_encode($request->query('orderInfo'));
            $amount = $request->query('amount');
            $requestId = $request->query('requestId');
            $extraData = $request->query('extraData');
            $rawHash = "partnerCode=" . $partnerCode . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&extraData=" . $extraData;
            $partnerSignature = hash_hmac("sha256", $rawHash, $secretKey);
            $events = session()->get('events', []);
            echo "<script>console.log('Debug huhu Objects: " . $rawHash . "' );</script>";
            echo "<script>console.log('Debug huhu Objects: " . $secretKey . "' );</script>";
            echo "<script>console.log('Debug huhu Objects: " . $partnerSignature . "' );</script>";


            if ($_GET["resultCode"] == '0') {
                if (Order::where('paymentId', $orderId)->exists()) {
                    return redirect()->route('checkout');
                } else {
                    $order = new Order();
                    $order->customer_id = $customer->id;
                    $order->paymentId = $orderId;
                    $order->recipient_name = $fullname_customer;
                    $order->recipient_phone = $phone_number_customer;
                    $order->recipient_address = $recipientAddress;
                    $order->recipient_email = $recipientEmail;
                    $order->message = $message;
                    $order->total_price = $amount;
                    $order->status = '1';
                    $order->payment_method = 'thanh toán momo ';
                    $order->shipping_id =  $shippingId;
                    $order->coupon_id = $couponId;
                    $order->save();

                    // Lưu chi tiết đơn hàng
                    foreach ($carts as $cart) {
                        $orderDetail = new OrderDetail();
                        $orderDetail->order_id = $order->id;
                        $orderDetail->product_id = $cart->product_id;
                        $orderDetail->quantity = $cart->quantity;
                        $orderDetail->sku_id = $cart->sku_id;

                        if ($cart->sku_id) {
                            $sku = Sku::findOrFail($cart->sku_id);
                            $orderDetail->price_detail = $sku->reduced_price ?? $sku->price;
                        } else {
                            $orderDetail->price_detail = $cart->product->reduced_price ?? $cart->product->price;
                        }
                        $orderDetail->subtotal_detail = $cart->quantity * $orderDetail->price_detail;

                        $orderDetail->save();
                    }
                    $carts->each->delete();
                }
            } else {
                return redirect()->route('checkout');
            }
        }



        return view('pages.checkout-success', compact('partnerCode', 'orderId', 'orderInfo', 'requestId', 'extraData', 'amount', 'order'));
    }
}
