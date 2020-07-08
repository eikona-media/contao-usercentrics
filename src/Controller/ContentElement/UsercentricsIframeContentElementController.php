<?php

declare(strict_types=1);

/*
 * This file is part of Usercentrics Bundle for Contao Open Source CMS.
 *
 * (c) eikona-media.de
 *
 * @license MIT
 */

namespace EikonaMedia\Contao\Usercentrics\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\ServiceAnnotation\ContentElement;
use Contao\PageModel;
use Contao\StringUtil;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @ContentElement("usercentrics_iframe", category="includes", template="ce_usercentric_iframe")
 */
class UsercentricsIframeContentElementController extends AbstractContentElementController
{
    protected function getResponse(Template $template, ContentModel $model, Request $request): ?Response
    {
        global $objPage;

        $GLOBALS['TL_JAVASCRIPT']['usercentrics'] = 'bundles/eikonamediacontaousercentrics/usercentrics.js';

        $template->iframeSrc = $model->iframeSrc;
        $template->iframeUcServiceName = $model->iframeUcServiceName;
        $template->iframeUcHintText = $model->iframeUcHintText;

        // Clean the RTE output
        if ('' !== $model->iframeUcHintText) {
            $template->iframeUcHintText = StringUtil::toHtml5($model->iframeUcHintText);
            $template->iframeUcHintText = StringUtil::encodeEmail($template->iframeUcHintText);
        }

        $template->iframeWidth = '100%';
        $size = StringUtil::deserialize($model->iframeWidth);

        if (isset($size['value']) && '' !== $size['value'] && $size['value'] >= 0) {
            $template->iframeWidth = $size['value'].$size['unit'];
        }

        $template->iframeHeight = '300px';
        $size = StringUtil::deserialize($model->iframeHeight);

        if (isset($size['value']) && '' !== $size['value'] && $size['value'] >= 0) {
            $template->iframeHeight = $size['value'].$size['unit'];
        }

        if (null !== ($objRootPage = PageModel::findByPk($objPage->rootId))) {
            $template->usercentricsActive = (int) $objRootPage->usercentricsActive;
            $template->usercentricsSettingId = $objRootPage->usercentricsSettingId;
            $template->usercentricsProtectorActive = (int) $objRootPage->usercentricsProtectorActive;
        }

        return $template->getResponse();
    }
}
