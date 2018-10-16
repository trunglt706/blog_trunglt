<?php

namespace App\payment\PayPal;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class paypal extends \App\Http\Controllers\Controller{
    
    private $apiContext;

    public function __construct() {
        $this->apiContext = new ApiContext(
                new OAuthTokenCredential(
                Config::get('paypal.ClientId'), Config::get('paypal.ClientSecret')
                )
        );
        $this->apiContext->setConfig(Config::get('paypal.settings'));        
    }
    
    public static function getReturn($paymentId, $PayerID) {
        $paypal = new paypal();
        $execution = new PaymentExecution();
        $execution->setPayerId($PayerID);
        
        try {
            $payment = Payment::get($paymentId, $paypal->apiContext);
            $result = $payment->execute($execution, $paypal->apiContext);
            return $result;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return null;
        }
    }

    public static function getUrl($data = null) {
        $paypal = new paypal();
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        // ### Itemized information
        // (Optional) Lets you specify item wise
        // information
        $item1 = new Item();
        $item1->setName($data['orderCode'])
                ->setCurrency($data['vpc_Currency'])
                ->setQuantity(1)    //số lượng
                ->setSku($data['developer_trans_id']) // Similar to `item_number` in Classic API
                ->setPrice($data['vpc_Amount']);    // giá
        $itemList = new ItemList();
        $itemList->setItems(array($item1));
        // ### Additional payment details
        // Use this optional field to set additional
        // payment information such as tax, shipping
        // charges etc.
        $details = new Details();
        $details->setShipping(0)
                ->setTax(0)
                ->setSubtotal($data['vpc_Amount']); // tổng tiền
        // ### Amount
        // Lets you specify a payment amount.
        // You can also specify additional details
        // such as shipping, tax.
        $amount = new Amount();
        $amount->setCurrency($data['vpc_Currency'])
                ->setTotal($data['vpc_Amount'])  // tổng thanh toán
                ->setDetails($details);
        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. 
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription($data['discription'])
                ->setInvoiceNumber(uniqid());
        // ### Redirect urls
        // Set the urls that the buyer must be redirected to after 
        // payment approval/ cancellation.
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('user.pay.return.paypal'))
                ->setCancelUrl(route('user.pay.return.paypal').'?key=cancel');
        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent set to 'sale'
        $payment = new Payment();
        $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));
        // ### Create Payment
        // Create a payment by calling the 'create' method
        // passing it a valid apiContext.
        // (See bootstrap.php for more on `ApiContext`)
        // The return object contains the state and the
        // url to which the buyer must be redirected to
        // for payment approval
        try {
            $payment->create($paypal->apiContext);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
        // ### Get redirect url
        // The API response provides the url that you must redirect
        // the buyer to. Retrieve the url from the $payment->getApprovalLink()
        // method
        $approvalUrl = $payment->getApprovalLink();
        return $approvalUrl;
    }

}
