<?php

declare(strict_types=1);

namespace AirMedia\CS\Tests;

use AirMedia\CS\Config;
use PhpCsFixer\ConfigInterface;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerFactory;
use PhpCsFixer\RuleSet;

class ConfigTest extends \PHPUnit\Framework\TestCase
{
    public function testImplementsInterface(): void
    {
        $config = new Config();

        $this->assertInstanceOf(ConfigInterface::class, $config);
    }

    public function testReturnsCorrectValues(): void
    {
        $config = new Config();

        $this->assertEquals('AirMedia', $config->getName());
        $this->assertTrue($config->getUsingCache());
        $this->assertTrue($config->getRiskyAllowed());
    }

    public function testHasRules(): void
    {
        $config = new Config();

        $this->assertNotEmpty($config->getRules());
    }

    public function testAllRulesAreSupported(): void
    {
        $config = new Config();
        $ruleSet = RuleSet::create(\array_map(static function () {
            return true;
        }, $config->getRules()));

        $configuredFixers = \array_keys($ruleSet->getRules());
        $availableFixers = $this->getAvailableFixers();

        $unknownFixers = \array_diff($configuredFixers, $availableFixers);

        $this->assertEmpty($unknownFixers, \sprintf(
            'The rules contain unknown fixers (%s).',
            \implode(', ', $unknownFixers)
        ));
    }

    private function getAvailableFixers(): array
    {
        $fixerFactory = new FixerFactory();
        $fixerFactory->registerBuiltInFixers();

        return \array_map(static function (FixerInterface $fixer) {
            return $fixer->getName();
        }, $fixerFactory->getFixers());
    }
}
