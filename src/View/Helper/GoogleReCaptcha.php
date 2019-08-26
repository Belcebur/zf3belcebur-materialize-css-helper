<?php

namespace ZF3Belcebur\MaterializeCssHelper\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\View\Renderer\PhpRenderer;

class GoogleReCaptcha extends AbstractHelper
{
    /**
     * @return string
     * @throws ServiceNotFoundException
     */
    public function __invoke(): string
    {
        /**
         * @var PhpRenderer $view
         */
        $view = $this->getView();
        $config = $view->getHelperPluginManager()->getServiceLocator()->get('config');

        $siteKey = $config['new_recaptcha']['sitekey'] ?? false;

        if ($siteKey) {
            return "<div class='g-recaptcha' data-callback='reCaptchaCallback' data-sitekey='{$siteKey}'></div>";
        }

        return 'Invalid site key';
    }

}
