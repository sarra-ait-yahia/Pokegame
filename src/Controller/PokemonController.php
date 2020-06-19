<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Herrera\DateInterval\DateInterval;
use Symfony\Component\Validator\Constraints\DateTimeZone;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

/**
 * @Route("/pokemon")
 */
class PokemonController extends AbstractController
{
    /**
     * @Route("/", name="pokemon_index", methods={"GET"})
     */
    public function index(PokemonRepository $pokemonRepository): Response
    {
        return $this->render('pokemon/index.html.twig', [
            'pokemon' => $pokemonRepository->findByUserField($this->getUser()),
        ]);
    }

    /**
     * @Route("/new", name="pokemon_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pokemon = new Pokemon();
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pokemon->setDresseur($this->getUser());
            $pokemon->setXp(0);
            $pokemon->setAVendre(false);
            $pokemon->setNiveau(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pokemon);
            $entityManager->flush();

            $this->getUser()->setPokemonOffert(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($this->getUser());
            $entityManager->flush();

            return $this->redirectToRoute('pokemon_show',array(
                'id' => $pokemon->getId(),
            ));
        }

        return $this->render('pokemon/new.html.twig', [
            'pokemon' => $pokemon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/pokemon_poke_a_vendre", name="pokemon_poke_a_vendre")
     */
    public function pokeAvendre(PokemonRepository $pokemonRepository): Response
    {
        return $this->render('pokemon/poke_a_vendre.html.twig', [
            'pokemon' => $pokemonRepository->findPokeVente(),
        ]);
    }


    /**
     * @Route("/{id}", name="pokemon_show", methods={"GET"})
     */
    public function show(Pokemon $pokemon): Response
    {
        return $this->render('pokemon/show.html.twig', [
            'pokemon' => $pokemon,
        ]);
    }


    /**
     * @Route("/{id}/entrainer", name="pokemon_entrainer", methods={"GET"})
     */
    public function entrainer(Pokemon $pokemon, Request $request): Response
    {
        $dateEntrainement = $pokemon->getDateDernierEntrainement();
      //  date_default_timezone_set('Europe/Paris');
        $dateMoinsHour = new \DateTime('-1 hour');

        if($dateEntrainement == null || $dateEntrainement<$dateMoinsHour) {
            $random = rand(10, 30);
            $pokemon->setXp($pokemon->getXp() + $random);
            //calcul du niveau
            $xp=0;
            $i=0;
            while($pokemon->getXp()>$xp){
                $i++;
                switch ($pokemon->getTypePokemon()->getTypeCourbeNiveau()){
                    case "M":
                        $xp=pow($i, 3);
                        break;
                    case "L":
                        $xp=1.2*pow($i, 3)-15*pow($i,2)+100*$i-140;
                        break;
                    case "P":
                        $xp=1.25*pow($i, 3);
                        break;
                     case "R":
                         $xp=0.8*pow($i, 3);
                         break;
                }
            }
            $pokemon->setNiveau($i-1);
            $date=new \DateTime('now');
            $pokemon->setDateDernierEntrainement($date);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pokemon);
            $entityManager->flush();

            return $this->render('pokemon/show.html.twig', [
                'pokemon' => $pokemon,
            ]);
        }
        else{
            return $this->render('pokemon/show.html.twig', [
                'pokemon' => $pokemon,
                'message'=>'Vous ne pouvez pas l\'entrainer , il a été entrainé il y a meme pas une heure'
            ]);
        }
    }

    /**
     * @Route("/{id}/pokemon_edit", name="pokemon_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pokemon $pokemon): Response
    {
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pokemon_index');
        }

        return $this->render('pokemon/edit.html.twig', [
            'pokemon' => $pokemon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/pokemon_avendre", name="pokemon_avendre", methods={"GET","POST"})
     */
    public function mettreEnVente(Pokemon $pokemon, Request $request): Response
    {
        $form = $this->createFormBuilder($pokemon)
                ->add('prix',IntegerType::class, array('label'=> false))
               ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pokemon->setAVendre(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pokemon);
            $entityManager->flush();

            return $this->render('pokemon/show.html.twig', [
                'pokemon' => $pokemon,
            ]);
        }

        return $this->render('pokemon/show.html.twig', [
            'pokemon' => $pokemon,
            'miseEnVente'=> true,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/pokemon_recuperer", name="pokemon_recuperer", methods={"GET","POST"})
     */
    public function recuperer(Pokemon $pokemon, Request $request): Response
    {
        $pokemon->setAVendre(false);
        $pokemon->setPrix(null);
        $this->getDoctrine()->getManager()->flush();

        return $this->render('pokemon/show.html.twig', [
            'pokemon' => $pokemon,
        ]);
    }

    /**
     * @Route("/{id}", name="pokemon_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pokemon $pokemon): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pokemon->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pokemon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pokemon_index');
    }

    /**
     * @Route("/{id}/pokemon_acheter", name="pokemon_acheter", methods={"GET","POST"})
     */
    public function acheter(Pokemon $pokemon, Request $request,PokemonRepository $pokemonRepository): Response
    {
        $prixDeVente=$pokemon->getPrix();
        $pieceDispo=$this->getUser()->getNbPiece();
        if($pieceDispo>=$prixDeVente) {
            $this->getUser()->setNbPiece($pieceDispo-$prixDeVente);
            $pieceVendeur=$pokemon->getDresseur()->getNbPiece();
            $pokemon->getDresseur()->setNbPiece($pieceVendeur+$prixDeVente);
            $pokemon->setAVendre(false);
            $pokemon->setPrix(null);
            $pokemon->setDresseur($this->getUser());

            $this->getDoctrine()->getManager()->flush();

            return $this->render('pokemon/show.html.twig', [
                'pokemon' => $pokemon,
            ]);
        }
        else{
            return $this->render('pokemon/poke_a_vendre.html.twig', [
                'pokemon' =>  $pokemonRepository->findAll(),
                'PiecePasAssez'=> 'Vous n\'avez pas assez de pièces pour effectuer cet achat',
            ]);
        }
    }
}
