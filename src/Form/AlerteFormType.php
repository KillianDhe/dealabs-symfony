<?php

namespace App\Form;

use App\Entity\Alerte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlerteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('recherche')
            ->add('temperatureMin')
            ->add('isSendEmail')
            ->add('créer alerte', SubmitType::class, array('attr' => array('class' => 'btn-primary flex-center form-item__submit')))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Alerte::class,
        ]);
    }
}
