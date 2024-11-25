<?php
declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use Digicademy\CHFMedia\Controller\GalleryController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

// Register 'Gallery' content element
ExtensionUtility::configurePlugin(
    'CHFMedia',
    'Gallery',
    [
        GalleryController::class => 'index, showSingle, showGroup',
    ],
    [], // None of the actions are non-cacheable
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
