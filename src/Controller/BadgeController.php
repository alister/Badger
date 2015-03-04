<?php

namespace GravityMedia\Badger\Controller;

use GravityMedia\Badger\Badge\Badge;
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
     * @var string
     */
    protected $charset;

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
     * Get charset
     *
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * Set charset
     *
     * @param string $charset
     *
     * @return $this
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
        return $this;
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
     * Escapes a text for HTML.
     *
     * @param string $text         The input text to be escaped
     * @param int    $flags        The flags (@see htmlspecialchars)
     * @param string $charset      The charset
     * @param bool   $doubleEncode Whether to try to avoid double escaping or not
     *
     * @return string Escaped text
     */
    public function escape($text, $flags = ENT_COMPAT, $charset = null, $doubleEncode = true)
    {
        return htmlspecialchars($text, $flags, $charset ?: $this->getCharset(), $doubleEncode);
    }

    /**
     * Badge action
     *
     * @param string $subject
     * @param string $status
     * @param string $color
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function badgeAction($subject, $status, $color)
    {
        $badge = new Badge();

        $style = $this->getRequest()->get('style', self::DEFAULT_STYLE);
        $badge->setXslFilename($this->getXslPath() . DIRECTORY_SEPARATOR . $style . '.xsl');

        $badge->setFontFilename($this->getFontFilename());

        $badge->setSubjectText($this->escape($subject));
        $badge->setStatusText($this->escape($status));

        $color = $this->escape($color);
        if (isset(Badge::$colors[$color])) {
            $badge->setStatusColor(Badge::$colors[$color]);
        }

        $document = $badge->createSvgDocument();
        return new Response($document->saveXML(), 200, array(
            'Content-Type' => 'image/svg+xml'
        ));
    }
}
