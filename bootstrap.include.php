<?php

use phpManufaktur\Basic\Control\CMS\EmbeddedAdministration;

$admin->get('/extensioncreator/setup',
    'thirdParty\extensionCreator\Data\Setup\Setup::Controller');
$admin->get('/extensioncreator/update',
    'thirdParty\extensionCreator\Data\Setup\Update::Controller');
$admin->get('/extensioncreator/uninstall',
    'thirdParty\extensionCreator\Data\Setup\Uninstall::Controller');


$app->get('/admin/extensioncreator',
    'thirdParty\extensionCreator\Control\Admin\Admin::ControllerSelectDefaultTab');
$app->get('/admin/extensioncreator/about',
    'thirdParty\extensionCreator\Control\Admin\About::Controller');
$app->get('/admin/extensioncreator/add',
    'thirdParty\extensionCreator\Control\Admin\Create::Controller');
$app->post('/admin/extensioncreator/save',
    'thirdParty\extensionCreator\Control\Admin\Create::ControllerSave');


// add a entry point for CONTACT
$entry_points = $app['security.role_entry_points'];
$entry_points['ROLE_ADMIN'][] = array(
    'route' => '/admin/extensioncreator/add',
    'name' => $app['translator']->trans('extensionCreator'),
    'info' => $app['translator']->trans('Create new extensions'),
    'icon' => array(
        'path' => '/extension/thirdparty/thirdParty/extensioncreator/extension.jpg',
        'url' => THIRDPARTY_URL.'/extensioncreator/extension.jpg'
    )
);
$app['security.role_entry_points'] = $entry_points;