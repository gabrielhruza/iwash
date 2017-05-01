<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\DateFormatter\DateFormat\DayTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

use AppBundle\EventListener\AddDireccionSubscriber;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TurnoParType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha', DateType::class, array(
                'widget' => 'single_text',
                'placeholder' => 'Seleccione el día',
                'attr' => array(
                    'class' => 'fecha form-control',
                    )
                ))
            ->add('hora', TimeType::class, array(
                'widget' => 'single_text',
                'placeholder' => 'Seleccione la hora.',
                'attr' => array(
                    'class' => 'hora',
                    )
                ))
            ->add('vehiculo', null, array(
                'placeholder' => 'Seleccione un tipo de vehículo.',
                ))
            ->add('patente', null, array(
                //'placeholder' => 'Seleccione un tipo de vehículo.',
                'attr' => array(
                    'style' => 'text-transform:uppercase',
                    'pattern' => '[a-z]{3}[0-9]{3}',
                    'placeholder' => 'Ej. ABC123',
                    'title' => 'Ej. ABC123'

                    )
                ))
            ->add('tipolavado', null, array(
                'label' => 'Lavado',
                'placeholder' => 'Seleccione un tipo de lavado.',
                'attr' => array('style' => 'width: 60%')
                ))
            ->add('centrointegral', null, array(
                'label' => 'Centro Integral',
                'placeholder' => 'Seleccione la sucursal.',
                'attr' => array('style' => 'width: 60%')
                ))
            ->add('movil', ChoiceType::class, array(
                    'label' => 'A domicilio',
                    'choices' => array(
                        'No' => false,
                        'Si' => true),
                    'expanded' => true
                    ))
            ->add('monto', HiddenType::class, array(
                'label_attr' => array('class' => 'sr-only'),
                //'attr' => array('style' => 'width: 40%, display:none')
                ))
            ->add('direccion', null, array(
                'label' => 'Dirección'
                //'placeholder' => 'Dirección donde desea que se dirija la unidad.',
                ))
        ;

        //$builder->addEventSubscriber(new AddDireccionSubscriber());
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\TurnoPar'
        ));
    }
}
