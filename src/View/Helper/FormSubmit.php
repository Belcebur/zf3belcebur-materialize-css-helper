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
use Zend\Form\Exception;
use Zend\Form\LabelAwareInterface;
use function array_key_exists;
use function array_merge;
use function get_class;
use function gettype;
use function is_array;
use function is_object;

class FormSubmit extends FormInput
{

    /**
     * @inheritdoc
     * @throws \Exception
     */
    public function render(ElementInterface $element, $buttonContent = null): string
    {
        if (null === $buttonContent) {
            $buttonContent = $element->getLabel();
            if (null === $buttonContent) {
                throw new Exception\DomainException(
                    sprintf(
                        '%s expects either button content as the second argument, ' .
                        'or that the element provided has a label value; neither found',
                        __METHOD__
                    )
                );
            }
        }

        if (null !== (
            $translator = $this->getTranslator())) {
            $buttonContent = $translator->translate(
                $buttonContent, $this->getTranslatorTextDomain()
            );
        }


        if (!$element instanceof LabelAwareInterface || !$element->getLabelOption('disable_html_escape')) {
            $escapeHtmlHelper = $this->getEscapeHtmlHelper();
            $buttonContent = $escapeHtmlHelper($buttonContent);
        }

        $iconDefaultOptions = ['class' => 'material-icons right'];
        $iconOptions = array_merge($iconDefaultOptions, $element->getOption('icon') ?? []);
        if (array_key_exists('icon', $iconOptions)) {
            $buttonContent .= "<i class='{$iconOptions['class']}'>{$iconOptions['icon']}</i>";
        }


        return $this->openTag($element) . $buttonContent . $this->closeTag();
    }

    /**
     * Generate an opening button tag
     *
     * @param null|array|ElementInterface $attributesOrElement
     * @return string
     * @throws Exception\InvalidArgumentException
     * @throws Exception\DomainException
     * @throws \Exception
     */
    public function openTag($attributesOrElement = null): string
    {
        if (null === $attributesOrElement) {
            return '<button>';
        }

        if (is_array($attributesOrElement)) {
            $attributes = $this->createAttributesString($attributesOrElement);
            return sprintf('<button %s>', $attributes);
        }

        if (!$attributesOrElement instanceof ElementInterface) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects an array or Zend\Form\ElementInterface instance; received "%s"',
                __METHOD__,
                (is_object($attributesOrElement) ? get_class($attributesOrElement) : gettype($attributesOrElement))
            ));
        }

        $element = $this->addAttribute($attributesOrElement, 'class', 'btn');
        $name = $element->getName();
        if (empty($name) && $name !== 0) {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has an assigned name; none discovered',
                __METHOD__
            ));
        }

        $attributes = $element->getAttributes();
        $type = $attributes['type'] ?? $this->getType($element);
        $attributes['id'] = $attributes['id'] ?? "{$type}-" . mt_rand();
        $attributes['name'] = $name;
        $attributes['type'] = $type;
        $attributes['value'] = $element->getValue();

        return sprintf(
            '<button %s>',
            $this->createAttributesString($attributes)
        );
    }

    /**
     * Determine button type to use
     *
     * @param ElementInterface $element
     * @return string
     */
    protected function getType(ElementInterface $element): string
    {
        $type = $element->getAttribute('type');
        if (empty($type)) {
            return 'submit';
        }

        $type = strtolower($type);
        if (!isset($this->validTypes[$type])) {
            return 'submit';
        }

        return $type;
    }

    /**
     * Return a closing button tag
     *
     * @return string
     */
    public function closeTag(): string
    {
        return '</button>';
    }

}
