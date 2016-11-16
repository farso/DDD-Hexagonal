<?php

namespace UicBundle\Infrastructure\Form\TipusCentre;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TipusCentreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descriCat')
            ->add('descriEsp')
            ->add('descriEng')
        ;
    }
}
