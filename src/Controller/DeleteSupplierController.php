<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteSupplierController extends AbstractController
{
    #[Route('/deleteSupplier/{id}', name: 'app_delete_supplier')]
    public function index(int $id, EntityManagerInterface $entityManager): Response
    {
        $conn = $entityManager->getConnection();
        $sql="DELETE FROM `supplier` WHERE `id` =".$id;
        $conn->executeQuery($sql);
        return $this->render('delete_supplier/delete_supplier.html.twig', array(
            'id' => $id
        ));
    }
}
