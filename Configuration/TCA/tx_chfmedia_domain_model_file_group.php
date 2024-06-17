<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * FileGroup and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileGroup',
        'label'                    => 'name',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'isHighlight ASC,name ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_media/Resources/Public/Icons/FileGroup.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'uuid,name,publicationDate,revisionNumber,revisionDate,editorialNote,importOrigin,import',
        'enablecolumns'            => [
            'disabled' => 'hidden',
            'fe_group' => 'fe_group',
        ],
    ],
    'columns' => [
        'fe_group' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.fe_group',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 5,
                'maxitems' => 20,
                'items' => [
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hide_at_login',
                        'value' => -1,
                    ],
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.any_login',
                        'value' => -2,
                    ],
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.usergroups',
                        'value' => '--div--',
                    ],
                ],
                'exclusiveKeys' => '-1,-2',
                'foreign_table' => 'fe_groups',
            ],
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l18n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_chfmedia_domain_model_file_group',
                'foreign_table_where' => 'AND {#tx_chfmedia_domain_model_file_group}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfmedia_domain_model_file_group}.{#sys_language_uid} IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'l18n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => '',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.hidden.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ]
                ],
            ]
        ],
        'parentResource' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'foreign_table' => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###',
                'sortItems' => [
                    'label' => 'asc',
                ],
                'required' => true,
            ],
        ],
        'uuid' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.uuid',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.uuid.description',
            'config' => [
                'type' => 'uuid',
                'size' => 40,
                'required' => true,
            ],
        ],
        'name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileGroup.name',
            'description' => 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileGroup.name.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'required' => true,
            ],
        ],
        'isHighlight' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.isHighlight',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.isHighlight.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => ''
                    ]
                ],
            ]
        ],
        'label' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.label',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.label.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'label\'',
                'MM' => 'tx_chfmedia_domain_model_file_group_tag_label_mm',
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
            ],
        ],
        'sameAs' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_same_as',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'top',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'authorshipRelation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'authorshipRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
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
            ],
        ],
        'licenceRelation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'licenceRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
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
            ],
        ],
        'publicationDate' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'revisionNumber' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber.description',
            'config' => [
                'type' => 'number',
            ],
        ],
        'revisionDate' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'editorialNote' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.editorialNote',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.editorialNote.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'max' => 2000,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'portfolio' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.fileGroup.portfolio',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.fileGroup.portfolio.description',
            'config' => [
                'type' => 'file',
            ],
        ],
        'contentElement' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.contentElement',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.contentElement.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tt_content',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'top',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'footnote' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.footnote',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.footnote.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_footnote',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'top',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'media' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.media',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.media.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-media-types',
            ],
        ],
        'file' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.file',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.file.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-text-types',
            ],
        ],
        'linkRelation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.linkRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.linkRelation.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'linkRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
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
            ],
        ],
        'importOrigin' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.importOrigin',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.importOrigin.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'import' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'max' => 100000,
                'eval' => 'trim',
            ],
        ],
    ],
    'palettes' => [
        'hiddenParentResource' => [
            'showitem' => 'hidden,parentResource,',
        ],
        'publicationDateRevisionNumberRevisionDate' => [
            'showitem' => 'publicationDate,revisionNumber,revisionDate,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hiddenParentResource,uuid,name,isHighlight,label,sameAs,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,authorshipRelation,licenceRelation,publicationDateRevisionNumberRevisionDate,editorialNote,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.content,portfolio,contentElement,footnote,media,file,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.relations,linkRelation,volumeRelation,sourceRelation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,importOrigin,import,',
        ],
    ],
];
