<?php

namespace GravityMedia\Badger\Controller;

/**
 * Error controller factory
 *
 * @package GravityMedia\Badger\Controller
 */
class ErrorControllerFactory
{
    /**
     * Create error controller
     *
     * @param \ArrayAccess $serviceLocator
     *
     * @return \GravityMedia\Badger\Controller\ErrorController
     */
    public function __invoke(\ArrayAccess $serviceLocator)
    {
        $controller = new ErrorController();
        return $controller
            ->setDebug($serviceLocator['debug'])
            ->setTwigEnvironment($serviceLocator['twig']);
    }
}
