<?php

namespace thirdParty\extensionCreator\Control\Admin;

use Silex\Application;

class About extends Admin {

    /**
     * Show the about dialog for the miniShop
     *
     * @return string rendered dialog
     */
    public function Controller(Application $app)
    {
        $this->initialize($app);

        $extension = $this->app['utils']->readJSON(THIRDPARTY_PATH.'/extensionCreator/extension.json');

        return $this->app['twig']->render($this->app['utils']->getTemplateFile(
            '@thirdParty/extensionCreator/Template', 'admin/about.twig'),
            array(
                'usage'     => self::$usage,
                'toolbar'   => $this->app['utils']->getToolbar('about','extensioncreator',self::$config),
                'extension' => $extension
            ));
    }

}
