<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZF3Belcebur\MaterializeCssHelper\View\Helper;

use Zend\Form\ElementInterface;

class FormHidden extends FormInput
{
    public function render(ElementInterface $element): string
    {
        $this->validTagAttributes = [
            'name' => true,
            'disabled' => true,
            'form' => true,
            'type' => true,
            'value' => true,
        ];

        return parent::render($element);
    }

    /**
     * Determine input type to use
     *
     * @param ElementInterface $element
     * @return string
     */
    protected function getType(ElementInterface $element): string
    {
        return 'hidden';
    }
}
