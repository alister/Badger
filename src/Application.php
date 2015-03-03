<?php

namespace GravityMedia\Badger;

use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\ServiceProviderInterface;
use Symfony\Component\Debug\Debug;

/**
 * Badger application
 *
 * @package GravityMedia\Badger
 */
class Application extends \Silex\Application
{
    /**
     * Create badge application
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct();

        foreach ($this->getDefaultProviders() as $provider) {
            $this->register($provider);
        }

        foreach ($config as $key => $value) {
            $this[$key] = $value;
        }
    }

    /**
     * Get default providers
     *
     * @return ServiceProviderInterface[]
     */
    protected function getDefaultProviders()
    {
        return [
            new ServiceControllerServiceProvider(),
            new TwigServiceProvider(),
            new UrlGeneratorServiceProvider()
        ];
    }

    /**
     * Configure application
     */
    protected function configure()
    {
        if ($this['debug']) {
            Debug::enable();
        }
    }
}
