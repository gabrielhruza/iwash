<?php
// src/AppBundle/Form/EventListener/AddNameFieldSubscriber.php
namespace AppBundle\EventListener;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ObjectManager;

class AddDireccionSubscriber implements EventSubscriberInterface
{   

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SUBMIT => 'preSubmit',
        );
    }

    /**
     * Cuando el usuario llene los datos del formulario y haga el envío del mismo,
     * este método será ejecutado.
     */
    public function preSubmit(FormEvent $event)
    {   
        $form = $event->getForm();
        //$data = $event->getData();

        //como $data contiene el pais seleccionado por el usuario al enviar el formulario,
        // usamos el valor de la posicion $data['country'] para filtrar el sql de los estados
        $this->addField($form);
    }

    public function addField(Form $form)
    {
            $form->add('monto');
    }
}