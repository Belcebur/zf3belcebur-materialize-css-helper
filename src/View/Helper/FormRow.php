<?php

namespace ZF3Belcebur\MaterializeCssHelper\View\Helper;

use Zend\Form\Element\Button;
use Zend\Form\Element\Captcha;
use Zend\Form\Element\Collection;
use Zend\Form\Element\MonthSelect;
use Zend\Form\ElementInterface;
use Zend\Form\Exception\DomainException;
use Zend\Form\Exception\InvalidArgumentException;
use Zend\Form\LabelAwareInterface;
use function count;
use function in_array;
use function sprintf;
use function str_replace;

class FormRow extends \Zend\Form\View\Helper\FormRow
{
    /**
     * Utility form helper that renders a label (if it exists), an element and errors
     *
     * @param ElementInterface $element
     * @param null|string $labelPosition
     *
     * @return string
     * @throws DomainException
     * @throws InvalidArgumentException
     */
    public function render(ElementInterface $element, $labelPosition = null): string
    {
        $escapeHtmlHelper = $this->getEscapeHtmlHelper();
        $labelHelper = $this->getLabelHelper();
        $elementHelper = $this->getElementHelper();
        $elementErrorsHelper = $this->getElementErrorsHelper();

        $label = $element->getLabel();
        $inputErrorClass = $this->getInputErrorClass();

        $translator = $this->getTranslator();
        if (null === $labelPosition) {
            $labelPosition = $this->labelPosition;
        }

        if ('' !== $label && $label !== null && null !== $translator) {
            $label = $translator->translate($label, $this->getTranslatorTextDomain());
        }
        if (!empty($inputErrorClass) && count($element->getMessages()) > 0) {
            $classAttributes = ($element->hasAttribute('class') ? $element->getAttribute('class') . ' ' : '');
            $classAttributes .= $inputErrorClass;

            $element->setAttribute('class', $classAttributes);
        }

        if ($this->partial) {
            $vars = [
                'element' => $element,
                'label' => $label,
                'labelAttributes' => $this->labelAttributes,
                'labelPosition' => $labelPosition,
                'renderErrors' => $this->renderErrors,
            ];

            return $this->view->render($this->partial, $vars);
        }

        $elementErrors = '';
        if ($this->renderErrors) {
            $elementErrors = $elementErrorsHelper->render($element);
        }
        $elementString = $elementHelper->render($element);
        $type = $element->getAttribute('type');
        if ($label !== null && '' !== $label && !in_array($type, ['hidden', 'submit'], true)) {
            $labelAttributes = [];

            if ($element instanceof LabelAwareInterface) {
                $labelAttributes = $element->getLabelAttributes();
            }

            if (!$element instanceof LabelAwareInterface || !$element->getLabelOption('disable_html_escape')) {
                $label = $escapeHtmlHelper($label);
            }

            if (empty($labelAttributes)) {
                $labelAttributes = $this->labelAttributes;
            }
            if ($type === 'multi_checkbox'
                || $type === 'radio'
                || $element instanceof MonthSelect
                || $element instanceof Captcha
            ) {
                $icon = $element->getOption('icon') ? "<i class='material-icons prefix'>{$element->getOption('icon')}</i>" : '';
                $markup = sprintf(
                    "<fieldset>{$icon}<legend>%s</legend>%s</fieldset>",
                    $label,
                    $elementString
                );
            } else {

                // Ensure element and label will be separated if element has an `id`-attribute.
                // If element has label option `always_wrap` it will be nested in any case.

                $helpBlockText = str_replace('"', '\'', $translator->translate($element->getOption('help-block')));
                $helpBlock = '';
                if ($helpBlockText) {
                    $helpBlockPattern = '<i class="material-icons tooltipped tooltip left-align" data-delay="50" data-tooltip="%s" data-html="true">live_help</i>';
                    $helpBlock = sprintf($helpBlockPattern, $helpBlockText);
                }
                $element->setLabel($helpBlock . $translator->translate($element->getLabel()));
                $element->setLabelOptions(['disable_html_escape' => true]);


                if ($element->hasAttribute('id')
                    && ($element instanceof LabelAwareInterface && !$element->getLabelOption('always_wrap'))
                ) {
                    $labelOpen = '';
                    $labelClose = '';

                    $label = $labelHelper($element);
                } else {
                    $labelOpen = $labelHelper->openTag($labelAttributes);
                    $labelClose = $labelHelper->closeTag();
                }

                if (($label !== '' && (!$element->hasAttribute('id')))
                    || ($element instanceof LabelAwareInterface && $element->getLabelOption('always_wrap'))
                ) {
                    $label = '<span>' . $label . '</span>';
                }


                // Button element is a special case, because label is always rendered inside it
                if ($element instanceof Button) {
                    $labelOpen = $labelClose = $label = '';
                }

                if ($element instanceof LabelAwareInterface && $element->getLabelOption('label_position')) {
                    $labelPosition = $element->getLabelOption('label_position');
                }

                if (!$this->renderErrors) {
                    $elementErrors = '';
                }

                $icon = $element->getOption('icon') ? "<i class='material-icons prefix'>{$element->getOption('icon')}</i>" : '';
                if ($type === 'select') {
                    $markup = "{$icon}{$elementString}{$labelOpen}{$label}{$labelClose}{$elementErrors}";
                } elseif ($type === 'range') {
                    $wrapOpen = '<div class="range-field">';
                    $wrapClose = '</div>';
                    $markup = "{$wrapOpen}{$elementString}{$wrapClose}{$labelOpen}{$icon}{$label}{$labelClose}{$elementErrors}";
                } elseif ('file' !== $type) {
                    switch ($labelPosition) {
                        case self::LABEL_PREPEND:
                            $markup = "{$elementString}{$icon}{$labelOpen}{$label}{$labelClose}{$elementErrors}";
                            break;
                        case self::LABEL_APPEND:
                        default:
                            $markup = "{$labelOpen}{$label}{$labelClose}{$elementString}{$icon}{$elementErrors}";
                            break;
                    }
                } else {
                    $markup = $elementString . $icon . $elementErrors;
                }
            }
        } else {

            if ($element instanceof Collection) {
                $markup = $elementString;
            } elseif ($this->renderErrors) {
                $markup = $elementString . $elementErrors;
            } else {
                $markup = $elementString;
            }
            if ($type === 'hidden') {
                return $markup;
            }
        }

        return "<div class='input-field'>{$markup}</div>";
    }
}
