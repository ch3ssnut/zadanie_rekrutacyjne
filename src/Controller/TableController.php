<?php

namespace App\Controller;

use App\Form\SortType;
use App\Service\Sort;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends AbstractController
{
    #[Route('/', name: 'app_table')]
    public function index(Request $request, Sort $sort): Response
    {
        // set filepath and decode json into array so php can manage it
        $filePath = $this->getParameter('kernel.project_dir') . '/public/files/naglowki_zamowienia.json';
        $json = file_get_contents($filePath);
        $data = json_decode($json, true);

        // create form to sort data
        $form = $this->createForm(SortType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            // sort data with service
            switch ($form->get('sort_by')->getData()) {
                case 'ref':
                    $data = $sort->sortTable($data, 'ref');
                    break;
                case 'symbol':
                    $data = $sort->sortTable($data, 'symbol');
                    break;
                case 'regdate':
                    $data = $sort->sortTable($data, 'regdate');
                    break;
                case 'send_date':
                    $data = $sort->sortTable($data, 'send_date');
                    break;
            }

            return $this->render('table/table.html.twig', [
                'data' => $data,
                'form' => $form->createView(),
            ]);
        }
        

        return $this->render('table/table.html.twig', [
            'data' => $data,
            'form' => $form->createView(),
        ]);
    }
}
