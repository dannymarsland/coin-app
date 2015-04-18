<?php

namespace Application\Service\Coin;

use UnitTestCase;

class CoinCalculatorTest extends UnitTestCase
{
    public function test()
    {
        // a list of coins available for the test. purposely out of order
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

        // a structure of tests to run through and the expected results
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
            // ensure the same number of coin types are given
            $this->assertIdentical(count($minimumCoins), count($expectedCoins), "Incorrect number of coins calculated for '£$value'");
            $numberOfCoins = count($minimumCoins);
            if ($numberOfCoins == count($expectedCoins)) {
                for($i =0; $i < $numberOfCoins; $i++) {
                    /** @var $coin Coin */
                    $coin = $minimumCoins[$i]['coin'];
                    // check the quantity and the coin value
                    $this->assertIdentical($expectedCoins[$i]['quantity'], $minimumCoins[$i]['quantity'] );
                    $this->assertIdentical($expectedCoins[$i]['value'], $coin->getValue());
                }
            }
        }


    }
}