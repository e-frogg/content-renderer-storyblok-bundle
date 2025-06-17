<?php

namespace Efrogg\Bundle\StoryblokBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class StoryblokExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        // usefull for the base route (route.yaml)
        $container->setParameter('storyblok.base-route', $config['pages']['base_route']);
        $container->setParameter('storyblok.demo-folder', $config['demo']['folder']);

        $container->setDefinition(
            'storyblok.config',
            new Definition(StoryblokConfig::class, [$config])
        );
    }

    public function getAlias(): string
    {
        return 'storyblok';
    }
}
