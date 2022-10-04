<?php

defined('TYPO3_MODE') || die();

call_user_func(function () {
    /**
     * Temporary variables
     */
    $extensionKey = 'my_sitepackage';

    /**
     * Default TypoScript for TotosSitepackage
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        $extensionKey,
        'Configuration/TypoScript/',
        'Snowowl Sitepackage'
    );

});
