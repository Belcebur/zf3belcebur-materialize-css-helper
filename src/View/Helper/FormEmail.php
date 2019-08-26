<?php

namespace ZF3Belcebur\MaterializeCssHelper\View\Helper;

use Zend\Form\ElementInterface;

class FormEmail extends FormInput
{
    /**
     * @inheritdoc
     */
    protected function getType(ElementInterface $element): string
    {
        return 'email';
    }
}
