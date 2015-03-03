<?php

namespace GravityMedia\Badger\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * Error controller
 *
 * @package GravityMedia\Badger\Controller
 */
class ErrorController
{
    /**
     * @var boolean
     */
    protected $debug;

    /**
     * @var \Twig_Environment
     */
    protected $twigEnvironment;

    /**
     * Is debug
     *
     * @return boolean
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * Set debug
     *
     * @param boolean $debug
     *
     * @return $this
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
        return $this;
    }

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
     * Error handler
     *
     * @param \Exception $exception
     * @param int        $code
     *
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    function onError(\Exception $exception, $code)
    {
        if ($this->isDebug()) {
            return;
        }

        $templates = [
            'errors/' . $code . '.twig',
            'errors/' . substr($code, 0, 2) . 'x.twig',
            'errors/' . substr($code, 0, 1) . 'xx.twig',
            'errors/default.twig',
        ];

        return new Response(
            $this->getTwigEnvironment()->resolveTemplate($templates)->render(array('code' => $code)),
            $code
        );
    }
}
