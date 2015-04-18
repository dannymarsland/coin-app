<?php

namespace Application\Service\Coin;

use Application\Service\Currency\CurrencyCodes;

use \Exception;

class CoinService {

    public function __construct()
    {
    }

    /**
     * @param $value
     * @param string $currencyCode
     * @return array[]
     * @throws Exception
     */
    public function getMinimumCoinsForValue($value, $currencyCode = CurrencyCodes::GBP)
    {
        switch ($currencyCode) {
            case CurrencyCodes::GBP :
                $coins = [
                    new Coin("£2",2.00),
                    new Coin("£1",1.00),
                    new Coin("50p",0.50),
                    new Coin("20p",0.20),
                    new Coin("10p",0.10),
                    new Coin("5p",0.05),
                    new Coin("2p",0.02),
                    new Coin("1p",0.01),
                ];
                $coinCalculator = new CoinCalculator($coins);
                return $coinCalculator->getMinimumCoins($value);
            default:
                throw new Exception("Unsupported currency code '$currencyCode'");

        }

    }

}