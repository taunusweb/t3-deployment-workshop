<?php

use TYPO3\CMS\Core\Cache\Backend\NullBackend;
use TYPO3\CMS\Core\Cache\Backend\TransientMemoryBackend;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Log\LogLevel;
use TYPO3\CMS\Core\Log\Writer\FileWriter;

return [
    'BE' => [
    'debug' => true,
    // Convenience
    'sessionTimeout' => 60 * 60 * 24 * 365,
    'installToolPassword' => getenv('TYPO3_INSTALL_TOOL') ?: '$argon2i$v=19$m=65536,t=16,p=1$SFlSZ0k2RDRFRUowNHN5RA$7AfBOwN9K4vc1UxyeZ0mnXASDIJzbceaNTsyKsFU0TQ'
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
//                'charset' => ' utf8mb4',
                'driver' => 'mysqli',
                'host' => getenv('TYPO3_DB_HOST') ?: 'db',
                'user' => getenv('TYPO3_DB_USERNAME') ?: 'db',
                'password' => getenv('TYPO3_DB_PASSWORD') ?: 'db',
                'dbname' => getenv('TYPO3_DB_DATABASE') ?: 'db',
                'port' => getenv('TYPO3_DB_PORT') ?: 3306,
            ],
        ],
    ],
    'EXT' => [

    ],
    'FE' => [
        'debug' => true,
        //   'pageNotFoundOnCHashError' => false,
    ],
    'GFX' => [
        'processor' => 'ImageMagick',
        'processor_path' => '/usr/bin/',
        'processor_path_lzw' => '/usr/bin/',
    ],
    'LOG' => [
        'writerConfiguration' => [
            LogLevel::DEBUG => [
                FileWriter::class => [
                    'logfile' => Environment::getPublicPath() . '/var/log/typo3-default.log'
                ]
            ]
        ]
    ],
    'MAIL' => [
//        'transport' => 'sendmail',
//        'transport_sendmail_command' => '/usr/bin/sendmail -t -i',
        'transport' => 'smtp',
        'transport_smtp_server' => 'localhost:1025',
        'transport_smtp_username' => '',
        'transport_smtp_password' => '',
        'transport_smtp_encrypt' => '',
    ],
    'SYS' => [
        'setDBinit' => "SET NAMES utf8; SET SESSION sql_mode = '';",
        'sitename' => getenv('TYPO3_SITENAME') ? '[DEV] | '. getenv('TYPO3_SITENAME') : '[DEV] TYPO3 11 Test Site',
        // Debug
        'displayErrors' => 1,
        'devIPmask' => '*',
        'sqlDebug' => 1,
        'enableDeprecationLog' => 'file',
        // bootstrap package is throwing deprecation warning exceptions due to filter-sanitization with svgs
        'exceptionalErrors' => E_WARNING | E_USER_ERROR | E_RECOVERABLE_ERROR/* | E_DEPRECATED | E_USER_DEPRECATED*/,
        'systemLogLevel' => 0,
        'caching' => [
            'cacheConfigurations' => [
                // Uncommenting the two lines below will slow down request times dramatically
//                'cache_core' => array(
//                    'backend' => \TYPO3\CMS\Core\Cache\Backend\NullBackend::class,
//                ),
//                'fluid_template' => array(
//                    'backend' => \TYPO3\CMS\Core\Cache\Backend\NullBackend::class,
//                ),
                'cache_hash' => array(
                    'backend' => NullBackend::class,
                    'options' => []
                ),
                'cache_pages' => array(
                    'backend' => NullBackend::class,
                    'options' => []
                ),
                'cache_pagesection' => array(
                    'backend' => NullBackend::class,
                    'options' => []
                ),
                'cache_phpcode' => array(
                    'backend' => NullBackend::class,
                    'options' => []
                ),
                'cache_runtime' => array(
                    'backend' => TransientMemoryBackend::class,
                ),
                'cache_rootline' => array(
                    'backend' => NullBackend::class,
                    'options' => []
                ),
                'cache_imagesizes' => array(
                    'backend' => NullBackend::class,
                    'options' => []
                ),
                'l10n' => array(
                    'backend' => NullBackend::class,
                    'options' => []
                ),
                'extbase_object' => array(
                    'backend' => NullBackend::class,
                    'options' => []
                ),
                'extbase_reflection' => array(
                    'backend' => NullBackend::class,
                    'options' => []
                ),
                'extbase_typo3dbbackend_tablecolumns' => array(
                    'backend' => NullBackend::class,
                    'options' => []
                ),
                'extbase_typo3dbbackend_queries' => array(
                    'backend' => NullBackend::class,
                    'options' => []
                ),
                'extbase_datamapfactory_datamap' => array(
                    'backend' => NullBackend::class,
                    'options' => []
                ),
            ]
        ],
        'trustedHostsPattern' => getenv('TYPO3_TRUSTED_HOSTS_PATTERN') ?: '.*'
    ],
];
