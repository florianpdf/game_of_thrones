<?php

namespace GameOfThronesBundle\Controller;

use GameOfThronesBundle\Entity\Personnage;
use GameOfThronesBundle\Form\PersonnageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function homePageAction(){
        return $this->render('@GameOfThrones/Default/index.html.twig');
    }

    /**
     * @Route("/list_personnages", name="persos")
    */
    public function listAllPersonnage(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $personnages = $em->getRepository('GameOfThronesBundle:Personnage')->findAll();

        //$persosByRoyaume = $em->getRepository('GameOfThronesBundle:Personnage')->myFindByRoyaume('royaume_1');

        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(array('royaume'));
        $jsonEncoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($jsonEncoder));

        $jsonPerso = $serializer->serialize($personnages, 'json');

        $content = $this->renderView('@GameOfThrones/allPersonnages.html.twig', array(
            'personnages'=>$personnages
        ));

        $response = new JsonResponse($content);

        return $response;
    }

    /**
     * @Route("/add_perso", name="add_perso")
     */
    public function addPersoAction(Request $request)
    {
        $perso = new Personnage();
        $form = $this->createForm(PersonnageType::class, $perso);

        $form->handleRequest($request);

        if ($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($perso);
            $em->flush();

            $nom = $perso->getNom();

            $response = new Response($nom);

            return $response;
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

        if($request->isXmlHttpRequest()){
            $royaume = $request->request->get('royaume');

            $em = $this->getDoctrine()->getManager();
            $persos = $em->getRepository('GameOfThronesBundle:Personnage')->myFindByRoyaume($royaume);
            if(empty($persos)){
                $content = "prout";
            }else {
                $content = $this->renderView('@GameOfThrones/allPersonnages.html.twig', array(
                    'personnages' => $persos
                ));
            }

            $response = new JsonResponse($content);

            return $response;
        }

        return $this->render('@GameOfThrones/search.html.twig');
    }
}
