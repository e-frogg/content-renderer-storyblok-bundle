<?php

declare(strict_types=1);

namespace Efrogg\Bundle\StoryblokBundle\Tests\Unit\DependencyInjection;

use Efrogg\Bundle\StoryblokBundle\DependencyInjection\StoryblokConfig;
use PHPUnit\Framework\TestCase;

class StoryblokConfigTest extends TestCase
{
    private StoryblokConfig $config;
    private array $testConfig;

    protected function setUp(): void
    {
        $this->testConfig = [
            'pages' => [
                'directory' => ['pages', 'articles'],
                'base_route' => '/content',
            ],
            'assets' => [
                'downloader' => [
                    'use' => true,
                    'local_storage' => '/assets/local',
                    'public_path' => '/assets/public',
                ],
            ],
            'api' => [
                'max_retries' => 3,
                'keys' => ['key1', 'key2'],
            ],
            'cache' => [
                'json_dumper' => [
                    'use' => true,
                    'dump_path' => '/cache/json',
                ],
            ],
            'demo' => [
                'key' => 'demo-key',
                'folder' => 'demo-folder',
            ],
        ];

        $this->config = new StoryblokConfig($this->testConfig);
    }

    public function testGetPagesDirectory(): void
    {
        $this->assertEquals(['pages', 'articles'], $this->config->getPagesDirectory());
    }

    public function testGetBaseRoute(): void
    {
        $this->assertEquals('/content', $this->config->getBaseRoute());
    }

    public function testIsAssetsDownloaderEnabled(): void
    {
        $this->assertTrue($this->config->isAssetsDownloaderEnabled());
    }

    public function testGetAssetsLocalStorage(): void
    {
        $this->assertEquals('/assets/local', $this->config->getAssetsLocalStorage());
    }

    public function testGetAssetsPublicPath(): void
    {
        $this->assertEquals('/assets/public', $this->config->getAssetsPublicPath());
    }

    public function testGetApiMaxRetries(): void
    {
        $this->assertEquals(3, $this->config->getApiMaxRetries());
    }

    public function testGetApiKeys(): void
    {
        $this->assertEquals(['key1', 'key2'], $this->config->getApiKeys());
    }

    public function testIsJsonDumperEnabled(): void
    {
        $this->assertTrue($this->config->isJsonDumperEnabled());
    }

    public function testGetJsonDumperPath(): void
    {
        $this->assertEquals('/cache/json', $this->config->getJsonDumperPath());
    }

    public function testGetConfig(): void
    {
        $this->assertEquals($this->testConfig, $this->config->getConfig());
    }

    public function testGetDemoKey(): void
    {
        $this->assertEquals('demo-key', $this->config->getDemoKey());
    }

    public function testGetDemoFolder(): void
    {
        $this->assertEquals('demo-folder', $this->config->getDemoFolder());
    }
} 