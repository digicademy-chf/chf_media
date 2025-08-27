<?php
declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * MediaResource and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add select item 'mediaResource'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_resource', 'type',
    [
        'label' => 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.mediaResource.type.mediaResource',
        'value' => 'mediaResource',
    ]
);

// Add column 'fileStorage'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_resource',
    [
        'fileStorage' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.mediaResource.fileStorage',
            'description' => 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.mediaResource.fileStorage.description',
            'config' => [
                'type' => 'folder',
                'maxitems' => 1,
            ],
        ],
    ]
);

// Add type 'mediaResource' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['types'] += ['mediaResource' => [
   'showitem' => 'type,--palette--;;titleLangCode,description,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,items,storage,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,--palette--;;iriUuid,same_as,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,editorial_note,authorship_relation,licence_relation,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,import_state,',
]];

// Add opposite usage info to 'items' column
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['columns']['items']['config']['MM_oppositeUsage']['tx_chfmedia_domain_model_filegroup'] = ['parent_resource'];
