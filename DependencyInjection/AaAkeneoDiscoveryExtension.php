<?php

namespace Aa\Bundle\AkeneoDiscoveryBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class AaAkeneoDiscoveryExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
       $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
//        $loader->load('entities.yml');
//        $loader->load('savers.yml');
//        $loader->load('widgets.yml');
//        $loader->load('providers.yml');
    }
}
