<?php

namespace AirMedia\CS\Tests;

use AirMedia\CS\Config;
use PhpCsFixer\ConfigInterface;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsInterface()
    {
        $config = new Config();

        $this->assertInstanceOf(ConfigInterface::class, $config);
    }

    public function testReturnsCorrectValues()
    {
        $config = new Config();

        $this->assertEquals('AirMedia', $config->getName());
        $this->assertTrue($config->getUsingCache());
        $this->assertTrue($config->getRiskyAllowed());
    }

    public function testHasRules()
    {
        $config = new Config();

        $this->assertNotEmpty($config->getRules());
    }
}
