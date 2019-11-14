<?php

namespace App\Controller;

use App\Entity\Card;
use App\Form\CardType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/admin/card", name="card")
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
     * @Route("/admin/card/add_card", name="add_card")
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

            return $this->redirectToRoute('card');

        }

        return $this->render('upload/upload.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
