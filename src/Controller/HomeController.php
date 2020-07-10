<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param PropertyRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PropertyRepository $repository):Response
    {
        $properties=$repository->findlatest();
        return $this->render('home/index.html.twig',[
            'CurrentMenu' => 'home',
            'properties' => $properties

        ]);
    }
}
