<?php

namespace Application\Service\Coin;

use UnitTestCase;

class CoinCalculatorTest extends UnitTestCase
{
    public function test()
    {
        $coins = [
            new Coin("£1",1.00),
            new Coin("50p",0.50),
            new Coin("20p",0.20),
            new Coin("£2",2.00),
            new Coin("5p",0.05),
            new Coin("2p",0.02),
            new Coin("1p",0.01),
            new Coin("10p",0.10),
        ];

        $tests = [
            [
                "value" => 10.00,
                "coins" => [
                    [
                        "quantity" => 5,
                        "value" => 2.00
                    ]
                ]
            ],
            [
                "value" => 0.01,
                "coins" => [
                    [
                        "quantity" => 1,
                        "value" => 0.01
                    ]
                ]
            ],
            [
                "value" => 0.57,
                "coins" => [
                    [
                        "quantity" => 1,
                        "value" => 0.5
                    ],
                    [
                        "quantity" => 1,
                        "value" => 0.05
                    ],
                    [
                        "quantity" => 1,
                        "value" => 0.02
                    ]
                ]
            ],
            [
                "value" => 1.12,
                "coins" => [
                    [
                        "quantity" => 1,
                        "value" => 1.00
                    ],
                    [
                        "quantity" => 1,
                        "value" => 0.10
                    ],
                    [
                        "quantity" => 1,
                        "value" => 0.02
                    ]
                ]
            ],
            [
                "value" => 23.33,
                "coins" => [
                    [
                        "quantity" => 11,
                        "value" => 2.0
                    ],
                    [
                        "quantity" => 1,
                        "value" => 1.00
                    ],
                    [
                        "quantity" => 1,
                        "value" => 0.20
                    ],
                    [
                        "quantity" => 1,
                        "value" => 0.10
                    ],
                    [
                        "quantity" => 1,
                        "value" => 0.02
                    ],
                    [
                        "quantity" => 1,
                        "value" => 0.01
                    ]
                ]
            ]
        ];

        $coinCalculator = new CoinCalculator($coins);

        foreach($tests as $test) {
            $expectedCoins = $test['coins'];
            $value = $test['value'];
            $minimumCoins = $coinCalculator->getMinimumCoins($value);
            $this->assertIdentical(count($minimumCoins), count($expectedCoins), "Incorrect number of coins calculated for '£$value'");
            $numberOfCoins = count($minimumCoins);
            if ($numberOfCoins == count($expectedCoins)) {
                for($i =0; $i < $numberOfCoins; $i++) {
                    /** @var $coin Coin */
                    $coin = $minimumCoins[$i]['coin'];
                    $this->assertIdentical($expectedCoins[$i]['quantity'], $minimumCoins[$i]['quantity'] );
                    $this->assertIdentical($expectedCoins[$i]['value'], $coin->getValue());
                }
            }
        }


    }
}