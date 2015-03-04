<?php

namespace GravityMedia\Badger\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * Page controller
 *
 * @package GravityMedia\Badger\Controller
 */
class PageController
{
    /**
     * Available colors
     *
     * @var array
     */
    public static $colors = [
        'dark-red' => 'Dark Red',
        'red' => 'Red',
        'dark-orange' => 'Dark Orange',
        'orange' => 'Orange',
        'gold' => 'Gold',
        'yellow' => 'Yellow',
        'dark-green' => 'Dark Green',
        'green' => 'Green',
        'yellow-green' => 'Yellow Green',
        'lime-green' => 'Lime Green',
        'dark-blue' => 'Dark Blue',
        'royal-blue' => 'Royal Blue',
        'sky-blue' => 'Sky Blue',
        'indigo' => 'Indigo',
        'dark-violet' => 'Dark Violet',
        'violet' => 'Violet',
        'dark-pink' => 'Dark Pink',
        'pink' => 'Pink',
        'grey' => 'Grey',
        'light-grey' => 'Light Grey',
    ];

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
     * Index action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function indexAction()
    {
        return new Response($this->getTwigEnvironment()->render('index.twig', ['colors' => self::$colors]));
    }

    /**
     * Help action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function helpAction()
    {
        return new Response($this->getTwigEnvironment()->render('help.twig', ['colors' => self::$colors]));
    }

    /**
     * Badge action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function badgeAction()
    {
        return new Response($this->getTwigEnvironment()->render('badge.twig', ['colors' => self::$colors]));
    }
}
