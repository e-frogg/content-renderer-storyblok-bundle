<?php

namespace Efrogg\Bundle\StoryblokBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('storyblok');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->arrayNode('pages')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('directory')
                            ->prototype('scalar')->end()
                            ->defaultValue(['pages/'])
                        ->end()
                        ->scalarNode('base_route')->defaultValue('/storyblok')->end()
                    ->end()
                ->end()
                ->arrayNode('assets')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('downloader')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->booleanNode('use')->defaultFalse()->end()
                                ->scalarNode('local_storage')->defaultValue('%shopware.filesystem.public.config.root%/cms-pictures/')->end()
                                ->scalarNode('public_path')->defaultValue('/cms-pictures/')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('api')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('max_retries')->defaultValue(3)->end()
                        ->arrayNode('keys')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('preview')->defaultValue('')->end()
                                ->scalarNode('public')->defaultValue('')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('cache')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('json_dumper')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->booleanNode('use')->defaultFalse()->end()
                                ->scalarNode('dump_path')->defaultValue('%kernel.cache_dir%/cms/json')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
} 