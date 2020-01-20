<?php

namespace App\Form;

use App\Entity\Apps;
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
//            ->add('image', ImageType::class, [
//                'label'=> false,
//                'required'   => false,
//            ])
            ->add('beschrijving', TextType::class, [
                'label'=> false,
                'required'   => false,
            ])
//            ->add('apps', ChoiceType::class, [
//                'label'=> false,
//                'choice_value' => function (apps $apps = null) {
//                    return $apps ? $apps->getapps() : 'apps';
//                },
//                'required'   => false,
//            ])
            ->add('naam', TextType::class, [
                'label'=> false,
                'required'   => false,
            ])
//            ->add('slug', TextType::class, [
//                'label' => false,
//                'required'   => false,
//                'disabled' => true
//
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
