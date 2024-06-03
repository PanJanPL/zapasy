<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteOrderController extends AbstractController
{
    #[Route('/deleteOrder/{id}', name: 'app_delete_order')]
    public function index(int $id, EntityManagerInterface $entityManager): Response
    {
        $conn = $entityManager->getConnection();
        $sql="DELETE FROM `order_entity` WHERE `id` =".$id;
        $conn->executeQuery($sql);
        return $this->render('delete_order/delete_order.html.twig', array(
            'id' => $id
        ));
    }
}

