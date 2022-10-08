<?php
namespace Deployer;

require 'recipe/typo3.php';
require 'contrib/rsync.php';


//** Config **

$deployPath = '/var/www/virtual/snowowl/serve';

// Set TYPO3 Docroot/ Webroot
set('typo3_webroot', 'public');

// Set repository not needed for rsync deployments
//set('repository', 'git@github.com:snowowl78/t3-deployment-workshop');

// rsync options
set('rsync_src', __DIR__);
set('rsync_dest','{{release_path}}');


// Set up / extend options for shared/ writable
add('shared_files', [
    '{{typo3_webroot}}/.env',
    '{{typo3_webroot}}/typo3conf/AdditionalConfiguration.php',
    '{{typo3_webroot}}/typo3conf/LocalConfiguration.php'
]);
add('shared_dirs', [
    '{{typo3_webroot}}/fileadmin'
]);
add('writable_dirs', []);

set('log_files', '/var/www/html/logs.txt');
// ** Hosts **
// Staging
host('stage')
    ->setLabels([
        'stage' => 'staging'
    ])
    ->set('stageDir', 'stage')
    ->setHostname('regulus.uberspace.de')
    ->setDeployPath($deployPath . '/{{stageDir}}')
    ->setRemoteUser( 'snowowl')
    /*->set('deploy_path', '~/t3deployws')*/;

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
desc('Rsync deployment, without use of git and composer');
task('deploy', [
    'deploy:prepare',
    'deplyoy:release',
    'rsync',
]);

// Hooks
after('deploy:release', 'rsync:warmup');
after('deploy:failed', 'deploy:unlock');