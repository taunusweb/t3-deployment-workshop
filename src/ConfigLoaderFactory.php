<?php

namespace Snowowl78\Distribution;

use Helhum\ConfigLoader\CachedConfigurationLoader;
use Helhum\ConfigLoader\ConfigurationLoader;
use Helhum\ConfigLoader\Reader\EnvironmentReader;
use Helhum\ConfigLoader\Reader\PhpFileReader;

/**
 * Class ConfigLoaderFactory
 */
class ConfigLoaderFactory
{
    /**
     * @param string $context
     * @param string $rootDir
     * @param array $additionalFileWatches
     * @param string $fixedCacheIdentifier
     * @return CachedConfigurationLoader
     */
    public static function buildLoader($context, $rootDir, $fixedCacheIdentifier = null, array $additionalFileWatches = array())
    {
        $confDir = $rootDir . '/config';
        $cacheDir = $rootDir . '/var/cache';

        if ($fixedCacheIdentifier) {
            // Freeze configuration with fixed identifier if requested
            $cacheIdentifier = $fixedCacheIdentifier;
        } else {
            $fileWatches = array_merge(
                [
                    $rootDir . '/public/typo3conf/LocalConfiguration.php',
                    $rootDir . '/public/typo3conf/AdditionalConfiguration.php',
                    $rootDir . '/.env',
                    $confDir . '/default.php',
                    $confDir . '/' . $context . '.php',
                    $confDir . '/override.php',
                ],
                $additionalFileWatches
            );

            $cacheIdentifier = self::getCacheIdentifier($context, $fileWatches);
        }
        return new CachedConfigurationLoader
        (
            $cacheDir,
            $cacheIdentifier,
            function () use ($confDir, $context) {
                return new ConfigurationLoader(
                    array(
                        new PhpFileReader($confDir . '/default.php'),
                        new PhpFileReader($confDir . '/' . $context . '.php'),
                        new EnvironmentReader('TYPO3'),
                        new PhpFileReader($confDir . '/override.php'),
                    )
                );
            }
        );
    }

    /**
     * @param string $context
     * @param array $fileWatches
     * @return string
     */
    protected static function getCacheIdentifier($context, array $fileWatches = array())
    {
        $identifier = $context;
        foreach ($fileWatches as $fileWatch) {
            if (file_exists($fileWatch)) {
                $identifier .= filemtime($fileWatch);
            }
        }
        return md5($identifier);
    }
}
