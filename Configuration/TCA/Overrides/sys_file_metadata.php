<?php
declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * FileMetadata and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Modify table settings
$GLOBALS['TCA']['sys_file_metadata']['ctrl']['sortby'] = 'sorting';
$GLOBALS['TCA']['sys_file_metadata']['ctrl']['default_sortby'] = 'is_highlight ASC,title ASC';
$GLOBALS['TCA']['sys_file_metadata']['ctrl']['descriptionColumn'] = 'editorial_note';
$GLOBALS['TCA']['sys_file_metadata']['ctrl']['searchFields'] = 'title,alternative,caption,copyright,creator_tool,duration,color_space,width,height,unit,pages,iri,uuid,content_creation_date,content_modification_date,revision_number,editorial_note,import_origin,import';

// Add various columns
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_metadata',
    [
        'extent' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.extent',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.extent.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_extent',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'label' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.label',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.label.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#type}=\'labelTag\'',
                'MM' => 'tx_chfmedia_domain_model_filemetadata_tag_label_mm',
                'multiple' => 1,
                'treeConfig' => [
                    'parentField' => 'parent_label_tag',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => true,
                    ],
                ],
                'size' => 8,
            ],
        ],
        'location_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.locationRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.locationRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'sys_file_metadata',
                    'fieldname' => 'location_relation',
                ],
                'MM_opposite_field' => 'record',
                'multiple' => 1,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'default' => 'locationRelation',
                                'readOnly' => true,
                            ],
                        ],
                        'role' => [
                            'config' => [
                                'default' => 'genericLocation',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'link_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.linkRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.linkRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'sys_file_metadata',
                    'fieldname' => 'link_relation',
                ],
                'MM_opposite_field' => 'record',
                'multiple' => 1,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'default' => 'linkRelation',
                                'readOnly' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'is_teaser' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.isTeaser',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.isTeaser.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                    ]
                ],
            ]
        ],
        'is_highlight' => [
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
        'iri' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.iri',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.iri.description',
            'config' => [
                'type' => 'slug',
                'size' => 40,
                'appearance' => [
                    'prefix' => 'Digicademy\CHFBase\UserFunctions\FormEngine\SlugPrefix->getPrefix',
                ],
                'prependSlash' => false,
                'generatorOptions' => [
                    'fields' => [
                        'uid',
                    ],
                    'fieldSeparator' => '/',
                    'prefixParentPageSlug' => false,
                    'replacements' => [
                        '/' => '',
                    ],
                ],
                'eval' => 'uniqueInSite',
                'fallbackCharacter' => '',
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
        'same_as' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_sameas',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'revision_number' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber.description',
            'config' => [
                'type' => 'number',
                'size' => 13,
                'default' => 1,
                'range' => [
                    'lower' => 1,
                ],
                'required' => true,
            ],
        ],
        'editorial_note' => [
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
        'authorship_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'sys_file_metadata',
                    'fieldname' => 'authorship_relation',
                ],
                'MM_opposite_field' => 'record',
                'multiple' => 1,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'default' => 'authorshipRelation',
                                'readOnly' => true,
                            ],
                        ],
                        'role' => [
                            'config' => [
                                'default' => 'author',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'licence_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'sys_file_metadata',
                    'fieldname' => 'licence_relation',
                ],
                'MM_opposite_field' => 'record',
                'multiple' => 1,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'default' => 'licenceRelation',
                                'readOnly' => true,
                            ],
                        ],
                        'role' => [
                            'config' => [
                                'default' => 'allContent',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'import_origin' => [
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
    ]
);

// Modify labels and descriptions
$GLOBALS['TCA']['sys_file_metadata']['columns']['title']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.title.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['alternative']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.alternative.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['caption']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.caption.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['copyright']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.copyright.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['creator_tool']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.creator_tool.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['duration']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.duration.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['color_space']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.color_space.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['width']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.width.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['height']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.height.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['unit']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.unit.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['pages']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.pages.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['visible']['description'] = 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.hidden.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['content_creation_date']['label'] = 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate';
$GLOBALS['TCA']['sys_file_metadata']['columns']['content_creation_date']['description'] = 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['content_modification_date']['label'] = 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate';
$GLOBALS['TCA']['sys_file_metadata']['columns']['content_modification_date']['description'] = 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate.description';

// Modify translation settings
$GLOBALS['TCA']['sys_file_metadata']['columns']['creator_tool']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['duration']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['color_space']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['width']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['height']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['unit']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['pages']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['visible']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['content_creation_date']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['content_modification_date']['l10n_mode'] = 'exclude';

// Create palette 'titleAlternative'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_metadata',
    'titleAlternative',
    'title,alternative,'
);

// Create palette 'captionCopyright'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_metadata',
    'captionCopyright',
    'caption,copyright,'
);

// Create palette 'widthHeightUnit'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_metadata',
    'widthHeightUnit',
    'width,height,unit,'
);

// Create palette 'visibleIsTeaserIsHighlight'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_metadata',
    'visibleIsTeaserIsHighlight',
    'visible,is_teaser,is_highlight,'
);

// Create palette 'iriUuid'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_metadata',
    'iriUuid',
    'iri,uuid,'
);

// Create palette 'publicationDateRevisionDateRevisionNumber'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_metadata',
    'publicationDateRevisionDateRevisionNumber',
    'content_creation_date,content_modification_date,revision_number,'
);

// Use a custom display order for properties
$GLOBALS['TCA']['sys_file_metadata']['types'] = [
    TYPO3\CMS\Core\Resource\FileType::UNKNOWN->value => [
        'showitem' => 'fileinfo,title,--palette--;;captionCopyright,extent,label,
            --div--;LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.fileType,creator_tool,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,coordinates,location_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,source_relation,link_relation,publication_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.placement,--palette--;;visibleIsTeaserIsHighlight,--palette--;;iriUuid,same_as,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,editorial_note,authorship_relation,licence_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,import,',
    ],
    TYPO3\CMS\Core\Resource\FileType::TEXT->value => [
        'showitem' => 'fileinfo,title,--palette--;;captionCopyright,extent,label,
            --div--;LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.fileType,creator_tool,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,coordinates,location_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,source_relation,link_relation,publication_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.placement,--palette--;;visibleIsTeaserIsHighlight,--palette--;;iriUuid,same_as,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,editorial_note,authorship_relation,licence_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,import,',
    ],
    TYPO3\CMS\Core\Resource\FileType::IMAGE->value => [
        'showitem' => 'fileinfo,--palette--;;titleAlternative,--palette--;;captionCopyright,extent,label,
            --div--;LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.fileType,creator_tool,color_space,--palette--;;widthHeightUnit,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,coordinates,location_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,source_relation,link_relation,publication_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.placement,--palette--;;visibleIsTeaserIsHighlight,--palette--;;iriUuid,same_as,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,editorial_note,authorship_relation,licence_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,import,',
    ],
    TYPO3\CMS\Core\Resource\FileType::AUDIO->value => [
        'showitem' => 'fileinfo,title,--palette--;;captionCopyright,extent,label,
            --div--;LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.fileType,creator_tool,duration,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,coordinates,location_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,source_relation,link_relation,publication_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.placement,--palette--;;visibleIsTeaserIsHighlight,--palette--;;iriUuid,same_as,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,editorial_note,authorship_relation,licence_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,import,',
    ],
    TYPO3\CMS\Core\Resource\FileType::VIDEO->value => [
        'showitem' => 'fileinfo,title,--palette--;;captionCopyright,extent,label,
            --div--;LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.fileType,creator_tool,duration,--palette--;;widthHeightUnit,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,coordinates,location_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,source_relation,link_relation,publication_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.placement,--palette--;;visibleIsTeaserIsHighlight,--palette--;;iriUuid,same_as,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,editorial_note,authorship_relation,licence_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,import,',
    ],
    TYPO3\CMS\Core\Resource\FileType::APPLICATION->value => [
        'showitem' => 'fileinfo,title,--palette--;;captionCopyright,extent,label,
            --div--;LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.fileType,creator_tool,pages,--palette--;;widthHeightUnit,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,coordinates,location_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,source_relation,link_relation,publication_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.placement,--palette--;;visibleIsTeaserIsHighlight,--palette--;;iriUuid,same_as,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,editorial_note,authorship_relation,licence_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,import,',
    ],
];
