<?php

namespace Efrogg\Bundle\StoryblokBundle\DependencyInjection\Compiler;

use Efrogg\Bundle\StoryblokBundle\Log\StoryblokLogger;
use Efrogg\ContentRenderer\Core\Resolver\ContainerTag;
use Efrogg\ContentRenderer\NodeProvider\JsonDumperNodeProvider;
use Efrogg\ContentRenderer\NodeProvider\SimpleJsonFileNodeProvider;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class JsonDumperPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
//        /** @var string[] $cacheServices */
        if (!$container->hasParameter('storyblok.json-dumper')) {
            return;
        }

        $dumperConfiguration = $container->getParameter('storyblok.json-dumper');

        if (($dumperConfiguration['write'] ?? false)) {
            // remove original node provider tag
            $definition = $container->getDefinition('cms.storyblok_node_provider')
                                    ->clearTag(ContainerTag::TAG_NODE_PROVIDER);
//
            // inject new service instead
            $container->register('cms.storyblok_node_provider_json_dumper', JsonDumperNodeProvider::class)
                      ->addArgument($dumperConfiguration['dump-path'])
                      ->addMethodCall('setNodeProvider', [$definition])
                      ->addMethodCall('setLogger', [new Reference('cms.storyblok.logger')])
//             ->addMethodCall('addConverterDecorator', [new UTF8EncodeStringDecorator()])
                      ->addTag(ContainerTag::TAG_NODE_PROVIDER);
        }

        if (($dumperConfiguration['read'] ?? false)) {
            // use simple json as node source
            $container->register('cms.storyblok_node_provider_json', SimpleJsonFileNodeProvider::class)
                      ->addArgument($dumperConfiguration['dump-path'])
//             ->addMethodCall('addDecorator', [new UTF8DecodeStringDecorator()])
                      ->addMethodCall('setLogger', [new Reference('cms.storyblok.logger')])
                      ->addTag(ContainerTag::TAG_NODE_PROVIDER);
        }
    }
}
