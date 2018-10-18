<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model {

    protected $table = 'payment';

    /**
     * @function insert data to transaction_history table
     * @param string $amount
     * @param string $note
     * @param int $id
     * @param int $status
     * @param string $tran_id
     * @param int $id_nap
     * @param string $phone
     * @param string $auth
     * @return \App\payment
     */
    public static function add($amount, $note, $id = null, $status = 2, $tran_id = NULL, $id_nap = null, $phone, $auth = 'auth') {
        $trans_his = new payment();
        $trans_his->id_nap = $id_nap;
        $trans_his->id_nhan = $id;
        $trans_his->developer_trans_id = self::gen_dev_trans_id($tran_id);
        $trans_his->phone = $phone;
        $trans_his->amount = $amount;
        $trans_his->note = $note;
        $trans_his->auth = $auth;
        $trans_his->status = $status;
        $trans_his->save();
        return $trans_his;
    }

    /**
     * @function update transaction of user
     * @param array $request
     * @param string $note
     */
    public static function edit($request, $note) {
        $trans_his = payment::where('developer_trans_id', $request['developer_trans_id'])->firstOrFail();
        $trans_his->status = $request['status'];
        if (!$request['status']) {
            $trans_his->note = $note;
        }
        $trans_his->save();
    }

    /**
     * @function generate transaction_id
     * @param string $tran_id
     * @return string
     */
    public static function gen_dev_trans_id($tran_id) {
        $company = 'TLT';
        $date = date('ymd');
        $rand = substr(md5(microtime()), rand(0, 22), 9);
        if (!is_null($tran_id)) {
            return $company . $date . $tran_id;
        }
        return $company . $date . $rand;
    }

}
