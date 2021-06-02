<?php

namespace App\Form;

use App\Entity\CodePromo;
use App\Entity\Groupe;
use App\Entity\Partenaire;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CodePromoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Titre')
            ->add('Description')
            ->add('LienDuDeal',UrlType::class)
            ->add('CodePromo')
            ->add('isExpire')
            ->add('Montant')
            ->add('typeReduction',ChoiceType::class, [
                'choices'  => [
                    'Pourcentage' => 'pourcentage',
                    'Euros' => 'euros',
                    'Livraisaon gratuite' => 'livraison gratuite',
                ]
            ])
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
