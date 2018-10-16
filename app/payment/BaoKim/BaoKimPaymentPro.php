<?php
namespace App\payment\BaoKim;

use App\payment\BaoKim\CallRestful;
use Illuminate\Support\Facades\Auth;
use App\Transaction_history;

class BaoKimPaymentPro extends \App\Http\Controllers\Controller{

    /**
     * Call API GET_SELLER_INFO
     *  + Create bank list show to frontend
     *
     * @internal param $method_code
     * @return string
     */
    public static function get_seller_info() {
        $param = array(
            'business' => env('BK_EMAIL_BUSINESS'),
        );
        $call_API = CallRestful::call_API("GET", $param, env('BK_BAOKIM_API_SELLER_INFO'));
        if (is_array($call_API)) {
            if (isset($call_API['error'])) {
                echo "<strong style='color:red'>call_API" . json_encode($call_API['error']) . "- code:" . $call_API['status'] . "</strong> - " . "System error. Please contact to administrator";
                die;
            }
        }
        $seller_info = json_decode($call_API, true);
        if (!empty($seller_info['error'])) {
            echo "<strong style='color:red'>eller_info" . json_encode($seller_info['error']) . "</strong> - " . "System error. Please contact to administrator";
            die;
        }
        $banks = $seller_info['bank_payment_methods'];
        return $banks;
    }

    /**
     * Call API PAY_BY_CARD
     *  + Get Order info
     *  + Sent order, action payment
     *
     * @param $data
     * @return mixed
     */
    public static function pay_by_card($data) {
        $note = 'User (' . Auth::user()->name . ') have just paymented ' . $data['vpc_Amount'] . ' '.$data['vpc_Currency'].' in to your account';
        $user_nap = "user";
        $id_nap = Auth::user()->id;
        $transaction_history = Transaction_history::add((float) $data['vpc_Amount'], 'Add', $note, Auth::id(), 0, NULL, $user_nap, $id_nap, Auth::user()->phone);
        
        $url_success = route('user.pay.return.baokim');
        $url_cancel = route('user.recharge.baokim')."?key=cancel";
        $order_id = $transaction_history->developer_trans_id;
        $total_amount = str_replace('.', '', $data['vpc_Amount']);

        $params['business'] = strval(env('BK_EMAIL_BUSINESS'));
        $params['bank_payment_method_id'] = intval($data['bank_payment_method_id']);
        $params['transaction_mode_id'] = '1'; // 2- trực tiếp
        $params['escrow_timeout'] = 3;

        $params['order_id'] = $order_id;
        $params['total_amount'] = $total_amount;
        $params['shipping_fee'] = '0';
        $params['tax_fee'] = '0';
        $params['currency_code'] = 'VND'; // USD

        $params['url_success'] = $url_success;
        $params['url_cancel'] = $url_cancel;
        $params['url_detail'] = '';

        $params['order_description'] = $note.' with order_id = '.$order_id;
        $params['payer_name'] = Auth::user()->name;
        $params['payer_email'] = Auth::user()->email;
        $params['payer_phone_no'] = $data['numberphone'];
        $params['payer_address'] = '';

        $result = json_decode(CallRestful::call_API("POST", $params, env('BK_BAOKIM_API_PAY_BY_CARD')), true);
        return $result;
    }

}