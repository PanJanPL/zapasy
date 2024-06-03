<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Form\SuppliersFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class NewSupplierController extends AbstractController
{
    #[Route('/newSupplier', name: 'app_new_supplier')]
    public function show(Environment $twig, Request $request, EntityManagerInterface $entityManager)
    {
        $order = new Supplier();

        $form = $this->createForm(SuppliersFormType::class, $order);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($order);
            $entityManager->flush();
            return new Response($twig->render('supplier_created/supplier_created.html.twig', array(
                'id' => $order->getId()
            )));
        }

        return new Response($twig->render('new_supplier/new_supplier.html.twig', array(
            'supplier_form' => $form->createView()
        )));
    }
}
