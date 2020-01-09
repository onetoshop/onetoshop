<?php

namespace App\Form;

use App\Entity\Card;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
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
            ->add('title', TextType::class, [
                'row_attr' => ['class' => 'text-editor'],
                'label' => false,
            ])
            ->add('customer', TextType::class,[
                'label' => false
            ])
            ->add('body', CKEditorType::class, [
                'label' => false
            ])
            ->add('footer', Texttype::class, [
                'label' => false
            ])
            ->add('slug', TextType::class, [
                'label' => false
            ])
            ->add('bgimage', ImageType::class, [
                'label' => false
            ])
            ->add('frimage', ImageType::class, [
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Card::class,
        ]);
    }
}
