<?php

namespace ZF3Belcebur\MaterializeCssHelper\View\Helper;

use Zend\Form\ElementInterface;

class FormDateTimeLocal extends FormDateTime
{
    /**
     * @inheritdoc
     */
    protected function getType(ElementInterface $element): string
    {
        return 'datetime-local';
    }
}
