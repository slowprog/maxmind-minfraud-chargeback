<?php

namespace MaxMind\MinFraudChargeback;

use MaxMind\MinFraudChargeback\Auth\Credential;
use MaxMind\MinFraudChargeback\Http\ClientInterface;
use MaxMind\MinFraudChargeback\Http\CurlClient;

/**
 * External layer for reporting chargebacks
 */
class Manager
{
    /**
     * @var Credential
     */
    protected $credential;
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @param Credential $credential
     * @param ClientInterface $httpClient
     */
    public function __construct(Credential $credential, ClientInterface $httpClient = null)
    {
        $this->credential = $credential;
        $this->httpClient = $httpClient ? : new CurlClient($credential);
    }

    /**
     * @param string $seconds
     *
     * @return Manager
     */
    public function setTimeout($seconds)
    {
        $this->httpClient->setTimeout($seconds);

        return $this;
    }

    /**
     * @param int $seconds
     *
     * @return Manager
     */
    public function setConnectTimeout($seconds)
    {
        $this->httpClient->setConnectTimeout($seconds);

        return $this;
    }

    /**
     * @param string $hostname
     *
     * @return Manager
     */
    public function setHostname($hostname)
    {
        $this->httpClient->setHostname($hostname);

        return $this;
    }

    /**
     * @param Chargeback $chargeback
     *
     * @return true
     *
     * @throws Exception\ExceptionAbstract
     */
    public function report(Chargeback $chargeback)
    {
        return $this->httpClient->report($chargeback);
    }
}
