<?php

namespace thirdParty\%extname%\Control\Admin;

use Silex\Application;

class About extends Admin {

    /**
     * Show the about dialog for %extname%
     *
     * @return string rendered dialog
     */
    public function Controller(Application $app)
    {
        $this->initialize($app);

        $extension = $this->app['utils']->readJSON(THIRDPARTY_PATH.'/%extname%/extension.json');

        return $this->app['twig']->render($this->app['utils']->getTemplateFile(
            '@thirdParty/%extname%/Template', 'admin/about.twig'),
            array(
                'usage'     => self::$usage,
                'toolbar'   => $this->app['utils']->getToolbar('about','%foldername%',self::$config),
                'extension' => $extension
            ));
    }

}
