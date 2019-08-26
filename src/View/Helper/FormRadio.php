<?php

namespace ZF3Belcebur\MaterializeCssHelper\View\Helper;

use Zend\Form\ElementInterface;

class FormRadio extends FormMultiCheckbox
{

    /**
     * @inheritdoc
     */
    protected static function getName(ElementInterface $element): string
    {
        return $element->getName();
    }

    /**
     * @inheritdoc
     */
    public function render(ElementInterface $element): string
    {
        $element->setAttribute('class', 'with-gap');
        return parent::render($element);
    }

    /**
     * @inheritdoc
     */
    protected function getInputType(): string
    {
        return 'radio';
    }
}
