<?php

namespace GameOfThronesBundle\Controller;

use GameOfThronesBundle\Entity\Personnage;
use GameOfThronesBundle\Form\PersonnageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/list_personnages", name="persos")
    */
    public function listAllPersonnage()
    {
        $em = $this->getDoctrine()->getManager();
        $personnages = $em->getRepository('GameOfThronesBundle:Personnage')->myFindAll();

        $persosByRoyaume = $em->getRepository('GameOfThronesBundle:Personnage')->myFindByRoyaume('royaume_1');

        return $this->render('@GameOfThrones/allPersonnages.html.twig', array(
            'personnages' => $personnages,
            'persosByRoyaume' => $persosByRoyaume
        ));
    }

    /**
     * @Route("/add_perso", name="add_perso")
     */
    public function addPersoAction(Request $request)
    {
        $perso = new Personnage();
        $form = $this->createForm(PersonnageType::class, $perso);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($perso);
            $em->flush();

            return $this->redirectToRoute('persos');
        }
        return $this->render('@GameOfThrones/addPerso.html.twig', array(
            'form' => $form->createView(),
            'perso' => $perso
        ));
    }


    /**
     * @Route("/search", name="search")
     */
    public function findByRoyaumeAction(Request $request){

        if ($request->isMethod('post')){
            $royaume = $_REQUEST['royaume'];

            $em = $this->getDoctrine()->getManager();
            $persos = $em->getRepository('GameOfThronesBundle:Personnage')->myFindByRoyaume($royaume);

            return $this->render('@GameOfThrones/search.html.twig', array(
                'persos' => $persos
            ));
        }

        return $this->render('@GameOfThrones/search.html.twig');
    }
}
