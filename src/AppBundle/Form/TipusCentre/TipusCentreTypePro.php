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
    const NAMEFORM = 'tipuscentreform';

    private $formBuilder;

    private function __construct(FormFactory $formFactory, $values = null)
    {
        if (null === $values) {
            $this->formBuilder = $formFactory->createNamedBuilder(self::NAMEFORM);
        } else {
            $this->formBuilder = $formFactory->createNamedBuilder(self::NAMEFORM, FormType::class, $values);
        }
    }

    public static function newForm(FormFactory $formFactory, $values = null)
    {
        $tipusCentreTypePro = new self($formFactory, $values);
        $formBuilder = $tipusCentreTypePro->formBuilder;

        $formBuilder
            ->add('descriCat')
            ->add('descriEng')
            ->add('descriEsp')
            ;
        return $formBuilder;
    }

    public static function deleteForm(FormFactory $formFactory)
    {
        $tipusCentreTypePro = new self($formFactory);
        $formBuilder = $tipusCentreTypePro->formBuilder;

        return $formBuilder;
    }


    public function getForm()
    {
        return $this->formBuilder
            ->getForm();
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DomainBundle\Entity\TipusCentre\TipusCentre'
        ));
    }
}
