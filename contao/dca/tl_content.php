<?php

declare(strict_types=1);

/*
 * This file is part of Usercentrics Bundle for Contao Open Source CMS.
 *
 * (c) eikona-media.de
 *
 * @license MIT
 */

$GLOBALS['TL_DCA']['tl_content']['palettes']['usercentrics_iframe'] = '
    {type_legend},type,headline;
    {iframe_legend},iframeSrc,iframeUcServiceName,iframeUcHintText,iframeWidth,iframeHeight;
    {template_legend:hide},customTpl;
    {protected_legend:hide},protected;
    {expert_legend:hide},guests,cssID;
    {invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['fields']['iframeSrc'] = [
    'exclude' => true,
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 255, 'dcaPicker' => true, 'addWizardClass' => false, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['iframeUcServiceName'] = [
    'exclude' => true,
    'inputType' => 'text',
    'eval' => ['decodeEntities' => true, 'tl_class' => 'w50'],
    'sql' => "text default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['iframeUcHintText'] = [
    'exclude' => true,
    'search' => true,
    'inputType' => 'textarea',
    'eval' => ['rte' => 'tinyMCE', 'tl_class' => 'clr'],
    'sql' => 'text NULL',
];

$GLOBALS['TL_DCA']['tl_content']['fields']['iframeWidth'] = [
    'exclude' => true,
    'inputType' => 'inputUnit',
    'options' => $GLOBALS['TL_CSS_UNITS'],
    'eval' => ['mandatory' => true, 'includeBlankOption' => true, 'rgxp' => 'digit', 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
    'default' => '100%',
];

$GLOBALS['TL_DCA']['tl_content']['fields']['iframeHeight'] = [
    'exclude' => true,
    'inputType' => 'inputUnit',
    'options' => $GLOBALS['TL_CSS_UNITS'],
    'eval' => ['mandatory' => true, 'includeBlankOption' => true, 'rgxp' => 'digit', 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
    'default' => '100%',
];
