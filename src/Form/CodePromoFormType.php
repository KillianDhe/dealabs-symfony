<?php

namespace App\Form;

use App\Entity\CodePromo;
use App\Entity\Groupe;
use App\Entity\Partenaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CodePromoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Description')
            ->add('Titre')
            ->add('LienDuDeal')
            ->add('CodePromo')
            ->add('isExpire')
            ->add('Montant')
            ->add('typeReduction')
            ->add('groupes')
            ->add('partenaires')
            ->add('groupes', EntityType::class, [
                'class' => Groupe::class,
                'choice_label' => 'nom',
                'multiple' => true,
                "expanded" => true,
            ])
            ->add('partenaires', EntityType::class, [
                'class' => Partenaire::class,
                'choice_label' => 'nom',
                'multiple' => true,
                "expanded" => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CodePromo::class,
        ]);
    }
}
