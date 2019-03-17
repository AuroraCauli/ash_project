<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * ShoppingCart controller.
 *
 * @Route("/cart")
 */

class ShoppingCartController extends Controller{

    const SESSION_ID = "shopping_cart_items";

    /**
     * Add items to cart.
     *
     * @Route("/add_item/{id}", name="add_item")
     * @Method("GET")
     */
    public function addToShoppingCart(Request $request, $id){

        $session = $this->get('session');

        $items = $session->get(self::SESSION_ID, array());

        $em = $this->getDoctrine()->getManager();

        $car = $em->getRepository('AppBundle:Car')->find($id);

        !isset($items[$id])? $quantity=1 : $quantity=$items[$id]['quantity']+1;

        $items[$car->getId()]=array('model'=>$car->getModel(), 'quantity'=>$quantity);

        $session->set(self::SESSION_ID, $items);

        return $this->redirectToRoute("frontend", $request->query->all());
    }

    /**
     * Remove items from cart.
     *
     * @Route("/remove_item/{id}", name="remove_item")
     * @Method("GET")
     */
    public function removeFromShoppingCart(Request $request, $id){
        $session = $this->get('session');

        $items = $session->get(self::SESSION_ID, array());

        if($items[$id]['quantity']>1) $items[$id]['quantity']=$items[$id]['quantity']-1;
        else unset($items[$id]);

        $session->set(self::SESSION_ID, $items);

        return $this->redirectToRoute("frontend", $request->query->all());
    }

    /**
     * Success buy.
     *
     * @Route("/success_buy", name="success_buy")
     * @Method("GET")
     */
    public function buySuccess(){

        $session = $this->get('session');
        $session->set(self::SESSION_ID, array());

        return $this->render('@App/frontend/success_buy.html.twig');
    }
}