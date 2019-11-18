<?php

namespace App\Controller;

use App\Entity\Card;
use App\Form\CardType;
use App\Form\UploadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class PostController extends AbstractController
{
    /**
     * @Route("/admin/card", name="card")
     * @IsGranted("ROLE_USER")
     */
    public function card()
    {
        $cards = $this->getDoctrine()->getRepository(Card::class)->findAll();
        return $this->render('upload/card.html.twig', [
            'cards' => $cards
        ]);
    }

    /**
     * @Route("/admin/card/show/{slug}", name="show_card")
     * @IsGranted("ROLE_USER")
     */
    public function show_card($slug)
    {
    $cards = $this->getDoctrine()->getRepository(Card::class)->findBy([
        'title' => $slug
    ]);


    return $this->render('upload/cardshow.html.twig', [
    'cards' => $cards
    ]);
    }


    /**
     * @Route("/admin/delete/{id}", name="delete")
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $card = $em->getRepository(Card::class)->find($id);

        $em->remove($card);
        $em->flush();

        $this->addFlash(
            'info',
            'Card Succesvol Verwijderd'
        );

        return $this->redirectToRoute('card');
    }


    /**
     * @Route("/admin/card/add_card", name="add_card")
     * @IsGranted("ROLE_USER")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $imageEn = new Card();

        $form = $this->createForm(CardType::class, $imageEn);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

            $file = $imageEn->getBackgroundimage();
            ($imageEn->getBackgroundimage());
            $file1 = $imageEn->getFrondimage();
            ($imageEn->getFrondimage());

            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $fileName1 = md5(uniqid()).'.'.$file1->guessExtension();

            $file->move($this->getParameter('upload'), $fileName);
            $file1->move($this->getParameter('upload'), $fileName1);

            $imageEn->setBackgroundimage($fileName);
            $imageEn->setFrondimage($fileName1);
            $em->persist($imageEn);
            $em->flush();


            $this->addFlash(
                'info',
                'Card Succesvol Aangemaakt!'
            );

            return $this->redirectToRoute('card');

        }

        return $this->render('upload/upload.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/card/edit/{title}", name="edit_card", methods={"GET", "POST"})
     */
    public function edit_card($title, Request $request){
       $card = new Card();
       $card = $this->getDoctrine()->getRepository(Card::class)->find($title);

       $form = $this->createFormBuilder($card)
           ->add('title', TextType::class)
           ->add('customer', TextType::class)
           ->add('body', TextareaType::class)
           ->add('link', TextareaType::class)
           ->add('footer', TextareaType::class)
           ->add('backgroundimage', FileType::class, array('label'=>'Upload Background Image'))
           ->add('frondimage', FileType::class, array('label'=>'Upload Frond Image'))
           ->getform();

       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()) {

           $em = $this->getDoctrine()->getManager();
           $em->flush();

           return $this->redirectToRoute('card');
       }
       return $this->render('upload/editcard.html.twig', [
          'form' => $form->createView(),
           'title' => $title
       ]);
    }
}
