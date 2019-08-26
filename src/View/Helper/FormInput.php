<?php

namespace ZF3Belcebur\MaterializeCssHelper\View\Helper;

use Zend\Form\Element\Url;
use Zend\Form\ElementInterface;
use function array_unique;
use function explode;
use function implode;

class FormInput extends \Zend\Form\View\Helper\FormInput
{
    public function render(ElementInterface $element): string
    {

        /**
         * @var Url $element
         */
        $name = $element->getName();
        $id = $element->getAttribute('id');
        $type = $this->getType($element);
        if (!$id && ($element->getOption('autogenerate_id') ?? true)) {
            $id = "{$type}-" . mt_rand();
        }
        $labelAttributes = $element->getLabelAttributes();
        if (array_key_exists('data-error', $labelAttributes) || array_key_exists('data-success', $labelAttributes)) {
            $element = $this->addAttribute($element, 'class', 'validate');
        }
        $element->setAttribute('id', $id);
        $attributes = $element->getAttributes();
        $attributes['name'] = $name;
        $attributes['type'] = $type;
        $attributes['value'] = $element->getValue();
        if ('password' === $type) {
            $attributes['value'] = '';
        }

        $element->setLabelAttributes(
            array_merge(
                $element->getLabelAttributes(), [
                    'for' => $id,
                ]
            )
        );

        $input = sprintf(
            '<input %s%s',
            $this->createAttributesString($attributes),
            $this->getInlineClosingBracket()
        );

        return $input;
    }

    protected function addAttribute(ElementInterface $element, string $name, string $value): ElementInterface
    {
        $attribute = explode(' ', $element->getAttribute($name));
        $attribute[] = $value;
        array_unique(array_filter($attribute));

        $element->setAttribute($name, implode(' ', $attribute));

        return $element;

    }
}
