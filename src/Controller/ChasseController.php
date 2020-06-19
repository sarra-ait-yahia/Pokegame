<?php

namespace App\Controller;

use App\Entity\Chasse;
use App\Entity\Pokemon;
use App\Form\ChasseType;
use App\Repository\ChasseRepository;
use App\Repository\CaptureRepository;
use App\Repository\PokemonTypeRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chasse")
 */
class ChasseController extends AbstractController
{
    /**
     * @Route("/", name="chasse_index", methods={"GET","POST"})
     */
    public function index(ChasseRepository $chasseRepository): Response
    {
        return $this->render('chasse/index.html.twig', [
            'chasses' => $chasseRepository->findChasse($this->getUser()),
        ]);
    }

    /**
     * @Route("/new", name="chasse_new", methods={"GET","POST"})
     */
    public function new(Request $request,CaptureRepository $captureRepository,  PokemonTypeRepository $pokemonTypeRepository): Response
    {

        $chasse = new Chasse();
        $form = $this->createForm(ChasseType::class, $chasse);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pokemonChasseur = $chasse->getPokemon();
            $dateDerniereChasse=$pokemonChasseur->getDateDerniereChasse();
            $dateDernierEntrainement=$pokemonChasseur->getDateDernierEntrainement();
            $dateMoinsHour=new \DateTime('-1 hour');
            if($dateDerniereChasse>$dateMoinsHour){
                return $this->render('chasse/new.html.twig', [
                    'chasse' => $chasse,
                    'message'=>'Ce pokémon a déjà chassé il y\'a meme pas une heure, sélectionnez un autre pokémon , ou attendez un peu de temps',
                    'form' => $form->createView(),
                ]);
            }
            elseif ($dateDernierEntrainement>$dateMoinsHour){
                return $this->render('chasse/new.html.twig', [
                    'chasse' => $chasse,
                    'message'=>'Ce pokémon a été entrainé il y\'a meme pas une heure, sélectionnez un autre pokémon , ou attendez un peu de temps',
                    'form' => $form->createView(),
                ]);
            }
            else{
                $captureLieu = $captureRepository->findByExampleField($chasse->getLieuCapture()->getLieu());
                $pokemonEspeces = $captureLieu->getPokemonEspece();
                $pokemonTypes=array();
                while(empty($pokemonTypes)) {
                    $pokemonEspece = $pokemonEspeces->get(array_rand($pokemonEspeces->toArray()));
                    $pokemonChasse = new pokemon();
                    $pokemonTypes = $pokemonTypeRepository->findByEspece($pokemonEspece);
                    $Index = array_rand($pokemonTypes);
                }
                $pokemonChasse->setTypePokemon($pokemonTypes[$Index]);
                $pokemonChasse->setDresseur($this->getUser());
                $genres= ['Ma','Fé'];
                $Indexg = array_rand($genres);
                $pokemonChasse->setSexe($genres[$Indexg]);
                $pokemonChasse->setXp(0);
                $pokemonChasse->setNiveau(0);
                $pokemonChasse->setAVendre(false);
                $chasse->setPokemonChasse($pokemonChasse);
                $chasse->setDresseur($this->getUser());
                $chasse->setDateChasse(new \DateTime('now'));

                $pokemonChasseur->setDateDerniereChasse($chasse->getDateChasse());

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($pokemonChasseur);
                $entityManager->flush();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($pokemonChasse);
                $entityManager->flush();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($chasse);
                $entityManager->flush();

                return $this->redirectToRoute('pokemon_addSurnom',array(
                    'id' => $pokemonChasse->getId(),
                ));


        }
        }

        return $this->render('chasse/new.html.twig', [
            'chasse' => $chasse,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/pokemon_addSurnom", name="pokemon_addSurnom", methods={"GET","POST"})
     */
    public function addSurnom(Pokemon $pokemon, Request $request): Response{
        $form = $this->createFormBuilder($pokemon)
            ->add('surnom',TextType::class, array('label'=> 'Donnez lui un petit surnom:'))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($pokemon);
                $entityManager->flush();

                return $this->render('pokemon/show.html.twig', [
                'pokemon' => $pokemon,
                ]);
        }
        return $this->render('chasse/showPokeCapture.html.twig', [
            'pokemon' => $pokemon,
            'form'=>$form->createView(),
        ]);
        }

}
