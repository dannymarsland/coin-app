<?php

namespace Application\Service\Coin;

use \Exception;

class CoinCalculator {

    /**
     * @var Coin[]
     */
    protected $denominations;

    /**
     * @param Coin[] $denominations
     */
    public function __construct($denominations)
    {
        // sort so highest denomination is first
        usort($denominations, function(Coin $a, Coin $b) {
            return $b->getValue() > $a->getValue();
        });
        $this->denominations = $denominations;
    }

    /**
     * @param $value
     * @return array
     * @throws \Exception
     */
    public function getMinimumCoins($value)
    {
        // float to int conversion is awful , converting to strings seems to be the way round it
        $intValue = intval(bcmul($value , 100));
        $valueRemaining = $intValue;
        $coins = [];
        $coinIndex = 0;
        $numberOfAvailableCoins = count($this->denominations);
//        print "Looking for coins to make $valueRemaining\n";
        while($valueRemaining > 0 && $coinIndex < $numberOfAvailableCoins) {
            $currentCoin  = $this->denominations[$coinIndex];
            $currentCoinValue = intVal(bcmul($currentCoin->getValue(), 100));
//            print "Trying coin of value $currentCoinValue\n";
            $quantityOfCurrentCoin = intVal(floor($valueRemaining / $currentCoinValue));
            if ($quantityOfCurrentCoin > 0) {
                $coins[] = ["coin" => $currentCoin, "quantity" => $quantityOfCurrentCoin];
                $valueRemaining -= $quantityOfCurrentCoin * $currentCoinValue;
            }
//            print "Value remaining $valueRemaining\n";
            $coinIndex++;
        }

        if($valueRemaining != 0) {
            throw new Exception("Cannot create value '$value' with available coins'");
        }

        return $coins;
    }

}