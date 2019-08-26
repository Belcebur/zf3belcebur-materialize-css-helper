<?php

use Zend\ServiceManager\Factory\InvokableFactory;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormButton;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormCheckbox;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormCollection;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormColor;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormDate;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormDateSelect;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormDateTime;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormDateTimeLocal;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormDateTimeSelect;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormElementErrors;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormEmail;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormFile;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormHidden;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormImage;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormInput;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormMonth;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormMonthSelect;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormMultiCheckbox;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormNumber;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormPassword;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormRadio;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormRange;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormReset;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormRow;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormSearch;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormSelect;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormSubmit;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormTel;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormText;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormTextarea;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormTime;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormUrl;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\FormWeek;
use ZF3Belcebur\MaterializeCssHelper\View\Helper\GoogleReCaptcha;

return [
    'view_helpers' => [
        'factories' => [
            FormButton::class => InvokableFactory::class,
            FormCheckbox::class => InvokableFactory::class,
            FormColor::class => InvokableFactory::class,
            FormCollection::class => InvokableFactory::class,
            FormDate::class => InvokableFactory::class,
            FormDateSelect::class => InvokableFactory::class,
            FormDateTime::class => InvokableFactory::class,
            FormDateTimeLocal::class => InvokableFactory::class,
            FormDateTimeSelect::class => InvokableFactory::class,
            FormElementErrors::class => InvokableFactory::class,
            FormEmail::class => InvokableFactory::class,
            FormFile::class => InvokableFactory::class,
            FormHidden::class => InvokableFactory::class,
            FormImage::class => InvokableFactory::class,
            FormInput::class => InvokableFactory::class,
            FormMonth::class => InvokableFactory::class,
            FormMonthSelect::class => InvokableFactory::class,
            FormMultiCheckbox::class => InvokableFactory::class,
            FormNumber::class => InvokableFactory::class,
            FormPassword::class => InvokableFactory::class,
            FormRadio::class => InvokableFactory::class,
            FormRange::class => InvokableFactory::class,
            FormReset::class => InvokableFactory::class,
            FormRow::class => InvokableFactory::class,
            FormSearch::class => InvokableFactory::class,
            FormSelect::class => InvokableFactory::class,
            FormSubmit::class => InvokableFactory::class,
            FormTel::class => InvokableFactory::class,
            FormText::class => InvokableFactory::class,
            FormTextarea::class => InvokableFactory::class,
            FormTime::class => InvokableFactory::class,
            FormUrl::class => InvokableFactory::class,
            FormWeek::class => InvokableFactory::class,
            GoogleReCaptcha::class => InvokableFactory::class,
        ],
        'aliases' => [
            \Zend\Form\View\Helper\FormButton::class => FormButton::class,
            \Zend\Form\View\Helper\FormCheckbox::class => FormCheckbox::class,
            \Zend\Form\View\Helper\FormColor::class => FormColor::class,
            \Zend\Form\View\Helper\FormCollection::class => FormCollection::class,
            \Zend\Form\View\Helper\FormDate::class => FormDate::class,
            \Zend\Form\View\Helper\FormDateSelect::class => FormDateSelect::class,
            \Zend\Form\View\Helper\FormDateTime::class => FormDateTime::class,
            \Zend\Form\View\Helper\FormDateTimeLocal::class => FormDateTimeLocal::class,
            \Zend\Form\View\Helper\FormDateTimeSelect::class => FormDateTimeSelect::class,
            \Zend\Form\View\Helper\FormElementErrors::class => FormElementErrors::class,
            \Zend\Form\View\Helper\FormEmail::class => FormEmail::class,
            \Zend\Form\View\Helper\FormFile::class => FormFile::class,
            \Zend\Form\View\Helper\FormHidden::class => FormHidden::class,
            \Zend\Form\View\Helper\FormImage::class => FormImage::class,
            \Zend\Form\View\Helper\FormInput::class => FormInput::class,
            \Zend\Form\View\Helper\FormMonth::class => FormMonth::class,
            \Zend\Form\View\Helper\FormMonthSelect::class => FormMonthSelect::class,
            \Zend\Form\View\Helper\FormMultiCheckbox::class => FormMultiCheckbox::class,
            \Zend\Form\View\Helper\FormNumber::class => FormNumber::class,
            \Zend\Form\View\Helper\FormPassword::class => FormPassword::class,
            \Zend\Form\View\Helper\FormRadio::class => FormRadio::class,
            \Zend\Form\View\Helper\FormRange::class => FormRange::class,
            \Zend\Form\View\Helper\FormReset::class => FormReset::class,
            \Zend\Form\View\Helper\FormRow::class => FormRow::class,
            \Zend\Form\View\Helper\FormSearch::class => FormSearch::class,
            \Zend\Form\View\Helper\FormSelect::class => FormSelect::class,
            \Zend\Form\View\Helper\FormSubmit::class => FormSubmit::class,
            \Zend\Form\View\Helper\FormTel::class => FormTel::class,
            \Zend\Form\View\Helper\FormText::class => FormText::class,
            \Zend\Form\View\Helper\FormTextarea::class => FormTextarea::class,
            \Zend\Form\View\Helper\FormTime::class => FormTime::class,
            \Zend\Form\View\Helper\FormUrl::class => FormUrl::class,
            \Zend\Form\View\Helper\FormWeek::class => FormWeek::class,
        ],
        'invokables' => [
            'GoogleReCaptcha' => GoogleReCaptcha::class,
            'googleReCaptcha' => GoogleReCaptcha::class,
        ],
    ],
];
