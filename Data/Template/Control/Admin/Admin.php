<?php

namespace thirdParty\%extname%\Control\Admin;

use Silex\Application;
use phpManufaktur\Basic\Control\Pattern\Alert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Admin extends Alert
{

    protected static $usage = null;
    protected static $usage_param = null;
    protected static $config = null;

    /**
     * Initialize the class with the needed parameters
     *
     * @param Application $app
     */
    protected function initialize(Application $app)
    {
        parent::initialize($app);

        $cms = $this->app['request']->get('usage');
        self::$usage = is_null($cms) ? 'framework' : $cms;
        self::$usage_param = (self::$usage != 'framework') ? '?usage='.self::$usage : '';
        // set the locale from the CMS locale
        if (self::$usage != 'framework') {
            $app['translator']->setLocale($this->app['session']->get('CMS_LOCALE', 'en'));
        }
        self::$config = $this->app['utils']->readJSON(THIRDPARTY_PATH.'/%extname%/config.%foldername%.json');
    }

}
