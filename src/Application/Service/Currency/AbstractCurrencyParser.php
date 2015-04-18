<?php

namespace Application\Service\Currency;

abstract class AbstractCurrencyParser {

    /**
     * @return string
     */
    abstract public function getCurrencyCode();

    /**
     * @return string
     */
    abstract public function getCurrencySymbol();

    /**
     * @param $value
     * @return CurrencyValue
     */
    abstract public function parseValue($value);

}