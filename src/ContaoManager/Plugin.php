<?php

declare(strict_types=1);

/*
 * This file is part of Usercentrics Bundle for Contao Open Source CMS.
 *
 * (c) eikona-media.de
 *
 * @license MIT
 */

namespace EikonaMedia\Contao\Usercentrics\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use EikonaMedia\Contao\Usercentrics\EikonaMediaContaoUsercentricsBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(EikonaMediaContaoUsercentricsBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
