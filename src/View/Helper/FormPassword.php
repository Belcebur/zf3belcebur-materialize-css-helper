<?php

namespace ZF3Belcebur\MaterializeCssHelper\View\Helper;

use Zend\Form\ElementInterface;

class FormPassword extends FormInput
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
            'maxlength' => true,
            'pattern' => true,
            'placeholder' => true,
            'readonly' => true,
            'required' => true,
            'size' => true,
            'type' => true,
            'value' => true,
        ];

        return parent::render($element);
    }


    /**
     * @inheritdoc
     */
    protected function getType(ElementInterface $element): string
    {
        return 'password';
    }
}
