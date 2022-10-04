<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Snowowl Sitepackage',
    'description' => 'Instance Specific Sitepackage',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-11.5.99',
            'fluid_styled_content' => '9.5.0-11.5.99',
            'rte_ckeditor' => '9.5.0-11.5.99'
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Snowowl78\\MySitepackage\\' => 'Classes'
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Thorsten Weber',
    'author_email' => 'snowowl78@gmail.com',
    'author_company' => 'Thorsten Weber',
    'version' => '0.1',
];
