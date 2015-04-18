<?php

namespace Application\Controller;

use Application\Entity\HomePageEntity;
use Application\Service\Coin\CoinService;
use Application\Service\Currency\CurrencyService;
use Hamlet\Request\RequestInterface;
use Hamlet\Resource\EntityResource;
use Hamlet\Resource\NotFoundResource;

class RootController
{

    public function __construct()
    {

    }

    /**
     * @param \Hamlet\Request\RequestInterface $request
     *
     * @return \Hamlet\Resource\ResourceInterface
     */
    public function findResource(RequestInterface $request)
    {
        if ($request->pathMatches("/")) {
            return new EntityResource(new HomePageEntity(new CurrencyService(), new CoinService(), $request->getParameter('value')));
        }
        return new NotFoundResource();
    }

}
