<?php

namespace App\Controller;

use App\Service\Helper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CsvController extends AbstractController
{
    /**
     * @Route("/csv", name="csv-generator")
     * this controller generate a csv file using $list data
     * @param Request $request
     * @param Helper $helper
     * @return Response
     */
    public function createCsv(Request $request,Helper $helper)
    {

        if ($request->request->get("download")) {
//            dump('clicked');die;

            $list = array(
                //these are the columns
                array('Firstname', 'Lastname',),
                //these are the rows
                array('Andrei', 'Boar'),
                array('John', 'Doe')
            );

        $fp = fopen('php://output', 'w');

        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }

        $response = new Response();
        $response->headers->set('Content-Type', 'text/csv');
        //it's gonna output in a testing.csv file
        $response->headers->set('Content-Disposition', 'attachment; filename="testing.csv"');

        return $response;
        }

        return $this->render('csv/index.html.twig', [
        'dir' =>  $helper->showProjectDir()
        ]);
    }
}
