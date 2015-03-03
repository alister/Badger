<?php

namespace GravityMedia\Badger;

use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\ServiceProviderInterface;

/**
 * Badger application
 *
 * @package GravityMedia\Badger
 */
class Application extends \Silex\Application
{
    /**
     * Create badge application
     */
    public function __construct()
    {
        parent::__construct();

        foreach ($this->getDefaultProviders() as $provider) {
            $this->register($provider);
        }
    }

    /**
     * Get default providers
     *
     * @return ServiceProviderInterface[]
     */
    protected function getDefaultProviders() {
        return array(
            new ServiceControllerServiceProvider(),
            new UrlGeneratorServiceProvider()
        );
    }
}
