<?php

namespace Application\Controller;

use Application\Entity\HomePageEntity;
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
            return new EntityResource(new HomePageEntity($request->getParameter('value')));
        }
        return new NotFoundResource();
    }

}
