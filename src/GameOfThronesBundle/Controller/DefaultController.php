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
     * @Route("/")
     */
    public function showPersonnageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $perso = $em->getRepository('GameOfThronesBundle:Personnage')->findOneById(1);

        return new Response($perso);
    }


    /**
     * @Route("/sexe", name="perso_sexe")
     */
    public function listPersonnageAction(){
        $em = $this->getDoctrine()->getManager();
        $personnages = $em->getRepository('GameOfThronesBundle:Personnage')->findBySexe('Homme');

        $response = '';
        $i = 1;
        foreach ($personnages as $personnage){
            $response .= "Personnage " . $i . ": <br>" . $personnage . "<br>";
            $i++;
        }

        return new Response($response);
    }

    /**
     * @Route("/add_perso", name="add_perso")
     */
    public function addPersoAction(Request $request){
        $perso = new Personnage();
        $form = $this->createForm(PersonnageType::class, $perso);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($perso);
            $em->flush();

            return $this->redirectToRoute('perso_sexe');
        }
        return $this->render('@GameOfThrones/addPerso.html.twig', array(
            'form' => $form->createView(),
            'perso' => $perso
        ));
    }
}
