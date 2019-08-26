<?php

namespace ZF3Belcebur\MaterializeCssHelper\View\Helper;

use Zend\Form\Element\MultiCheckbox as MultiCheckboxElement;
use Zend\Form\Exception\DomainException;
use Zend\Form\Exception\InvalidArgumentException;
use Zend\Form\LabelAwareInterface;
use function in_array;

class FormMultiCheckbox extends \Zend\Form\View\Helper\FormMultiCheckbox
{

    /**
     * Render options
     *
     * @param MultiCheckboxElement $element
     * @param array $options
     * @param array $selectedOptions
     * @param array $attributes
     *
     * @return string
     * @throws InvalidArgumentException
     * @throws DomainException
     */
    protected function renderOptions(MultiCheckboxElement $element, array $options = [], array $selectedOptions = [], array $attributes = []): string
    {
        $escapeHtmlHelper = $this->getEscapeHtmlHelper();
        $labelHelper = $this->getLabelHelper();
        $labelClose = $labelHelper->closeTag();
        $labelPosition = $this->getLabelPosition();
        $globalLabelAttributes = [];
        $closingBracket = $this->getInlineClosingBracket();

        if ($element instanceof LabelAwareInterface) {
            $globalLabelAttributes = $element->getLabelAttributes();
        }

        if (empty($globalLabelAttributes)) {
            $globalLabelAttributes = $this->labelAttributes;
        }

        $combinedMarkup = [];
        $count = 0;
        $wrapClass = $element->getLabelOption('wrapClass') ?? null;
        foreach ($options as $key => $optionSpec) {
            $count++;
            if ($count > 1 && array_key_exists('id', $attributes)) {
                unset($attributes['id']);
            }

            $value = '';
            $label = '';
            $inputAttributes = $attributes;
            $labelAttributes = $globalLabelAttributes;
            $random = mt_rand();
            $id = "{$this->getInputType()}-{$random}";
            $selected = (isset($inputAttributes['selected']) && $inputAttributes['type'] !== 'radio' && $inputAttributes['selected']);
            $disabled = (isset($inputAttributes['disabled']) && $inputAttributes['disabled']);

            if (is_scalar($optionSpec)) {
                $optionSpec = [
                    'label' => $optionSpec,
                    'value' => $key,
                ];
            }
            if (isset($optionSpec['value'])) {
                $value = $optionSpec['value'];
            }
            if (isset($optionSpec['label'])) {
                $label = $optionSpec['label'];
            }
            if (isset($optionSpec['selected'])) {
                $selected = $optionSpec['selected'];
            }
            if (isset($optionSpec['disabled'])) {
                $disabled = $optionSpec['disabled'];
            }
            if (isset($optionSpec['label_attributes'])) {
                $labelAttributes = $labelAttributes !== null ? array_merge($labelAttributes, $optionSpec['label_attributes']) : $optionSpec['label_attributes'];
            }
            if (isset($optionSpec['attributes'])) {
                $inputAttributes = array_merge($inputAttributes, $optionSpec['attributes']);
            }

            if (in_array($value, $selectedOptions, false)) {
                $selected = true;
            }

            $inputAttributes['value'] = $value;
            $inputAttributes['checked'] = $selected;
            $inputAttributes['disabled'] = $disabled;
            $inputAttributes['id'] = $id;
            $labelAttributes['for'] = $id;

            $input = sprintf(
                '<input %s%s',
                $this->createAttributesString($inputAttributes),
                $closingBracket
            );

            if (null !== (
                $translator = $this->getTranslator())) {
                $label = $translator->translate(
                    $label,
                    $this->getTranslatorTextDomain()
                );
            }

            if (!$element instanceof LabelAwareInterface || !$element->getLabelOption('disable_html_escape')) {
                $label = $escapeHtmlHelper($label);
            }

            $labelOpen = $labelHelper->openTag($labelAttributes);
            $template = "<p class='{$wrapClass}'>%s{$labelOpen}%s{$labelClose}</p>";
            switch ($labelPosition) {
                case self::LABEL_PREPEND:
                    $markup = sprintf($template, $label, $input);
                    break;
                case self::LABEL_APPEND:
                default:
                    $markup = sprintf($template, $input, $label);
                    break;
            }
            $combinedMarkup[] = $markup;
        }

        return implode($this->getSeparator(), $combinedMarkup);
    }

}
