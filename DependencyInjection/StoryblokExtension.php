<?php

namespace Efrogg\Bundle\StoryblokBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class StoryblokExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        // Configuration des pages
        $container->setParameter('storyblok.page-directory', $config['pages']['directory']);
        $container->setParameter('storyblok.base-route', $config['pages']['base_route']);

        // Configuration des assets
        $container->setParameter('storyblok.assets_downloader.use', $config['assets']['downloader']['use']);
        $container->setParameter('storyblok.assets_downloader.local_storage', $config['assets']['downloader']['local_storage']);
        $container->setParameter('storyblok.assets_downloader.public_path', $config['assets']['downloader']['public_path']);

        // Configuration de l'API
        $container->setParameter('storyblok.max_retries', $config['api']['max_retries']);
        $container->setParameter('storyblok.api-keys', $config['api']['keys']);

        // Configuration du cache
        $container->setParameter('storyblok.json-dumper.use', $config['cache']['json_dumper']['use']);
        $container->setParameter('storyblok.json-dumper.dump-path', $config['cache']['json_dumper']['dump_path']);

//        dump(array_filter($container->getParameterBag()->all(), function ($key) {
//            return strpos($key, 'storyblok') === 0;
//        }, ARRAY_FILTER_USE_KEY));
    }

    public function getAlias(): string
    {
        return 'storyblok';
    }
}
