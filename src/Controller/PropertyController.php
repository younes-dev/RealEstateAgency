<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator,Request $request):Response
    {
//        $surface=$this->repository->selectSurface();
//        dump($surface);die;
        /****************************************************************/

        $search = new PropertySearch();
        $formSearch = $this->createForm(PropertySearchType::class,$search);
        $formSearch->handleRequest($request);
        /****************************************************************/
        $properties=$paginator->paginate(
            $this->repository->findAllActivePropertyQuery($search),/* query NOT result */
            $request->query->getInt('page',1),/*page number*/
            12);/*limit per page*/
        return $this->render('property/index.html.twig', [
            'CurrentMenu' => 'properties',
            'properties' => $properties,
            'formSearch' => $formSearch->createView()
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
