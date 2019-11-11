<?php

namespace MaxMind\MinFraudChargeback;

use Webmozart\Assert\Assert;
use InvalidArgumentException;

/**
 * This is a namespaced container for the values a chargeback can have
 */
class Chargeback
{
    /**
     * Indicates transaction is unlikely fraudulent
     */
    const TAG_NOT_FRAUD = 'not_fraud';
    /**
     * Indicates transaction is suspectedly fraudulent
     */
    const TAG_SUSPECTED_FRAUD = 'suspected_fraud';
    /**
     * Indicates transaction is spam or abuse
     */
    const TAG_SPAM_OR_ABUSE = 'spam_or_abuse';
    /**
     * Indicates transaction is likely fraudulent
     */
    const TAG_CHARGEBACK = 'chargeback';

    /**
     * @var string
     */
    protected $ipAddress;
    /**
     * @var string
     */
    protected $chargebackCode;
    /**
     * @var string
     */
    protected $tag;
    /**
     * @var string
     */
    protected $maxmindId;
    /**
     * @var string
     */
    protected $minfraudId;
    /**
     * @var string
     */
    protected $transactionId;

    /**
     * @param string $ipAddress The IP address of the customer placing the order.
     * This should be passed as a string like “44.55.66.77” or “2001:db8::2:1”.
     *
     * @throws InvalidArgumentException
     */
    public function __construct($ipAddress)
    {
        Assert::stringNotEmpty($ipAddress);

        $this->ipAddress = $ipAddress;
    }

    /**
     * @param A string which is provided by your payment processor
     * indicating the reason for the chargeback.
     * @see https://en.wikipedia.org/wiki/Chargeback#Reason_codes
     *
     * @throws InvalidArgumentException
     *
     * @return Chargeback
     */
    public function setChargebackCode($chargebackCode)
    {
        Assert::stringNotEmpty($chargebackCode);

        $this->chargebackCode = $chargebackCode;

        return $this;
    }

    /**
     * @param string $tag A string indicating the likelihood that
     * a transaction may be fraudulent.
     * Possible values: not_fraud, suspected_fraud, spam_or_abuse, chargeback.
     *
     * @throws InvalidArgumentException
     *
     * @return Chargeback
     */
    public function setTag($tag)
    {
        if (!in_array($tag, [
                static::TAG_CHARGEBACK,
                static::TAG_SPAM_OR_ABUSE,
                static::TAG_NOT_FRAUD,
                static::TAG_SUSPECTED_FRAUD
            ])) {
            throw new InvalidArgumentException('Invalid fraud score.');
        }

        $this->tag = $tag;

        return $this;
    }

    /**
     * @param string $maxmindId A unique eight character string identifying
     * a minFraud Standard or Premium request. These IDs are returned in the
     * maxmindID field of a response for a successful minFraud request.
     * This field is not required, but you are encouraged to provide it, if possible.
     *
     * @throws InvalidArgumentException
     *
     * @return Chargeback
     */
    public function setMaxmindId($maxmindId)
    {
        Assert::length($maxmindId, 8);

        $this->maxmindId = $maxmindId;

        return $this;
    }

    /**
     * @param string $minfraudId A UUID that identifies a minFraud Score,
     * minFraud Insights, or minFraud Factors request.
     * This ID is returned at /id in the response.
     * This field is not required, but you are encouraged to provide it if
     * the request was made to one of these services.
     *
     * @throws InvalidArgumentException
     *
     * @return Chargeback
     */
    public function setMinfraudId($minfraudId)
    {
        Assert::length($minfraudId, 36);

        $this->minfraudId = $minfraudId;

        return $this;
    }

    /**
     * @param string $transactionId The transaction ID you originally passed to minFraud.
     * This field is not required, but you are encouraged to provide it or
     * the transaction’s maxmind_id or minfraud_id.
     *
     * @throws InvalidArgumentException
     *
     * @return Chargeback
     */
    public function setTransactionId($transactionId)
    {
        Assert::stringNotEmpty($transactionId);

        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * @return array An array with properties in key=>value fashion
     */
    public function toArray()
    {
        $array = [
            'ip_address' => $this->ipAddress
        ];

        if ($this->chargebackCode) {
            $array['chargeback_code'] = $this->chargebackCode;
        }

        if ($this->tag) {
            $array['tag'] = $this->tag;
        }

        if ($this->maxmindId) {
            $array['maxmind_id'] = $this->maxmindId;
        }


        if ($this->minfraudId) {
            $array['minfraud_id'] = $this->minfraudId;
        }

        if ($this->transactionId) {
            $array['transaction_id'] = $this->transactionId;
        }

        return $array;
    }
}
