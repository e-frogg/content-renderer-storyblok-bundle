<?php

declare(strict_types=1);

namespace Efrogg\Bundle\StoryblokBundle\DependencyInjection\CompilerPass;

use Efrogg\Bundle\StoryblokBundle\DependencyInjection\StoryblokConfig;
use Efrogg\ContentRenderer\Core\Resolver\ContainerTag;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class StoryblokCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        /**
         * @var StoryblokConfig $config
         */
        $config = $container->get('storyblok.config');

        // asset downloader
        $usedServiceName = ($config->isAssetsDownloaderEnabled() ? 'cms.storyblok.cached_asset_handler' : 'cms.storyblok.asset_handler');
        $container
            ->getDefinition($usedServiceName)
            ->addTag(ContainerTag::TAG_ASSET_HANDLER)
            ->setAbstract(false);

        // json dumper
        $useJsonDumperAsFallbackNodeProvider = $config->isJsonDumperEnabled();
        if ($useJsonDumperAsFallbackNodeProvider) {
            $container
                ->getDefinition('cms.storyblok_node_provider_json_fallback')
                ->addTag(ContainerTag::TAG_NODE_PROVIDER, ['priority' => -20]);
        }
    }
}
