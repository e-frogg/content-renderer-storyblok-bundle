<?php

namespace Efrogg\Bundle\StoryblokBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class StoryblokExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $serviceLoader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $serviceLoader->load('services.yaml');


//        $routesLoader = new \Symfony\Component\Routing\Loader\YamlFileLoader(
//            new FileLocator(__DIR__.'/../Resources/config')
//        );
//        $routesLoader->load('routes.yaml');

    }
}
