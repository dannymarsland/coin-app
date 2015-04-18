<?php

namespace Application\Service\Currency;


class CurrencyValue {

    private $value;
    private $currencyCode;

    function __construct($currencyCode, $value)
    {
        $this->currencyCode = $currencyCode;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

} 