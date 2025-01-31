<?php

namespace Anand\LaravelPaytmWallet\Providers;

use Anand\LaravelPaytmWallet\Traits\HasTransactionStatus;


class RefundStatusCheckProvider extends PaytmWalletProvider
{
    use HasTransactionStatus;

    protected $response;
    private $parameters = null;

    public function prepare($params = array())
    {
        $defaults = [
            'order' => NULL,
            'reference' => NULL,
        ];

        $_p = array_merge($defaults, $params);
        foreach ($_p as $key => $value) {

            if ($value == NULL) {

                throw new \Exception(' \'' . $key . '\' parameter not specified in array passed in prepare() method');

                return false;
            }
        }
        $this->parameters = $_p;
        return $this;
    }


    public function check()
    {
        if ($this->parameters == null) {
            throw new \Exception("prepare() method not called");
        }
        return $this->beginTransaction();
    }


    private function beginTransaction()
    {
        $params = array(
            'MID' => $this->merchant_id,
            'ORDERID' => $this->parameters['order'],
            'REFID' => $this->parameters['reference']
        );
        $chk = getChecksumFromArray($params, $this->merchant_key);
        $params['CHECKSUM'] = $chk;
        $this->response = $this->api_call_new($this->paytm_txn_status_url, $params);
        return $this;
    }

    public function getOrderId()
    {
        return $this->response()['ORDERID'];
    }

    public function response()
    {
        return $this->response;
    }

    public function getTransactionId()
    {
        return $this->response()['TXNID'];
    }


}
