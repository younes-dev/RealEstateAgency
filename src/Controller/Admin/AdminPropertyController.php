<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;


class AdminPropertyController extends AbstractController
{
    /**
     * @var EntityRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(PropertyRepository  $repository,EntityManagerInterface $manager ){

        $this->repository = $repository;
        $this->manager = $manager;
    }


    /**
     * @Route("/admin", name="admin.property.index")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator,Request $request):Response
    {
        $session = new Session();
        $session->clear();

//        $properties = $this->repository->findAll();
//        dump($properties);die;
//************************************************************

        $properties=$paginator->paginate(
            $this->repository->findAll(),/* query NOT result */
            $request->query->getInt('page',1),/*page number*/
            12);/*limit per page*/
//************************************************************


        return $this->render('admin/admin_property/index.html.twig',[
                'properties' => $properties
            ]
//            compact('properties')
        );
    }


    /**
     * @Route("/admin/property/create",name="admin.property.new")
     * @param Request $request
     */
    public function new(Request $request):Response
    {
        $property =new Property();
        $form=$this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($property);
            $this->manager->flush();
            $this->addFlash('success','le bien et modifier avec succses');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render("admin/admin_property/new.html.twig",[
            'form' => $form->createView(),
            'property' => $property
        ]);
    }


    /**
     * @Route("/admin/property/{id}",name="admin.property.edit",methods={"GET","POST"})
     * @param Property $property
     * @param Request $request
     * @return Response
     */
    public function edit(Property $property,Request $request):Response
    {

        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
//            $this->manager->persist($property);
            $this->manager->flush();
            $this->addFlash('success','le bien et modifier avec succses');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/admin_property/edit.html.twig', [
            'form' => $form->createView(),
            'properties' => $property,
        ]);
    }


    /**
     * @Route("/admin/property/{id}",name="admin.property.delete",methods={"GET","DELETE"})
     * @param Property $property
     * @param Request $request
     * @return Response
     */
    public function delete(Property $property,Request $request):Response
    {
        if($this->isCsrfTokenValid('delete'.$property->getId(),$request->get('_token'))){
            $this->manager->remove($property);
            $this->manager->flush();
            $this->addFlash('success','le bien et supprimer avec succses');
        }

        return $this->redirectToRoute('admin.property.index');
    }

}