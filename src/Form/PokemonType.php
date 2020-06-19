<?php

namespace App\Form;

use App\Entity\Pokemon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;

class PokemonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surnom',  TextType::class, array('label'=>"Donnez lui un petit surnom"))
            ->add('sexe',  ChoiceType::class, array('label'=>"Sexe du pokemon",'expanded' => true, 'multiple' => false,
                'choices' => array('f' => 'Féminin', 'm' => 'Masculin')))

            ->add('typePokemon',EntityType::class, [
        // looks for choices from this entity
        'class' => \App\Entity\PokemonType::class,
        'query_builder' => function (EntityRepository $pokeT) {
                    return $pokeT->createQueryBuilder('p')
                        ->andWhere('p.nom = \'Bulbizare\' or p.nom = \'Salamèche\' or p.nom = \'Carapuce\' ');},
        'choice_label' => 'nom',
    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class,
        ]);
    }
}
