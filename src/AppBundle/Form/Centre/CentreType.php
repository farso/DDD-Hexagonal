<?php

namespace AppBundle\Form\Centre;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
            ->add('tipusCentre', EntityType::class, array(
                'class' => 'AppBundle:TipusCentre\TipusCentre',
                'choice_label' => 'descriCat'
                ))
        ;



    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Centre\Centre'
        ));
    }
}
