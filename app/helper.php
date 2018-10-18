<?php

use App\admins;
use App\users;

define('PRIVATE_KEY_BAOKIM', '-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCv3ZWFmSEHVA3t
19pxEnx+qdjm4IubJ9oNLVjnIRpLiYKGAmoyzaLU0izTPUSqCek+zDNfkQMNEr6s
2g9E287AvtIyPv1dgkkgoKXdLy29vII0/aZQMJPNirPl2fbGpp/v7ZN3nfvaKrU4
NI7XMLvjyOklQ9dKiloCK9JIZyL5wPOtdUTxz187rR4dzLyEs+an682tfPA16LIV
GDawoxEez6eAM8F3J2oJGNIvkn8lOtfeHw+1LdskyOXQYZdkXybnDnAro1fdzfkH
+TWKPN//hJ4sKLINGKlKTs8V2UDtmjc3O8ndPdfvqzQ6CJfhLCialCWOzFuNG6Wy
MfVv2u+VAgMBAAECggEAOBj9ff0njPfh7ZFiC5ly/tBc8OCFh7uBkZx6dFeZ1KiL
awXQLF5t52cXh1ZO1dKNhUuLw5s1FvF4wxhXsIZRACieUgrHtRE/FFpKLjDDbXd5
LUAP0hp8ux7YXaRWVG2ILPdih9BsKt5eqgwR2FCiTnmi7REj1pIlPfYOgKvtey7q
5f+/LIwDR+188C5i+nO8TbEEXVbd58eA3M5hDcbj3pvxMvaFMgESHNIZKwLpndjg
XPFaHRIcfmttzP+v9eafMv7fDxdKTH7zJ756X1jYegEWSD9qQAL9OzxHgp6psdgB
AEIT5/KVJAXugrBy+kKx9sx8DhKEaZn1yU4747DPLQKBgQDYzp6MJ+u34PYhVn7z
AKCA2sSQuc7LVqXeHEJmSYjoO+crIQ6w4xZOpwGwd6RIufiZBKrX0r7WSbV0OqkH
0HLtrZDityc6z0ddGjywrf4EIiga2eykARewBZiP79prckLft0fQe3U4ZV/K+2ha
gcjBkJ3ZKva9j8ppSPj1nIGB1wKBgQDPqEaGSHXY2lgYhP0MVNWuc2+ikFOembYz
ZntX4H8IhtJMdGg0+pxKycxPP07De2318JDAIH41jRU6mHuHJTzGkjX/zrVI4yj+
YIJcpaN1+xmGR9dvycmVJ9eVQzyJekqudF4SBTYNHwHxCzS8vtlQtWk9blJ4W0Nb
TdpWGUPEcwKBgBuxUJkQZFBpYKbjeHWrh9TNnLvrr9lTKP6U13pfPCiFtkJRB6Ja
bzf+pv2WWpqbfoB1EylcFtoiMhY1g++mlXd8avw6br1ZSoE+36+lmcOHZV4ApfRQ
22i1XkZMWbbNsnMG4xpjGpbog/LWZ/7fgvgOc8sQbNHLswv9sScWJYijAoGAGCdj
pKTzCDlFe/ykDnYjsLn+pzMQduc8OThXan5TaGN+PKRhpp/r5Asa97DOcZB+1teX
jrF43LO/X2RzIeIj8pj5LPsXPRYnI4eIQkyF+eguLN9YYMlg6DeNLPB4LymJXEdu
1bvDcL1FlYsPJFEyp9+iESIu947uA8XHerJPnp8CgYEAgTnqYPBjKbIQgGUIOM4N
rZCztBqitNkhow2/Cl1GvtB1XieDZfSDSVdW9lArzvL5InAWUPbu8BUzbxh7OP4z
9CgCSFp7EvABLYQF+ePuSUX/pEzV/MCyF6Ybh+FuKSz2O4t5t508Z7frfZ/v7Q35
PuEFmGRIQ3Zt2tsGC7p0Ez4=
-----END PRIVATE KEY-----');

/**
 * @function active menu haven't sup item
 * @param Route $route
 * @param string $output
 * @return string
 */
function isActiveRoute($route, $output = "active") {
    if (Route::currentRouteName() == $route) {
        return $output;
    }
}

/**
 * @function active menu have sup item
 * @param array $routes
 * @param string $output
 * @return string
 */
function areActiveRoutes(Array $routes, $output = "active") {
    foreach ($routes as $route) {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }
}

/**
 * @function get info from username
 * @param $username
 * @return null
 */
function getUser($username) {
    $rs = null;
    $admin = admins::where('username', $username)->first();
    if (!is_null($admin)) {
        $rs = $admin;
    }
    $user = users::where('username', $username)->where('status', 1)->first();
    if (!is_null($user)) {
        $rs = $user;
    }
    return $rs;
}

/**
 * @function get response of nganluong.vn
 * @param type $responseCode
 * @return string
 */
function getResponseNganLuong($responseCode) {
    switch ($responseCode) {
        case "0" :
            $result = "Giao dịch thành công - Approved";
            break;
        case "1" :
            $result = "Ngân hàng từ chối giao dịch - Bank Declined";
            break;
        case "3" :
            $result = "Mã đơn vị không tồn tại - Merchant not exist";
            break;
        case "4" :
            $result = "Không đúng access code - Invalid access code";
            break;
        case "5" :
            $result = "Số tiền không hợp lệ - Invalid amount";
            break;
        case "6" :
            $result = "Mã tiền tệ không tồn tại - Invalid currency code";
            break;
        case "7" :
            $result = "Lỗi không xác định - Unspecified Failure";
            break;
        case "8" :
            $result = "Số thẻ không đúng - Invalid card Number";
            break;
        case "9" :
            $result = "Tên chủ thẻ không đúng - Invalid card name";
            break;
        case "10" :
            $result = "Thẻ hết hạn/Thẻ bị khóa - Expired Card";
            break;
        case "11" :
            $result = "Thẻ chưa đăng ký sử dụng dịch vụ - Card Not Registed Service(internet banking)";
            break;
        case "12" :
            $result = "Ngày phát hành/Hết hạn không đúng - Invalid card date";
            break;
        case "13" :
            $result = "Vượt quá hạn mức thanh toán - Exist Amount";
            break;
        case "21" :
            $result = "Số tiền không đủ để thanh toán - Insufficient fund";
            break;
        case "99" :
            $result = "Người sủ dụng hủy giao dịch - User cancel";
            break;
        default :
            $result = "Lỗi không xác định - Unspecified Failure";
    }
    return $result;
}

//  -----------------------------------------------------------------------------
// If input is null, returns string "No Value Returned", else returns input
function null2unknown($data) {
    if ($data == "") {
        return "No Value Returned";
    } else {
        return $data;
    }
}

/**
 * @function generate image of bank
 * @param object $banks
 * @param integer $payment_method_type
 * @return string
 */
function generateBankImage($banks, $payment_method_type) {
    $html = '';
    foreach ($banks as $bank) {
        if ($bank['payment_method_type'] == $payment_method_type) {
            $html .= '<li><img onclick="selectbank(' . $payment_method_type . ')" class="img-bank ' . $payment_method_type . '"  id="' . $bank['id'] . '" src="' . $bank['logo_url'] . '" title="' . $bank['name'] . '"/></li>';
        }
    }
    return $html;
}

/**
 * @function get response of baokim.vn
 * @param type $response
 * @return string
 */
function getResponseBaoKim($response) {
    $result = "";
    switch ($response) {
        case "1":
            $result = 'Giao dịch chưa xác minh OTP';
            break;
        case "2":
            $result = 'Giao dịch đã xác minh OTP';
            break;
        case "4":
            $result = 'Giao dịch thành công';
            break;
        case "5":
            $result = 'Giao dịch bị hủy';
            break;
        case "6":
            $result = 'Giao dịch bị từ chối nhận tiền';
            break;
        case "7":
            $result = 'Giao dịch hết hạn';
            break;
        case "8":
            $result = 'Giao dịch thất bại';
            break;
        case "12":
            $result = 'Giao dịch bị đóng băng';
            break;
        case "13":
            $result = 'Giao dịch bị tạm giữ (thanh toán an toàn)';
            break;
        default:
            $result = 'Giao dịch thất bại!';
            break;
    }
    return $result;
}

/**
 * @function get response of onepay.vn noidia
 * @param type $response
 * @return string
 */
function getResponseOnepayNoiDia($response) {
    $result = "";
    switch ($response) {
        case "0":
            $result = 'Giao dịch thanh toán thành công';
            break;
        case "1":
            $result = 'Ngân hàng từ chối giao dịch. Tư vấn khách liên hệ Ngân hàng phát hành bằng số điện thoại sau mặt thẻ.';
            break;
        case "3":
            $result = 'Đơn vị chấp nhận thẻ đã đóng cổng thanh toán. Liên hệ bộ phận kĩ thuật của đơn vị chấp nhận thẻ hoặc OnePAY yêu cầu hỗ trợ.';
            break;
        case "4":
            $result = 'Lỗi phát sinh trong quá trình cập nhật hệ thống của đơn vị chấp nhận thẻ. Liên hệ bộ phận kĩ thuật của đơn vị chấp nhận thẻ hoặc OnePAY yêu cầu hỗ trợ.';
            break;
        case "5":
            $result = 'Số tiền không hợp lệ (tiền lẻ số thập phân....)';
            break;
        case "6":
            $result = 'Sai mã tiền tệ. Liên hệ bộ phận kĩ thuật của đơn vị chấp nhận thẻ hoặc OnePAY yêu cầu hỗ trợ.';
            break;
        case "7":
            $result = 'Lỗi không xác định. Liên hệ bộ phận kĩ thuật của đơn vị chấp nhận thẻ hoặc OnePAY yêu cầu hỗ trợ.';
            break;
        case "8":
            $result = 'Số thẻ không đúng ';
            break;
        case "9":
            $result = 'Tên chủ thẻ không đúng';
            break;
        case "10":
            $result = 'Thẻ hết hạn/Thẻ bị khóa';
            break;
        case "11":
            $result = 'Thẻ chưa đăng ký sử dụng dịch vụ';
            break;
        case "12":
            $result = 'Ngày phát hành/Hết hạn không đúng.';
            break;
        case "13":
            $result = 'Vượt quá hạn mức thanh toán';
            break;
        case "21":
            $result = 'Số dư tài khoản không đủ để thanh toán';
            break;
        case "22":
            $result = 'Thông tin tài khoản không đúng';
            break;
        case "23":
            $result = 'Tài khoản bị khóa';
            break;
        case "24":
            $result = 'Thông tin thẻ không đúng';
            break;
        case "25":
            $result = 'OTP không đúng';
            break;
        case "253":
            $result = 'Quá thời gian thanh toán';
            break;
        case "99":
            $result = 'Người sử dụng hủy giao dịch';
            break;
        default:
            $result = 'Lỗi không xác định. Liên hệ bộ phận kĩ thuật của đơn vị chấp nhận thẻ hoặc OnePAY yêu cầu hỗ trợ';
            break;
    }
    return $result;
}

/**
 * @function get response of onepay.vn quocte
 * @param type $response
 * @return string
 */
function getResponseOnepayQuocTe($response) {
    $result = "";
    switch ($response) {
        case "0":
            $result = 'Giao dịch thành công - Successful Transaction';
            break;
        case "1":
            $result = 'Ngân hàng phát hành không cấp phép hoặc thẻ chưa đăng ký sử dụng / không được kích hoạt dịch vụ thanh toán Internet. Vui lòng liên hệ Ngân hàng phát hành - Unauthorized transaction with unspecified failure. Please contact Issuer Bank by the phone number behind the card surface.';
            break;
        case "2":
            $result = 'Ngân hàng từ chối cấp phép (thẻ chưa đăng ký sử dụng dịch vụ thanh toán Interner, thẻ không đủ hạn mức/ tài khoản không đủ giá trị thanh toán, thông tin CSC không đúng…..). Vui lòng liên hệ Ngân hàng phát hành - Issuer Bank declined transactions. Please recheck card expiry date, CSC, credit limit/ balance....or contact Issuer Bank by the phone number behind the card surface';
            break;
        case "3":
            $result = 'Cổng thanh toán không nhận được kết quả trả về từ Ngân hàng phát hành - OnePAY did not receive authorized results of Issuer Bank. Please contact Issuer Bank by the phone number behind the card surface.';
            break;
        case "4":
            $result = 'Thẻ hết hạn thanh toán - Payment card is expired';
            break;
        case "5":
            $result = 'Không đủ hạn mức hoặc tài khoản không đủ giá trị thanh toán - Account/credit does not have enough money to cover a payment';
            break;
        case "6":
            $result = 'Lỗi từ Ngân hàng phát hành. Vui lòng liên hệ Ngân hàng phát hành - Error from Issuer Bank. Please contact Issuer Bank by the phone number behind the card surface.';
            break;
        case "7":
            $result = 'Lỗi hệ thống khi xin cấp phép. Vui lòng liên hệ Ngân hàng phát hành - Error when payment system processes the transaction. Please contact Issuer Bank by the phone number behind the card surface.';
            break;
        case "8":
            $result = 'Ngân hàng phát hành không hỗ trợ giao dịch Internet - Issuer Bank does not support Internet transaction. Please contact Issuer Bank by the phone number behind the card surface';
            break;
        case "9":
            $result = 'Không kết nối được với Ngân hàng phát hành/ Ngân hàng từ chối. Vui lòng liên hệ Ngân hàng phát hành - Cannot connect to Issuer Bank. Transaction was declined. Please contact Issuer Bank by the phone number behind the card surface';
            break;
        case "99":
            $result = 'Giao dịch thất bại. Người dùng hủy giao dịch - User cancel';
            break;
        case "E":
            $result = 'Thông tin CSC không đúng/ vượt hạn mức thanh toán của thẻ - Wrong CSC entered';
            break;
        case "I":
            $result = 'Xác thực CSC lỗi - CSC verification failed. Please contact Issuer Bank by the phone number behind the card surface.';
            break;
        case "U":
            $result = 'Thông tin CSC không đúng - Wrong CSC enter.';
            break;
        case "B":
            $result = 'Không xác thực được 3D-Secure. Liên hệ OnePAY - Your transaction did not pass 3D Secure Password so OnePAY system did not send it to Issuer Bank to authorize. Please require Issuer Bank to check your transactions in authentication system, not in their authorisation log.';
            break;
        case "OP":
            $result = 'Thông tin thẻ chưa được xử lý do mất kết nối Internet/ tắt trình duyệt Web trong khi giao dịch hoặc không qua xác thực 3D-Secure (không nhập/ nhập sai mật khẩu tại trang xác thực của Ngân hàng phát hành) - Your transaction did not pass 3D Secure Password so OnePAY system did not send it to Issuer Bank to authorize. Please require Issuer Bank to check your transactions in authentication system, not in their authorisation log.';
            break;
        case "F":
            $result = 'Không xác thực được 3D-Secure (Chủ thẻ không tham gia, không nhập hoặc nhập sai mật khẩu).Vui lòng liên hệ Ngân hàng phát hành - Your transaction did not pass 3D Secure Password so OnePAY system did not send it to Issuer Bank to authorize. Please require Issuer Bank to check your transactions in authentication system, not in their authorisation log.';
            break;
        default:
            $result = 'Giao dịch không thành công - Transaction was failed';
            break;
    }
    return $result;
}

/**
 * @function get response of vnpay.vn
 * @param type $response
 * @return string
 */
function getResponseVNPay($response) {
    $result = "";
    switch ($response) {
        case "00":
            $result = 'Giao dịch thành công';
            break;
        case "01":
            $result = 'Giao dịch đã tồn tại';
            break;
        case "02":
            $result = 'Merchant không hợp lệ (kiểm tra lại vnp_TmnCode)';
            break;
        case "03":
            $result = 'Dữ liệu gửi sang không đúng định dạng';
            break;
        case "04":
            $result = 'Khởi tạo GD không thành công do Website đang bị tạm khóa';
            break;
        case "05":
            $result = 'Giao dịch không thành công do: Quý khách nhập sai mật khẩu quá số lần quy định. Xin quý khách vui lòng thực hiện lại giao dịch';
            break;
        case "06":
            $result = 'Giao dịch không thành công do Quý khách nhập sai mật khẩu xác thực giao dịch (OTP). Xin quý khách vui lòng thực hiện lại giao dịch';
            break;
        case "07":
            $result = 'Giao dịch bị nghi ngờ là giao dịch gian lận';
            break;
        case "09":
            $result = 'Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng chưa đăng ký dịch vụ InternetBanking tại ngân hàng';
            break;
        case "10":
            $result = 'Giao dịch không thành công do: Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần';
            break;
        case "11":
            $result = 'Giao dịch không thành công do: Đã hết hạn chờ thanh toán. Xin quý khách vui lòng thực hiện lại giao dịch';
            break;
        case "12":
            $result = 'Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng bị khóa';
            break;
        case "51":
            $result = 'Giao dịch không thành công do: Tài khoản của quý khách không đủ số dư để thực hiện giao dịch';
            break;
        case "65":
            $result = 'Giao dịch không thành công do: Tài khoản của Quý khách đã vượt quá hạn mức giao dịch trong ngày';
            break;
        case "08":
            $result = 'Giao dịch không thành công do: Hệ thống Ngân hàng đang bảo trì. Xin quý khách tạm thời không thực hiện giao dịch bằng thẻ/tài khoản của Ngân hàng này';
            break;
        case "99":
            $result = 'Các lỗi khác (lỗi còn lại, không có trong danh sách mã lỗi đã liệt kê)';
            break;
        default:
            $result = 'Các lỗi khác (lỗi còn lại, không có trong danh sách mã lỗi đã liệt kê)';
            break;
    }
    return $result;
}