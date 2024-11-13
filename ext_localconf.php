<?php
declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use Digicademy\CHFMedia\Controller\FileGroupController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

// Register 'Collection' content element
ExtensionUtility::configurePlugin(
    'CHFMedia',
    'Collection',
    [
        FileGroupController::class => 'index, show',
    ],
    [], // None of the actions are non-cacheable
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
