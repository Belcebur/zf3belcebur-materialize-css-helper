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

class FormDateTime extends FormInput
{

    /**
     * @inheritdoc
     */
    public function render(ElementInterface $element): string
    {
        $this->validTagAttributes = [
            'name' => true,
            'autocomplete' => true,
            'autofocus' => true,
            'disabled' => true,
            'form' => true,
            'list' => true,
            'max' => true,
            'min' => true,
            'readonly' => true,
            'required' => true,
            'step' => true,
            'type' => true,
            'value' => true,
        ];


        if (!$element->getOption('browser-default')) {
            $element = $this->addAttribute($element, 'class', 'datepicker');
        }


        return parent::render($element);
    }

    /**
     * @inheritdoc
     */
    protected function getType(ElementInterface $element): string
    {
        if (!$element->getOption('browser-default')) {
            return 'text';
        }

        return 'datetime';

    }
}
