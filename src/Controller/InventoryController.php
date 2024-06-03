<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCodeBundle\Response\QrCodeResponse;

class InventoryController extends AbstractController
{
    #[Route('/inventory', name: 'inventory')]
    public function show(Environment $twig, EntityManagerInterface $entityManager, BuilderInterface $customQrCodeBuilder)
    {
        
        $conn = $entityManager->getConnection();
        $sql="Select * From `inventory`";
        $resultSet = $conn->executeQuery($sql);
        return new Response($twig->render('inventory/inventory.html.twig', array(
            "result" => $resultSet->fetchAllAssociative(),
        )));
    }
}
