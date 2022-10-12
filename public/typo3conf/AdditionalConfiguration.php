<?php


/*
if (getenv('IS_DDEV_PROJECT') == 'true') {
    $GLOBALS['TYPO3_CONF_VARS'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS'],
        [
            'DB' => [
                'Connections' => [
                    'Default' => [
                        'dbname' => 'db',
                        'driver' => 'mysqli',
                        'host' => 'db',
                        'password' => 'db',
                        'port' => '3306',
                        'user' => 'db',
                    ],
                ],
            ],
            // This GFX configuration allows processing by installed ImageMagick 6
            'GFX' => [
                'processor' => 'ImageMagick',
                'processor_path' => '/usr/bin/',
                'processor_path_lzw' => '/usr/bin/',
            ],
            // This mail configuration sends all emails to mailhog
            'MAIL' => [
                'transport' => 'smtp',
                'transport_smtp_encrypt' => false,
                'transport_smtp_server' => 'localhost:1025',
            ],
            'SYS' => [
                'trustedHostsPattern' => '.*.*',
                'devIPmask' => '*',
                'displayErrors' => 1,
            ],
        ]
    );
}*/
$context = \TYPO3\CMS\Core\Core\Environment::getContext()->isProduction() ? 'production' : 'development';
$context = \TYPO3\CMS\Core\Core\Environment::getContext()->isTesting() ? 'testing' : $context;
$subContext = explode('/', \TYPO3\CMS\Core\Core\Environment::getContext()->__toString());
$context .= isset($subContext[1]) ? '-' . strtolower($subContext[1]) : '';
$configLoader = \Snowowl78\Distribution\ConfigLoaderFactory::buildLoader(
    $context,
    $rootDir = dirname(dirname(__DIR__)),
    $fixedCacheIdentifier = getenv('CONFIGURATION_CACHE_IDENTIFIER')
);

\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(getenv(), 'getenv');
$GLOBALS['TYPO3_CONF_VARS'] = array_replace_recursive(
    $GLOBALS['TYPO3_CONF_VARS'],
    $configLoader->load()
);

