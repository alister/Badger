<?php

namespace GravityMedia\Badger\Controller;

use GravityMedia\Badger\Badge\Badge;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Badge controller
 *
 * @package GravityMedia\Badger\Controller
 */
class BadgeController
{
    /**
     * Default style
     */
    const DEFAULT_STYLE = 'flat';

    /**
     * @var Application
     */
    protected $application;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var string
     */
    protected $xslPath;

    /**
     * @var string
     */
    protected $fontFilename;

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
     * Get request
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set request
     *
     * @param Request $request
     *
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Get XSL path
     *
     * @return string
     */
    public function getXslPath()
    {
        return $this->xslPath;
    }

    /**
     * Set XSL path
     *
     * @param string $xslPath
     *
     * @return $this
     */
    public function setXslPath($xslPath)
    {
        $this->xslPath = $xslPath;
        return $this;
    }

    /**
     * Get font filename
     *
     * @return string
     */
    public function getFontFilename()
    {
        return $this->fontFilename;
    }

    /**
     * Set font filename
     *
     * @param string $fontFilename
     *
     * @return $this
     */
    public function setFontFilename($fontFilename)
    {
        $this->fontFilename = $fontFilename;
        return $this;
    }

    /**
     * Badge action
     *
     * @param string $subject
     * @param string $status
     * @param string $color
     *
     * @return string
     */
    function badgeAction($subject, $status, $color)
    {
        $application = $this->getApplication();
        $color = $application->escape($color);

        $request = $this->getRequest();
        $style = $request->get('style', self::DEFAULT_STYLE);

        $badge = new Badge();
        $badge->setXslFilename($this->getXslPath() . DIRECTORY_SEPARATOR . $style . '.xsl');
        $badge->setFontFilename($this->getFontFilename());
        $badge->setSubjectText($application->escape($subject));
        $badge->setStatusText($application->escape($status));
        if (isset(Badge::$colors[$color])) {
            $badge->setStatusColor(Badge::$colors[$color]);
        }

        $document = $badge->createSvgDocument();
        return new Response($document->saveXML(), 200, array(
            'Content-Type' => 'image/svg+xml'
        ));
    }
}
