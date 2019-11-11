<?php

namespace MaxMind\MinFraudChargeback\Auth;

use Webmozart\Assert\Assert;

/**
 * Simple ValueObjet for pairing user and password
 */
class Credential
{
    /**
     * @var string
     */
    protected $user;
    /**
     * @var string
     */
    protected $password;

    /**
     * @param string $user
     * @param string $password
     *
     * @throws InvalidArgumentException
     */
    public function __construct($user, $password)
    {
        Assert::stringNotEmpty($user);
        Assert::stringNotEmpty($password);

        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
