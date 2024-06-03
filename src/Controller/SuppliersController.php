<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class SuppliersController extends AbstractController
{
    #[Route('/suppliers', name: 'app_suppliers')]
    public function show(Environment $twig, EntityManagerInterface $entityManager)
    {
        
        $conn = $entityManager->getConnection();
        $sql="Select * From `supplier`";
        $resultSet = $conn->executeQuery($sql);

        return new Response($twig->render('suppliers/suppliers.html.twig', array(
            "result" => $resultSet->fetchAllAssociative()
        )));
    }
}
