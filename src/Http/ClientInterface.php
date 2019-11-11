<?php

namespace MaxMind\MinFraudChargeback\Http;

use MaxMind\MinFraudChargeback\Chargeback;
use MaxMind\MinFraudChargeback\Exception\ExceptionAbstract;

/**
 * Interface for those classes that will be between MaxMind and the Manager
 */
interface ClientInterface
{
    /**
     * @param int $seconds
     *
     * @return ClientInterface
     */
    public function setTimeout($seconds);

    /**
     * @param int $seconds
     *
     * @return ClientInterface
     */
    public function setConnectTimeout($seconds);

    /**
     * @param string $string
     *
     * @return ClientInterface
     */
    public function setHostname($string);

    /**
     * @param Chargeback $chargeback
     *
     * @throws ExceptionAbstract
     * @throws RuntimeException
     *
     * @return bool
     */
    public function report(Chargeback $chargeback);
}
