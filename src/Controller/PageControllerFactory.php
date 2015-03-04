<?php

namespace GravityMedia\Badger\Controller;

/**
 * Page controller factory
 *
 * @package GravityMedia\Badger\Controller
 */
class PageControllerFactory
{
    /**
     * Create page controller
     *
     * @param \ArrayAccess $serviceLocator
     *
     * @return \GravityMedia\Badger\Controller\PageController
     */
    public function __invoke(\ArrayAccess $serviceLocator)
    {
        $controller = new PageController();
        return $controller
            ->setTwigEnvironment($serviceLocator['twig']);
    }
}
