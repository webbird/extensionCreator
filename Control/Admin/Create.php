<?php

namespace thirdParty\extensionCreator\Control\Admin;

use Silex\Application;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use phpManufaktur\Basic\Control\Forms\Helper;

class Create extends Admin {

    /**
     * Show the about dialog for the miniShop
     *
     * @return string rendered dialog
     */
    public function Controller(Application $app)
    {
        $this->initialize($app);

        $form = $this->ControllerGetForm();

        return $this->app['twig']->render($this->app['utils']->getTemplateFile(
            '@thirdParty/extensionCreator/Template',
            'admin/create.form.twig'),
            array(
                'toolbar' => $this->app['utils']->getToolbar('add','extensioncreator',self::$config),
                'form' => $form->getForm()->createView()
            ));
    }

    /**
     * creates the new extension
     *
     * @access public
     * @param  $app
     * @return void
     **/
    public function ControllerSave(Application $app)
    {
        $this->initialize($app);
        $form = $this->ControllerGetForm()->getForm();     // populate the form
        $form->bind($this->app['request']);                // bind request to form

        $showform = true;
        $errors   = 0;

        if(!$form->isValid() || count($form->getErrors())) // validate
        {
            $this->setAlert('The form is not valid, please check your input and try again!', array(),
                self::ALERT_TYPE_DANGER, true, array('form_errors' => ((string) $form->getErrors(true)),
                    'method' => __METHOD__, 'line' => __LINE__));
            
            $this->setAlert(
                \phpManufaktur\Basic\Control\Forms\Helper::getErrorsAsString($form),
                array(),
                self::ALERT_TYPE_WARNING
            );
        }
        else
        {
            $folders = self::$config['extensiondata']['folders'];
            $files   = self::$config['extensiondata']['files'];
            $data    = $form->getData();
            $replacements = array(
                '%year%' => date('Y'),
                '%date%' => date('c'),
            );

// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// TODO
//   + Pfade und Dateien auf Existenz prüfen, nicht einfach überschreiben
//   + Controller erzeugen
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

            // create mapping
            foreach($data as $key => $value)
            {
                if(is_scalar($value))
                {
                    $replacements['%'.$key.'%'] = $value;
                }
            }

            // create the folders
            foreach($folders as $f)
            {
                if(!$app['filesystem']->isAbsolutePath($f))
                    $f = THIRDPARTY_PATH.'/'.$data['foldername'].'/'.$f;
                if(!$app['filesystem']->isAbsolutePath($f))
                    $this->setAlert('Invalid path', array(), self::ALERT_TYPE_DANGER);
                if (!$app['filesystem']->exists($f)) {
                    $app['filesystem']->mkdir($f);
                }
            }

            // put default files
            foreach($files as $f)
            {
                if(!$app['filesystem']->isAbsolutePath($f))
                {
                    $source_dir = $this->app['utils']->sanitizePath(
                        dirname(__FILE__).'/../../Data/Template/'.pathinfo($f,PATHINFO_DIRNAME)
                    );
                    $f = THIRDPARTY_PATH.'/'.$data['foldername'].'/'.$f;
                }
                else
                {
                    $source_dir = pathinfo($f,PATHINFO_DIRNAME);
                }
                if(!$app['filesystem']->isAbsolutePath($f))
                {
                    $this->setAlert('Invalid path', array(), self::ALERT_TYPE_DANGER);
                }
                else
                {
                    $source = $this->app['utils']->sanitizePath($source_dir.'/'.pathinfo($f,PATHINFO_BASENAME));
                    $this->patchFile($source,$f,$replacements);
                }
            }

            // create config file
            $this->patchFile(
                $this->app['utils']->sanitizePath(dirname(__FILE__).'/../../Data/Template/config.template.json'),
                $this->app['utils']->sanitizePath(THIRDPARTY_PATH.'/'.$data['foldername'].'/config.'.$data['foldername'].'.json'),
                $replacements
            );

            $this->setAlert('The extension was created.');
            $showform = false;

        }

        return $this->app['twig']->render($this->app['utils']->getTemplateFile(
            '@thirdParty/extensionCreator/Template',
            'admin/create.form.twig'),
            array(
                'toolbar'     => $this->getToolbar('add'),
                'form'        => ( $showform ? $form->createView() : NULL ),
                'alert'       => $this->getAlert(),
                'toolbar'     => $this->app['utils']->getToolbar('about','extensioncreator',self::$config),
            ));
    }

    /**
     *
     * @access private
     * @return
     **/
    private function ControllerGetForm()
    {
        self::$config = $this->app['utils']->readJSON(THIRDPARTY_PATH.'/extensionCreator/config.extensioncreator.json');
        return \phpManufaktur\Basic\Control\Forms\Helper::build($this->app,self::$config);
    }   // end function ControllerGetForm()

    /**
     * replaces the placeholders in the template files
     *
     * @access private
     * @return void
     **/
    private function patchFile($infile,$outdir,$data)
    {
        if (false === ($include = file_get_contents($infile))) {
            throw new \Exception('Missing '.$infile.'!');
        }
        $include = str_replace(
            array_keys($data),
            array_values($data),
            $include
        );
        if (false === (file_put_contents($outdir, $include))) {
            throw new \Exception("Can't create $outdir/".pathinfo($infile,PATHINFO_BASENAME)."!");
        }
    }   // end function patchFile()

}
