<?php

namespace AppBundle\Form\Centre;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class CentreTypePro
{
    private $formBuilder;

    private function __construct(FormFactory $formFactory)
    {
        $this->formBuilder = $formFactory->createBuilder();
    }

    public static function newForm(FormFactory $formFactory)
    {
        $centreTypePro = new self($formFactory);
        $formBuilder = $centreTypePro->formBuilder;

        $formBuilder
            ->add('nombre')
            ->add('codi')
            ->add('mailCentre')
            ->add('codiOficial')
            ->add('color');

        return $formBuilder;
    }

    public static function deleteForm(FormFactory $formFactory)
    {
        $centreTypePro = new self($formFactory);
        $formBuilder = $centreTypePro->formBuilder;

        return $formBuilder;
    }


    public function getForm()
    {
        return $this->formBuilder
            ->getForm();
    }
}
