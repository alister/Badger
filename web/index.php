<?php

use GravityMedia\Badger\Application;
use GravityMedia\Badger\Controller\BadgeController;
use GravityMedia\Badger\Controller\ErrorController;
use GravityMedia\Badger\Controller\IndexController;

require_once __DIR__ . '/../vendor/autoload.php';

// Init application
$application = new Application(require __DIR__ . '/../config/application.config.php');

// Index controller factory
$application['error.controller'] = $application->share(function () use ($application) {
    $controller = new ErrorController();
    return $controller
        ->setDebug($application['debug'])
        ->setTwigEnvironment($application['twig']);
});

// Index controller factory
$application['index.controller'] = $application->share(function () use ($application) {
    $controller = new IndexController();
    return $controller
        ->setTwigEnvironment($application['twig']);
});

// Badge controller factory
$application['badge.controller'] = $application->share(function () use ($application) {
    $controller = new BadgeController($application);
    return $controller
        ->setRequest($application['request'])
        ->setXslPath($application['badge.xsl.path'])
        ->setFontFilename($application['badge.font.filename']);
});

// Set up and run
$application->error('error.controller:onError');
$application->get('/', 'index.controller:onIndex')->bind('index');
$application->get('/badge/{subject}-{status}-{color}.svg', 'badge.controller:badgeAction')->bind('badge');
$application->run();
