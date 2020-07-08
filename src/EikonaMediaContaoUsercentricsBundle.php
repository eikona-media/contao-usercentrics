<?php

declare(strict_types=1);

/*
 * This file is part of Usercentrics Bundle for Contao Open Source CMS.
 *
 * (c) eikona-media.de
 *
 * @license MIT
 */

namespace EikonaMedia\Contao\Usercentrics;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EikonaMediaContaoUsercentricsBundle extends Bundle
{
    public function getPath()
    {
        return \dirname(__DIR__);
    }
}
