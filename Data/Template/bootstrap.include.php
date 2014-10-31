<?php

$admin->get('/%foldername%/setup',
    'thirdParty\%extname%\Data\Setup\Setup::Controller');
$admin->get('/%foldername%/update',
    'thirdParty\%extname%\Data\Setup\Update::Controller');
$admin->get('/%foldername%/uninstall',
    'thirdParty\%extname%\Data\Setup\Uninstall::Controller');


$app->get('/admin/%foldername%',
    'thirdParty\%extname%\Control\Admin\Admin::ControllerSelectDefaultTab');
$app->get('/admin/%foldername%/about',
    'thirdParty\%extname%\Control\Admin\About::Controller');
