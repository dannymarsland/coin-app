<?php

namespace Application\Entity;

use Application\Service\Coin\Coin;
use Application\Service\Coin\CoinService;
use Application\Service\Currency\CurrencyCodes;
use Application\Service\Currency\CurrencyService;
use Hamlet\Entity\AbstractSmartyEntity;

class HomePageEntity extends AbstractSmartyEntity
{

    private $userValue;
    private $currencyService;
    private $coinService;

    /**
     * @param CurrencyService $currencyService
     * @param CoinService $coinService
     * @param string $userValue
     */
    public function __construct(CurrencyService $currencyService, CoinService $coinService, $userValue = null)
    {
        $this->currencyService = $currencyService;
        $this->coinService = $coinService;
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
        $coins = [];
        $hadUserInput = !is_null($this->userValue);
        // if we have had user input then try calculate the results
        if ($hadUserInput) {
            try {
                // get the correct currency value. currently only supporting GBP
                $currencyValue = $this->currencyService->parseValue($this->userValue, CurrencyCodes::GBP);
                // a nicely formatted value string to present to the user
                $formattedValue = number_format($currencyValue->getValue(),2);
                // don't allow too small values
                if ($currencyValue->getValue() < 0.01) {
                    $error = true;
                    $errorMessage = 'Please enter a minimum value of 0.01';
                } else {
                    try {
                        // calculate the correct coins and prepare the data for templating
                        $minimumCoins = $this->coinService->getMinimumCoinsForValue($currencyValue->getValue(),$currencyValue->getCurrencyCode());
                        foreach($minimumCoins as $coinAndQuantity) {
                            /**
                             * @var $coin Coin
                             */
                            $coin = $coinAndQuantity['coin'];
                            $quantity = $coinAndQuantity['quantity'];
                            $coins[] = [
                                "name" => $coin->getName(),
                                "value" => $coin->getValue(),
                                "quantity" => $quantity,
                                "total" => $quantity * $coin->getValue()
                            ];
                        }
                    } catch (\Exception $e) {
                        $error = true;
                        $errorMessage = "Sorry, an error occurred";
                    }
                }
            } catch (\Exception $e) {
                $error = true;
                $errorMessage = "Please enter a valid value";
            }
        }
        // return the data for templating
        return [
            'userValue' => $this->userValue,
            'error' => $error,
            'errorMessage' => $errorMessage,
            'formattedValue' => $formattedValue,
            'coins' => $coins,
            'hadUserInput' => $hadUserInput
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
