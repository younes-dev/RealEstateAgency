<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\ContactType;
use App\Form\PropertySearchType;
use App\Notification\ContactNotification;
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
     * @param Request $request
     * @param ContactNotification $notification
     * @return Response
     */
    public function show(Property $property,string $slug, Request $request, ContactNotification $notification):Response
    {
//        $property=$this->repository->find($id);

        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show',[
                'id' =>  $property->getId(),
                'slug' =>  $property->getSlug()
            ],302);
        }

        $contact = new Contact();
        $contact->setProperty($property);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);
            //dump($notification->notify($contact));die;
            $this->addFlash('success', 'Votre message a été envoyé');
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ]);
        }

        return $this->render('property/show.html.twig', [
            'property' => $property,
            'CurrentMenu' => 'Properties',
            'form' => $form->createView()

        ]);
    }

}
