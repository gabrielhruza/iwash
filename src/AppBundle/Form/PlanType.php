<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PlanType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('flotas', CollectionType::class, array(
            'entry_type' => FlotaType::class,
            'allow_add'  => true,
            'by_reference' => false,
            'allow_delete' => true,
        ))
        
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Plan',
            'cascade_validation' => true,
        ));
    }
}
