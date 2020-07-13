<?php

namespace App\Form;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Repository\PropertyRepository;
use Gedmo\Tree\RepositoryInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{


    /**
     * @var RepositoryInterface
     */
    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $value = [];
//        for ($i = 1; $i <= sizeof($this->repository->selectSurface()); $i++) {
//            $value[] += $this->repository->selectSurface()[$i]['surface'];
//            $i++;
//        }
//        $collection = [];
//        foreach ($value as $key => $val) {
//            $collection[] += $val;
//        }

        $builder
            ->add('minSurface',IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Surface Minimale'
                ]
            ])
            //**********************************************
            //**********   Input integer Type   ************
            //**********************************************
            ->add('maxSurface',IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Surface Maximale'
                ]
            ])
            // todo try apply those methods
            //**********************************************
            //**********   Choice Entity Type   ************
            //**********************************************
//            ->add('maxSurface',EntityType::class,[
//                'class' => Property::class,
//                'choice_label' => ('surface'),
//                'label' => false,
//                'choice_value' => 'surface',

            //**********************************************
            //**********   Choice Entity Type   ************
            //**********************************************
//            ->add('maxSurface',IntegerType::class,[
//                'choice_label' => function () {
//                    return $query= $this->repository->createQueryBuilder('p')
//                        ->select('p.surface')
//                        ->distinct('p.surface')
//                        ->getQuery()
//                        ->getResult();
//                },
            //**********************************************
            //**********   Choice Entity Type   ************
            //**********************************************
//            ->add('maxSurface',IntegerType::class,[
//                'class'  => [ Property::class,
//                    'choice' =>
//                        function (Property  $property) {return  $property->getSurface();}
//                         ],
            //**********************************************
            //**********   Choice Choice Type   ************
            //**********************************************
//            ->add('maxSurface',ChoiceType::class,[
//                'choices' => array_flip($collection),
//                'label'=> false,
//
//            ])

                ->add('maxPrice',IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Buget Maximale'
                ]
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'GET',           // changer la method par default a get
            'csrf_protection' => false,   // désactiver la protection Csrf des formulaire
        ]);
    }

    public function getBlockPrefix()
    {
        // return only the parameters in the url and values is exist.ty
        return null || '';
    }
}
