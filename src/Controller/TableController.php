<?php

namespace App\Controller;

use App\Form\SearchType;
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

        // Search form
        $searchForm = $this->createForm(SearchType::class);
        $searchForm->handleRequest($request);
        
        // sort data functionality
        if ($form->isSubmitted() && $form->isValid()) { 
            // sort data with sort service
            $filter = $form->get('sort_by')->getData();
            $data = $sort->sortTable($data, $filter);
            
            return $this->render('table/table.html.twig', [
                'data' => $data,
                'form' => $form->createView(),
                'searchForm' => $searchForm->createView(),
            ]);
        }
        
        
        // search functionality
        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $pattern = $searchForm->get('find_by')->getData();
            $escapedPattern = preg_quote($pattern, '/');
            $pattern = '~' . preg_quote($pattern) . '~i';
            $foundRows = Array();
            foreach ($data as $dataRow) {
                
                if (preg_match($pattern, strval($dataRow['ref'])) || preg_match($pattern, strval($dataRow['symbol']))) {
                    array_push($foundRows, $dataRow);
                }
            }
            return $this->render('table/table.html.twig', [
                'data' => $foundRows,
                'form' => $form->createView(),
                'searchForm' => $searchForm->createView(),
            ]);
        }


        return $this->render('table/table.html.twig', [
            'data' => $data,
            'form' => $form->createView(),
            'searchForm' => $searchForm->createView(),
        ]);
    }
}
