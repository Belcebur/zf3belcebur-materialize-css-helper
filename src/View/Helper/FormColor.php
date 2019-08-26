<?php

namespace ZF3Belcebur\MaterializeCssHelper\View\Helper;

use Zend\Form\ElementInterface;

class FormColor extends FormInput
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
        return 'color';
    }
}
