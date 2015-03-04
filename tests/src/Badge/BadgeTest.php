<?php

namespace GravityMedia\BadgerTest\Badge;

use GravityMedia\Badger\Badge\Badge;

/**
 * Badge test
 *
 * @package GravityMedia\BadgerTest\Badge
 */
class BadgeTest extends \PHPUnit_Framework_TestCase
{
    public function testFontFilenameSetterAndGetter()
    {
        $expectedFontFilename = '/path/to/font/filename.ttf';
        $badge = new Badge();
        $badge->setFontFilename($expectedFontFilename);
        $this->assertEquals($expectedFontFilename, $badge->getFontFilename());
    }

    public function testFontSizeGetter()
    {
        $badge = new Badge();
        $this->assertEquals(Badge::DEFAULT_FONT_SIZE, $badge->getFontSize());
    }

    public function testSubjectTextSetterAndGetter()
    {
        $expectedSubjectText = 'My test subject';
        $badge = new Badge();
        $badge->setSubjectText($expectedSubjectText);
        $this->assertEquals($expectedSubjectText, $badge->getSubjectText());
    }

    public function testSubjectColorGetter()
    {
        $badge = new Badge();
        $this->assertEquals(Badge::DEFAULT_SUBJECT_COLOR, $badge->getSubjectColor());
    }

    public function testStatusTextSetterAndGetter()
    {
        $expectedStatusText = 'My test status';
        $badge = new Badge();
        $badge->setStatusText($expectedStatusText);
        $this->assertEquals($expectedStatusText, $badge->getStatusText());
    }

    public function testStatusColorSetterAndGetter()
    {
        $expectedStatusColor = '#000000';
        $badge = new Badge();
        $this->assertEquals(Badge::DEFAULT_STATUS_COLOR, $badge->getStatusColor());
        $badge->setStatusColor($expectedStatusColor);
        $this->assertEquals($expectedStatusColor, $badge->getStatusColor());
    }

    public function testXslUrlGetterAndXslPathSetterAndGetter()
    {
        $expectedXslFilename = '/path/to/test.xsl';
        $badge = new Badge();
        $badge->setXslFilename($expectedXslFilename);
        $this->assertEquals($expectedXslFilename, $badge->getXslFilename());
        $expectedXslUrl = basename($expectedXslFilename);
        $this->assertEquals($expectedXslUrl, $badge->getXslUrl());
    }
}
