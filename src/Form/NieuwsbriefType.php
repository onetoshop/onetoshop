<?php

namespace App\Form;

use App\Entity\Nieuwsbrief;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NieuwsbriefType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,array(
                'required' => true,
                'trim' => true,
                'label' => false,
                'attr' => array('placeholder' => 'Uw email' )))
//            ->add('aanmelden', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Nieuwsbrief::class,
        ]);
    }
}
