<?php

require_once __DIR__ . '/../vendor/autoload.php';

$application = new GravityMedia\Badger\Application();

$application['badge.controller'] = $application->share(function() use ($application) {
    return new GravityMedia\Badger\Controller\BadgeController($application);
});

$application->get('/badge/{subject}-{status}-{color}.svg', 'badge.controller:get')->bind('badge');

$application->run();
