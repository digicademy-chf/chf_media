<?php
declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * LabelTag and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add column 'asLabelOfFileGroup'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_tag',
    [
        'asLabelOfFileGroup' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfFileGroup',
            'description' => 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfFileGroup.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfmedia_domain_model_file_group',
                'foreign_table_where' => 'AND {#tx_chfmedia_domain_model_file_group}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chfmedia_domain_model_file_group_tag_label_mm',
                'MM_opposite_field' => 'label',
                'MM_match_fields' => [
                    'fieldname' => 'asLabelOfFileGroup',
                ],
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'readOnly' => true,
            ],
        ],
    ]
);
