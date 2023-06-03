<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends AbstractController
{
    #[Route('/', name: 'app_table')]
    public function index(): Response
    {
        $filePath = $this->getParameter('kernel.project_dir') . '/public/files/naglowki_zamowienia.json';


        $json = file_get_contents($filePath);
        $data = json_decode($json, true);
        

        return $this->render('table/table.html.twig', [
            'data' => $data,
        ]);
    }
}
