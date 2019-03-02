<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use AppBundle\Entity\CarCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Frontend controller.
 *
 * @Route("/")
 */

class FrontendController extends Controller{

    /**
     * Lists active cars in frontend.
     *
     * @Route("/", name="frontend")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {

        $model=$request->query->get('model');
        $engine_size=$request->query->get('engine_size');

        $em = $this->getDoctrine()->getManager();

        $activeCars = $em->getRepository('AppBundle:Car')->getFrontendList($model, $engine_size);

        return $this->render('@App/frontend/index.html.twig', array(
            'activeCars' => $activeCars
        ));
    }

}