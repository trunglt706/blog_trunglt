<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\payment\BaoKim\BaoKimPayment;
use App\payment\BaoKim\BaoKimPaymentPro;
use App\payment\NganLuong\NL_CheckOutV3;
use App\payment\PayPal\paypal;
use App\Http\Requests\RechargePayPalRequest;
use App\Http\Requests\RechargeRequest;
use App\Http\Requests\RechargeVNPayRequest;
use App\Http\Requests\RechargeBaoKimRequest;
use App\payment;

class PaymentController extends Controller {
    
    public function index() {
        return view('payment');
    }

    //================================================ ONEPAY.VN ========================//
    public function onepay() {
        return view('payment.onepay');
    }

    /**
     * @function user recharge - onepay.vn local
     * @param RechargeRequest $request
     * @return url
     */
    public function recharge_noidia(RechargeRequest $request) {
        try {
            $SECURE_SECRET = env('SECURE_SECRET_ND');
            unset($_POST['_token']);
            unset($_POST['type_payment']);

            $note = 'Người dùng ' . $request->$_POST['phone'] . ' thanh toán ' . $_POST['amount'] . ' VND';
            $id_nap = isset(Auth::user()->id) ? Auth::user()->id : null;
            $transaction_history = payment::add($_POST['amount'], $note, $id, $status, $tran_id, $id_nap, $phone, $auth);

            $vpcURL = env('virtualPaymentClientURL_ND') . "?";
            $_POST['vpc_MerchTxnRef'] = payment::gen_dev_trans_id(NULL);
            $_POST['vpc_Merchant'] = env('vpc_Merchant');
            $_POST['vpc_AccessCode'] = env('vpc_AccessCode');
            $_POST['vpc_OrderInfo'] = $transaction_history->developer_trans_id;
            $_POST['vpc_Locale'] = "vn";
            $_POST['vpc_Command'] = "pay";
            $_POST['vpc_Version'] = env('vpc_Version');
            $_POST['vpc_TicketNo'] = $_SERVER ['REMOTE_ADDR'];
            $_POST['vpc_ReturnURL'] = route('payment.pay.return.noidia');
            $_POST['amount'] = (float) ($_POST['amount'] * 100);
            $_POST['title'] = "Blog TrungLT - " . $note;

            $stringHashData = "";
            ksort($_POST);
            $appendAmp = 0;

            foreach ($_POST as $key => $value) {
                if (strlen($value) > 0) {
                    if ($appendAmp == 0) {
                        $vpcURL .= urlencode($key) . '=' . urlencode($value);
                        $appendAmp = 1;
                    } else {
                        $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                    }
                    if ((strlen($value) > 0) && ((substr($key, 0, 4) == "vpc_") || (substr($key, 0, 5) == "user_"))) {
                        $stringHashData .= $key . "=" . $value . "&";
                    }
                }
            }
            $stringHashData = rtrim($stringHashData, "&");
            if (strlen($SECURE_SECRET) > 0) {
                $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*', $SECURE_SECRET)));
            }
            return redirect()->to($vpcURL);
        } catch (\Exception $ex) {
            \Slack::send('[Payment NoiDia] - ' . $ex->getMessage());
            return redirect()->route('payment.onepay')->with('error', 'Lỗi, server không nhận được dữ liệu!');
        }
    }

    /**
     * @function handling when user recharge - onepay.vn local
     * @param Request $request
     * @return view
     */
    public function payReturnNoidia() {
        $flag = "success";
        $transStatus = "";
        try {
            $SECURE_SECRET = env('SECURE_SECRET_ND');

            $vpc_Txn_Secure_Hash = $_GET ["vpc_SecureHash"];
            unset($_GET ["vpc_SecureHash"]);

            ksort($_GET);
            if (strlen($SECURE_SECRET) > 0 && $_GET ["vpc_TxnResponseCode"] != "7" && $_GET ["vpc_TxnResponseCode"] != "No Value Returned") {
                $stringHashData = "";
                // sort all the incoming vpc response fields and leave out any with no value
                foreach ($_GET as $key => $value) {
                    if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0, 4) == "vpc_") || (substr($key, 0, 5) == "user_"))) {
                        $stringHashData .= $key . "=" . $value . "&";
                    }
                }
                $stringHashData = rtrim($stringHashData, "&");
                $hashValidated = (strtoupper($vpc_Txn_Secure_Hash) == strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*', $SECURE_SECRET)))) ? "CORRECT" : "INVALID HASH";
            } else {
                $hashValidated = "INVALID HASH";
            }
            $txnResponseCode = null2unknown($_GET ["vpc_TxnResponseCode"]);
            $amount = null2unknown($_GET ["vpc_Amount"]);
            $vpc_OrderInfo = null2unknown($_GET ["vpc_OrderInfo"]);

            if ($hashValidated == "CORRECT" && $txnResponseCode == "0") {
                $request['developer_trans_id'] = $vpc_OrderInfo;
                $request['status'] = 1;
                //update balance of user
                $pment = payment::where('developer_trans_id', $vpc_OrderInfo)->first();
                if ($pment->status != 1) {
                    $transStatus = "Giao dịch thành công. Bạn vừa nạp thêm vào tài khoản Storage: " . number_format(($amount / 100), 0) . " VNĐ";
                    //update transaction
                    payment::edit($request, $transStatus);
                } else {
                    $transStatus = "Lỗi, lệnh giao dịch này đã được thực hiện rồi. Vui lòng thực hiện lệnh giao dịch khác!";
                    $flag = "error";
                }
            } else {
                $transStatus = getResponseOnepayNoiDia($txnResponseCode);
                $flag = "error";
            }
        } catch (\Exception $ex) {
            \Slack::send('[Payment NoiDia] - ' . $ex->getMessage());
        }
        return redirect()->route('payment.onepay')->with($flag, $transStatus);
    }

    /**
     * @function user recharge - onepay.vn international
     * @param RechargeRequest $request
     * @return url
     */
    public function recharge_quocte(RechargeRequest $request) {
        try {
            $SECURE_SECRET = env('SECURE_SECRET_QT');
            unset($_POST['_token']);
            unset($_POST['type_payment']);
            unset($_POST['vpc_Currency']);

            $note = 'User (' . Auth::user()->name . ') have just paymented ' . $_POST['amount'] . ' VND in to your account';
            $user_nap = "user";
            $id_nap = Auth::user()->id;
            $transaction_history = payment::add((float) $_POST['amount'], 'Add', $note, Auth::id(), 0, NULL, $user_nap, $id_nap, Auth::user()->phone);

            $vpcURL = env('virtualPaymentClientURL_QT') . "?";
            $_POST['AgainLink'] = urlencode($_SERVER['HTTP_REFERER']);
            $_POST['vpc_MerchTxnRef'] = payment::gen_dev_trans_id(NULL);
            $_POST['vpc_Merchant'] = env('vpc_Merchant_QT');
            $_POST['vpc_AccessCode'] = env('vpc_AccessCode_QT');
            $_POST['vpc_OrderInfo'] = $transaction_history->developer_trans_id;
            $_POST['vpc_Locale'] = "en";
            $_POST['vpc_Command'] = "pay";
            $_POST['vpc_Version'] = env('vpc_Version');
            $_POST['vpc_TicketNo'] = $_SERVER ['REMOTE_ADDR'];
            $_POST['vpc_ReturnURL'] = route('payment.pay.return.quocte');
            $_POST['Title'] = "Kdata Storage - " . $note;
            $_POST['amount'] = (float) ($_POST['amount'] * 100);

            $md5HashData = "";
            ksort($_POST);
            $appendAmp = 0;

            foreach ($_POST as $key => $value) {
                if (strlen($value) > 0) {
                    if ($appendAmp == 0) {
                        $vpcURL .= urlencode($key) . '=' . urlencode($value);
                        $appendAmp = 1;
                    } else {
                        $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                    }
                    if ((strlen($value) > 0) && ((substr($key, 0, 4) == "vpc_") || (substr($key, 0, 5) == "user_"))) {
                        $md5HashData .= $key . "=" . $value . "&";
                    }
                }
            }
            $md5HashData = rtrim($md5HashData, "&");
            if (strlen($SECURE_SECRET) > 0) {
                $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*', $SECURE_SECRET)));
            }
            return redirect()->to($vpcURL);
        } catch (\Exception $ex) {
            \Slack::send('[Payment QuocTe] - ' . $ex->getMessage());
            return redirect()->route('payment.onepay')->with('error', 'Lỗi, server không nhận được dữ liệu!');
        }
    }

    /**
     * @function handling when user recharge - onepay.vn international
     * @param Request $request
     * @return view
     */
    public function payReturnQuocte(Request $request) {
        $flag = "success";
        $transStatus = "";
        try {
            $SECURE_SECRET = env('SECURE_SECRET_QT');

            $vpc_Txn_Secure_Hash = $_GET["vpc_SecureHash"];
            unset($_GET ["vpc_SecureHash"]);

            if (strlen($SECURE_SECRET) > 0 && $_GET["vpc_TxnResponseCode"] != "7" && $_GET["vpc_TxnResponseCode"] != "No Value Returned") {
                ksort($_GET);
                $md5HashData = "";
                // sort all the incoming vpc response fields and leave out any with no value
                foreach ($_GET as $key => $value) {
                    if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0, 4) == "vpc_") || (substr($key, 0, 5) == "user_"))) {
                        $md5HashData .= $key . "=" . $value . "&";
                    }
                }
                $md5HashData = rtrim($md5HashData, "&");
                $hashValidated = (strtoupper($vpc_Txn_Secure_Hash) == strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*', $SECURE_SECRET)))) ? "CORRECT" : "INVALID HASH";
            } else {
                $hashValidated = "INVALID HASH";
            }
            $txnResponseCode = null2unknown($_GET ["vpc_TxnResponseCode"]);
            $amount = null2unknown($_GET ["vpc_Amount"]);
            $vpc_OrderInfo = null2unknown($_GET ["vpc_OrderInfo"]);

            if ($hashValidated == "CORRECT" && $txnResponseCode == "0") {
                $req['status'] = 1;
                $req['developer_trans_id'] = $vpc_OrderInfo;

                //update balance of user
                $pment = payment::where('developer_trans_id', $vpc_OrderInfo)->first();
                if ($pment->status != 1) {
                    $transStatus = "Giao dịch thành công. Bạn vừa nạp thêm vào tài khoản Storage: " . number_format(($amount / 100), 0) . " VNĐ";
                    
                    //update transaction
                    payment::edit($req, $transStatus);
                } else {
                    $transStatus = "Lỗi, lệnh giao dịch này đã được thực hiện rồi. Vui lòng thực hiện lệnh giao dịch khác!";
                    $flag = "error";
                }
            } else {
                $transStatus = getResponseOnepayQuocTe($txnResponseCode);
                $flag = "error";
            }
        } catch (\Exception $ex) {
            \Slack::send('[Payment QuocTe] - ' . $ex->getMessage());
        }
        return redirect()->route('payment.onepay')->with($flag, $transStatus);
    }

    //================================================ END ONEPAY.VN ========================//
    //
    //
    //================================================ NGANLUONG.VN ========================//
    public function nganluong() {
        return view('payment.nganluong');
    }
    
    /**
     * @function user recharge nganluong.vn
     * @param RechargeRequest $request
     * @return view
     */
    public function recharge_nganluong(RechargeRequest $request) {
        try {
            $nlcheckout = new NL_CheckOutV3(env('NL_merchant_id'), env('NL_merchant_password'), env('NL_email_receiver'), env('NL_url_api'));
            $total_amount = $_POST['amount'];

            $note = 'User (' . Auth::user()->name . ') have just paymented ' . $_POST['amount'] . ' VND in to your account';
            $user_nap = "user";
            $id_nap = Auth::user()->id;
            $transaction_history = payment::add((float) $_POST['amount'], 'Add', $note, Auth::id(), 0, NULL, $user_nap, $id_nap, Auth::user()->phone);

            $array_items[0] = array(
                'item_name1' => 'Nạp tiền vào Kdata Storage qua nganluong.vn',
                'item_quantity1' => 1,
                'item_amount1' => $total_amount,
                'item_url1' => 'http://nganluong.vn/');

            $array_items = array();
            $payment_method = $_POST['option_payment'];
            $bank_code = @$_POST['bankcode'];
            $order_code = $transaction_history->developer_trans_id;

            $payment_type = '';
            $discount_amount = 0;
            $order_description = $note;
            $tax_amount = 0;
            $fee_shipping = 0;
            $return_url = route('payment.pay.return.nganluong');
            $cancel_url = route('payment.recharge.nganluong') . "?key=cancel";

            $buyer_fullname = Auth::user()->name;
            $buyer_email = Auth::user()->email;
            $buyer_mobile = $_POST['phone'];

            $buyer_address = '';

            if ($payment_method != '' && $buyer_email != "" && $buyer_mobile != "" && $buyer_fullname != "" && filter_var($buyer_email, FILTER_VALIDATE_EMAIL)) {
                switch ($payment_method) {
                    case "NL":
                        $nl_result = $nlcheckout->NLCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
                        break;
                    case "ATM_ONLINE":
                        if (isset($_POST['bankcode']) && ($_POST['bankcode'] != "")) {
                            $nl_result = $nlcheckout->BankCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
                            break;
                        } else {
                            return redirect()->route('payment.nganluong')->with("error", "Giao dịch thất bại. Vui lòng chọn loại ngân hàng phù hợp với phương thức thanh toán đã chọn!");
                        }
                    case "VISA":
                        if (isset($_POST['bankcode']) && ($_POST['bankcode'] != "")) {
                            $nl_result = $nlcheckout->VisaCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items, $bank_code);
                            break;
                        } else {
                            return redirect()->route('payment.nganluong')->with("error", "Giao dịch thất bại. Vui lòng chọn loại ngân hàng phù hợp với phương thức thanh toán đã chọn!");
                        }
                    default:
                        return redirect()->route('payment.nganluong')->with("error", "Giao dịch thất bại. Vui lòng chọn phương thức thanh toán trước khi thực hiện giao dịch!");
                }
                return redirect()->to($nl_result->checkout_url);
            } else {
                return redirect()->route('payment.nganluong')->with("error", "Giao dịch thất bại do thiếu thông tin khách hàng. Vui lòng kiểm tra lại hoặc liên hệ với Admin để được hỗ trợ!");
            }
        } catch (\Exception $ex) {
            \Slack::send('[Payment NganLuong] - ' . $ex->getMessage());
            return redirect()->route('payment.nganluong')->with('error', 'Lỗi, server không nhận được dữ liệu!');
        }
    }

    /**
     * @function handling when user recharge - nganluong.vn
     * @param Request $request
     * @return view
     */
    public function payReturnNganluong(Request $request) {
        $flag = "success";
        $transStatus = "";
        try {
            $nlcheckout = new NL_CheckOutV3(env('NL_merchant_id'), env('NL_merchant_password'), env('NL_email_receiver'), env('NL_url_api'));
            $nl_result = $nlcheckout->GetTransactionDetail($_GET['token']);
            $order_code = $nl_result->order_code;
            $amount = $nl_result->total_amount;

            if ($nl_result) {
                $nl_errorcode = (string) $nl_result->error_code;
                $nl_transaction_status = (string) $nl_result->transaction_status;
                if ($nl_errorcode == '00') {
                    if ($nl_transaction_status == '00') {
                        $req['status'] = 1;
                        $req['developer_trans_id'] = $order_code;
                        $datauser['updated_at'] = date("Y-m-d H:i:s");

                        //update balance of user
                        $pment = payment::where('developer_trans_id', $order_code)->first();
                        if ($pment->status != 1) {
                            $transStatus = "Giao dịch thành công. Bạn vừa nạp thêm vào tài khoản Storage: " . number_format($amount, 0) . " VNĐ";
                            
                            //update transaction
                            payment::edit($req, $transStatus);
                        } else {
                            $transStatus = "Lỗi, lệnh giao dịch này đã được thực hiện rồi. Vui lòng thực hiện lệnh giao dịch khác!";
                            $flag = "error";
                        }
                    }
                } else {
                    $transStatus = getResponseNganLuong($nl_errorcode);
                    $flag = "error";
                }
            }
        } catch (\Exception $ex) {
            \Slack::send('[Payment NganLuong] - ' . $ex->getMessage());
        }
        return redirect()->route('payment.nganluong')->with($flag, $transStatus);
    }

    //================================================ END NGANLUONG.VN ========================//
    //================================================ PAYPAL.COM ========================//
    public function paypal() {
        return view('payment.paypal');
    }
    
    /**
     * @function user recharge paypal.com
     * @param RechargeRequest $request
     * @return view
     */
    public function recharge_paypal(RechargePayPalRequest $request) {
        try {
            //Chuyển đổi sang tiền Việt
            $ty_gia_cf = configs::getConfig("ty_gia");
            $ty_gia = ($ty_gia_cf != null) ? $ty_gia_cf->giatri : 23000;
            $amountvn = $request['vpc_Amount'] * $ty_gia;
            $note = 'User (' . Auth::user()->name . ') have just paymented ' . $request['vpc_Amount'] . ' USD in to your account';
            $user_nap = "user";
            $id_nap = Auth::user()->id;
            $transaction_history = payment::add((float) $amountvn, 'Add', $note, Auth::id(), 0, NULL, $user_nap, $id_nap, Auth::user()->phone);
            $order_code = $transaction_history->developer_trans_id;
            $data = array(
                "vpc_Amount" => $request['vpc_Amount'],
                "vpc_Currency" => $request['vpc_Currency'],
                "orderCode" => "Payment for Kdata Storage with order code: " . $order_code,
                "developer_trans_id" => $order_code,
                "discription" => $note
            );
            $redirect_url = paypal::getUrl($data);
            if ($redirect_url != null) {
                return redirect()->to($redirect_url);
            } else {
                return redirect()->route('payment.paypal')->with("error", "Lỗi cấu hình, không nhận được đường dẫn đến paypal.");
            }
        } catch (\Exception $ex) {
            \Slack::send('[Payment Paypal] - ' . $ex->getMessage());
            return redirect()->route('payment.paypal')->with("error", "Lỗi, server không nhận được dữ liệu!");
        }
    }

    /**
     * @function handling when user recharge - paypal.com
     * @param Request $request
     * @return view
     */
    public function payReturnPayPal(Request $request) {
        $flag = "success";
        $transStatus = "";
        try {
            $paymentId = $request->input("paymentId");
            $PayerID = $request->input("PayerID");
            $result = paypal::getReturn($paymentId, $PayerID);
            if (isset($request['paymentId']) && isset($request['PayerID'])) {
                if ($result != null) {
                    if ($result->state == "approved") {
                        $req['status'] = 1;
                        $req['developer_trans_id'] = $result->transactions[0]->item_list->items[0]->sku;
                        $amount = $result->transactions[0]->amount->total;
                        //update balance of user
                        $pment = payment::where('developer_trans_id', $req['developer_trans_id'])->first();
                        if ($pment->status != 1) {
                            $transStatus = "Giao dịch thành công. Bạn vừa nạp thêm vào tài khoản Storage: " . $amount . " USD";
                            
                            //update transaction
                            payment::edit($req, $transStatus);
                        } else {
                            $transStatus = "Lỗi, lệnh giao dịch này đã được thực hiện rồi. Vui lòng thực hiện lệnh giao dịch khác!";
                            $flag = "error";
                        }
                    } else {
                        $transStatus = "Lỗi, không chấp nhận thanh toán!";
                        $flag = "error";
                    }
                } else {
                    $transStatus = "Lỗi, không thực thi được lệnh thanh toán trên paypal!";
                    $flag = "error";
                }
            } else {
                $transStatus = "Lỗi, không thực thi được lệnh thanh toán trên paypal!";
                $flag = "error";
            }
        } catch (\Exception $ex) {
            \Slack::send('[Payment Paypal] - ' . $ex->getMessage());
        }
        return redirect()->route('payment.paypal')->with($flag, $transStatus);
    }

    //================================================ END PAYPAL.COM ========================//
    //================================================ START BAOKIM.COM ========================//
    public function baokim() {
        return view('payment.baokim');
    }
    
    /**
     * @function user recharge baokim.vn
     * @param RechargeBaoKimRequest $request
     */
    public function rechargeBaoKim(RechargeBaoKimRequest $request) {
        try {
            $input = $request->only("vpc_Amount", "vpc_Currency", "method", "numberphone", "bank_payment_method_id", "method");
            if (($input['bank_payment_method_id'] != "0") && !empty($input['bank_payment_method_id'])) {
                $result = BaoKimPaymentPro::pay_by_card($input);
                if (!empty($result['error'])) {
                    echo '<p><strong style="color:red">' . $result['error'] . '</strong></p></div>';
                    die;
                }
                $baokim_url = isset($result['redirect_url']) ? $result['redirect_url'] : $result['guide_url'];
                echo "<script>window.location='" . $baokim_url . "'</script>";
            } else {
                $baokim_url = BaoKimPayment::createRequestUrl($input);
                echo "<script>window.location='" . $baokim_url . "'</script>";
            }
        } catch (\Exception $ex) {
            \Slack::send('[Payment Paypal] - ' . $ex->getMessage());
            return redirect()->route('payment.baokim')->with("error", "Lỗi, server không nhận được dữ liệu!");
        }
    }

    /**
     * @function get return from baokim.vn
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payReturnBaoKim(Request $request) {
        $flag = "success";
        $transStatus = "";
        try {
            $rs = BaoKimPayment::verifyResponseUrl($_GET);
            if ($rs == TRUE) {
                $transStatus = $_GET['transaction_status'];
                $amount = $_GET['total_amount'];
                if (($transStatus == "4") || ($transStatus == "13")) {
                    $req['status'] = 1;
                    $req['developer_trans_id'] = $_GET['order_id'];
                    $datauser['updated_at'] = date("Y-m-d H:i:s");

                    //update balance of user
                    $pment = payment::where('developer_trans_id', $_GET['order_id'])->first();
                    if ($pment->status != 1) {
                        $transStatus = "Giao dịch thành công. Bạn vừa nạp thêm vào tài khoản Storage: " . number_format($amount, 0) . " VNĐ";
                        
                        //Update table transaction
                        payment::edit($req, $transStatus);
                    } else {
                        $transStatus = "Lỗi, lệnh giao dịch này đã được thực hiện rồi. Vui lòng thực hiện lệnh giao dịch khác!";
                        $flag = "error";
                    }
                } else {
                    $transStatus = getResponseBaoKim($transStatus);
                    $flag = "error";
                }
            } else {
                $transStatus = "Lỗi giao dịch!";
                $flag = "error";
            }
        } catch (\Exception $ex) {
            \Slack::send('[Payment BaoKim] - ' . $ex->getMessage());
        }
        return redirect()->route('payment.baokim')->with($flag, $transStatus);
    }
    //================================================ END BAOKIM.COM ========================//
    //================================================ START VNPAY.VN ========================//
    public function vnpay() {
        return view('payment.vnpay');
    }
    
    /**
     * @function user recharge vnpay.vn
     * @param RechargeVNPayRequest $request
     */
    public function recharge_vnpay(RechargeVNPayRequest $request) {
        try {
            
        } catch (\Exception $ex) {
            \Slack::send('[Payment VNPay] -  '. $ex->getMessage());
            return redirect()->route('payment.baokim')->with("error", "Lỗi, server không nhận được dữ liệu!");
        }
    }

    /**
     * @function get return from vnpay.vn
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payReturnvnpay(Request $request) {
        $flag = "success";
        $transStatus = "";
        try {
            
        } catch (\Exception $ex) {
            \Slack::send('[Payment BaoKim] - ' . $ex->getMessage());
        }
        return redirect()->route('payment.baokim')->with($flag, $transStatus);
    }
    //================================================ END VNPAY.VN ========================//
}
