<?php

namespace UicBundle\Infrastructure\Form\Centre;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CentreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('codi')
            ->add('mailCentre')
            ->add('codiOficial')
            ->add('color')
            ->add('idTipusCentre', EntityType::class, array(
                'class' => 'UicBundle:TipusCentre\TipusCentre',
                'choice_label' => 'descriCat',
                'choice_value' => 'id',
                'placeholder' => 'Choose an option',
                'empty_data'  => null
                ))
            // VALUE OBJECT ADDRESS
            ->add('carrer', TextType::class, array(
                'required' => true))
        ;
    }
}
