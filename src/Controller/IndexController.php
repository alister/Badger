<?php

namespace GravityMedia\Badger\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * Index controller
 *
 * @package GravityMedia\Badger\Controller
 */
class IndexController
{
    /**
     * @var \Twig_Environment
     */
    protected $twigEnvironment;

    /**
     * Get twig environment
     *
     * @return \Twig_Environment
     */
    public function getTwigEnvironment()
    {
        return $this->twigEnvironment;
    }

    /**
     * Set twig environment
     *
     * @param \Twig_Environment $twigEnvironment
     *
     * @return $this
     */
    public function setTwigEnvironment($twigEnvironment)
    {
        $this->twigEnvironment = $twigEnvironment;
        return $this;
    }

    /**
     * Index handler
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function onIndex()
    {
        return new Response($this->getTwigEnvironment()->render('index.twig'));
    }
}
