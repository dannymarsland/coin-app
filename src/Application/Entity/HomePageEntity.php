<?php

namespace Application\Entity;

use Hamlet\Entity\AbstractSmartyEntity;

class HomePageEntity extends AbstractSmartyEntity
{

    private $userValue;

    /**
     * @param string $userValue
     */
    public function __construct($userValue = null)
    {
        $this->userValue = $userValue;
    }

    /**
     * @return array|mixed
     */
    public function getTemplateData()
    {
        return [
            'userValue' => $this->userValue
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
