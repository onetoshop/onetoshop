<?php

namespace App\Form;

use App\Entity\Functionaliteit;
use Doctrine\ORM\EntityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FunctionaliteitenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('body', CKEditorType::class,[
                'required' => false,
                'label' => false,
            ])
            ->add('name', TextType::class,[
                'required' => false,
                'label' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('slug', HiddenType::class, [
                'required' => false,
            ])
            ->add('publiceer', CheckboxType::class, [
                'required' => false,
                'label' => false,
                'attr' => ['class' => 'custom-control-input']
            ])
            ->add('parent', EntityType::class, [
                'required' => false,
                'class' => Functionaliteit::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.parent IS NULL')
                        ->orderBy('u.parent', 'ASC');
                },
                'choice_label' => 'name',
                'choice_value' => 'id',
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Functionaliteit::class,
        ]);
    }
}
