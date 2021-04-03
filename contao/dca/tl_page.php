<?php

declare(strict_types=1);

/*
 * This file is part of Usercentrics Bundle for Contao Open Source CMS.
 *
 * (c) eikona-media.de
 *
 * @license MIT
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'usercentricsActive';

PaletteManipulator::create()
    ->addLegend('usercentrics_legend', 'publish_legend', PaletteManipulator::POSITION_BEFORE)
    ->addField(['usercentricsActive'], 'usercentrics_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('root', 'tl_page')
    ->applyToPalette('rootfallback', 'tl_page')
;

$GLOBALS['TL_DCA']['tl_page']['subpalettes']['usercentricsActive'] = 'usercentricsSettingId,usercentricsProtectorActive';

$GLOBALS['TL_DCA']['tl_page']['fields']['usercentricsActive'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['submitOnChange' => true],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['usercentricsSettingId'] = [
    'exclude' => true,
    'search' => true,
    'inputType' => 'text',
    'eval' => ['decodeEntities' => true, 'tl_class' => 'w50'],
    'sql' => "text default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['usercentricsProtectorActive'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50 m12'],
    'sql' => "char(1) NOT NULL default ''",
];
