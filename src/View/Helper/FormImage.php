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

class FormImage extends FormInput
{
    /**
     * @inheritdoc
     */
    public function render(ElementInterface $element): string
    {
        $this->validTagAttributes = [
            'name' => true,
            'alt' => true,
            'autofocus' => true,
            'disabled' => true,
            'form' => true,
            'formaction' => true,
            'formenctype' => true,
            'formmethod' => true,
            'formnovalidate' => true,
            'formtarget' => true,
            'height' => true,
            'src' => true,
            'type' => true,
            'width' => true,
        ];

        if (empty($element->getAttribute('src'))) {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has an assigned src; none discovered',
                __METHOD__
            ));
        }

        return parent::render($element);
    }

    /**
     * @inheritdoc
     */
    protected function getType(ElementInterface $element): string
    {
        return 'image';
    }
}
