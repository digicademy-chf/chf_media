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
$GLOBALS['TCA']['sys_file_metadata']['ctrl']['default_sortby'] = 'is_highlight ASC,content_creation_date DESC,title ASC';
$GLOBALS['TCA']['sys_file_metadata']['ctrl']['descriptionColumn'] = 'note';
$GLOBALS['TCA']['sys_file_metadata']['ctrl']['searchFields'] = 'title,alternative,download_name,caption,copyright,creator_tool,duration,color_space,width,height,unit,pages,location_continent,location_country,location_region,location_city,location_building,location_part_of_building,longitude,latitude,iri,uuid,content_creation_date,content_modification_date,revision_number,note,import_origin';

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
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#sys_language_uid} IN (-1, 0)'
                    #. ' AND {#tx_chfbase_domain_model_tag}.{#pid} IN (###CURRENT_PID###, ###SITE:settings.chf.data.falPage###, ###SITE:settings.chf.data.page###)'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'labelTag\'',
                'MM' => 'tx_chfbase_domain_model_tag_record_mm',
                'MM_match_fields' => [
                    'fieldname' => 'label',
                    'tablenames' => 'sys_file_metadata',
                ],
                'MM_opposite_field' => 'items',
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
        'agent_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.agentRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.agentRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_field' => 'record',
                'foreign_match_fields' => [
                    'type' => 'agentRelation'
                ],
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
                                'readOnly' => true,
                            ],
                        ],
                        'role' => [
                            'config' => [
                                'default' => 'curator',
                            ],
                        ],
                    ],
                ],
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
                'foreign_field' => 'record',
                'foreign_match_fields' => [
                    'type' => 'locationRelation'
                ],
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
        'location_continent' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.locationContinent',
            'description' => 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.locationContinent.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'location_building' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.locationBuilding',
            'description' => 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.locationBuilding.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'location_part_of_building' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.locationPartOfBuilding',
            'description' => 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.locationPartOfBuilding.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
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
                'foreign_field' => 'record',
                'foreign_match_fields' => [
                    'type' => 'linkRelation'
                ],
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
                    'prefixParentPageSlug' => false,
                    'replacements' => [
                        '/' => '',
                    ],
                ],
                'default' => 'f',
                'eval' => 'uniqueInSite',
                'fallbackCharacter' => '',
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
        'authorship_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_field' => 'record',
                'foreign_match_fields' => [
                    'type' => 'authorshipRelation'
                ],
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
                'foreign_field' => 'record',
                'foreign_match_fields' => [
                    'type' => 'licenceRelation'
                ],
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
    ]
);

// Modify labels, descriptions, and other settings of existing fields
$GLOBALS['TCA']['sys_file_metadata']['columns']['title']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.title.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['alternative']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.alternative.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['download_name']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.downloadName.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['caption']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.caption.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['copyright']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.copyright.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['categories']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.categories.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['categories']['config']['size'] = 8;
$GLOBALS['TCA']['sys_file_metadata']['columns']['creator_tool']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.creator_tool.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['creator_tool']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['duration']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.duration.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['duration']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['color_space']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.color_space.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['color_space']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['width']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.width.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['width']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['height']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.height.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['height']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['unit']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.unit.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['unit']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['pages']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.pages.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['pages']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['location_country']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.locationCountry.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['location_country']['size'] = 40;
$GLOBALS['TCA']['sys_file_metadata']['columns']['location_country']['max'] = 255;
$GLOBALS['TCA']['sys_file_metadata']['columns']['location_region']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.locationRegion.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['location_region']['size'] = 40;
$GLOBALS['TCA']['sys_file_metadata']['columns']['location_region']['max'] = 255;
$GLOBALS['TCA']['sys_file_metadata']['columns']['location_city']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.locationCity.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['location_city']['size'] = 40;
$GLOBALS['TCA']['sys_file_metadata']['columns']['location_city']['max'] = 255;
$GLOBALS['TCA']['sys_file_metadata']['columns']['longitude']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.longitude.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['longitude']['size'] = 40;
$GLOBALS['TCA']['sys_file_metadata']['columns']['longitude']['max'] = 255;
$GLOBALS['TCA']['sys_file_metadata']['columns']['latitude']['description'] = 'LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.latitude.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['latitude']['size'] = 40;
$GLOBALS['TCA']['sys_file_metadata']['columns']['latitude']['max'] = 255;
$GLOBALS['TCA']['sys_file_metadata']['columns']['visible']['description'] = 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.hidden.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['visible']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['visible']['config']['renderType'] = 'checkboxToggle';
$GLOBALS['TCA']['sys_file_metadata']['columns']['content_creation_date']['label'] = 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate';
$GLOBALS['TCA']['sys_file_metadata']['columns']['content_creation_date']['description'] = 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['content_creation_date']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['content_modification_date']['label'] = 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate';
$GLOBALS['TCA']['sys_file_metadata']['columns']['content_modification_date']['description'] = 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['content_modification_date']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['sys_file_metadata']['columns']['note']['label'] = 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.editorialNote';
$GLOBALS['TCA']['sys_file_metadata']['columns']['note']['description'] = 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.editorialNote.description';
$GLOBALS['TCA']['sys_file_metadata']['columns']['note']['config']['rows'] = 5;
$GLOBALS['TCA']['sys_file_metadata']['columns']['note']['config']['max'] = 2000;
$GLOBALS['TCA']['sys_file_metadata']['columns']['note']['config']['behaviour']['allowLanguageSynchronization'] = true;

// Create palette 'alternativeDownloadName'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_metadata',
    'alternativeDownloadName',
    'alternative,download_name,'
);

// Create palette 'captionCopyright'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_metadata',
    'captionCopyright',
    'caption,copyright,'
);

// Create palette 'labelCategories'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_metadata',
    'labelCategories',
    'label,categories,'
);

// Create palette 'widthHeightUnit'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_metadata',
    'widthHeightUnit',
    'width,height,unit,'
);

// Create palette 'longitudeLatitude'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_metadata',
    'longitudeLatitude',
    'longitude,latitude,'
);

// Create palette 'location'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_metadata',
    'location',
    'location_continent,location_country,location_region,--linebreak--,location_city,location_building,location_part_of_building,'
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
// Original showitem also contains 'description', 'ranking, 'keywords', 'creator', 'publisher', 'source', 'language', and 'fe_groups'
$GLOBALS['TCA']['sys_file_metadata']['types'] = [
    TYPO3\CMS\Core\Resource\FileType::UNKNOWN->value => [
        'showitem' => 'fileinfo,title,download_name,--palette--;;captionCopyright,extent,--palette--;;labelCategories,
            --div--;LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.fileType,creator_tool,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,agent_relation,location_relation,--palette--;;location,--palette--;;longitudeLatitude,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,source_relation,link_relation,publication_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,--palette--;;visibleIsTeaserIsHighlight,--palette--;;iriUuid,same_as,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,note,authorship_relation,licence_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,',
    ],
    TYPO3\CMS\Core\Resource\FileType::TEXT->value => [
        'showitem' => 'fileinfo,title,download_name,--palette--;;captionCopyright,extent,--palette--;;labelCategories,
            --div--;LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.fileType,creator_tool,pages,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,agent_relation,location_relation,--palette--;;location,--palette--;;longitudeLatitude,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,source_relation,link_relation,publication_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,--palette--;;visibleIsTeaserIsHighlight,--palette--;;iriUuid,same_as,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,note,authorship_relation,licence_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,',
    ],
    TYPO3\CMS\Core\Resource\FileType::IMAGE->value => [
        'showitem' => 'fileinfo,title,--palette--;;alternativeDownloadName,--palette--;;captionCopyright,extent,--palette--;;labelCategories,
            --div--;LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.fileType,creator_tool,color_space,--palette--;;widthHeightUnit,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,agent_relation,location_relation,--palette--;;location,--palette--;;longitudeLatitude,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,source_relation,link_relation,publication_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,--palette--;;visibleIsTeaserIsHighlight,--palette--;;iriUuid,same_as,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,note,authorship_relation,licence_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,',
    ],
    TYPO3\CMS\Core\Resource\FileType::AUDIO->value => [
        'showitem' => 'fileinfo,title,download_name,--palette--;;captionCopyright,extent,--palette--;;labelCategories,
            --div--;LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.fileType,creator_tool,duration,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,agent_relation,location_relation,--palette--;;location,--palette--;;longitudeLatitude,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,source_relation,link_relation,publication_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,--palette--;;visibleIsTeaserIsHighlight,--palette--;;iriUuid,same_as,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,note,authorship_relation,licence_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,',
    ],
    TYPO3\CMS\Core\Resource\FileType::VIDEO->value => [
        'showitem' => 'fileinfo,title,download_name,--palette--;;captionCopyright,extent,--palette--;;labelCategories,
            --div--;LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.fileType,creator_tool,duration,--palette--;;widthHeightUnit,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,agent_relation,location_relation,--palette--;;location,--palette--;;longitudeLatitude,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,source_relation,link_relation,publication_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,--palette--;;visibleIsTeaserIsHighlight,--palette--;;iriUuid,same_as,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,note,authorship_relation,licence_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,',
    ],
    TYPO3\CMS\Core\Resource\FileType::APPLICATION->value => [
        'showitem' => 'fileinfo,title,download_name,--palette--;;captionCopyright,extent,--palette--;;labelCategories,
            --div--;LLL:EXT:chf_media/Resources/Private/Language/locallang.xlf:object.fileMetadata.fileType,creator_tool,pages,--palette--;;widthHeightUnit,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,agent_relation,location_relation,--palette--;;location,--palette--;;longitudeLatitude,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,source_relation,link_relation,publication_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,--palette--;;visibleIsTeaserIsHighlight,--palette--;;iriUuid,same_as,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,note,authorship_relation,licence_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,',
    ],
];
