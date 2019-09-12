<?php

namespace ZF3Belcebur\MaterializeCssHelper\View\Helper;

use Zend\Form\Element\Collection as CollectionElement;
use Zend\Form\ElementInterface;
use Zend\Form\FieldsetInterface;


class FormCollection extends \Zend\Form\View\Helper\FormCollection
{

    /**
     * @param CollectionElement $collection
     * @return string
     */
    public function renderTemplate(CollectionElement $collection): string
    {
        /** @var FormRow $elementHelper */
        $elementHelper = $this->getElementHelper();
        $escapeHtmlAttribHelper = $this->getEscapeHtmlAttrHelper();
        $fieldsetHelper = $this->getFieldsetHelper();
        $templateMarkup = '';

        $elementOrFieldset = $collection->getTemplateElement();
        if ($elementOrFieldset instanceof FieldsetInterface) {
            foreach ($elementOrFieldset->getElements() as $element) {
                /** @var ElementInterface $element */
                $element->setAttribute('id', $element->getName());
            }
            $templateMarkup .= $fieldsetHelper($elementOrFieldset, $this->shouldWrap());
        } elseif ($elementOrFieldset instanceof ElementInterface) {
            $templateMarkup .= $elementHelper($elementOrFieldset);
        }

        $regex = '/(id=[\'"][\w\\[\]]+[\'"])/m';

        return sprintf($this->getTemplateWrapper(), $escapeHtmlAttribHelper(preg_replace($regex, '', $templateMarkup)));
    }

}
