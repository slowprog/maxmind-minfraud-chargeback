# MaxMind minFraud Chargeback API Client

![php 5.4+](https://img.shields.io/badge/php-min%205.4-red.svg?style=flat-square)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)](https://github.com/slowprog/maxmind-minfraud-chargeback/blob/master/LICENSE.md)

This is a client for [MaxMind's minFraud Chargeback Web Service Api](http://dev.maxmind.com/minfraud/chargeback/).

This is NOT an official implementation, although it was written following official documentation.

## Install

Via Composer

```bash
$ composer require slowprog/maxmind-minfraud-chargeback
```

## Usage

Please read http://dev.maxmind.com/minfraud/chargeback/


```php
use MaxMind\MinFraudChargeback\Chargeback;
use MaxMind\MinFraudChargeback\Manager;
use MaxMind\MinFraudChargeback\Auth\Credential;

$chargeback = new Chargeback('77.77.77.77');
$chargeback->setChargebackCode('CHARGEBACK_STRING')
    ->setFraudScore(Chargeback::SUSPECTED_FRAUD)
    ->setMaxmindId('XXXXXXXX')
    ->setMinfraudId('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx')
    ->setTransactionId('XXXXXX');

$manager = new Manager(new Credential('XXXXX', 'XXXXXXXXXXXX'));
$manager->setConnectTimeout(1)
    ->setTimeout(1);

try {
    $manager->report($chargeback);
} catch (Exception $exc) {
    echo $exc->getMessage();
}
```

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
