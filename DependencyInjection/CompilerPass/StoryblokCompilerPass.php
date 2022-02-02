<?php

declare(strict_types=1);

namespace Efrogg\Bundle\StoryblokBundle\DependencyInjection\CompilerPass;

use Efrogg\ContentRenderer\Core\Resolver\ContainerTag;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class StoryblokCompilerPass implements CompilerPassInterface
{

    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        # asset downloader
        $useStoryblokAssetDownloader = $container->getParameter('storyblok.assets_downloader.use');
        $usedServiceName = ($useStoryblokAssetDownloader?'cms.storyblok.cached_asset_handler':'cms.storyblok.asset_handler');
        $container
            ->getDefinition($usedServiceName)
            ->addTag(ContainerTag::TAG_ASSET_HANDLER)
            ->setAbstract(false);

        # json dumper
        $useJsonDumperAsFallbackNodeProvider = $container->getParameter('storyblok.json-dumper.use');
        if($useJsonDumperAsFallbackNodeProvider) {
            $container
                ->getDefinition('cms.storyblok_node_provider_json_fallback')
                ->addTag(ContainerTag::TAG_NODE_PROVIDER,['priority'=>-20]);
        }
    }
}
