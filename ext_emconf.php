<?php

$EM_CONF[$_EXTKEY] = [
    'title'          => 'CHF Media',
    'description'    => 'Create and manage media archives in TYPO3',
    'category'       => 'misc',
    'author'         => 'Jonatan Jalle Steller',
    'author_email'   => 'jonatan.steller@adwmainz.de',
    'author_company' => 'Academy of Sciences and Literature Mainz',
    'state'          => 'stable',
    'version'        => '2.0.0',
    'constraints'    => [
        'depends'   => [
            'typo3'                => '13.0.0-13.99.99',
            'filemetadata'         => '13.0.0-13.99.99',
            'fluid_styled_content' => '13.0.0-13.99.99'
        ],
        'conflicts' => [
        ],
        'suggests'  => [
        ],
    ],
    'autoload'       => [
        'psr-4' => [
           'Digicademy\\CHFMedia\\' => 'Classes/'
        ]
     ]
];
