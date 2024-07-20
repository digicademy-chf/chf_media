<?php
declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

defined('TYPO3') or die();

// Extension-provided icons
return [
    'tx-chfmedia' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_media/Resources/Public/Icons/Extension.svg',
    ],
    'tx-chfmedia-table-file-group' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_media/Resources/Public/Icons/TableFileGroup.svg',
    ],
    'tx-chfmedia-plugin-media-collection' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_media/Resources/Public/Icons/PluginMediaCollection.svg',
    ],
];
