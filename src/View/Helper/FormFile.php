<?php

namespace ZF3Belcebur\MaterializeCssHelper\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Exception;
use function is_array;
use function is_string;

class FormFile extends \Zend\Form\View\Helper\FormFile
{

    /**
     * Render a form <input> element from the provided $element
     *
     * @param ElementInterface $element
     *
     * @return string
     * @throws Exception\DomainException
     * @throws \Exception
     */
    public function render(ElementInterface $element): string
    {
        $name = $element->getName();
        $attributes = $element->getAttributes();
        $attributes['type'] = $this->getType($element);
        $attributes['name'] = $name;
        if (array_key_exists('multiple', $attributes) && $attributes['multiple']) {
            $attributes['name'] .= '[]';
        }

        $value = $element->getValue();
        if (is_array($value) && isset($value['name']) && !is_array($value['name'])) {
            $attributes['value'] = $value['name'];
        } elseif (is_string($value)) {
            $attributes['value'] = $value;
        }


        $input = sprintf(
            '<input %s%s',
            $this->createAttributesString($attributes),
            $this->getInlineClosingBracket()
        );

        return "<div class='file-field input-field'><div class='btn'><span>{$element->getLabel()}</span>{$input}</div><div class='file-path-wrapper'><input class='file-path validate' type='text' placeholder='{$element->getAttribute('placeholder')}'></div></div>";
    }

}
