<?php

namespace App\Form;

use App\Entity\Card;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('customer', TextType::class)
            ->add('body', TextareaType::class)
            ->add('footer', TextareaType::class)
            ->add('slug', TextType::class)
            ->add('bgimage', ImageType::class, ['label' => 'Upload Background Foto'])
            ->add('frimage', ImageType::class, ['label' => 'Upload Frond Foto'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Card::class,
        ]);
    }
}
