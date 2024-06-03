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

class OrdersController extends AbstractController
{
    #[Route('/orders', name: 'orders')]
    public function show(Environment $twig, EntityManagerInterface $entityManager)
    {
        
        $conn = $entityManager->getConnection();
        $sql="Select * From `order_entity`";
        $resultSet = $conn->executeQuery($sql);

        return new Response($twig->render('orders/orders.html.twig', array(
            "result" => $resultSet->fetchAllAssociative()
        )));
    }
}
