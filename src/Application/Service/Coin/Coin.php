<?php

namespace Application\Service\Coin;


class Coin {

    private $value;
    private $name;

    /**
     * @param $name
     * @param $value
     */
    function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

} 