<?php

namespace GravityMedia\Badger\Controller;

/**
 * Badge controller factory
 *
 * @package GravityMedia\Badger\Controller
 */
class BadgeControllerFactory
{
    /**
     * Create badge controller
     *
     * @param \ArrayAccess $serviceLocator
     *
     * @return \GravityMedia\Badger\Controller\BadgeController
     */
    public function __invoke(\ArrayAccess $serviceLocator)
    {
        $controller = new BadgeController();
        return $controller
            ->setCharset($serviceLocator['charset'])
            ->setRequest($serviceLocator['request'])
            ->setXslPath($serviceLocator['badge.xsl.path'])
            ->setFontFilename($serviceLocator['badge.font.filename']);
    }
}
