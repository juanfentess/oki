<?php

namespace Anand\LaravelPaytmWallet;

use Illuminate\Support\Manager;

class PaytmWalletManager extends Manager implements Contracts\Factory
{


    protected $config;


    public function with($driver)
    {
        return $this->driver($driver);
    }

    public function getDefaultDriver()
    {
        throw new \Exception('No driver was specified. - Laravel Paytm Wallet');
    }

    protected function createReceiveDriver()
    {
        $this->config = $this->container['config']['services.paytm-wallet'];

        return $this->buildProvider(
            'Anand\LaravelPaytmWallet\Providers\ReceivePaymentProvider',
            $this->config
        );
    }

    public function buildProvider($provider, $config)
    {
        return new $provider(
            $this->container['request'],
            $config
        );
    }

    protected function createStatusDriver()
    {
        $this->config = $this->container['config']['services.paytm-wallet'];
        return $this->buildProvider(
            'Anand\LaravelPaytmWallet\Providers\StatusCheckProvider',
            $this->config
        );
    }

    protected function createBalanceDriver()
    {
        $this->config = $this->container['config']['services.paytm-wallet'];
        return $this->buildProvider(
            'Anand\LaravelPaytmWallet\Providers\BalanceCheckProvider',
            $this->config
        );
    }

    protected function createAppDriver()
    {
        $this->config = $this->container['config']['services.paytm-wallet'];
        return $this->buildProvider(
            'Anand\LaravelPaytmWallet\Providers\PaytmAppProvider',
            $this->config
        );
    }

    protected function createRefundDriver()
    {
        $this->config = $this->container['config']['services.paytm-wallet'];
        return $this->buildProvider(
            'Anand\LaravelPaytmWallet\Providers\RefundPaymentProvider',
            $this->config
        );
    }

    protected function createRefundStatusDriver()
    {
        $this->config = $this->container['config']['services.paytm-wallet'];
        return $this->buildProvider(
            'Anand\LaravelPaytmWallet\Providers\RefundStatusCheckProvider',
            $this->config
        );
    }
}
