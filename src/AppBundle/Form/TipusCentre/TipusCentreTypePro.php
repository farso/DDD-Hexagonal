<?php

namespace AppBundle\Form\TipusCentre;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;

class TipusCentreTypePro
{
    private $formBuilder;

    const NOM_FORM = 'tipus_centre';

    private function __construct(FormFactory $formFactory, $values = null)
    {
        if (null === $values) {
            $this->formBuilder = $formFactory->createNamedBuilder(self::NOM_FORM);
        } else {
            $this->formBuilder = $formFactory->createNamedBuilder(self::NOM_FORM, FormType::class, $values);
        }
    }

    public static function newForm(FormFactory $formFactory, $values = null)
    {
        $centreTypePro = new self($formFactory, $values);
        $formBuilder = $centreTypePro->formBuilder;

        $formBuilder
            ->add('descriCat')
            ->add('descriEsp')
            ->add('descriEng');

        return $formBuilder->getForm();
    }

    public static function deleteFormBuilder(FormFactory $formFactory)
    {
        $centreTypePro = new self($formFactory);
        $formBuilder = $centreTypePro->formBuilder;

        return $formBuilder;
    }
}
