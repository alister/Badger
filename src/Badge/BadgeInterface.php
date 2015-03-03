<?php

namespace GravityMedia\Badger\Badge;

/**
 * Badge interface
 *
 * @package GravityMedia\Badger\Badge
 */
interface BadgeInterface
{
    /**
     * Create XML document
     *
     * @return \DOMDocument
     */
    public function createXmlDocument();

    /**
     * Create XSL document
     *
     * @return \DOMDocument
     */
    public function createXslDocument();

    /**
     * Create SVG document
     *
     * @return \DOMDocument
     */
    public function createSvgDocument();
}
