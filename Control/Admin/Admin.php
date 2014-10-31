<?php

namespace thirdParty\extensionCreator\Control\Admin;

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
        self::$config = $this->app['utils']->readJSON(THIRDPARTY_PATH.'/extensionCreator/config.extensioncreator.json');
    }

    /**
     * Get the toolbar for all backend dialogs
     *
     * @param string $active dialog
     * @return array
     */
    public function getToolbar($active) {
        $toolbar = array();
        foreach (self::$config['nav_tabs']['order'] as $tab) {
            switch ($tab) {
                case 'about':
                    $toolbar[$tab] = array(
                        'name' => 'about',
                        'text' => $this->app['translator']->trans('About'),
                        'hint' => $this->app['translator']->trans('Information about the extensionCreator extension'),
                        'link' => FRAMEWORK_URL.'/admin/extensioncreator/about',
                        'active' => ($active == 'about')
                    );
                    break;
                case 'add':
                    $toolbar[$tab] = array(
                        'name' => 'add',
                        'text' => $this->app['translator']->trans('Create extension'),
                        'hint' => $this->app['translator']->trans('Allows to create a new thirdParty extension for the kitFramework by filling a form'),
                        'link' => FRAMEWORK_URL.'/admin/extensioncreator/add',
                        'active' => ($active == 'add')
                    );
                    break;
            }
        }
        return $toolbar;
    }

}
