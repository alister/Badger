<?php

namespace GravityMedia\Badger\Controller;

use Silex\Application;

/**
 * Badge controller
 *
 * @package GravityMedia\Badger\Controller
 */
class BadgeController
{
    /**
     * @var Application
     */
    protected $application;

    /**
     * Create controller
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Get application
     *
     * @return Application
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * Get badge
     *
     * @param string $subject
     * @param string $status
     * @param string $color
     *
     * @return string
     */
    function get($subject, $status, $color)
    {
        $application = $this->getApplication();

        return sprintf('%s-%s-%s.svg',
            $application->escape($subject),
            $application->escape($status),
            $application->escape($color)
        );
    }
}
