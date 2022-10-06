<?php

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Log\LogLevel;
use TYPO3\CMS\Core\Log\Writer\FileWriter;

return [
//    'EXTENSIONS' => [
//    ],
    'LOG' => [
        'writerConfiguration' => [
            LogLevel::WARNING => [
                FileWriter::class => [
                    'logFile' => Environment::getPublicPath() . '/var/log/typo3-default.log'
                ]
            ]
        ]
    ],
];
