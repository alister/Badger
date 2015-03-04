<?php

namespace GravityMedia\BadgerTest\Controller;

use GravityMedia\Badger\Controller\BadgeControllerFactory;
use Symfony\Component\HttpFoundation\Request;

/**
 * Badge controller factory test
 *
 * @package GravityMedia\BadgerTest\Controller
 */
class BadgeControllerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testControllerCreation()
    {
        $serviceLocator = new \ArrayObject([
            'charset' => 'utf-8',
            'request' => new Request(),
            'badge.xsl.path' => '/path/to/xsl',
            'badge.font.filename' => '/path/to/font/filename.ttf'

        ]);
        $factory = new BadgeControllerFactory();
        $this->assertInstanceOf('GravityMedia\Badger\Controller\BadgeController', $factory($serviceLocator));
    }
}
