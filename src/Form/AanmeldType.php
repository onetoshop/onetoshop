<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaTypeType;

class AanmeldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('voornaam', TextType::class, [
                'label' => 'Voornaam',
            ])
            ->add('achternaam', TextType::class, [
                'label' => 'Achternaam',
            ])
            ->add('telefoon', TextType::class, [
                'label' => 'Telefoonnummer',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Emailadres',
            ])
            ->add('doel', TextareaType::class, [
                'label' => 'Doel',
            ])
            ->add('voorkeur', TextareaType::class, [
                'label' => 'Doel van je webshop',
            ])
            ->add('contact', TextType::class, [
                'label' => 'Contact opnemen?',
            ])
            ->add('Verzend', SubmitType::class)
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
