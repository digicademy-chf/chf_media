<?php
declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use Digicademy\CHFMedia\Controller\GalleryController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

// Default file conversions in the frontend
$GLOBALS['TYPO3_CONF_VARS']['GFX']['imageFileConversionFormats'] = [
    'jpg' => 'jpg',
    'jpeg' => 'jpeg',
    'avif' => 'avif',
    'gif' => 'gif',
    'png' => 'png',
    'webp' => 'webp',
    'svg' => 'svg',
    'default' => 'jpg',
];

// Set image options (remove blur, set sRGB, improve quality)
$GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_effects'] = 0;
$GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_stripColorProfileParameters'] = [
    '-profile',
    '../vendor/digicademy/chf_media/Resources/Private/Icc/sRGB2014.icc',
];
$GLOBALS['TYPO3_CONF_VARS']['GFX']['avif_quality'] = 90;
$GLOBALS['TYPO3_CONF_VARS']['GFX']['jpg_quality'] = 90;
$GLOBALS['TYPO3_CONF_VARS']['GFX']['webp_quality'] = 90;

// Register 'Gallery' content element
ExtensionUtility::configurePlugin(
    'CHFMedia',
    'Gallery',
    [
        GalleryController::class => 'index, show, showGroup',
    ],
    [], // None of the actions are non-cacheable
    null,
);
