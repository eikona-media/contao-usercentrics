<?php

declare(strict_types=1);

/*
 * This file is part of Usercentrics Bundle for Contao Open Source CMS.
 *
 * (c) eikona-media.de
 *
 * @license MIT
 */

namespace EikonaMedia\Contao\Usercentrics\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class EikonaMediaContaoUsercentricsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yaml');
    }
}
