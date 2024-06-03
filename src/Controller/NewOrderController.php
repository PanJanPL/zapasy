<?php

namespace App\Controller;

use App\Entity\OrderEntity;
use App\Form\OrderFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class NewOrderController extends AbstractController
{
    #[Route('/newOrder', name: 'newOrder')]
    public function show(Environment $twig, Request $request, EntityManagerInterface $entityManager)
    {
        $order = new OrderEntity();

        $form = $this->createForm(OrderFormType::class, $order);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($order);
            $entityManager->flush();
            return new Response($twig->render('order_created/order_created.html.twig', array(
                'id' => $order->getId()
            )));
        }

        return new Response($twig->render('new_order/new_order.html.twig', array(
            'order_form' => $form->createView()
        )));
    }
}
