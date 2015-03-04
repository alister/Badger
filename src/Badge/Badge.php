<?php

namespace GravityMedia\Badger\Badge;

/**
 * Badge
 *
 * @package GravityMedia\Badger\Badge
 */
class Badge implements BadgeInterface
{
    /**
     * Default font size
     */
    const DEFAULT_FONT_SIZE = 11;

    /**
     * Default subject color
     */
    const DEFAULT_SUBJECT_COLOR = '#555';

    /**
     * Default status color
     */
    const DEFAULT_STATUS_COLOR = '#9f9f9f';

    /**
     * Available colors
     *
     * @var array
     */
    public static $colors = [
        // red colors
        'dark-red' => '#b21f35',
        'red' => '#d82735',
        // orange colors
        'dark-orange' => '#ff7435',
        'orange' => '#ffa135',
        // yellow colors
        'gold' => '#ffcb35',
        'yellow' => '#ffe63b',
        // green colors
        'dark-green' => '#00753a',
        'green' => '#009e47',
        'yellow-green' => '#9af000',
        'lime-green' => '#16dd36',
        // blue colors
        'dark-blue' => '#0052a5',
        'royal-blue' => '#0079e7',
        'sky-blue' => '#06a9fc',
        // violet colors
        'indigo' => '#681e7e',
        'dark-violet' => '#7d3cb5',
        'violet' => '#b610bf',
        'dark-pink' => '#e400e0',
        'pink' => '#ec47e9',
        // grey colors
        'grey' => '#555',
        'light-grey' => '#9f9f9f',
    ];

    /**
     * @var string
     */
    protected $fontFilename;

    /**
     * @var string
     */
    protected $subjectText;

    /**
     * @var string
     */
    protected $statusText;

    /**
     * @var string
     */
    protected $statusColor;

    /**
     * @var string
     */
    protected $xslFilename;

    /**
     * Get font filename
     *
     * @throws \BadMethodCallException
     *
     * @return string
     */
    public function getFontFilename()
    {
        if (null === $this->fontFilename) {
            throw new \BadMethodCallException('Font filename not set');
        }
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
     * Get font size
     *
     * @return int
     */
    public function getFontSize()
    {
        return self::DEFAULT_FONT_SIZE;
    }

    /**
     * Get subject text
     *
     * @return string
     */
    public function getSubjectText()
    {
        if (null === $this->subjectText) {
            return '';
        }
        return $this->subjectText;
    }

    /**
     * Set subject text
     *
     * @param string $subjectText
     *
     * @return $this
     */
    public function setSubjectText($subjectText)
    {
        $this->subjectText = $subjectText;
        return $this;
    }

    /**
     * Get subject color
     *
     * @return string
     */
    public function getSubjectColor()
    {
        return self::DEFAULT_SUBJECT_COLOR;
    }

    /**
     * Get status text
     *
     * @return string
     */
    public function getStatusText()
    {
        if (null === $this->statusText) {
            return '';
        }
        return $this->statusText;
    }

    /**
     * Set status text
     *
     * @param string $statusText
     *
     * @return $this
     */
    public function setStatusText($statusText)
    {
        $this->statusText = $statusText;
        return $this;
    }

    /**
     * Get status color
     *
     * @return string
     */
    public function getStatusColor()
    {
        if (null === $this->statusColor) {
            return self::DEFAULT_STATUS_COLOR;
        }
        return $this->statusColor;
    }

    /**
     * Set status color
     *
     * @param string $statusColor
     *
     * @return $this
     */
    public function setStatusColor($statusColor)
    {
        $this->statusColor = $statusColor;
        return $this;
    }

    /**
     * Get URL of XSL
     *
     * @return string
     */
    public function getXslUrl()
    {
        return basename($this->getXslFilename());
    }

    /**
     * Get filename of XSL
     *
     * @throws \BadMethodCallException
     *
     * @return string
     */
    public function getXslFilename()
    {
        if (null === $this->xslFilename) {
            throw new \BadMethodCallException('XSL path not set');
        }
        return $this->xslFilename;
    }

    /**
     * Set filename of XSL
     *
     * @param string $xslFilename
     *
     * @return $this
     */
    public function setXslFilename($xslFilename)
    {
        $this->xslFilename = $xslFilename;
        return $this;
    }

    /**
     * Measure text
     *
     * @param string $text
     *
     * @return array
     */
    protected function measureText($text)
    {
        $box = imagettfbbox($this->getFontSize(), 0, $this->getFontFilename(), $text);
        $width = abs($box[4] - $box[0]);
        $height = abs($box[5] - $box[1]);

        $size = array($width, $height);
        $size['width'] = $width;
        $size['height'] = $height;

        return $size;
    }

    /**
     * @inheritdoc
     */
    public function createXmlDocument()
    {
        $document = new \DOMDocument('1.0', 'UTF-8');
        $document->preserveWhiteSpace = false;
        $document->formatOutput = true;
        $document->appendChild($document->createProcessingInstruction(
            'xml-stylesheet',
            sprintf('type="text/xsl" href="%s"', $this->getXslUrl())
        ));

        $subjectText = $this->getSubjectText();
        $statusText = $this->getStatusText();
        /** @var \DOMElement $badge */
        $badge = $document->appendChild($document->createElement('badge'));
        /** @var \DOMElement $subject */
        $subject = $badge->appendChild($document->createElement('subject', $subjectText));
        /** @var \DOMElement $status */
        $status = $badge->appendChild($document->createElement('status', $statusText));

        $subjectSize = $this->measureText($subjectText);
        $subject->setAttribute('width', $subjectSize['width'] + 10);
        $subject->setAttribute('position', intval($subject->getAttribute('width')) / 2);
        $subject->setAttribute('color', $this->getSubjectColor());

        $statusSize = $this->measureText($statusText);
        $status->setAttribute('width', $statusSize['width'] + 10);
        $status->setAttribute('position', intval($subject->getAttribute('width')) + intval($status->getAttribute('width')) / 2);
        $status->setAttribute('color', $this->getStatusColor());

        $badge->setAttribute('width', intval($subject->getAttribute('width')) + intval($status->getAttribute('width')));

        return $document;
    }

    /**
     * @inheritdoc
     */
    public function createXslDocument()
    {
        $document = new \DOMDocument();
        $document->load($this->getXslFilename());

        return $document;
    }

    /**
     * @inheritdoc
     */
    public function createSvgDocument()
    {
        $processor = new \XSLTProcessor();
        $processor->importStyleSheet($this->createXslDocument());

        return $processor->transformToDoc($this->createXmlDocument());
    }
}
