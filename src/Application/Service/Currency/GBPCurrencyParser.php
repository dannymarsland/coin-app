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
        // check for beginning '£' and end 'p'
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
        // extract the numeric value string
        $numericString = substr($value, $trimStart, $valueLen - $trimStart - $trimEnd);
        // determine if this value is in pence or pounds
        $valueIsInPence = ! ($beginsWithPoundSign || ( strpos($numericString,'.') !== false ));
        // get the value as a float
        $numericValue = filter_var($numericString, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND);
        if ($numericValue === false) {
            throw new Exception("Invalid numeric string '$numericString'");
        }
        // if the value is in pence convert to pounds
        if($valueIsInPence) {
            $numericValue /= 100;
        }
        // round the value - should we do this?
        $numericValue = round($numericValue, 2);
        return new CurrencyValue($this->getCurrencyCode(), $numericValue);
    }
}