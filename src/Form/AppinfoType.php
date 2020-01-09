<?php

namespace App\Form;

use App\Entity\Appinfo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppinfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam', TextType::class, [
                'label' => false
            ])
            ->add('body', TextareaType::class, [
                'label' => false
            ])
            ->add('url', TextType::class, [
                'label' => false
            ])
            ->add('groep', TextType::class, [
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appinfo::class,
        ]);
    }
}
