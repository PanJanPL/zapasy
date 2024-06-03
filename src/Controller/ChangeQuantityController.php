<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;

class ChangeQuantityController extends AbstractController
{
    #[Route('/changeQuantity/{id}', name: 'app_change_quantity')]
    public function index(int $id, Environment $twig, EntityManagerInterface $entityManager): Response
    {
        $conn = $entityManager->getConnection();
        
        $sql="UPDATE `inventory` SET `quantity` = `quantity` - 1 WHERE `id` =".$id;
        $conn->executeQuery($sql);
        $sql="DELETE FROM `inventory` Where `quantity` <= 0";
        $conn->executeQuery($sql);
        $sql="Select * From `inventory`";
        $resultSet = $conn->executeQuery($sql);

        return new Response($twig->render('inventory/inventory.html.twig', array(
            "result" => $resultSet->fetchAllAssociative()
        )));
    }
}
