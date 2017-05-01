<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FlotaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad', null, array(
                'label_attr' => array('class' => 'sr-only'),
                'attr' => array(
                    'placeholder' => 'Indique cantidad'
                    )
                ))
            ->add('tipovehiculo', null, array(
                'label_attr' => array('class' => 'sr-only'),
                'attr' => array(
                    'placeholder' => 'Seleccione tipo de vehiculo'
                    )
                ))
            ->add('tipolavado', null, array(
                'label_attr' => array('class' => 'sr-only'),
                'attr' => array(
                    'placeholder' => 'Seleccione tipo de lavado'
                    )
                ))
            ->add('centrointegral', null, array(
                'label_attr' => array('class' => 'sr-only'),
                'attr' => array(
                    'placeholder' => 'Seleccione centro integral'
                    )
                ))
            ->add('periodicidad', ChoiceType::class, array(
                'choices' => array(
                    '1 vez por semana' => '1 vez por semana',
                    '2 veces por semana' => '2 veces por semana',
                    '3 veces por semana' => '3 veces por semana',
                    ),
                'label_attr' => array('class' => 'sr-only'),
                'attr' => array(
                    'placeholder' => 'Seleccione periodicidad'
                    )
                ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Flota',
        ));
    }
}
