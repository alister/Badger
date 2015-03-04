<?php

use GravityMedia\Badger\Application;
use GravityMedia\Badger\Controller\BadgeControllerFactory;
use GravityMedia\Badger\Controller\ErrorControllerFactory;
use GravityMedia\Badger\Controller\PageControllerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

// Init application
$application = new Application(require __DIR__ . '/../config/application.config.php');

// Share controller factories
$application['badge.controller'] = $application->share(new BadgeControllerFactory());
$application['error.controller'] = $application->share(new ErrorControllerFactory());
$application['page.controller'] = $application->share(new PageControllerFactory());

// Set up routes and run
$application->error('error.controller:errorAction');
$application->get('/', 'page.controller:indexAction')->bind('page.index');
$application->get('/help', 'page.controller:helpAction')->bind('page.help');
$application->get('/badge', 'page.controller:badgeAction')->bind('page.badge');
$application->get('/badge/{subject}-{status}-{color}.svg', 'badge.controller:badgeAction')->bind('badge.badge');
$application->run();
