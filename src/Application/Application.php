<?php

namespace Application;

use Application\Controller\RootController;
use Hamlet\Application\AbstractApplication;
use Hamlet\Cache\TransientCache;
use Hamlet\Request\RequestInterface;

class Application extends AbstractApplication
{

    protected function findResource(RequestInterface $request)
    {
        $rootController = new RootController();
        $resource = $rootController->findResource($request);
        return $resource;
    }

    /**
     * Find response for the specified request
     * @param \Hamlet\Request\RequestInterface $request
     * @return \Hamlet\Response\ResponseInterface
     */
    public function run(RequestInterface $request)
    {
        $resource = $this->findResource($request);
        $response = $resource->getResponse($request);
        return $response;
    }

    protected function getCache(RequestInterface $request)
    {
        return new TransientCache();
    }
}