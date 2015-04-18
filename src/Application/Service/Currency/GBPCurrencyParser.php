<?php

namespace Application\Service\Currency;

use \Exception;

class GBPCurrencyParser extends AbstractCurrencyParser {


    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return CurrencyCodes::GBP;
    }

    /**
     * @return string
     */
    public function getCurrencySymbol()
    {
        return "£";
    }

    /**
     * @param $value
     * @return CurrencyValue
     * @throws \Exception
     */
    public function parseValue($value)
    {

        $value = trim($value);
        $valueLen = strlen($value);
        if ($valueLen < 1) {
            throw new Exception('Invalid currency string');
        }
        $symbol = $this->getCurrencySymbol();
        $beginsWithPoundSign = strpos($value, $symbol) === 0;
        $endsWithPence = $value[$valueLen-1] === 'p';
        $trimStart = 0;
        $trimEnd = 0;
        if ($beginsWithPoundSign) {
            $trimStart += strlen($symbol);
        }
        if ($endsWithPence) {
            $trimEnd++;
        }
        $numericString = substr($value, $trimStart, $valueLen - $trimStart - $trimEnd);
        $valueIsInPence = ! ($beginsWithPoundSign || ( strpos($numericString,'.') !== false ));
        $numericValue = filter_var($numericString, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND);
        if ($numericValue === false) {
            throw new Exception("Invalid numeric string '$numericString'");
        }
        if($valueIsInPence) {
            $numericValue /= 100;
        }
        $numericValue = round($numericValue, 2);
        return new CurrencyValue($this->getCurrencyCode(), $numericValue);
    }
}