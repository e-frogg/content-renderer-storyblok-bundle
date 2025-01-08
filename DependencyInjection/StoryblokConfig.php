<?php

declare(strict_types=1);

namespace Efrogg\Bundle\StoryblokBundle\DependencyInjection;

class StoryblokConfig
{
    /**
     * @param array{
     *     pages: array{
     *         directory: array<string>,
     *         base_route: string
     *     },
     *     assets: array{
     *         downloader: array{
     *             use: bool,
     *             local_storage: string,
     *             public_path: string
     *         }
     *     },
     *     api: array{
     *         max_retries: int,
     *         keys: array<string>
     *     },
     *     cache: array{
     *         json_dumper: array{
     *             use: bool,
     *             dump_path: string
     *         }
     *     }
     * } $config
     */
    public function __construct(
        private array $config,
    ) {
    }

    /**
     * @return array<string>
     */
    public function getPagesDirectory(): array
    {
        return $this->config['pages']['directory'];
    }

    public function getBaseRoute(): string
    {
        return $this->config['pages']['base_route'];
    }

    public function isAssetsDownloaderEnabled(): bool
    {
        return $this->config['assets']['downloader']['use'];
    }

    public function getAssetsLocalStorage(): string
    {
        return $this->config['assets']['downloader']['local_storage'];
    }

    public function getAssetsPublicPath(): string
    {
        return $this->config['assets']['downloader']['public_path'];
    }

    public function getApiMaxRetries(): int
    {
        return $this->config['api']['max_retries'];
    }

    public function getApiKeys(): array
    {
        return $this->config['api']['keys'];
    }

    public function isJsonDumperEnabled(): bool
    {
        return $this->config['cache']['json_dumper']['use'];
    }

    public function getJsonDumperPath(): string
    {
        return $this->config['cache']['json_dumper']['dump_path'];
    }

    public function getConfig(): array
    {
        return $this->config;
    }
}
