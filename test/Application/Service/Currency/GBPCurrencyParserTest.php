<?php

namespace Application\Service\Currency;

use UnitTestCase;
use \Exception;

class GBPCurrencyParserTest extends UnitTestCase {

    public function test()
    {
        $parser = new GBPCurrencyParser();
        $validInputs = [
            [
                "text" => "4",
                "value" => 0.04
            ],
            [
                "text" => "85",
                "value" => 0.85
            ],
            [
                "text" => "197p",
                "value" => 1.97
            ],
            [
                "text" => "2p",
                "value" => 0.02
            ],
            [
                "text" => "1.87",
                "value" => 1.87
            ],
            [
                "text" => "£1.23",
                "value" => 1.23
            ],
            [
                "text" => "£2",
                "value" => 2.00
            ],
            [
                "text" => "£10",
                "value" => 10.00
            ],
            [
                "text" => "£1.87",
                "value" => 1.87
            ],
            [
                "text" => "£1p",
                "value" => 1.00
            ],
            [
                "text" => "£1.p",
                "value" => 1.00
            ],
            [
                "text" => "001.41p",
                "value" => 1.41
            ],
            [
                "text" => "4.235p",
                "value" => 4.24
            ],
            [
                "text" => "£1.2574224457p",
                "value" => 1.26
            ]
        ];

        $invalidInputs = [
            "",
            "1x",
            "£1x.0p",
            "£p",
            "£2.00"
        ];
        foreach( $validInputs as $input) {
            $value = $parser->parseValue($input['text']);
            $this->assertIdentical($value->getValue(),$input['value']);
        }

        foreach( $invalidInputs as $input) {
            try {
                $value = $parser->parseValue($input);
                $this->fail("Parser should throw exception for invalid input '$input'");
            } catch ( Exception $e ) {
                // deprecated, but exception testing did not work the way I expected
                $this->pass();
            }

        }
    }

}

 