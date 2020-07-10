<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * PropertyController constructor.
     * @param PropertyRepository $repository
     * @param EntityManagerInterface $manager
     */
    public function __construct(PropertyRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/biens", name="property.index")
     */
    public function index():Response
    {
        $property=$this->repository->findAllActiveProperty();

        return $this->render('property/index.html.twig', [
            'CurrentMenu' => 'Properties',
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}",name="property.show", requirements={"slug":"[a-z0-9\-]*"})
     * @param Property $property
     * @param string $slug
     * @return Response
     */
    public function show(Property $property,string $slug):Response
    {
//        $property=$this->repository->find($id);

        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show',[
                'id' =>  $property->getId(),
                'slug' =>  $property->getSlug(),302
            ]);
        }
        return $this->render('property/show.html.twig', [
            'property' => $property,
            'CurrentMenu' => 'Properties'
        ]);
    }

}
