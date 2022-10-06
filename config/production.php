<?php
// All production values should be in LocalConfiguration.php
return [
    'BE' => [
        'IPmaskList' => '',
        'adminOnly' => '0',
        'compressionLevel' => '5',
        'debug' => '0',
        'explicitADmode' => 'explicitAllow',
        'installToolPassword' => getenv('TYPO3_INSTALL_TOOL'),
        'lockSSL' => '1',

        'versionNumberInFilename' => '0',
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\BcryptPasswordHash',
            'options' => [],
        ],
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
                'charset' => 'utf8',
                'host' => getenv('TYPO3_DB_HOST'),
                'user' => getenv('TYPO3_DB_USERNAME'),
                'password' =>  getenv('TYPO3_DB_PASSWORD'),
                'dbname' => getenv('TYPO3_DB_DATABASE'),
                'port' => getenv('TYPO_DB_PORT'),
            ],
        ],
    ],
    'EXTCONF' => [
        'lang' => [
            'availableLanguages' => [
                'de',
            ],
        ],
    ],
    'FE' => [
        'cHashIncludePageId' => '1',
        'debug' => '0',

        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\BcryptPasswordHash',
            'options' => [],
        ],
    ],
    'GFX' => [
        'colorspace' => 'sRGB',
        'im' => 1,
        'im_mask_temp_ext_gif' => 1,
        'im_path' => '/usr/bin/',
        'im_path_lzw' => '/usr/bin/',
        'im_v5effects' => 1,
        'im_version_5' => 'im6',
        'image_processing' => 1,
        'jpg_quality' => '80',
    ],
    'HTTP' => [
        'adapter' => 'curl',
        'userAgent' => 'TYPO3',
    ],
    'MAIL' => [
        'transport' => getenv('TYPO3_MAIL_TRANSPORT'),
        'transport_sendmail_command' => getenv('TYPO3_MAIL_TRANSPORT_SENDMAIL_COMMAND'),
        'transport_smtp_encrypt' => getenv('TYPO3_MAIL_TRANSPORT_SMTP_ENCRYPT'),
        'transport_smtp_password' => getenv('TYPO3_MAIL_TRANSPORT_SMTP_PASSWORD'),
        'transport_smtp_server' => getenv('TYPO3_MAIL_TRANSPORT_SMTP_SERVER'),
        'transport_smtp_username' => getenv('TYPO3_MAIL_TRANSPORT_SMTP_USERNAME'),
        'defaultMailFromAddress' => getenv('TYPO3_MAIL_FROM_ADDRESS'),
        'defaultMailFromName' => getenv('TYPO3_MAIL_FROM_NAME'),
    ],
    'SYS' => [
        'clearCacheSystem' => '1',
        'cookieSecure' => '1',
        'curlUse' => '0',
        'devIPmask' => '',
        'displayErrors' => '1',
        'enableDeprecationLog' => '',
        'isInitialInstallationInProgress' => false,
        'sitename' => getenv('TYPO3_SITENAME') ? '[LIVE] | '. getenv('TYPO3_SITENAME') : '[LIVE] TYPO3 11 Test Site',
        'sqlDebug' => '1',
        'systemLogLevel' => '2',
        't3lib_cs_convMethod' => 'mbstring',
        't3lib_cs_utils' => 'mbstring',
    ]
];
