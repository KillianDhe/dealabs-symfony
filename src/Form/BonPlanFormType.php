<?php

namespace App\Form;

use App\Entity\BonPlan;
use App\Entity\Groupe;
use App\Entity\Partenaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BonPlanFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Titre')
            ->add('Description')
            ->add('LienDuDeal',UrlType::class)
            ->add('CodePromo')
            ->add('isExpire')
            ->add('Prix')
            ->add('PrixHabituel')
            ->add('FraisDePort')
            ->add('isLivraisonGratuite')
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
        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BonPlan::class,
        ]);
    }
}
