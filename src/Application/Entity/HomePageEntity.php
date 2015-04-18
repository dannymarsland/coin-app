<?php

namespace Application\Entity;

use Application\Service\Currency\CurrencyCodes;
use Application\Service\Currency\CurrencyService;
use Hamlet\Entity\AbstractSmartyEntity;

class HomePageEntity extends AbstractSmartyEntity
{

    private $userValue;
    private $currencyService;

    /**
     * @param CurrencyService $currencyService
     * @param string $userValue
     */
    public function __construct($currencyService, $userValue = null)
    {
        $this->currencyService = $currencyService;
        $this->userValue = $userValue;
    }

    /**
     * @return array|mixed
     */
    public function getTemplateData()
    {
        $error = null;
        $errorMessage = '';
        $formattedValue = '';
        if ($this->userValue) {
            try {
                $currencyValue = $this->currencyService->parseValue($this->userValue, CurrencyCodes::GBP);
                $formattedValue = number_format($currencyValue->getValue(),2);
            } catch (\Exception $e) {
                $error = true;
                $errorMessage = "Please enter a valid value";
            }
        }

        return [
            'userValue' => $this->userValue,
            'error' => $error,
            'errorMessage' => $errorMessage,
            'formattedValue' => $formattedValue
        ];
    }


    /**
     * Get absolute path to entity template
     * @return string
     */
    protected function getTemplatePath()
    {
        return __DIR__ . '/templates/home-page.tpl';
    }

    /**
     * Get cache key of the entity
     * @return string
     */
    public function getKey()
    {
        return get_class($this) . $this->userValue;
    }
}
