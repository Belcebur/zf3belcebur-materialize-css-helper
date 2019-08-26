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

class FormMonth extends FormDateTime
{

    /**
     * @inheritdoc
     */
    public function render(ElementInterface $element): string
    {


        $element = $this->addAttribute($element, 'data-format', 'mmmm');
        $element = $this->addAttribute($element, 'data-format-submit', 'mm');

        return parent::render($element);
    }

    /**
     * @inheritdoc
     */
    protected function getType(ElementInterface $element): string
    {
        return 'month';
    }
}
