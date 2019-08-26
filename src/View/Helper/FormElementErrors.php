<?php

namespace ZF3Belcebur\MaterializeCssHelper\View\Helper;

use Traversable;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;
use function array_filter;
use function array_merge;
use function array_unique;
use function explode;
use function get_class;
use function gettype;
use function implode;
use function is_array;
use function is_object;

class FormElementErrors extends \Zend\Form\View\Helper\FormElementErrors
{

    /**
     * Render validation errors for the provided $element
     *
     * @param ElementInterface $element
     * @param array $attributes
     *
     * @return string
     * @throws Exception\DomainException
     * @throws \Exception
     */
    public function render(ElementInterface $element, array $attributes = []): string
    {

        $this->setMessageCloseString('</li></ul>');
        $this->setMessageOpenFormat('<ul%s><li class="red-text">');
        $this->setMessageSeparatorString('</li><li class="red-text">');

        $messages = $element->getMessages();
        if (empty($messages)) {
            return '';
        }
        if (!is_array($messages) && !$messages instanceof Traversable) {
            throw new Exception\DomainException(
                sprintf(
                    '%s expects that $element->getMessages() will return an array or Traversable; received "%s"',
                    __METHOD__,
                    (is_object($messages) ? get_class($messages) : gettype($messages))
                )
            );
        }

        $attributesMerged = array_merge($this->attributes, $attributes);
        $classes = explode(' ', $attributesMerged['class'] ?? '');
        $classes[] = 'error-list';
        $attributesMerged['class'] = implode(' ', array_unique(array_filter($classes)));

        $newAttributes = $this->createAttributesString($attributesMerged);
        if (!empty($newAttributes)) {
            $newAttributes = ' ' . $newAttributes;
        }
        $escapeHtml = $this->getEscapeHtmlHelper();
        $messagesToPrint = [];
        array_walk_recursive($messages, function ($item) use (&$messagesToPrint, $escapeHtml) {
            $messagesToPrint[] = $escapeHtml($item);
        });

        if (empty($messagesToPrint)) {
            return '';
        }

        $markup = sprintf($this->getMessageOpenFormat(), $newAttributes);
        $markup .= implode($this->getMessageSeparatorString(), $messagesToPrint);
        $markup .= $this->getMessageCloseString();

        return $markup;
    }
}
