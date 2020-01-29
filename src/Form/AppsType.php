<?php

namespace App\Form;

use App\Entity\Apps;
use Doctrine\ORM\EntityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('beschrijving', CKEditorType::class, [
                'label'=> false,
                'required'   => false,
            ])

            ->add('parent', EntityType::class, [
                'required' => false,
                'class' => Apps::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                    ->where('u.parent IS NULL')
                    ->orderBy('u.parent', 'ASC');
                },
                'choice_label' => 'naam',
                'choice_value' => 'id',
                'label' => false,
            ])
            ->add('naam', TextType::class, [
                'label'=> false,
                'required'   => true,
            ])
            ->add('slug', HiddenType::class,[
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Apps::class,
        ]);
    }
}
