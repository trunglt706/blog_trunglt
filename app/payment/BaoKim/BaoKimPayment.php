<?php
namespace App\payment\BaoKim;

use Illuminate\Support\Facades\Auth;
use App\Transaction_history;

class BaoKimPayment extends \App\Http\Controllers\Controller {
    
    /**
     * Cấu hình phương thức thanh toán với các tham số
     * E-mail Bảo Kim - E-mail tài khoản bạn đăng ký với BaoKim.vn.
     * Merchant ID - là “mã website” được Baokim cấp khi bạn đăng ký tích hợp.
     * Mã bảo mật - là “mật khẩu” được Baokim cấp khi bạn đăng ký tích hợp
     * Vd : 12f31c74fgd002b1
     * Server Bảo Kim
     * Trang ​Kiểm thử - server để test thử phương thức thanh. .toán
     * Trang thực tế - Server thực tế thực hiện thanh toán.
     * https://www.baokim.vn/payment/order/version11' => ('Trang thực tế'),
     * http://kiemthu.baokim.vn/payment/order/version11' => ('Trang kiểm thử')
     * Chọn Save configuration để áp dụng thay đổi
     * Hàm xây dựng url chuyển đến BaoKim.vn thực hiện thanh toán, trong đó có tham số mã hóa (còn gọi là public key)
     * @param $order_id                Mã đơn hàng
     * @param $business            Email tài khoản người bán
     * @param $total_amount            Giá trị đơn hàng
     * @param $shipping_fee            Phí vận chuyển
     * @param $tax_fee                Thuế
     * @param $order_description    Mô tả đơn hàng
     * @param $url_success            Url trả về khi thanh toán thành công
     * @param $url_cancel            Url trả về khi hủy thanh toán
     * @param $url_detail            Url chi tiết đơn hàng
     * @param null $payer_name
     * @param null $payer_email
     * @param null $payer_phone_no
     * @param null $shipping_address
     * @return url cần tạo
     */
    public static function createRequestUrl($data) {
        $note = 'User (' . Auth::user()->name . ') have just paymented ' . $data['vpc_Amount'] . ' '.$data['vpc_Currency'].' in to your account';
        $user_nap = "user";
        $id_nap = Auth::user()->id;
        $transaction_history = Transaction_history::add((float) $data['vpc_Amount'], 'Add', $note, Auth::id(), 0, NULL, $user_nap, $id_nap, Auth::user()->phone);
        
        $order_id = $transaction_history->developer_trans_id;
        $total_amount = str_replace('.', '', $data['vpc_Amount']);
        $url_success = route('user.pay.return.baokim');
        $url_cancel = route('user.recharge.baokim')."?key=cancel";
        $currency = 'VND'; // USD
        // Mảng các tham số chuyển tới baokim.vn
        $params = array(
            'merchant_id' => strval(env('BK_MERCHANT_ID')),
            'order_id' => strval($order_id),
            'business' => strval(env('BK_EMAIL_BUSINESS')),
            'total_amount' => strval($total_amount),
            'shipping_fee' => strval('0'),
            'tax_fee' => strval('0'),
            'order_description' => $note.' with order_id = '.$order_id,
            'url_success' => strtolower($url_success),
            'url_cancel' => strtolower($url_cancel),
            'url_detail' => strtolower(''),
            'payer_name' => strval(Auth::user()->name),
            'payer_email' => strval(Auth::user()->email),
            'payer_phone_no' => strval($data['numberphone']),
            'shipping_address' => '',
            'currency' => strval($currency),
        );
        ksort($params);
        $params['checksum'] = hash_hmac('SHA1', implode('', $params), env('BK_SECURE_PASS'));
        //Kiểm tra  biến $redirect_url xem có '?' không, nếu không có thì bổ sung vào
        $redirect_url = env('BK_BAOKIM_API_PAYMENT');
        if (strpos($redirect_url, '?') === false) {
            $redirect_url .= '?';
        } else if (substr($redirect_url, strlen($redirect_url) - 1, 1) != '?' && strpos($redirect_url, '&') === false) {
            // Nếu biến $redirect_url có '?' nhưng không kết thúc bằng '?' và có chứa dấu '&' thì bổ sung vào cuối
            $redirect_url .= '&';
        }
        // Tạo đoạn url chứa tham số
        $url_params = '';
        foreach ($params as $key => $value) {
            if ($url_params == '') {
                $url_params .= $key . '=' . urlencode($value);
            } else {
                $url_params .= '&' . $key . '=' . urlencode($value);
            }
        }
        return $redirect_url . $url_params;
    }

    /**
     * Hàm thực hiện xác minh tính chính xác thông tin trả về từ BaoKim.vn
     * @param $url_params chứa tham số trả về trên url
     * @return true nếu thông tin là chính xác, false nếu thông tin không chính xác
     */
    public static function verifyResponseUrl($url_params = array()) {
        if (empty($url_params['checksum'])) {
            echo "invalid parameters: checksum is missing";
            return FALSE;
        }
        $checksum = $url_params['checksum'];
        unset($url_params['checksum']);
        ksort($url_params);
        if (strcasecmp($checksum, hash_hmac('SHA1', implode('', $url_params), env('BK_SECURE_PASS'))) === 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}