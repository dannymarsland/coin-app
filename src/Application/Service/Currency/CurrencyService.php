<?php

namespace Application\Service\Currency;
use Exception;

class CurrencyService {

    public function __construct() {

    }

    /**
     * @param $valueString
     * @param string $currencyCode
     * @return CurrencyValue
     * @throws \Exception
     */
    public function parseValue($valueString, $currencyCode = CurrencyCodes::GBP) {
        switch ($currencyCode) {
            case CurrencyCodes::GBP :
                $parser = new GBPCurrencyParser();
                return $parser->parseValue($valueString);
            default:
                throw new Exception("Unsupported currency code '$currencyCode'");

        }
    }

}