<?php

namespace App\Form;

use App\Entity\Chasse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\Security;

class ChasseType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('lieuCapture',EntityType::class, [
                // looks for choices from this entity
                'class' => \App\Entity\CaptureLieu::class,
                'choice_label' => 'Lieu',
                'label'=>'Choisissez le lieu de la chasse: ',
            ])
            ->add('pokemon',EntityType::class, [
                // looks for choices from this entity
                'class' => \App\Entity\Pokemon::class,
                'query_builder' => function (EntityRepository $poke) {
                    return $poke->createQueryBuilder('p')
                        ->andWhere('p.dresseur =:user')
                        ->setParameter(':user', $this->security->getUser());},
                'choice_label' => 'surnom',
                'label'=>'Choisissez le pokémon que vous voulez envoyer à la chasse: ',
            ])
        ;
    }
    //=> function (EntityRepository $pokemon) {
    //                        return $pokemon->getTypePokemon()->getNom() . ' : ' . $pokemon->getSurnom();
    //                 },

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chasse::class,
        ]);
    }
}
