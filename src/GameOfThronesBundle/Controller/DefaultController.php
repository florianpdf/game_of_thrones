<?php

namespace GameOfThronesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * @Route("/sexe")
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
}
