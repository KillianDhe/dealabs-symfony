<?php

namespace App\Form;

use App\Entity\BonPlan;
use App\Entity\Groupe;
use App\Entity\Partenaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BonPlanFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Description')
            ->add('Titre')
            ->add('LienDuDeal')
            ->add('CodePromo')
            ->add('isExpire')
            ->add('Prix')
            ->add('PrixHabituel')
            ->add('FraisDePort')
            ->add('isLivraisonGratuite');
            /*->add('groupes', EntityType::class, [
                'class' => Groupe::class,
                'choice_label' => 'nom',
            ])
        ->add('partenaires', EntityType::class, [
            'class' => Partenaire::class,
            'choice_label' => 'nom',
        ]);*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BonPlan::class,
        ]);
    }
}
