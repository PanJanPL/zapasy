<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompleteOrderController extends AbstractController
{
    #[Route('/completeOrder/{id}', name: 'app_complete_order')]
    public function index(int $id, EntityManagerInterface $entityManager): Response
    {
        $conn = $entityManager->getConnection();
        $sql="SELECT `product`, `quantity` FROM `order_entity` WHERE `id` =".$id;
        $res = $conn->executeQuery($sql);
        $res = $res->fetchAllAssociative();
        $product = $res[0]["product"];
        $quantity = $res[0]["quantity"];
        $conn->executeQuery("DELETE FROM `order_entity` WHERE `id` =".$id);
        $conn->executeQuery("INSERT INTO `inventory`(`product`,`quantity`) VALUES ('".$product."',".$quantity.")");
        return $this->render('complete_order/complete_order.html.twig', array(
            'id' => $id
        ));
    }
}
