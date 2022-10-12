<?php
namespace Deployer;

require 'recipe/typo3.php';
require 'contrib/rsync.php';


//** Config **

$deployPath = '/home/www/p485699/html/t3-dep-ws';

// Set TYPO3 Docroot/ Webroot
set('typo3_webroot', 'public');
set('keep_releases', 5);

// Set repository not needed for rsync deployments
//set('repository', 'git@github.com:snowowl78/t3-deployment-workshop');

// rsync options
set('rsync', [
    'exclude' =>[
//        'composer.json',
//        'composer.lock',
        'deploy.php',
        '.ddev',
        '.env',
        '.git',
        '.gitignore',
        'LICENSE',
        'README.md',
    ],
    'exclude-file' => false,
    'filter' => [],
    'filter-file' => false,
    'filter-perdir' => false,
    'flags' => 'az',
    'include' => [],
    'include-file' => false,
    'options' => ['info=progress2', 'delete-after'],
]);

set('rsync_src', __DIR__);
set('rsync_dest','{{release_path}}');
// TODO: setup options to sync all necessary folders incl. vendor!


// Set up / extend options for shared/ writable
add('shared_files', [
    '.env',
//    '{{typo3_webroot}}/typo3conf/AdditionalConfiguration.php',
//    '{{typo3_webroot}}/typo3conf/LocalConfiguration.php'
]);
add('shared_dirs', [
    '{{typo3_webroot}}/fileadmin'
]);
add('writable_dirs', []);

set('writeable_mode', 'chmod');
//set('writable_chmod_mode', 'u=rwX,go=rX');
set('log_files', '/var/www/html/logs.txt');


// ** Hosts **
// Staging
host('stage')
    ->setLabels([
        'stage' => 'staging'
    ])
    ->set('stageDir', 'stage')
    ->setHostname('p485699.webspaceconfig.de')
    ->setDeployPath($deployPath . '/{{stageDir}}')
    ->setRemoteUser( 'p485699')
    ->set('http_user', 'p485699')
    /*->set('deploy_path', '~/t3deployws')*/
;

/**
 * setup live host
 */
host('live')
    ->setLabels([
        'stage' => 'production'
    ])
    ->set('stageDir', 'production')
    ->setHostname('regulus.uberspace.de')
    ->setDeployPath($deployPath . '/{{stageDir}}')
    ->setRemoteUser( 'snowowl')
    /*->set('deploy_path', '~/t3deployws')*/;


/** demo task
 *
 * description first
 * task definition
 */
desc('DEMO TASK showing writeln, run and get');
// then task
task('demo_task', function() {
    writeln('run ls command:');
    run('ls -al {{deploy_path}}');
    writeln('show shared_files for stage = '. get('labels')['stage'] .':');
    foreach(get('shared_files') as $file) {
        writeln($file);
   }
    writeln('releasePath set to {{release_path}}' );
});

/**
 * Rsync deployment task
 * set description
 * configure task
 */
desc('Prepare with Rsync deployment, without use of git and composer');
task('deploy:prepare', [
    'deploy:info',
    'deploy:setup',
    'deploy:lock',
    'deploy:release',
    'rsync',
    'deploy:shared',
    'deploy:writable'
]);

desc('Deploy customized');
task('deploy', [
   'deploy:prepare',
//   'deploy:vendors',
   'deploy:publish'
]);



// Hooks
after('deploy:release', 'rsync:warmup');
after('deploy:failed', 'deploy:unlock');
