<?php

namespace App\Form;

use App\Entity\Apps;
use App\Repository\AppsRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', ImageType::class, [
                'label'=> false,
                'required'   => false,
            ])
            ->add('beschrijving', CKEditorType::class, [
                'label'=> false,
                'required'   => false,
            ])
//            ->add('parent', ChoiceType::class, [
//                'choice_value'  => 'id',
//                'required'      => true,
//                'multiple'      => true,
//                'expanded'      => false,
//                'class'         => 'AppBundle\Entity\Apps',

//            ])
            ->add('naam', TextType::class, [
                'label'=> false,
                'required'   => true,
            ])
//            ->add('slug', TextType::class, [
//                'label' => false,
//                'required'   => false,
//                'class' => 'hidden'
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Apps::class,
        ]);
    }
}
