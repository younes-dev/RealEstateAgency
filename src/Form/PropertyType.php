<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\Property;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('airConditioner',ChoiceType::class,[
                'choices' => array_flip( Property::Heat),
            ])
            ->add('options',EntityType::class,[
                'class' => Option::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false,
            ])
            ->add('imageFile',FileType::class,[
                'required' => false,
            ])
            ->add('city')
            ->add('adress')
            ->add('code_zip')
            ->add('sold', CheckboxType::class, [
                'label_attr' => [
                    'class' => 'switch-custom  bg-light',
                    'style' => 'background:red; color:#007bff;width:50px;height:30px;font-weight:bold'],
                'required' => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain' => 'forms'
        ]);
    }
}
