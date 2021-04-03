<?php

declare(strict_types=1);

/*
 * This file is part of Usercentrics Bundle for Contao Open Source CMS.
 *
 * (c) eikona-media.de
 *
 * @license MIT
 */

namespace EikonaMedia\Contao\Usercentrics\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use PageModel;

/**
 * @Hook("modifyFrontendPage")
 */
class ModifyFrontendPageListener
{
    public const UC_SCRIPT = '<script type="application/javascript" src="https://app.usercentrics.eu/latest/main.js" id="%s" ></script>';
    public const UC_PRIVACY_PROXY = '<meta data-privacy-proxy-server="https://privacy-proxy-server.usercentrics.eu">';
    public const UC_PROTECTOR = '<script type="application/javascript" src="https://privacy-proxy.usercentrics.eu/latest/uc-block.bundle.js"></script>';

    public function __invoke(string $buffer, string $templateName): string
    {
        if (false === strpos($templateName, 'fe_', 0)) {
            return $buffer;
        }

        global $objPage;

        if (null !== ($objRootPage = PageModel::findByPk($objPage->rootId)) && 1 === (int) $objRootPage->usercentricsActive) {
            $settingId = $objRootPage->usercentricsSettingId;

            if (!empty($settingId)) {
                $script = sprintf(self::UC_SCRIPT, $settingId);

                if (1 === (int) $objRootPage->usercentricsProtectorActive) {
                    $script .= self::UC_PRIVACY_PROXY;
                    $script .= self::UC_PROTECTOR;
                }
                $buffer = str_replace(
                    '</title>',
                    "</title>\n$script",
                    $buffer
                );
            }
        }

        return $buffer;
    }
}
