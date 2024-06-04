<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use TomasVotruba\BarcodeBundle\Base1DBarcode;

class BarcodeController extends AbstractController
{
    #[Route('/barcode/{id}', name: 'app_barcode')]
    public function index($id): Response
    {
        $myBarcode = new Base1DBarcode();
        $myBarcode->savePath = '/my/temp/media/path';
        $bcHTMLRaw = $myBarcode->getBarcodeHTML($id, 'EAN13', 3.5, 90);
        return $this->render('barcode/barcode.html.twig', [
            'barcode' => $bcHTMLRaw,
        ]);
    }
}
